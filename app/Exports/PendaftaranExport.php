<?php
namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PendaftaranExport implements FromView
{
    public function view(): View
    {
        $pendaftaran = Pendaftaran::with(['user', 'lowongan.user'])->get();
        return view('pendaftaran.excel', compact('pendaftaran'));
    }
}

