<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class SiswaController extends Controller
{
    public function store(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'nis'           => ['required', 'string', 'max:20',
                                // NIS unik per tahun ajaran
                                \Illuminate\Validation\Rule::unique('siswas')->where(fn($q) =>
                                    $q->where('tahun_ajaran_id', $tahunAjaran->id)
                                )],
            'nama'          => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'kelas'         => ['required', 'string', 'max:10'],
            'status'        => ['required', 'in:Lulus,Tidak Lulus'],
        ], [
            'nis.unique' => 'NIS ini sudah terdaftar di tahun ajaran yang sama.',
        ]);

        $tahunAjaran->siswas()->create($request->only([
            'nis', 'nama', 'jenis_kelamin', 'kelas', 'status',
        ]));

        return redirect()->route('tahun-ajaran.show', $tahunAjaran)
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, TahunAjaran $tahunAjaran, Siswa $siswa)
    {
        $request->validate([
            'nis'           => ['required', 'string', 'max:20',
                                \Illuminate\Validation\Rule::unique('siswas')
                                    ->where(fn($q) => $q->where('tahun_ajaran_id', $tahunAjaran->id))
                                    ->ignore($siswa->id)],
            'nama'          => ['required', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'kelas'         => ['required', 'string', 'max:10'],
            'status'        => ['required', 'in:Lulus,Tidak Lulus'],
        ], [
            'nis.unique' => 'NIS ini sudah terdaftar di tahun ajaran yang sama.',
        ]);

        $siswa->update($request->only([
            'nis', 'nama', 'jenis_kelamin', 'kelas', 'status',
        ]));

        return redirect()->route('tahun-ajaran.show', $tahunAjaran)
                         ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran, Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('tahun-ajaran.show', $tahunAjaran)
                         ->with('success', 'Data siswa berhasil dihapus.');
    }



    public function import(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        try {
            Excel::import(new SiswaImport($tahunAjaran->id), $request->file('file'));


            return redirect()->route('tahun-ajaran.show', $tahunAjaran)
                ->with('success', 'Import data siswa berhasil.');

        } catch (ValidationException $e) {

            $failures = $e->failures();

            $errors = [];

            foreach ($failures as $failure) {
                $errors[] = [
                    'row' => $failure->row(), // baris ke berapa
                    'attribute' => $failure->attribute(), // kolom
                    'errors' => $failure->errors(), // pesan error
                    'values' => $failure->values(), // isi row
                ];
            }

            return redirect()->back()->with('import_errors', $errors);
        }
    }
}

