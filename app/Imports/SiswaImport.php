<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    protected $tahunAjaranId;

    public function __construct($tahunAjaranId)
    {
        $this->tahunAjaranId = $tahunAjaranId;
    }

    public function model(array $row)
    {
        if (!array_filter($row)) {
        return null;
    }
        return new Siswa([
            'tahun_ajaran_id' => $this->tahunAjaranId,
            'nis'             => $row['nis'],
            'nama'            => $row['nama'],
            'jenis_kelamin'   => $row['jenis_kelamin'],
            'kelas'           => $row['kelas'],
            'status'          => $row['status'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nis' => [
                'required',
                Rule::unique('siswas')->where(fn ($q) =>
                    $q->where('tahun_ajaran_id', $this->tahunAjaranId)
                )
            ],
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required',
            'status' => 'required|in:Lulus,Tidak Lulus',
        ];
    }
}
