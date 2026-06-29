@extends('layouts.app')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Tambah Jadwal</h4>
    <small class="text-muted"><a href="{{ route('jadwal.index') }}">Jadwal</a> / Tambah</small>
</div>

<div class="card" style="max-width:600px">
    <div class="card-header">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-calendar-plus me-2 text-primary"></i>Form Tambah Jadwal</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('jadwal.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Mata Kuliah <span class="text-danger">*</span></label>
                <select name="kode_matakuliah" class="form-select @error('kode_matakuliah') is-invalid @enderror">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliah as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                            [{{ $mk->kode_matakuliah }}] {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                        </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Dosen Pengajar <span class="text-danger">*</span></label>
                <select name="nidn" class="form-select @error('nidn') is-invalid @enderror">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->nidn }}" {{ old('nidn') == $d->nidn ? 'selected' : '' }}>
                            [{{ $d->nidn }}] {{ $d->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                    <select name="kelas" class="form-select @error('kelas') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach(['A','B','C','D','E'] as $k)
                            <option value="{{ $k }}" {{ old('kelas') == $k ? 'selected' : '' }}>Kelas {{ $k }}</option>
                        @endforeach
                    </select>
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Hari <span class="text-danger">*</span></label>
                    <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)
                            <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                    @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Jam Mulai <span class="text-danger">*</span></label>
                <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                       value="{{ old('jam') }}">
                @error('jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
