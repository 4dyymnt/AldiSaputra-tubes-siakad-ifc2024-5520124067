<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $data = [
                'totalDosen'      => Dosen::count(),
                'totalMahasiswa'  => Mahasiswa::count(),
                'totalMatakuliah' => Matakuliah::count(),
                'totalJadwal'     => Jadwal::count(),
                'totalKrs'        => Krs::count(),
                'recentJadwal'    => Jadwal::with(['matakuliah', 'dosen'])->latest()->take(5)->get(),
            ];
            return view('dashboard.admin', $data);
        }

        // Mahasiswa dashboard
        $npm  = $user->npm;
        $mahasiswa = Mahasiswa::find($npm);
        $krs  = Krs::with('matakuliah')->where('npm', $npm)->get();
        $totalSks = $krs->sum(fn($k) => $k->matakuliah->sks ?? 0);

        return view('dashboard.mahasiswa', compact('mahasiswa', 'krs', 'totalSks'));
    }
}
