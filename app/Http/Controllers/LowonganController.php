<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $lowongans = Lowongan::when(request()->search, function ($lowongan) {
            $lowongan = $lowongan->where('name', 'like', '%' . request()->search . '%');
        })->paginate(5);

        $user = Auth::user();
        if (in_array($user->roles, ['Admin', 'Pekerja'])) {
            // Admin dan Pekerja melihat semua lowongan
            $lowongans = Lowongan::with('user')->paginate(10);
        } else {
            // Pengguna biasa hanya melihat lowongan yang dia buat sendiri
            $lowongans = Lowongan::with('user')->where('user_id', $user->id)->paginate(10);
        }
        return view('lowongan.index', compact('lowongans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:100',
            'status' => 'required|in:Aktif,Ditutup',
        ]);

        // Simpan data dengan user yang sedang login
        Lowongan::create([
            'user_id' => Auth::id(), // Menyimpan ID pengguna yang login
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi ?? 'Tidak Diketahui', // Jika tidak ada input lokasi
            'gaji' => $request->gaji ?? 0, // Jika tidak ada input gaji, set ke 0
            'status' => $request->status,  // Default status aktif
        ]);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('lowongan.show', compact('lowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lowongan = Lowongan::findOrFail($id);
        // Debugging: Cek apakah data ada
        return view('lowongan.edit', compact('lowongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'gaji' => 'required|numeric|min:0',
            'status' => 'required|in:Aktif,Ditutup',
        ]);

        $lowongans = Lowongan::findOrFail($id);
        $lowongans->update($request->all());
        $lowongans->update($request->all());
        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil dihapus');
    }
}
