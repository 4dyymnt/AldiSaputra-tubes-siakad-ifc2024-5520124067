@extends('layouts.app')
@section('title', 'Detail Jadwal')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Detail Jadwal</h4>
    <small class="text-muted"><a href="{{ route('jadwal.index') }}">Jadwal</a> / Detail</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-calendar3 me-2 text-primary"></i>Informasi Jadwal</h6>
    </div>
    <div class="card-body">
        <table class="table table-borderless mb-0">
            <tr>
                <th style="width:180px" class="text-muted fw-normal">Mata Kuliah</th>
                <td>
                    <div class="fw-semibold">{{ $jadwal->matakuliah->nama_matakuliah ?? '-' }}</div>
                    <small class="text-muted">{{ $jadwal->kode_matakuliah }}</small>
                </td>
            </tr>
            <tr>
                <th class="text-muted fw-normal">SKS</th>
                <td><span class="badge" style="background:#7c3aed">{{ $jadwal->matakuliah->sks ?? '-' }} SKS</span></td>
            </tr>
            <tr>
                <th class="text-muted fw-normal">Dosen Pengajar</th>
                <td>
                    <div class="fw-semibold">{{ $jadwal->dosen->nama ?? '-' }}</div>
                    <small class="text-muted">NIDN: {{ $jadwal->nidn }}</small>
                </td>
            </tr>
            <tr>
                <th class="text-muted fw-normal">Kelas</th>
                <td><span class="badge bg-primary fs-6">Kelas {{ $jadwal->kelas }}</span></td>
            </tr>
            <tr>
                <th class="text-muted fw-normal">Hari</th>
                <td>{{ $jadwal->hari }}</td>
            </tr>
            <tr>
                <th class="text-muted fw-normal">Jam Mulai</th>
                <td><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($jadwal->jam)->format('H:i') }} WIB</td>
            </tr>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning ms-2">
        <i class="bi bi-pencil me-1"></i> Edit
    </a>
</div>
@endsection
