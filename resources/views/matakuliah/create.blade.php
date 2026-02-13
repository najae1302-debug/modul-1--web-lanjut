@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Mata Kuliah Baru
                </h4>
            </div>
            
            <div class="card-body">
                <!-- Error Messages -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <h5 class="alert-heading">
                        <i class="bi bi-exclamation-triangle me-2"></i>Terjadi Kesalahan!
                    </h5>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form -->
                <form action="{{ route('matakuliah.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Kode MK -->
                        <div class="col-md-6 mb-3">
                            <label for="kode_mk" class="form-label">
                                Kode Mata Kuliah <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('kode_mk') is-invalid @enderror" 
                                       id="kode_mk" 
                                       name="kode_mk" 
                                       value="{{ old('kode_mk') }}"
                                       placeholder="Contoh: PWL2024"
                                       maxlength="10"
                                       required>
                            </div>
                            @error('kode_mk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 10 karakter, harus unik</small>
                        </div>
                        
                        <!-- Nama MK -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_mk" class="form-label">
                                Nama Mata Kuliah <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-journal-text"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('nama_mk') is-invalid @enderror" 
                                       id="nama_mk" 
                                       name="nama_mk" 
                                       value="{{ old('nama_mk') }}"
                                       placeholder="Contoh: Pemrograman Web Lanjut"
                                       maxlength="100"
                                       required>
                            </div>
                            @error('nama_mk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- SKS -->
                        <div class="col-md-6 mb-3">
                            <label for="sks" class="form-label">
                                SKS <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-bar-chart"></i>
                                </span>
                                <select class="form-control @error('sks') is-invalid @enderror" 
                                        id="sks" 
                                        name="sks"
                                        required>
                                    <option value="">Pilih SKS</option>
                                    @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>
                                        {{ $i }} SKS
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            @error('sks')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih antara 1-6 SKS</small>
                        </div>
                        
                        <!-- Semester -->
                        <div class="col-md-6 mb-3">
                            <label for="semester" class="form-label">
                                Semester <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar"></i>
                                </span>
                                <select class="form-control @error('semester') is-invalid @enderror" 
                                        id="semester" 
                                        name="semester"
                                        required>
                                    <option value="">Pilih Semester</option>
                                    @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            @error('semester')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Pilih antara Semester 1-8</small>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Field dengan tanda (*) wajib diisi
                </small>
            </div>
        </div>
    </div>
</div>
@endsection