@extends('layouts.app')

@section('content')

<style>
/* Soft styling */
.bg-soft-gradient {
    background: linear-gradient(135deg, #eff6ff, #f0f9ff);
    border-bottom: 1px solid #e2e8f0;
}

.form-label {
    font-size: 0.9rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.5rem;
}

.form-label span {
    color: #ef4444;
    margin-left: 2px;
}

.form-control, .form-select {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.6rem 1rem;
    transition: all 0.2s;
    background-color: white;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.form-control:focus, .form-select:focus {
    border-color: #94a3b8;
    box-shadow: 0 0 0 4px rgba(148, 163, 184, 0.1);
    outline: none;
}

.form-control.is-invalid, .form-select.is-invalid {
    border-color: #ef4444;
    background-image: none;
}

.form-control.is-invalid:focus, .form-select.is-invalid:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
}

.invalid-feedback {
    color: #ef4444;
    font-size: 0.8rem;
    margin-top: 0.3rem;
    padding-left: 0.5rem;
}

.card {
    border-radius: 20px;
    border: none;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
    overflow: hidden;
}

.card-header {
    background-color: white;
    border-bottom: 1px solid #f1f5f9;
    padding: 1.25rem 1.5rem;
}

.card-body {
    padding: 2rem;
}

/* Tombol soft */
.btn-soft-secondary {
    background-color: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
    padding: 0.6rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-soft-secondary:hover {
    background-color: #e2e8f0;
    color: #1e293b;
    border-color: #cbd5e1;
}

.btn-soft-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    border: none;
    padding: 0.6rem 2rem;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.2);
}

.btn-soft-warning:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    transform: translateY(-1px);
    box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.3);
}

/* Icon dalam tombol */
.btn-soft-secondary i, .btn-soft-warning i {
    font-size: 1.1rem;
}

/* Info kecil */
.text-info-soft {
    color: #64748b;
    font-size: 0.85rem;
    margin-top: 0.3rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.text-info-soft i {
    color: #94a3b8;
}

/* Alert styling */
.alert-soft-danger {
    background-color: #fef2f2;
    border-left: 4px solid #ef4444;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    color: #991b1b;
}

.alert-soft-danger h5 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-soft-danger ul {
    margin-bottom: 0;
    padding-left: 2rem;
}

.alert-soft-danger li {
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
}

/* Readonly field */
.form-control[readonly] {
    background-color: #f8fafc;
    color: #64748b;
    border-color: #e2e8f0;
    cursor: not-allowed;
}
</style>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                {{-- HEADER SOFT --}}
                <div class="card-header bg-soft-gradient d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 me-3 shadow-sm">
                            <i class="bi bi-pencil-square text-warning" style="font-size: 1.2rem;"></i>
                        </div>
                        <div>
                            <h5 class="fw-semibold text-gray-800 mb-0">
                                Edit Data Mahasiswa
                            </h5>
                            <small class="text-muted">Perbarui data mahasiswa</small>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    {{-- ERROR VALIDATION --}}
                    @if($errors->any())
                    <div class="alert-soft-danger">
                        <h5>
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Terjadi Kesalahan!
                        </h5>
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

                        {{-- NIM (readonly) --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-qr-code me-1 text-muted"></i>
                                NIM
                            </label>
                            <input type="text"
                                   class="form-control bg-light"
                                   value="{{ $mahasiswa->nim }}"
                                   readonly>
                            <div class="text-info-soft">
                                <i class="bi bi-info-circle"></i>
                                NIM tidak dapat diubah
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-person me-1 text-muted"></i>
                                Nama Lengkap <span>*</span>
                            </label>
                            <input type="text"
                                   name="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $mahasiswa->nama) }}"
                                   placeholder="Masukkan Nama Lengkap"
                                   required>
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
                                <i class="bi bi-people me-1 text-muted"></i>
                                Kelas <span>*</span>
                            </label>
                            <input type="text"
                                   name="kelas"
                                   class="form-control @error('kelas') is-invalid @enderror"
                                   value="{{ old('kelas', $mahasiswa->kelas) }}"
                                   placeholder="Contoh: SI-KIP-P1"
                                   required>
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
                                <i class="bi bi-book me-1 text-muted"></i>
                                Mata Kuliah <span>*</span>
                            </label>
                            <select name="matakuliah_id"
                                    class="form-select @error('matakuliah_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($matakuliahs as $mk)
                                    <option value="{{ $mk->kode_mk }}"
                                        {{ old('matakuliah_id', $mahasiswa->matakuliah_id) == $mk->kode_mk ? 'selected' : '' }}>
                                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-info-soft">
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
                        <div class="bg-blue-50 p-3 rounded-3 mb-4" style="background-color: #eff6ff;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-info-circle text-warning"></i>
                                <small class="text-warning" style="color: #b45309 !important;">
                                    <span style="color: red;">*</span> Field wajib diisi
                                </small>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('mahasiswa.index') }}"
                               class="btn-soft-secondary text-decoration-none">
                                <i class="bi bi-arrow-left"></i>
                                Batal
                            </a>

                            <button type="submit"
                                    class="btn-soft-warning border-0">
                                <i class="bi bi-check-circle"></i>
                                Update Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection