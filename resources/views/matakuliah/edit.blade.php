@extends('layouts.app')

@section('content')

<style>
/* Soft styling - untuk Edit Mata Kuliah - Soft Green */
.bg-soft-gradient-green {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-bottom: 1px solid #bbf7d0;
}

.form-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #166534;
    margin-bottom: 0.5rem;
}

.form-label span {
    color: #ef4444;
    margin-left: 2px;
}

.form-control, .form-select {
    border: 1px solid #bbf7d0;
    border-radius: 16px;
    padding: 0.75rem 1rem;
    transition: all 0.2s;
    background-color: white;
    box-shadow: 0 2px 4px rgba(34, 197, 94, 0.05);
}

.form-control:focus, .form-select:focus {
    border-color: #4ade80;
    box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
    outline: none;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #ef4444;
}

.form-control.is-invalid:focus, .form-select.is-invalid:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.3rem;
    padding-left: 0.5rem;
}

.form-control[readonly] {
    background-color: #f0fdf4;
    color: #166534;
    border-color: #bbf7d0;
    cursor: not-allowed;
}

.card {
    border-radius: 24px;
    border: none;
    box-shadow: 0 10px 30px -5px rgba(34, 197, 94, 0.1);
    overflow: hidden;
}

.card-header {
    background-color: white;
    border-bottom: 1px solid #f0fdf4;
    padding: 1.5rem 2rem;
}

.card-body {
    padding: 2rem;
}

/* Tombol soft - Warna Hijau */
.btn-soft-secondary-green {
    background-color: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    padding: 0.75rem 2rem;
    border-radius: 40px;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.btn-soft-secondary-green:hover {
    background-color: #dcfce7;
    color: #14532d;
    border-color: #4ade80;
}

.btn-soft-warning-green {
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 40px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    font-size: 0.95rem;
}

.btn-soft-warning-green:hover {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
}

.btn-soft-success-green {
    background: linear-gradient(135deg, #4ade80, #22c55e);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 40px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    font-size: 0.95rem;
    text-decoration: none;
}

.btn-soft-success-green:hover {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
    color: white;
}

/* Icon dalam tombol */
.btn-soft-secondary-green i, .btn-soft-warning-green i, .btn-soft-success-green i {
    font-size: 1.1rem;
}

/* Info kecil */
.text-info-soft-green {
    color: #16a34a;
    font-size: 0.85rem;
    margin-top: 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.text-info-soft-green i {
    color: #4ade80;
    font-size: 0.9rem;
}

/* Icon circle */
.icon-circle-green {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 50%;
    padding: 0.75rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #4ade80;
}

.icon-circle-green i {
    color: #16a34a;
    font-size: 1.3rem;
}

/* Badge kecil */
.badge-soft-green {
    background-color: #f0fdf4;
    color: #166534;
    padding: 0.25rem 0.75rem;
    border-radius: 30px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid #bbf7d0;
}

/* Info card */
.info-card-green {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 16px;
    padding: 1rem;
    border: 1px solid #bbf7d0;
}

.info-card-green small {
    color: #166534;
}

.info-card-green i {
    color: #22c55e;
}
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                {{-- HEADER SOFT GREEN --}}
                <div class="card-header bg-soft-gradient-green d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle-green me-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold text-gray-800 mb-1">
                                Edit Data Mata Kuliah
                            </h5>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-muted">Perbarui data mata kuliah</small>
                                <span class="badge-soft-green">Form Edit</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- Error Messages --}}
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 16px;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <h5 class="mb-0">Terjadi Kesalahan!</h5>
                        </div>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Kode MK (readonly) --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-tag-fill me-1" style="color: #22c55e;"></i>
                                Kode Mata Kuliah
                            </label>
                            <input type="text"
                                   class="form-control"
                                   value="{{ $matakuliah->kode_mk }}"
                                   readonly>
                            <div class="text-info-soft-green">
                                <i class="bi bi-info-circle-fill"></i>
                                Kode MK tidak dapat diubah
                            </div>
                        </div>

                        {{-- Nama Mata Kuliah --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-book-fill me-1" style="color: #22c55e;"></i>
                                Nama Mata Kuliah <span>*</span>
                            </label>
                            <input type="text"
                                   name="nama_mk"
                                   class="form-control @error('nama_mk') is-invalid @enderror"
                                   value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
                                   placeholder="Masukkan nama mata kuliah"
                                   required>
                            @error('nama_mk')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Row SKS & Semester --}}
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-sort-numeric-up-alt me-1" style="color: #22c55e;"></i>
                                    SKS <span>*</span>
                                </label>
                                <select name="sks" class="form-select @error('sks') is-invalid @enderror" required>
                                    <option value="">-- Pilih SKS --</option>
                                    @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" 
                                        {{ old('sks', $matakuliah->sks) == $i ? 'selected' : '' }}>
                                        {{ $i }} SKS
                                    </option>
                                    @endfor
                                </select>
                                @error('sks')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    <i class="bi bi-calendar-week me-1" style="color: #22c55e;"></i>
                                    Semester <span>*</span>
                                </label>
                                <select name="semester" class="form-select @error('semester') is-invalid @enderror" required>
                                    <option value="">-- Pilih Semester --</option>
                                    @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" 
                                        {{ old('semester', $matakuliah->semester) == $i ? 'selected' : '' }}>
                                        Semester {{ $i }}
                                    </option>
                                    @endfor
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Info Created & Updated --}}
                        <div class="info-card-green mt-4 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="d-flex align-items-center gap-2">
                                        <i class="bi bi-clock"></i>
                                        <strong>Dibuat:</strong> 
                                        {{ $matakuliah->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <small class="d-flex align-items-center gap-2">
                                        <i class="bi bi-arrow-clockwise"></i>
                                        <strong>Diupdate:</strong> 
                                        {{ $matakuliah->updated_at->format('d/m/Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Informasi wajib diisi --}}
                        <div class="info-card-green mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-info-circle-fill" style="color: #16a34a;"></i>
                                <div>
                                    <small style="color: #166534; font-weight: 500;">
                                        <span style="color: red; font-weight: 700;">*</span> Field wajib diisi
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('matakuliah.index') }}" 
                               class="btn-soft-secondary-green text-decoration-none">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('matakuliah.create') }}" 
                                   class="btn-soft-success-green text-decoration-none">
                                    <i class="bi bi-plus-circle"></i>
                                    Tambah Baru
                                </a>
                                <button type="submit" 
                                        class="btn-soft-warning-green border-0">
                                    <i class="bi bi-check-circle"></i>
                                    Update Data
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection