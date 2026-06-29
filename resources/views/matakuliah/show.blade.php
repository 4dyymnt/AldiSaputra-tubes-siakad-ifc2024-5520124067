@extends('layouts.app')
@section('title', 'Detail Mata Kuliah')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Detail Mata Kuliah</h4>
    <small class="text-muted"><a href="{{ route('matakuliah.index') }}">Mata Kuliah</a> / Detail</small>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="mx-auto mb-3" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#7c3aed,#a78bfa);display:flex;align-items:center;justify-content:center">
                <i class="bi bi-book text-white fs-2"></i>
            </div>
            <h5 class="fw-bold">{{ $matakuliah->nama_matakuliah }}</h5>
            <p class="text-muted mb-1">Kode: <code>{{ $matakuliah->kode_matakuliah }}</code></p>
            <span class="badge" style="background:#7c3aed;font-size:0.9rem">{{ $matakuliah->sks }} SKS</span>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-calendar3 me-2 text-primary"></i>Jadwal Mata Kuliah</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr><th>Dosen</th><th>Kelas</th><th>Hari</th><th>Jam</th></tr>
                    </thead>
                    <tbody>
                        @forelse($matakuliah->jadwal as $j)
                        <tr>
                            <td>{{ $j->dosen->nama ?? '-' }}</td>
                            <td><span class="badge bg-primary">{{ $j->kelas }}</span></td>
                            <td>{{ $j->hari }}</td>
                            <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Belum ada jadwal.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <a href="{{ route('matakuliah.edit', $matakuliah->kode_matakuliah) }}" class="btn btn-warning ms-2">
        <i class="bi bi-pencil me-1"></i> Edit
    </a>
</div>
@endsection
