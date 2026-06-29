@extends('layouts.app')
@section('title', 'Data Mata Kuliah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Data Mata Kuliah</h4>
        <small class="text-muted">Manajemen data mata kuliah</small>
    </div>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Mata Kuliah
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('matakuliah.index') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama atau kode..." value="{{ request('search') }}" style="max-width:300px">
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('matakuliah.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matakuliah as $i => $mk)
                <tr>
                    <td>{{ $matakuliah->firstItem() + $i }}</td>
                    <td><code>{{ $mk->kode_matakuliah }}</code></td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td><span class="badge bg-purple" style="background:#7c3aed">{{ $mk->sks }} SKS</span></td>
                    <td>
                        <a href="{{ route('matakuliah.show', $mk->kode_matakuliah) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" class="d-inline"
                              onsubmit="return confirm('Yakin hapus mata kuliah {{ $mk->nama_matakuliah }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada data mata kuliah.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($matakuliah->hasPages())
    <div class="card-footer">{{ $matakuliah->links() }}</div>
    @endif
</div>
@endsection
