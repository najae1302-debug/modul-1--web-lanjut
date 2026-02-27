@extends('layouts.app')

@section('content')

<style>
/* Soft styling - untuk Mahasiswa */
.bg-soft-gradient-blue {
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    border-bottom: 1px solid #bfdbfe;
}

.form-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1e40af;
    margin-bottom: 0.5rem;
}

.form-label span {
    color: #ef4444;
    margin-left: 2px;
}

.form-control, .form-select {
    border: 1px solid #bfdbfe;
    border-radius: 16px;
    padding: 0.75rem 1rem;
    transition: all 0.2s;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.form-control:focus, .form-select:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
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

.card {
    border-radius: 24px;
    border: none;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.card-header {
    background-color: white;
    border-bottom: 1px solid #e2e8f0;
    padding: 1.5rem 2rem;
}

.card-body {
    padding: 2rem;
}

/* Tombol soft */
.btn-soft-secondary-blue {
    background-color: #f1f5f9;
    color: #1e40af;
    border: 1px solid #bfdbfe;
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

.btn-soft-secondary-blue:hover {
    background-color: #dbeafe;
    color: #1e3a8a;
    border-color: #3b82f6;
}

.btn-soft-primary-blue {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border: none;
    padding: 0.75rem 2.5rem;
    border-radius: 40px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    font-size: 0.95rem;
}

.btn-soft-primary-blue:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
}

/* Icon dalam tombol */
.btn-soft-secondary-blue i, .btn-soft-primary-blue i {
    font-size: 1.1rem;
}

/* Info kecil */
.text-info-soft-blue {
    color: #3b82f6;
    font-size: 0.85rem;
    margin-top: 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.text-info-soft-blue i {
    color: #3b82f6;
    font-size: 0.9rem;
}

/* Icon circle */
.icon-circle-blue {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    border-radius: 50%;
    padding: 0.75rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #3b82f6;
}

.icon-circle-blue i {
    color: #1e40af;
    font-size: 1.3rem;
}

/* Helper text */
.text-muted-small {
    color: #6b7280;
    font-size: 0.8rem;
    margin-top: 0.2rem;
}

/* Placeholder styling */
::placeholder {
    color: #9ca3af;
    opacity: 0.7;
}
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                {{-- HEADER SOFT BLUE --}}
                <div class="card-header bg-soft-gradient-blue d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle-blue me-3">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold text-gray-800 mb-1">
                                Tambah Data Mahasiswa
                            </h5>
                            <small class="text-muted">Isi form berikut untuk menambah mahasiswa baru</small>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf

                        {{-- NIM --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-qr-code me-1"></i>
                                NIM <span>*</span>
                            </label>
                            <input type="text" 
                                   name="nim"
                                   class="form-control @error('nim') is-invalid @enderror"
                                   value="{{ old('nim') }}"
                                   placeholder="Contoh: 43240349">
                            <div class="text-info-soft-blue">
                                <i class="bi bi-info-circle"></i>
                                NIM harus unik dan terdiri dari 8 digit angka
                            </div>
                            @error('nim')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-person me-1"></i>
                                Nama Lengkap <span>*</span>
                            </label>
                            <input type="text"
                                   name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama') }}"
                                   placeholder="Contoh: John Doe">
                            @error('nama')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-people me-1"></i>
                                Kelas <span>*</span>
                            </label>
                            <input type="text"
                                   name="kelas"
                                   class="form-control @error('kelas') is-invalid @enderror"
                                   value="{{ old('kelas') }}"
                                   placeholder="Contoh: SI-KIP-P1">
                            <div class="text-info-soft-blue">
                                <i class="bi bi-info-circle"></i>
                                Gunakan format yang sudah ditentukan
                            </div>
                            @error('kelas')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Mata Kuliah --}}
                        <div class="mb-5">
                            <label class="form-label">
                                <i class="bi bi-book me-1"></i>
                                Mata Kuliah <span>*</span>
                            </label>
                            <select name="matakuliah_id"
                                    class="form-select @error('matakuliah_id') is-invalid @enderror">
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($matakuliahs as $mk)
                                    <option value="{{ $mk->kode_mk }}"
                                        {{ old('matakuliah_id') == $mk->kode_mk ? 'selected' : '' }}>
                                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-info-soft-blue">
                                <i class="bi bi-info-circle"></i>
                                Pilih mata kuliah yang akan diambil
                            </div>
                            @error('matakuliah_id')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Informasi wajib diisi --}}
                        <div class="bg-blue-50 p-3 rounded-3 mb-4" style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 16px;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-info-circle" style="color: #1e40af;"></i>
                                <small style="color: #1e40af;">
                                    <span style="color: red;">*</span> Field wajib diisi
                                </small>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('mahasiswa.index') }}"
                               class="btn-soft-secondary-blue text-decoration-none">
                                <i class="bi bi-arrow-left"></i>
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn-soft-primary-blue border-0">
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