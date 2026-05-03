<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        TahunAjaran::create([
            'nama' => '2026/2027',
            'tanggal_mulai_pengumuman' => '2026-04-02',
            'tanggal_selesai_pengumuman' => '2026-12-08',
        ]);
    }
}
