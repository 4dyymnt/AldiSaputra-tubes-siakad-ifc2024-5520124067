@extends('layouts.app')
@section('title', 'Data Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Data Dosen</h4>
        <small class="text-muted">Manajemen data dosen</small>
    </div>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Dosen
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('dosen.index') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau NIDN..." value="{{ request('search') }}" style="max-width:300px">
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('dosen.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Jumlah Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $i => $d)
                <tr>
                    <td>{{ $dosen->firstItem() + $i }}</td>
                    <td><code>{{ $d->nidn }}</code></td>
                    <td>{{ $d->nama }}</td>
                    <td><span class="badge bg-secondary">{{ $d->jadwal_count ?? $d->jadwal()->count() }}</span></td>
                    <td>
                        <a href="{{ route('dosen.show', $d->nidn) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('dosen.edit', $d->nidn) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('dosen.destroy', $d->nidn) }}" class="d-inline"
                              onsubmit="return confirm('Yakin hapus dosen {{ $d->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada data dosen.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($dosen->hasPages())
    <div class="card-footer">
        {{ $dosen->links() }}
    </div>
    @endif
</div>
@endsection
