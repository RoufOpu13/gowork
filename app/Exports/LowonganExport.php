<?php

namespace App\Exports;

use App\Models\Lowongan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LowonganExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Lowongan::select('judul', 'deskripsi', 'kategori', 'lokasi', 'gaji', 'status')->get();
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Deskripsi',
            'Kategori',
            'Lokasi',
            'Gaji',
            'Status',
        ];
    }
}
