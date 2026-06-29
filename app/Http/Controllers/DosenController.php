<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('nidn', 'like', "%$search%");
        }
        $dosen = $query->latest()->paginate(10)->withQueryString();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|string|size:10|unique:dosen,nidn',
            'nama' => 'required|string|max:50',
        ], [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.size'     => 'NIDN harus tepat 10 karakter.',
            'nidn.unique'   => 'NIDN sudah terdaftar.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.max'      => 'Nama maksimal 50 karakter.',
        ]);

        Dosen::create($request->only('nidn', 'nama'));
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max'      => 'Nama maksimal 50 karakter.',
        ]);

        $dosen->update($request->only('nama'));
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
