@extends('layouts.app')
@section('title', 'KRS Saya')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Kartu Rencana Studi (KRS)</h4>
    <small class="text-muted">{{ $mahasiswa->nama ?? '' }} &mdash; NPM: {{ $mahasiswa->npm ?? '' }}</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background:linear-gradient(135deg,#059669,#10b981)">
            <div style="font-size:0.8rem;opacity:0.8">Mata Kuliah Diambil</div>
            <div style="font-size:2rem;font-weight:700">{{ $krs->count() }}</div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)">
            <div style="font-size:0.8rem;opacity:0.8">Total SKS</div>
            <div style="font-size:2rem;font-weight:700">{{ $totalSks }} <span style="font-size:1rem;opacity:0.7">/ 24</span></div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="stat-card" style="background:linear-gradient(135deg,#1e40af,#3b82f6)">
            <div style="font-size:0.8rem;opacity:0.8">Sisa SKS</div>
            <div style="font-size:2rem;font-weight:700">{{ 24 - $totalSks }}</div>
        </div>
    </div>
</div>

<div class="row g-3">
    <!-- Daftar KRS -->
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-journal-check me-2 text-primary"></i>KRS Saya</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($krs as $i => $k)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $k->matakuliah->nama_matakuliah ?? '-' }}</div>
                                <small class="text-muted">{{ $k->kode_matakuliah }}</small>
                            </td>
                            <td><span class="badge" style="background:#7c3aed">{{ $k->matakuliah->sks ?? 0 }} SKS</span></td>
                            <td>
                                <form method="POST" action="{{ route('krs.destroy', $k->id) }}"
                                      onsubmit="return confirm('Drop mata kuliah {{ $k->matakuliah->nama_matakuliah ?? '' }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>Drop
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bi bi-journal-x d-block fs-2 mb-1"></i>
                                Belum ada mata kuliah di KRS.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($krs->count() > 0)
            <div class="card-footer text-muted" style="font-size:0.85rem">
                Total: <strong>{{ $krs->count() }}</strong> mata kuliah &bull; <strong>{{ $totalSks }}</strong> SKS
            </div>
            @endif
        </div>
    </div>

    <!-- Ambil Mata Kuliah -->
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-plus-circle me-2 text-success"></i>Ambil Mata Kuliah</h6>
            </div>
            <div class="card-body">
                @if($matakuliah->count() > 0)
                <form method="POST" action="{{ route('krs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Mata Kuliah</label>
                        <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}"
                                    {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                    {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                            @endforeach
                        </select>
                        @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-plus-circle me-1"></i> Tambahkan ke KRS
                    </button>
                </form>
                <div class="mt-3 p-2 rounded" style="background:#f8fafc;font-size:0.8rem">
                    <i class="bi bi-info-circle me-1 text-primary"></i>
                    Batas maksimal pengambilan adalah <strong>24 SKS</strong> per semester.
                </div>
                @else
                <div class="text-center text-muted py-4">
                    <i class="bi bi-check-circle-fill fs-2 text-success d-block mb-2"></i>
                    Semua mata kuliah sudah diambil.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
