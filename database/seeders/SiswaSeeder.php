<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Siswa;
use App\Models\TahunAjaran;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $tahun = TahunAjaran::first();

        Siswa::create([
            'nis' => '12345',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'kelas' => 'IX A',
            'tahun_ajaran_id' => $tahun->id,
            'status' => 'lulus'
        ]);

        Siswa::create([
            'nis' => '12346',
            'nama' => 'Siti Aminah',
            'jenis_kelamin' => 'P',
            'kelas' => 'IX B',
            'tahun_ajaran_id' => $tahun->id,
            'status' => 'Tidak Lulus'
        ]);
    }
}
