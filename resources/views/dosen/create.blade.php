@extends('layouts.app')
@section('title', 'Tambah Dosen')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Tambah Dosen</h4>
    <small class="text-muted"><a href="{{ route('dosen.index') }}">Dosen</a> / Tambah</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-person-badge me-2 text-primary"></i>Form Tambah Dosen</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dosen.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">NIDN <span class="text-danger">*</span></label>
                <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror"
                       value="{{ old('nidn') }}" placeholder="10 digit NIDN" maxlength="10">
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">NIDN harus tepat 10 karakter angka.</small>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" placeholder="Nama lengkap dosen">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
