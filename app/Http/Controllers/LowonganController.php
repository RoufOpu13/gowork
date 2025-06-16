<?php

namespace App\Http\Controllers;

use App\Exports\LowonganExport;
use App\Exports\LowonganExportPerekrut;
use App\Models\Lowongan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $query = Lowongan::with('user');

        // Search filter
        if ($search = request('search')) {
    $query->where(function ($q) use ($search) {
        $q->where('lokasi', 'like', '%' . $search . '%') // Filter lokasi saja
          ->orWhereHas('user', function ($q2) use ($search) {
              $q2->where('name', 'like', '%' . $search . '%');
          });
    });
}



        // Status filter
        if ($status = request('status')) {
            if ($status !== 'Semua') {
                $query->where('status', $status);
            }
        }

        // Role based access
        if (!in_array($user->roles, ['Admin', 'Pekerja'])) {
            // Non Admin/Pekerja hanya bisa lihat lowongan milik sendiri
            $query->where('user_id', $user->id);
        }

        $lowongans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Calculate pagination number offset
        $i = ($lowongans->currentPage() - 1) * $lowongans->perPage();

        return view('lowongan.index', compact('lowongans', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (!in_array($user->roles, ['Admin', 'Perekrut'])) {
            abort(403, 'Unauthorized action.');
        }

        return view('lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!in_array($user->roles, ['Admin', 'Perekrut'])) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'gaji' => 'required|numeric|min:0',
            'status' => 'required|in:Aktif,Ditutup',
        ]);

        $validated['user_id'] = $user->id;

        Lowongan::create($validated);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lowongan $lowongan)
    {
        $user = Auth::user();

        if (!in_array($user->roles, ['Admin', 'Perekrut']) || ($user->id !== $lowongan->user_id && $user->roles !== 'Admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('lowongan.edit', compact('lowongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lowongan $lowongan)
    {
        $user = Auth::user();

        if (!in_array($user->roles, ['Admin', 'Perekrut']) || ($user->id !== $lowongan->user_id && $user->roles !== 'Admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'gaji' => 'required|numeric|min:0',
            'status' => 'required|in:Aktif,Ditutup',
        ]);

        $lowongan->update($validated);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lowongan $lowongan)
    {
        $user = Auth::user();

        if (!in_array($user->roles, ['Admin', 'Perekrut']) || ($user->id !== $lowongan->user_id && $user->roles !== 'Admin')) {
            abort(403, 'Unauthorized action.');
        }

        $lowongan->delete();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    /**
     * Export lowongan ke PDF.
     */
    public function exportPdf()
    {
        $user = Auth::user();

        if ($user->roles === 'Admin') {
            $lowongans = Lowongan::with('user')->orderBy('created_at', 'desc')->get();
        } else if ($user->roles === 'Perekrut') {
            $lowongans = Lowongan::with('user')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        } else {
            abort(403, 'Unauthorized action.');
        }

        $pdf = Pdf::loadView('lowongan.export_pdf', compact('lowongans', 'user'));
        return $pdf->download('lowongan_export.pdf');
    }

    /**
     * Export lowongan ke Excel.
     */
    public function exportExcel()
    {
        $user = Auth::user();

        if ($user->roles === 'Admin') {
            return Excel::download(new LowonganExport, 'lowongan_export.xlsx');
        } else if ($user->roles === 'Perekrut') {
            return Excel::download(new LowonganExportPerekrut($user->id), 'lowongan_export_perekrut.xlsx');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
