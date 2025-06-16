<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Manajemen;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data dasar untuk semua role
        $data = [
            'users' => User::count(),
            'lowongans' => Lowongan::count(),
            'manajemens' => Manajemen::count(),
            'pendaftarans' => Pendaftaran::count()
        ];

        // Data tambahan berdasarkan role
        switch (Auth::user()->roles) {
            case 'Admin':
                $data['totalRecruiters'] = User::where('roles', 'Perekrut')->count();
                $data['totalWorkers'] = User::where('roles', 'Pekerja')->count();
                $data['activeJobs'] = Lowongan::where('status', 'aktif')->count();
                $data['registrationData'] = $this->getRegistrationData();
                break;

            case 'Perekrut':
                $data['lowongans'] = Lowongan::where('user_id', Auth::id())->count();
                $data['pendaftarans'] = Pendaftaran::whereHas('lowongan', function($query) {
                    $query->where('user_id', Auth::id());
                })->count();
                $data['activeJobs'] = Lowongan::where('user_id', Auth::id())
                                        ->where('status', 'aktif')
                                        ->count();
                break;

            case 'Pekerja':
                $data['pendaftarans'] = Pendaftaran::where('user_id', Auth::id())->count();
                break;
        }

        return view('dashboard', $data);
    }

    private function getRegistrationData()
    {
        // Data 6 bulan terakhir
        $months = [];
        $counts = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->translatedFormat('F');
            $counts[] = Pendaftaran::whereMonth('tanggal_pendaftaran', $date->month)
                            ->whereYear('tanggal_pendaftaran', $date->year)
                            ->count();
        }

        return [
            'months' => $months,
            'counts' => $counts,
            'status' => [
                'menunggu' => Pendaftaran::where('status', 'menunggu')->count(),
                'diterima' => Pendaftaran::where('status', 'diterima')->count(),
                'ditolak' => Pendaftaran::where('status', 'ditolak')->count()
            ]
        ];
    }
}