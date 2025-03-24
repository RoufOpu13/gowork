<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Manajemen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Filter berdasarkan role
        $manajemenQuery = Manajemen::with(['lowongans', 'users']);
    
        if ($user->roles === 'Perekrut') {
            $manajemenQuery->whereHas('lowongans', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } elseif ($user->roles === 'Pekerja') {
            $manajemenQuery->where('user_id', $user->id);
        }
    
        // Tambahkan pencarian jika ada
        if (request()->has('search')) {
            $manajemenQuery->whereHas('users', function ($query) {
                $query->where('name', 'like', '%' . request()->search . '%');
            });
        }
    
        // Paginate hasilnya
        $manajemen = $manajemenQuery->paginate(10);
    
        return view('manajemen.index', compact('manajemen'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
    
        if ($user->roles === 'Perekrut') {
            // Ambil pekerja yang status pendaftarannya "Diterima" dan lowongan dari perekrut yang login
            $users = User::where('roles', 'Pekerja')
                ->whereHas('pendaftarans', function ($query) use ($user) {
                    $query->whereHas('lowongan', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->where('status', 'Diterima'); // Hanya yang "Diterima"
                })->get();
            
            // Ambil lowongan dari perekrut yang login
            $lowongans = Lowongan::where('user_id', $user->id)->get();
        } else {
            // Admin bisa melihat semua pekerja dan lowongan terbuka
            $users = User::where('roles', 'Pekerja')->get();
            $lowongans = Lowongan::where('status', '!=', 'Ditutup')->get();
        }
    
        return view('manajemen.create', compact('users', 'lowongans'));
    }
    
    
    
    
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'lowongan_id' => 'required|exists:lowongans,id',
            'jenis_kontrak' => 'required|in:harian,mingguan,bulanan,proyek',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,selesai,diberhentikan',
            'catatan' => 'nullable|string',
        ]);
        
        Manajemen::create($request->all());
        
        return redirect()->route('manajemen.index')->with('success', 'Data manajemen berhasil ditambahkan');
        
        
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
    public function edit(string $id)
    {
        $manajemen = Manajemen::findOrFail($id);
        return view('manajemen.edit', compact('manajemen'));
        
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
        {
            $manajemen = Manajemen::findOrFail($id);
    $manajemen->update($request->all());
    return redirect()->route('manajemen.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manajemen = Manajemen::findOrFail($id);
        $manajemen->delete();
        return redirect()->route('manajemen.index')->with('success', 'Manajemen berhasil dihapus');
    }

    public function getLowongan($user_id)
    {
        $user = Auth::user();
    
        // Ambil lowongan yang dibuat oleh perekrut yang login dan diterima
        $lowongans = Lowongan::where('user_id', $user->id)
            ->whereHas('pendaftarans', function ($query) use ($user_id) {
                $query->where('user_id', $user_id)
                      ->where('status', 'Diterima'); // Hanya yang statusnya "Diterima"
            })->get();
    
        return response()->json($lowongans);
    }
    
    

}
