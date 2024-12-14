<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//models
use App\Models\JabatanModel;
use App\Models\User;
use App\Models\AbsensiModel;

class DashboardController
{
    public function index()
    {
        $jabatan = JabatanModel::all()->count();
        $karyawan_aktif = User::where('status', 1)->get()->count();
        $karyawan_non_aktif = User::where('status', 2)->get()->count();
        $absensi_today      = AbsensiModel::where('today_date', today()->toDateString())->get()->count();

        return view('dashboard', [
            'jabatan'           => $jabatan,
            'karyawan_aktif'    => $karyawan_aktif,
            'karyawan_non_aktif'=> $karyawan_non_aktif,
            'absensi_today'     => $absensi_today,
        ]);
    }
}
