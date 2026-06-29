@extends('layouts.app')
@section('title', 'Jadwal Kuliah')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Jadwal Perkuliahan</h4>
    <small class="text-muted">Daftar seluruh jadwal perkuliahan</small>
</div>

@php
    $urutan = ['Senin','Selasa','Rabu','Kamis','Jumat'];
@endphp

@foreach($urutan as $hari)
    @if(isset($jadwal[$hari]) && $jadwal[$hari]->count() > 0)
    <div class="card mb-3">
        <div class="card-header d-flex align-items-center gap-2">
            <div style="width:10px;height:10px;border-radius:50%;background:#1e40af"></div>
            <h6 class="mb-0 fw-semibold">{{ $hari }}</h6>
            <span class="badge bg-secondary ms-auto">{{ $jadwal[$hari]->count() }} jadwal</span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal[$hari]->sortBy('jam') as $j)
                    <tr>
                        <td><span class="badge bg-light text-dark border"><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</span></td>
                        <td>
                            <div class="fw-semibold">{{ $j->matakuliah->nama_matakuliah ?? '-' }}</div>
                            <small class="text-muted">{{ $j->kode_matakuliah }}</small>
                        </td>
                        <td><span class="badge" style="background:#7c3aed">{{ $j->matakuliah->sks ?? '-' }} SKS</span></td>
                        <td>{{ $j->dosen->nama ?? '-' }}</td>
                        <td><span class="badge bg-primary">Kelas {{ $j->kelas }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
@endforeach

@if($jadwal->isEmpty())
<div class="card">
    <div class="card-body text-center text-muted py-5">
        <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
        Belum ada jadwal perkuliahan.
    </div>
</div>
@endif
@endsection
