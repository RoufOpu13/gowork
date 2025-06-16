<?php

namespace App\Http\Controllers;

use App\Exports\PendaftaranExport;
use App\Exports\PendaftaranExportPerekrut;
use App\Models\Lowongan;
use App\Models\Pendaftaran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class PendaftaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with(['user', 'lowongan.user']);

        // Filter pencarian umum
        if (request()->filled('search')) {
            $search = request()->search;
            $pendaftaran->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('id', $search);
                })->orWhereHas('lowongan', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($q2) use ($search) {
                            $q2->where('name', 'like', '%' . $search . '%');
                        });
                })->orWhere('pengalaman', 'like', '%' . $search . '%')
                    ->orWhere('keahlian', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_pendaftaran', 'like', '%' . $search . '%');
            });
        }

        // Filter tanggal
        if (request()->filled('tanggal_mulai') && request()->filled('tanggal_selesai')) {
            $pendaftaran->whereBetween('tanggal_pendaftaran', [
                request('tanggal_mulai'),
                request('tanggal_selesai')
            ]);
        }

        // Filter berdasarkan perekrut_id (khusus Admin)
        if ($user->roles === 'Admin' && request()->filled('perekrut_id')) {
            $pendaftaran->whereHas('lowongan', function ($query) {
                $query->where('user_id', request('perekrut_id'));
            });
        }

        // Role-based filtering
        if ($user->roles === 'Admin') {
            $pendaftaran = $pendaftaran->orderBy('tanggal_pendaftaran', 'desc')->paginate(5);
        } elseif ($user->roles === 'Perekrut') {
            $pendaftaran = $pendaftaran->whereHas('lowongan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('tanggal_pendaftaran', 'desc')->paginate(5);
        } else {
            $pendaftaran = $pendaftaran->where('user_id', $user->id)
                ->orderBy('tanggal_pendaftaran', 'desc')->paginate(5);
        }

        // Ambil data perekrut untuk dropdown
        $perekruts = User::where('roles', 'Perekrut')->get();

        return view('pendaftaran.index', compact('pendaftaran', 'perekruts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    public function create()
    {
        $users = User::where('roles', 'Pekerja')->get();
        $lowongans = Lowongan::where('status', '!=', 'Ditutup')->get();
        return view('pendaftaran.create', compact('users', 'lowongans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'pengalaman' => 'nullable|string',
            'keahlian' => 'nullable|string',
        ]);

        $data = $request->only(['user_id', 'lowongan_id', 'pengalaman', 'keahlian']);
        $data['status'] = 'Menunggu';
        $data['tanggal_pendaftaran'] = now()->toDateString();

        Pendaftaran::create($data);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $lowongans = Lowongan::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'lowongans'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'pengalaman' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
            'tanggal_pendaftaran' => 'required|date',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus');
    }

    public function exportExcel()
    {
        $user = Auth::user();

        if ($user->roles === 'Pekerja') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }

        if ($user->roles === 'Admin') {
            return Excel::download(new PendaftaranExport, 'pendaftaran.xlsx');
        } elseif ($user->roles === 'Perekrut') {
            return Excel::download(new PendaftaranExportPerekrut($user->id), 'pendaftaran.xlsx');
        } else {
            abort(403, 'Role tidak dikenali.');
        }
    }


    public function print($id)
    {
        $daftar = Pendaftaran::with(['user', 'lowongan.user'])->findOrFail($id);

        $user = Auth::user();
        if ($user->roles === 'Pekerja' && $daftar->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mencetak pendaftaran ini.');
        }

        if ($user->roles === 'Perekrut' && $daftar->lowongan->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mencetak pendaftaran ini.');
        }

        $pdf = Pdf::loadView('pendaftaran.print', compact('daftar'));

        $filename = 'pendaftaran_' . $daftar->id . '.pdf';

        // Langsung download
        return $pdf->download($filename);
    }


    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        if ($user->roles === 'Pekerja') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }

        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');
        $perekrutId = $request->input('perekrut_id');

        $query = Pendaftaran::with(['user', 'lowongan.user']);

        if ($tanggalMulai && $tanggalSelesai) {
            $query->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalSelesai]);
        }

        if ($user->roles === 'Admin') {
            if ($perekrutId) {
                $query->whereHas('lowongan', function ($q) use ($perekrutId) {
                    $q->where('user_id', $perekrutId);
                });
            }
            $pendaftarans = $query->orderBy('tanggal_pendaftaran')->get();
        } elseif ($user->roles === 'Perekrut') {
            $pendaftarans = $query->whereHas('lowongan', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->orderBy('tanggal_pendaftaran')->get();
        } else {
            abort(403, 'Role tidak dikenali.');
        }

        $pdf = Pdf::loadView('pendaftaran.pdf_sesuai_tanggal', [
            'pendaftarans' => $pendaftarans,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan_pendaftaran.pdf');
    }



    public function terima($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'Diterima';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran telah diterima.');
    }



    public function tolak($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'Ditolak';
        $pendaftaran->save();

        return redirect()->back()->with('error', 'Pendaftaran telah ditolak.');
    }
}
