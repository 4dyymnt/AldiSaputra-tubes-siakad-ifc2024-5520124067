@extends('layouts.app')
@section('title', 'Detail Mahasiswa')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Detail Mahasiswa</h4>
    <small class="text-muted"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a> / Detail</small>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="mx-auto mb-3" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#059669,#10b981);display:flex;align-items:center;justify-content:center">
                <i class="bi bi-person text-white fs-2"></i>
            </div>
            <h5 class="fw-bold">{{ $mahasiswa->nama }}</h5>
            <p class="text-muted mb-1">NPM: <code>{{ $mahasiswa->npm }}</code></p>
            <p class="text-muted mb-0">
                <span class="badge bg-success">{{ $mahasiswa->krs->count() }} Mata Kuliah</span>
                <span class="badge bg-primary ms-1">{{ $mahasiswa->krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }} SKS</span>
            </p>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-journal-check me-2 text-primary"></i>KRS Mahasiswa</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Kode</th><th>Mata Kuliah</th><th>SKS</th></tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa->krs as $k)
                        <tr>
                            <td><code>{{ $k->kode_matakuliah }}</code></td>
                            <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td><span class="badge bg-primary">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Belum ada KRS.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <a href="{{ route('mahasiswa.edit', $mahasiswa->npm) }}" class="btn btn-warning ms-2">
        <i class="bi bi-pencil me-1"></i> Edit
    </a>
</div>
@endsection
