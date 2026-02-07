@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Mahasiswa</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                       id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
                @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control @error('kelas') is-invalid @enderror" 
                       id="kelas" name="kelas" value="{{ old('kelas', $mahasiswa->kelas) }}" required>
                @error('kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="matakuliah" class="form-label">Mata Kuliah</label>
                <input type="text" class="form-control @error('matakuliah') is-invalid @enderror" 
                       id="matakuliah" name="matakuliah" value="{{ old('matakuliah', $mahasiswa->matakuliah) }}" required>
                @error('matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection