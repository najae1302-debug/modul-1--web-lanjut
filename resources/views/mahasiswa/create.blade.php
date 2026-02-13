@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="bi bi-person-plus"></i> Tambah Data Mahasiswa Baru
                </h4>
            </div>
            
            <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="bi bi-exclamation-triangle"></i> Terjadi Kesalahan!</h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('mahasiswa.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nim') is-invalid @enderror" 
                               id="nim" 
                               name="nim" 
                               value="{{ old('nim') }}" 
                               placeholder="Masukkan NIM" 
                               required>
                        @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama') }}" 
                               placeholder="Masukkan nama lengkap" 
                               required>
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('kelas') is-invalid @enderror" 
                               id="kelas" 
                               name="kelas" 
                               value="{{ old('kelas') }}" 
                               placeholder="Contoh: SI-KIP-P1" 
                               required>
                        @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="matakuliah" class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('matakuliah') is-invalid @enderror" 
                               id="matakuliah" 
                               name="matakuliah" 
                               value="{{ old('matakuliah') }}" 
                               placeholder="Contoh: PWL-2024 - PEMOGRAMAN WEB LANJUT" 
                               required>
                        @error('matakuliah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Gunakan format: KODE_MK - NAMA_MATAKULIAH</small>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection