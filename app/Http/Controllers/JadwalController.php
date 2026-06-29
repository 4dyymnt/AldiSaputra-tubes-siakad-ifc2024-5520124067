<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['matakuliah', 'dosen']);
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('matakuliah', fn($q) => $q->where('nama_matakuliah', 'like', "%$search%"))
                  ->orWhere('hari', 'like', "%$search%")
                  ->orWhere('kelas', 'like', "%$search%");
        }
        if ($request->filled('hari')) {
            $query->where('hari', $request->hari);
        }
        $jadwal = $query->latest()->paginate(10)->withQueryString();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $dosen      = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('jadwal.create', compact('dosen', 'matakuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1|in:A,B,C,D,E',
            'hari'            => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam'             => 'required',
        ], [
            'kode_matakuliah.required' => 'Mata kuliah wajib dipilih.',
            'kode_matakuliah.exists'   => 'Mata kuliah tidak ditemukan.',
            'nidn.required'            => 'Dosen wajib dipilih.',
            'nidn.exists'              => 'Dosen tidak ditemukan.',
            'kelas.required'           => 'Kelas wajib diisi.',
            'kelas.in'                 => 'Kelas hanya boleh A, B, C, D, atau E.',
            'hari.required'            => 'Hari wajib dipilih.',
            'hari.in'                  => 'Hari tidak valid.',
            'jam.required'             => 'Jam wajib diisi.',
        ]);

        Jadwal::create($request->only('kode_matakuliah', 'nidn', 'kelas', 'hari', 'jam'));
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(['matakuliah', 'dosen']);
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $dosen      = Dosen::all();
        $matakuliah = Matakuliah::all();
        return view('jadwal.edit', compact('jadwal', 'dosen', 'matakuliah'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|string|size:1|in:A,B,C,D,E',
            'hari'            => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'jam'             => 'required',
        ]);

        $jadwal->update($request->only('kode_matakuliah', 'nidn', 'kelas', 'hari', 'jam'));
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus.');
    }

    public function mahasiswaView()
    {
        $jadwal = Jadwal::with(['matakuliah', 'dosen'])->get()->groupBy('hari');
        return view('jadwal.mahasiswa', compact('jadwal'));
    }
}
