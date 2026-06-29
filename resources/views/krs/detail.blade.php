@extends('layouts.app')
@section('title', 'Detail KRS')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Detail KRS</h4>
    <small class="text-muted"><a href="{{ route('krs.admin') }}">KRS Mahasiswa</a> / Detail</small>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="mx-auto mb-3" style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#059669,#10b981);display:flex;align-items:center;justify-content:center">
                <i class="bi bi-person text-white fs-2"></i>
            </div>
            <h5 class="fw-bold">{{ $mahasiswa->nama }}</h5>
            <p class="text-muted mb-2">NPM: <code>{{ $mahasiswa->npm }}</code></p>
            @php $totalSks = $mahasiswa->krs->sum(fn($k) => $k->matakuliah->sks ?? 0); @endphp
            <div class="d-flex justify-content-center gap-2">
                <span class="badge bg-success">{{ $mahasiswa->krs->count() }} Mata Kuliah</span>
                <span class="badge bg-primary">{{ $totalSks }} SKS</span>
            </div>
            <div class="mt-3">
                <div class="text-muted mb-1" style="font-size:0.8rem">Progres SKS ({{ $totalSks }}/24)</div>
                <div class="progress" style="height:8px">
                    <div class="progress-bar bg-primary" style="width:{{ min(($totalSks/24)*100, 100) }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-journal-check me-2 text-primary"></i>Daftar KRS</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa->krs as $i => $k)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><code>{{ $k->kode_matakuliah }}</code></td>
                            <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                            <td><span class="badge" style="background:#7c3aed">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Mahasiswa belum mengambil KRS.</td></tr>
                        @endforelse
                    </tbody>
                    @if($mahasiswa->krs->count() > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="3" class="text-end">Total SKS:</th>
                            <th><span class="badge bg-primary fs-6">{{ $totalSks }} SKS</span></th>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('krs.admin') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>
@endsection
