@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <small class="text-muted">Selamat datang, {{ auth()->user()->name }}</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#1e40af,#3b82f6)">
            <div style="font-size:0.8rem;opacity:0.8">NPM</div>
            <div style="font-size:1.4rem;font-weight:700">{{ $mahasiswa->npm ?? '-' }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#059669,#10b981)">
            <div style="font-size:0.8rem;opacity:0.8">Mata Kuliah Diambil</div>
            <div style="font-size:2rem;font-weight:700">{{ $krs->count() }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg,#7c3aed,#a78bfa)">
            <div style="font-size:0.8rem;opacity:0.8">Total SKS</div>
            <div style="font-size:2rem;font-weight:700">{{ $totalSks }} / 24</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-journal-check me-2 text-primary"></i>KRS Saya</h6>
        <a href="{{ route('krs.index') }}" class="btn btn-sm btn-primary">Kelola KRS</a>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $k)
                <tr>
                    <td><code>{{ $k->kode_matakuliah }}</code></td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td><span class="badge bg-primary">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-4">Belum ada KRS. <a href="{{ route('krs.index') }}">Ambil mata kuliah sekarang</a>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
