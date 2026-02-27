@extends('layouts.app')

@section('content')

<style>
/* Soft styling - untuk Mata Kuliah - Soft Green */
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

.form-control {
    border: 1px solid #bbf7d0;
    border-radius: 16px;
    padding: 0.75rem 1rem;
    transition: all 0.2s;
    background-color: white;
    box-shadow: 0 2px 4px rgba(34, 197, 94, 0.05);
}

.form-control:focus {
    border-color: #4ade80;
    box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
    outline: none;
}

.form-control.is-invalid {
    border-color: #ef4444;
}

.form-control.is-invalid:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.3rem;
    padding-left: 0.5rem;
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

.btn-soft-primary-green {
    background: linear-gradient(135deg, #4ade80, #22c55e);
    color: white;
    border: none;
    padding: 0.75rem 2.5rem;
    border-radius: 40px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    font-size: 0.95rem;
}

.btn-soft-primary-green:hover {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
}

/* Icon dalam tombol */
.btn-soft-secondary-green i, .btn-soft-primary-green i {
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

/* Helper text */
.text-muted-small {
    color: #9ca3af;
    font-size: 0.8rem;
    margin-top: 0.2rem;
}

/* Info wajib diisi */
.info-wajib-green {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-radius: 16px;
    padding: 1rem;
    border: 1px solid #bbf7d0;
}
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow-sm border-0">

                {{-- HEADER SOFT GREEN --}}
                <div class="card-header bg-soft-gradient-green d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle-green me-3">
                            <i class="bi bi-journal-plus"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold text-gray-800 mb-1">
                                Tambah Data Mata Kuliah
                            </h5>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-muted">Isi form berikut untuk menambah mata kuliah baru</small>
                                <span class="badge-soft-green">Form Input</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('matakuliah.store') }}" method="POST">
                        @csrf

                        {{-- KODE MK --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-tag-fill me-1" style="color: #22c55e;"></i>
                                Kode Mata Kuliah <span>*</span>
                            </label>

                            <input type="text"
                                   name="kode_mk"
                                   class="form-control @error('kode_mk') is-invalid @enderror"
                                   value="{{ old('kode_mk') }}"
                                   placeholder="Contoh: BD-001"
                                   style="font-size: 1rem;">

                            <div class="text-info-soft-green">
                                <i class="bi bi-info-circle-fill"></i>
                                Gunakan format huruf besar dan angka, contoh: 
                                <span class="badge-soft-green">AI-000</span> 
                                <span class="badge-soft-green">BD-000</span> 
                                <span class="badge-soft-green">PWL-000</span>
                            </div>

                            @error('kode_mk')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- NAMA MATA KULIAH --}}
                        <div class="mb-5">
                            <label class="form-label">
                                <i class="bi bi-book-fill me-1" style="color: #22c55e;"></i>
                                Nama Mata Kuliah <span>*</span>
                            </label>

                            <input type="text"
                                   name="nama_mk"
                                   class="form-control @error('nama_mk') is-invalid @enderror"
                                   value="{{ old('nama_mk') }}"
                                   placeholder="Contoh: Pemrograman Web Lanjut"
                                   style="font-size: 1rem;">

                            <div class="text-info-soft-green">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama lengkap mata kuliah
                            </div>

                            @error('nama_mk')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Informasi wajib diisi --}}
                        <div class="info-wajib-green mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-info-circle-fill" style="color: #16a34a;"></i>
                                <div>
                                    <small style="color: #166534; font-weight: 500;">
                                        <span style="color: red; font-weight: 700;">*</span> Field wajib diisi
                                    </small>
                                    <small class="text-muted d-block" style="color: #16a34a; opacity: 0.7;">
                                        Pastikan data yang dimasukkan sudah benar
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

                            <button type="submit"
                                    class="btn-soft-primary-green border-0">
                                <i class="bi bi-save"></i>
                                Simpan Data
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection