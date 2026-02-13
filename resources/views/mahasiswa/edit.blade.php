@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Data Mahasiswa
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

                <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" 
                               class="form-control bg-light" 
                               id="nim" 
                               value="{{ $mahasiswa->nim }}" 
                               readonly>
                        <small class="text-muted">NIM tidak dapat diubah</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               value="{{ old('nama', $mahasiswa->nama) }}" 
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
                               value="{{ old('kelas', $mahasiswa->kelas) }}" 
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
                               value="{{ old('matakuliah', $mahasiswa->matakuliah) }}" 
                               required>
                        @error('matakuliah')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Gunakan format: KODE_MK - NAMA_MATAKULIAH</small>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection