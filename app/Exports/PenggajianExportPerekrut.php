<?php

namespace App\Exports;

use App\Models\Penggajian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenggajianExportPerekrut implements FromCollection
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Return data penggajian milik perekrut tertentu.
     */
    public function collection()
    {
        return Penggajian::where('user_id', $this->userId)->get();
    }
}
