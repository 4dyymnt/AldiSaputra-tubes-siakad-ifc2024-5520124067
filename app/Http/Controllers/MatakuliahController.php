<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = Matakuliah::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_matakuliah', 'like', "%$search%")
                  ->orWhere('kode_matakuliah', 'like', "%$search%");
        }
        $matakuliah = $query->latest()->paginate(10)->withQueryString();
        return view('matakuliah.index', compact('matakuliah'));
    }

    public function create()
    {
        return view('matakuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matakuliah' => 'required|string|size:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah wajib diisi.',
            'kode_matakuliah.size'     => 'Kode mata kuliah harus tepat 8 karakter.',
            'kode_matakuliah.unique'   => 'Kode mata kuliah sudah ada.',
            'nama_matakuliah.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.min'                  => 'SKS minimal 1.',
            'sks.max'                  => 'SKS maksimal 6.',
        ]);

        Matakuliah::create($request->only('kode_matakuliah', 'nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function show(Matakuliah $matakuliah)
    {
        $matakuliah->load('jadwal.dosen');
        return view('matakuliah.show', compact('matakuliah'));
    }

    public function edit(Matakuliah $matakuliah)
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    public function update(Request $request, Matakuliah $matakuliah)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:50',
            'sks'             => 'required|integer|min:1|max:6',
        ]);

        $matakuliah->update($request->only('nama_matakuliah', 'sks'));
        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}
