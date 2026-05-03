<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\TahunAjaran;

class KelulusanController extends Controller
{
    public function index()
    {
        // Ambil tahun ajaran yang sedang aktif (berdasarkan tanggal hari ini)
        $tahun = TahunAjaran::whereDate('tanggal_mulai_pengumuman', '<=', now())
            ->whereDate('tanggal_selesai_pengumuman', '>=', now())
            ->first();

        // Kalau belum masuk periode
        if (!$tahun) {
            return view('kelulusan', [
                'data' => collect(),
                'periode' => null
            ]);
        }

        // Ambil siswa hanya untuk tahun ajaran tersebut
        $data = Siswa::with('tahunAjaran')->where('tahun_ajaran_id', $tahun->id)->get();

        return view('kelulusan', [
            'data' => $data,
            'periode' => [
                'mulai' => $tahun->tanggal_mulai_pengumuman,
                'selesai' => $tahun->tanggal_selesai_pengumuman,
                'nama' => $tahun->nama
            ]
        ]);
    }
}
