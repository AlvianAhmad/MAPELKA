<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */

    public function admin()
    {
        return view('dashboard.admin');
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Pelatih
    |--------------------------------------------------------------------------
    */

    public function pelatih()
    {
        return view('dashboard.pelatih');
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Karyawan
    |--------------------------------------------------------------------------
    */

    public function karyawanDashboard()
    {
        // Ambil semua data materi beserta data pelatihnya
        $materis = Materi::with('user')->get();

        // Ambil semua sertifikat milik user yang sedang login
        $sertifikats = Certificate::where('user_id', Auth::id())->get();

        // Kirim data ke view
        return view('dashboard.karyawan', compact('materis', 'sertifikats'));
    }
}
