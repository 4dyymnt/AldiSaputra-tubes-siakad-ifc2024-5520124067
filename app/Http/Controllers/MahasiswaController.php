<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('npm', 'like', "%$search%");
        }
        $mahasiswa = $query->latest()->paginate(10)->withQueryString();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm'   => 'required|string|size:10|unique:mahasiswa,npm',
            'nama'  => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
        ], [
            'npm.required'   => 'NPM wajib diisi.',
            'npm.size'       => 'NPM harus tepat 10 karakter.',
            'npm.unique'     => 'NPM sudah terdaftar.',
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique'   => 'Email sudah terdaftar.',
        ]);

        Mahasiswa::create($request->only('npm', 'nama'));

        User::create([
            'name'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->npm), // default password = npm
            'role'     => 'mahasiswa',
            'npm'      => $request->npm,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan. Password default: NPM mahasiswa.');
    }

    public function show(Mahasiswa $mahasiswum)
    {
        $mahasiswum->load('krs.matakuliah');
        return view('mahasiswa.show', ['mahasiswa' => $mahasiswum]);
    }

    public function edit(Mahasiswa $mahasiswum)
    {
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswum]);
    }

    public function update(Request $request, Mahasiswa $mahasiswum)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ], [
            'nama.required' => 'Nama wajib diisi.',
        ]);

        $mahasiswum->update($request->only('nama'));

        // Update user name too
        User::where('npm', $mahasiswum->npm)->update(['name' => $request->nama]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswum)
    {
        User::where('npm', $mahasiswum->npm)->delete();
        $mahasiswum->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
