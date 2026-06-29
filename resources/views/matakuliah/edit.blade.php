@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Edit Mata Kuliah</h4>
    <small class="text-muted"><a href="{{ route('matakuliah.index') }}">Mata Kuliah</a> / Edit</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-pencil me-2 text-warning"></i>Form Edit Mata Kuliah</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('matakuliah.update', $matakuliah->kode_matakuliah) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Mata Kuliah</label>
                <input type="text" class="form-control bg-light" value="{{ $matakuliah->kode_matakuliah }}" disabled>
                <small class="text-muted">Kode tidak dapat diubah.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror"
                       value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah) }}" placeholder="Nama lengkap mata kuliah">
                @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">SKS <span class="text-danger">*</span></label>
                <select name="sks" class="form-select @error('sks') is-invalid @enderror">
                    @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ old('sks', $matakuliah->sks) == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                    @endfor
                </select>
                @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save me-1"></i> Update
                </button>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
