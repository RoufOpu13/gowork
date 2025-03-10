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
        $pendaftaran = Pendaftaran::when(request()->search, function ($pendaftaran) {
            $pendaftaran = $pendaftaran->where('name', 'like', '%' . request()->search . '%');
        })->paginate(5);
        $user = Auth::user();

        if ($user->roles == 'Admin') {
            // Admin melihat semua pendaftaran
            $pendaftaran = Pendaftaran::with(['user', 'lowongan.user'])->paginate(10);
        } elseif ($user->roles == 'Perekrut') {
            // Perekrut hanya melihat pendaftaran yang terkait dengan lowongan yang dibuatnya
            $pendaftaran = Pendaftaran::with(['user', 'lowongan.user'])
                ->whereHas('lowongan', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->paginate(10);
        } else {
            // Pekerja hanya melihat pendaftaran yang dia buat sendiri
            $pendaftaran = Pendaftaran::with(['user', 'lowongan.user'])
                ->where('user_id', $user->id)
                ->paginate(10);
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
