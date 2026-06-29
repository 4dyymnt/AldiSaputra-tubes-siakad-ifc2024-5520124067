<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    // Mahasiswa: lihat & ambil KRS sendiri
    public function index()
    {
        $npm        = Auth::user()->npm;
        $mahasiswa  = Mahasiswa::find($npm);
        $krs        = Krs::with('matakuliah')->where('npm', $npm)->get();
        $sudahAmbil = $krs->pluck('kode_matakuliah')->toArray();
        $matakuliah = Matakuliah::whereNotIn('kode_matakuliah', $sudahAmbil)->get();
        $totalSks   = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        return view('krs.index', compact('mahasiswa', 'krs', 'matakuliah', 'totalSks'));
    }

    public function store(Request $request)
    {
        $npm = Auth::user()->npm;

        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
        ], [
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'kode_matakuliah.exists'   => 'Mata kuliah tidak ditemukan.',
        ]);

        // Cek duplikasi
        $exists = Krs::where('npm', $npm)
                     ->where('kode_matakuliah', $request->kode_matakuliah)
                     ->exists();

        if ($exists) {
            return back()->with('error', 'Mata kuliah sudah ada di KRS Anda.');
        }

        // Cek batas SKS (max 24)
        $krs = Krs::with('matakuliah')->where('npm', $npm)->get();
        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);
        $newMk = Matakuliah::find($request->kode_matakuliah);
        if ($totalSks + $newMk->sks > 24) {
            return back()->with('error', 'Total SKS melebihi batas maksimum (24 SKS).');
        }

        Krs::create(['npm' => $npm, 'kode_matakuliah' => $request->kode_matakuliah]);
        return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS.');
    }

    public function destroy($id)
    {
        $npm = Auth::user()->npm;
        $krs = Krs::where('id', $id)->where('npm', $npm)->firstOrFail();
        $krs->delete();
        return back()->with('success', 'Mata kuliah berhasil di-drop dari KRS.');
    }

    // Admin: lihat semua KRS
    public function adminIndex(Request $request)
    {
        $query = Mahasiswa::with('krs.matakuliah');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")->orWhere('npm', 'like', "%$search%");
        }
        $mahasiswa = $query->paginate(10)->withQueryString();
        return view('krs.admin', compact('mahasiswa'));
    }

    public function showByMahasiswa($npm)
    {
        $mahasiswa = Mahasiswa::with('krs.matakuliah')->findOrFail($npm);
        return view('krs.detail', compact('mahasiswa'));
    }
}
