@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <small class="text-muted">Selamat datang, {{ auth()->user()->name }}</small>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#1e40af,#3b82f6)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem;opacity:0.8">Total Dosen</div>
                    <div style="font-size:2rem;font-weight:700">{{ $totalDosen }}</div>
                </div>
                <i class="bi bi-person-badge fs-2 opacity-50"></i>
            </div>
            <a href="{{ route('dosen.index') }}" class="text-white-50" style="font-size:0.8rem">Lihat semua →</a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#059669,#10b981)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem;opacity:0.8">Total Mahasiswa</div>
                    <div style="font-size:2rem;font-weight:700">{{ $totalMahasiswa }}</div>
                </div>
                <i class="bi bi-people fs-2 opacity-50"></i>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="text-white-50" style="font-size:0.8rem">Lihat semua →</a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#7c3aed,#a78bfa)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem;opacity:0.8">Mata Kuliah</div>
                    <div style="font-size:2rem;font-weight:700">{{ $totalMatakuliah }}</div>
                </div>
                <i class="bi bi-book fs-2 opacity-50"></i>
            </div>
            <a href="{{ route('matakuliah.index') }}" class="text-white-50" style="font-size:0.8rem">Lihat semua →</a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background: linear-gradient(135deg,#dc2626,#f87171)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div style="font-size:0.8rem;opacity:0.8">Total KRS</div>
                    <div style="font-size:2rem;font-weight:700">{{ $totalKrs }}</div>
                </div>
                <i class="bi bi-journal-check fs-2 opacity-50"></i>
            </div>
            <a href="{{ route('krs.admin') }}" class="text-white-50" style="font-size:0.8rem">Lihat semua →</a>
        </div>
    </div>
</div>

<!-- Recent Jadwal -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-calendar3 me-2 text-primary"></i>Jadwal Terbaru</h6>
        <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentJadwal as $j)
                <tr>
                    <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td><span class="badge bg-primary">{{ $j->kelas }}</span></td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
