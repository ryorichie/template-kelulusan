<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjarans = TahunAjaran::withCount('siswas')->latest()->get();

        return view('tahun-ajaran.index', compact('tahunAjarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'                        => ['required', 'string', 'max:20', 'unique:tahun_ajarans,nama'],
            'tanggal_mulai_pengumuman'    => ['required', 'date'],
            'tanggal_selesai_pengumuman'  => ['required', 'date', 'after:tanggal_mulai_pengumuman'],
        ], [
            'nama.unique'                           => 'Tahun ajaran ini sudah ada.',
            'tanggal_selesai_pengumuman.after'      => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        TahunAjaran::create($request->only([
            'nama',
            'tanggal_mulai_pengumuman',
            'tanggal_selesai_pengumuman',
        ]));

        return redirect()->route('tahun-ajaran.index')
                         ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function show(TahunAjaran $tahunAjaran, Request $request)
    {
        $query = $tahunAjaran->siswas()->orderBy('kelas')->orderBy('nama');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        $siswas          = $query->paginate(15)->withQueryString();
        $totalLulus      = $tahunAjaran->siswas()->where('status', 'Lulus')->count();
        $totalTidakLulus = $tahunAjaran->siswas()->where('status', 'Tidak Lulus')->count();

        return view('tahun-ajaran.show', compact('tahunAjaran', 'siswas', 'totalLulus', 'totalTidakLulus'));
    }

    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        $request->validate([
            'nama'                       => ['required', 'string', 'max:20', "unique:tahun_ajarans,nama,{$tahunAjaran->id}"],
            'tanggal_mulai_pengumuman'   => ['required', 'date'],
            'tanggal_selesai_pengumuman' => ['required', 'date', 'after:tanggal_mulai_pengumuman'],
        ], [
            'nama.unique'                       => 'Tahun ajaran ini sudah ada.',
            'tanggal_selesai_pengumuman.after'  => 'Tanggal selesai harus setelah tanggal mulai.',
        ]);

        $tahunAjaran->update($request->only([
            'nama',
            'tanggal_mulai_pengumuman',
            'tanggal_selesai_pengumuman',
        ]));

        return redirect()->route('tahun-ajaran.index')
                         ->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->delete(); // cascade delete siswa otomatis

        return redirect()->route('tahun-ajaran.index')
                         ->with('success', 'Tahun ajaran beserta data siswa berhasil dihapus.');
    }
}

