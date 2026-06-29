@extends('layouts.app')
@section('title', 'KRS Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">KRS Mahasiswa</h4>
        <small class="text-muted">Rekap Kartu Rencana Studi seluruh mahasiswa</small>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('krs.admin') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau NPM..." value="{{ request('search') }}" style="max-width:300px">
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('krs.admin') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jumlah MK</th>
                    <th>Total SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $i => $m)
                @php
                    $totalSks = $m->krs->sum(fn($k) => $k->matakuliah->sks ?? 0);
                @endphp
                <tr>
                    <td>{{ $mahasiswa->firstItem() + $i }}</td>
                    <td><code>{{ $m->npm }}</code></td>
                    <td>{{ $m->nama }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $m->krs->count() }} MK</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1" style="height:6px;max-width:80px">
                                <div class="progress-bar bg-primary" style="width:{{ min(($totalSks/24)*100, 100) }}%"></div>
                            </div>
                            <span style="font-size:0.85rem">{{ $totalSks }}/24</span>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('krs.mahasiswa', $m->npm) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i>Detail KRS
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data mahasiswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($mahasiswa->hasPages())
    <div class="card-footer">{{ $mahasiswa->links() }}</div>
    @endif
</div>
@endsection
