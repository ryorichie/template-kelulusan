<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $fillable = [
        'nama',
        'tanggal_mulai_pengumuman',
        'tanggal_selesai_pengumuman'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    // helper untuk cek apakah pengumuman aktif
    public function isPengumumanAktif()
    {
        return now()->between(
            $this->tanggal_mulai_pengumuman,
            $this->tanggal_selesai_pengumuman
        );
    }
}
