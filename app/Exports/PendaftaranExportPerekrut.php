<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PendaftaranExportPerekrut implements FromView
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function view(): View
    {
        $pendaftaran = Pendaftaran::with(['user', 'lowongan.user'])
            ->whereHas('lowongan', function ($query) {
                $query->where('user_id', $this->userId);
            })->get();

        return view('pendaftaran.excel', compact('pendaftaran'));
    }
}
