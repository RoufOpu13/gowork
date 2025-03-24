<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login
    
        // Query dasar dengan relasi
        $pendaftaran = Pendaftaran::with(['user', 'lowongan.user']);
    
        // Pencarian berdasarkan atribut tertentu
        if (request()->has('search')) {
            $search = request()->search;
            $pendaftaran->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%') // Cari berdasarkan nama pekerja
                      ->orWhere('id', $search); // Cari berdasarkan user_id
                })->orWhereHas('lowongan', function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%') // Cari berdasarkan nama lowongan
                      ->orWhereHas('user', function ($q2) use ($search) {
                          $q2->where('name', 'like', '%' . $search . '%'); // Cari berdasarkan nama perekrut
                      });
                })->orWhere('pengalaman', 'like', '%' . $search . '%') // Cari berdasarkan pengalaman
                  ->orWhere('keahlian', 'like', '%' . $search . '%') // Cari berdasarkan keahlian
                  ->orWhere('status', 'like', '%' . $search . '%'); // Cari berdasarkan status
            });
        }
    
        // Filter berdasarkan roles pengguna
        if ($user->roles == 'Admin') {
            // Admin melihat semua pendaftaran
            $pendaftaran = $pendaftaran->paginate(5);
        } elseif ($user->roles == 'Perekrut') {
            // Perekrut hanya melihat pendaftaran yang terkait dengan lowongan yang dibuatnya
            $pendaftaran = $pendaftaran
                ->whereHas('lowongan', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->paginate(5);
        } else {
            // Pekerja hanya melihat pendaftaran yang dia buat sendiri
            $pendaftaran = $pendaftaran
                ->where('user_id', $user->id)
                ->paginate(5);
        }
    
        return view('pendaftaran.index', compact('pendaftaran'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('roles', 'Pekerja')->get(); // Hanya ambil pekerja
        $lowongans = Lowongan::where('status', '!=', 'Ditutup')->get();
        return view('pendaftaran.create', compact('users', 'lowongans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'pengalaman' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $lowongans = Lowongan::all(); // Ambil semua lowongan
        return view('pendaftaran.edit', compact('pendaftaran', 'lowongans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'pengalaman' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus');
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
