<?php

namespace App\Exports;

use App\Models\Penggajian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenggajianExport implements FromCollection
{
    /**
     * Return all data penggajian untuk admin.
     */
    public function collection()
    {
        return Penggajian::all();
    }
}
