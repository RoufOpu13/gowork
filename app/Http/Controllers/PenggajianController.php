<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PenggajianExport;
use App\Exports\PenggajianExportPerekrut;
use App\Models\Lowongan;
use App\Models\Manajemen;
use Barryvdh\DomPDF\Facade\Pdf;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Contoh pencarian: (pastikan pencarian sesuai dengan kolom pada tabel penggajian)
        $penggajian = Penggajian::when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%');
        })->paginate(5);

        return view('penggajian.index', compact('penggajian'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user(); // Perekrut yang login

        // Ambil pekerja aktif yang dimanajemen oleh Perekrut ini
        $manajemens = Manajemen::with(['user', 'lowongan'])
            ->where('status', 'aktif')
            ->whereHas('lowongan', function ($query) use ($user) {
                $query->where('created_by', $user->id);
            })
            ->get();

        return view('penggajian.create', compact('manajemens'));
    }

    public function getLowonganByUser($user_id)
    {
        // Cek apakah user ini memiliki status manajemen aktif
        $aktif = Manajemen::where('user_id', $user_id)->where('status', 'aktif')->exists();

        if (!$aktif) {
            return response()->json([]); // tidak ada lowongan jika manajemen tidak aktif
        }

        // Ambil lowongan yang dibuat oleh user (misal user_id = created_by)
        $lowongans = Lowongan::where('created_by', $user_id)->get();

        return response()->json($lowongans);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'gaji' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'status' => 'required|in:Belum Dibayar,Sudah Dibayar',
        ]);

        $manajemenAktif = Manajemen::where('user_id', $validated['user_id'])
            ->where('status', 'aktif')
            ->exists();

        if (!$manajemenAktif) {
            return back()->withErrors(['user_id' => 'User ini tidak memiliki manajemen aktif.'])->withInput();
        }

        // ✅ Perbaikan di sini
        $lowonganValid = Lowongan::where('id', $validated['lowongan_id'])
            ->where('created_by', $validated['user_id'])
            ->exists();

        if (!$lowonganValid) {
            return back()->withErrors(['lowongan_id' => 'Lowongan ini tidak dimiliki oleh user yang dipilih.'])->withInput();
        }

        Penggajian::create($validated);

        return redirect()->route('penggajian.index')->with('success', 'Data penggajian berhasil disimpan');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Implementasi jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Contoh:
        // $penggajian = Penggajian::findOrFail($id);
        // return view('penggajian.edit', compact('penggajian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi dan perbarui data penggajian
        // Contoh:
        // $penggajian = Penggajian::findOrFail($id);
        // $penggajian->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->delete();
        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil dihapus');
    }

    /**
     * Export data penggajian ke PDF.
     */
    public function exportPdf()
    {
        $user = Auth::user();

        // Hanya Admin dan Perekrut yang dapat ekspor
        if ($user->roles === 'Pekerja') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }

        if ($user->roles === 'Admin') {
            // Admin mengekspor seluruh data
            $penggajian = Penggajian::all();
        } elseif ($user->roles === 'Perekrut') {
            // Perekrut hanya mengekspor data miliknya (misalnya berdasarkan user_id)
            $penggajian = Penggajian::where('user_id', $user->id)->get();
        } else {
            abort(403, 'Role tidak dikenali.');
        }

        $pdf = Pdf::loadView('penggajian.export-pdf', compact('penggajian'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('penggajian.pdf');
    }

    /**
     * Export data penggajian ke Excel.
     */
    public function exportExcel()
    {
        $user = Auth::user();

        if ($user->roles === 'Pekerja') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }

        if ($user->roles === 'Admin') {
            return Excel::download(new PenggajianExport, 'penggajian.xlsx');
        } elseif ($user->roles === 'Perekrut') {
            return Excel::download(new PenggajianExportPerekrut($user->id), 'penggajian.xlsx');
        } else {
            abort(403, 'Role tidak dikenali.');
        }
    }
}
