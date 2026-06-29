@extends('layouts.app')
@section('title', 'Edit Dosen')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Edit Dosen</h4>
    <small class="text-muted"><a href="{{ route('dosen.index') }}">Dosen</a> / Edit</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-pencil me-2 text-warning"></i>Form Edit Dosen</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('dosen.update', $dosen->nidn) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">NIDN</label>
                <input type="text" class="form-control bg-light" value="{{ $dosen->nidn }}" disabled>
                <small class="text-muted">NIDN tidak dapat diubah.</small>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $dosen->nama) }}" placeholder="Nama lengkap dosen">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
