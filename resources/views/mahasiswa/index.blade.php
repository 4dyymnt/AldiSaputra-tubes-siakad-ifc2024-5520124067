@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Data Mahasiswa</h4>
        <small class="text-muted">Manajemen data mahasiswa</small>
    </div>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau NPM..." value="{{ request('search') }}" style="max-width:300px">
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jumlah KRS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $i => $m)
                <tr>
                    <td>{{ $mahasiswa->firstItem() + $i }}</td>
                    <td><code>{{ $m->npm }}</code></td>
                    <td>{{ $m->nama }}</td>
                    <td><span class="badge bg-secondary">{{ $m->krs()->count() }} MK</span></td>
                    <td>
                        <a href="{{ route('mahasiswa.show', $m->npm) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('mahasiswa.edit', $m->npm) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('mahasiswa.destroy', $m->npm) }}" class="d-inline"
                              onsubmit="return confirm('Yakin hapus mahasiswa {{ $m->nama }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada data mahasiswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($mahasiswa->hasPages())
    <div class="card-footer">{{ $mahasiswa->links() }}</div>
    @endif
</div>
@endsection
