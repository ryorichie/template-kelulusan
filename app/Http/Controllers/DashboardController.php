<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $tahunAjaranList  = TahunAjaran::withCount('siswas')->latest()->take(5)->get();
        $tahunAktif       = TahunAjaran::all()->first(fn($t) => $t->isPengumumanAktif());
        $totalTahunAjaran = TahunAjaran::count();
        $totalSiswa       = Siswa::count();
        $totalLulus       = Siswa::where('status', 'Lulus')->count();
        $totalTidakLulus  = Siswa::where('status', 'Tidak Lulus')->count();

        return view('dashboard', compact(
            'tahunAjaranList',
            'tahunAktif',
            'totalTahunAjaran',
            'totalSiswa',
            'totalLulus',
            'totalTidakLulus'
        ));
    }
}
