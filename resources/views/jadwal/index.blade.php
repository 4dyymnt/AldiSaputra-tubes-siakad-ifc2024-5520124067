@extends('layouts.app')
@section('title', 'Data Jadwal')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">Data Jadwal</h4>
        <small class="text-muted">Manajemen jadwal perkuliahan</small>
    </div>
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('jadwal.index') }}" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari mata kuliah, kelas..." value="{{ request('search') }}" style="max-width:250px">
            <select name="hari" class="form-select form-select-sm" style="max-width:150px">
                <option value="">Semua Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
                    <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-search"></i></button>
            @if(request('search') || request('hari'))
                <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $i => $j)
                <tr>
                    <td>{{ $jadwal->firstItem() + $i }}</td>
                    <td>
                        <div class="fw-semibold">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                        <small class="text-muted">{{ $j->kode_matakuliah }}</small>
                    </td>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td><span class="badge bg-primary">Kelas {{ $j->kelas }}</span></td>
                    <td>{{ $j->hari }}</td>
                    <td><i class="bi bi-clock me-1 text-muted"></i>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                    <td>
                        <a href="{{ route('jadwal.show', $j->id) }}" class="btn btn-sm btn-outline-info me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('jadwal.destroy', $j->id) }}" class="d-inline"
                              onsubmit="return confirm('Yakin hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data jadwal.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jadwal->hasPages())
    <div class="card-footer">{{ $jadwal->links() }}</div>
    @endif
</div>
@endsection
