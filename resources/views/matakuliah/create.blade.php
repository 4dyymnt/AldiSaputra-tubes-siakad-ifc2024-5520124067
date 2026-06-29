@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Tambah Mata Kuliah</h4>
    <small class="text-muted"><a href="{{ route('matakuliah.index') }}">Mata Kuliah</a> / Tambah</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-book me-2 text-primary"></i>Form Tambah Mata Kuliah</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('matakuliah.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Mata Kuliah <span class="text-danger">*</span></label>
                <input type="text" name="kode_matakuliah" class="form-control @error('kode_matakuliah') is-invalid @enderror"
                       value="{{ old('kode_matakuliah') }}" placeholder="cth: IF001001" maxlength="8">
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <small class="text-muted">Kode harus tepat 8 karakter.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mata Kuliah <span class="text-danger">*</span></label>
                <input type="text" name="nama_matakuliah" class="form-control @error('nama_matakuliah') is-invalid @enderror"
                       value="{{ old('nama_matakuliah') }}" placeholder="Nama lengkap mata kuliah">
                @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">SKS <span class="text-danger">*</span></label>
                <select name="sks" class="form-select @error('sks') is-invalid @enderror">
                    <option value="">-- Pilih SKS --</option>
                    @for($i = 1; $i <= 6; $i++)
                        <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>{{ $i }} SKS</option>
                    @endfor
                </select>
                @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
