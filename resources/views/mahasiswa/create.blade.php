@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Tambah Mahasiswa</h4>
    <small class="text-muted"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a> / Tambah</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-person-plus me-2 text-primary"></i>Form Tambah Mahasiswa</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">NPM <span class="text-danger">*</span></label>
                <input type="text" name="npm" class="form-control @error('npm') is-invalid @enderror"
                       value="{{ old('npm') }}" placeholder="10 digit NPM" maxlength="10">
                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">NPM harus tepat 10 karakter. Password default = NPM.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}" placeholder="Nama lengkap mahasiswa">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Email Login <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="email@mahasiswa.ac.id">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">Email digunakan untuk login ke sistem.</small>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
