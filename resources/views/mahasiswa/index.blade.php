@extends('layouts.app')

@section('content')

<style>
/* Soft styling */
.table-clean thead {
    background-color: #f8fafc;
    border-bottom: 2px solid #e2e8f0;
}

.table-clean tbody tr:hover {
    background-color: #f1f5f9;
    transition: 0.2s;
}

.card {
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Soft gradient header */
.soft-gradient-header {
    background: linear-gradient(135deg, #eff6ff, #f0f9ff);
    border-bottom: 1px solid #e2e8f0;
    padding: 1.25rem 1.5rem;
}

/* Badge soft */
.badge-soft {
    background-color: #dbeafe;
    color: #1e40af;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.875rem;
}

/* Badge untuk mata kuliah */
.matkul-badge {
    background-color: #f1f5f9;
    color: #334155;
    font-weight: 500;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
}

/* Tombol aksi soft - INLINE */
.btn-aksi {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    margin: 0 2px;
}

.btn-aksi i {
    margin-right: 4px;
    font-size: 0.9rem;
}

.btn-edit {
    background-color: #fef3c7;
    color: #b45309;
    border: 1px solid #fcd34d;
}

.btn-edit:hover {
    background-color: #b45309;
    color: white;
    border-color: #b45309;
}

.btn-hapus {
    background-color: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.btn-hapus:hover:not(:disabled) {
    background-color: #b91c1c;
    color: white;
    border-color: #b91c1c;
}

.btn-hapus:disabled, .btn-hapus.disabled {
    background-color: #f1f5f9;
    color: #94a3b8;
    border: 1px solid #e2e8f0;
    cursor: not-allowed;
    opacity: 0.7;
}

/* Tombol Tambah Data - Soft Blue Gradient */
.btn-soft-blue-gradient {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    text-decoration: none;
}

.btn-soft-blue-gradient:hover {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(37, 99, 235, 0.3);
    color: white;
}

.btn-soft-blue-gradient i {
    font-size: 1.1rem;
}

/* Tooltip warning */
[data-tooltip] {
    position: relative;
    cursor: help;
}

[data-tooltip]:before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #1e293b;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 0.8rem;
    white-space: nowrap;
    z-index: 1000;
    display: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 8px;
}

[data-tooltip]:hover:before {
    display: block;
}

[data-tooltip]:after {
    content: '';
    position: relative;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    border-width: 6px;
    border-style: solid;
    border-color: #1e293b transparent transparent transparent;
    display: none;
    margin-bottom: -4px;
}

[data-tooltip]:hover:after {
    display: block;
}

/* Container aksi */
.aksi-container {
    display: flex;
    gap: 6px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Warning banner */
.warning-banner {
    background-color: #fffbeb;
    border-left: 4px solid #f59e0b;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.warning-banner i {
    color: #f59e0b;
    font-size: 1.5rem;
}

.warning-banner .warning-text {
    color: #92400e;
    font-size: 0.95rem;
}

/* Search box */
.search-box {
    border: 1px solid #e2e8f0;
    border-radius: 30px;
    padding: 0.5rem 1rem;
    transition: all 0.2s;
    background-color: white;
}

.search-box:focus-within {
    border-color: #94a3b8;
    box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.1);
}

.search-box input {
    outline: none;
    width: 250px;
}

/* Pagination soft */
.pagination {
    gap: 5px;
}

.pagination .page-link {
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 30px;
    color: #64748b;
    background-color: #f8fafc;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #e2e8f0;
    color: #334155;
}

.pagination .active .page-link {
    background-color: #3b82f6;
    color: white;
}
</style>

<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">

        {{-- HEADER SOFT --}}
        <div class="soft-gradient-header d-flex justify-content-between align-items-center rounded-top">
            <div>
                <h5 class="fw-semibold text-gray-800 mb-0">
                    <i class="bi bi-people-fill me-2 text-primary"></i> Data Mahasiswa
                </h5>
                <small class="text-muted">Kelola data mahasiswa</small>
            </div>
            <span class="bg-white text-primary px-3 py-1 rounded-pill shadow-sm">
                Total: {{ $mahasiswas->total() }}
            </span>
        </div>

        <div class="card-body p-4">

            {{-- WARNING BANNER UNTUK USER BIASA --}}
            @if(!str_ends_with(auth()->user()->email, '@ikmi.ac.id'))
                <div class="warning-banner">
                    <i class="bi bi-shield-exclamation"></i>
                    <div class="warning-text">
                        <strong>⚠️ Akses Terbatas!</strong> Hanya pengguna dengan email <strong>@ikmi.ac.id</strong> yang dapat menghapus data mahasiswa. Tombol Hapus akan tampil dalam keadaan non-aktif.
                    </div>
                </div>
            @endif

            {{-- ALERT SESSION --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- TOOLBAR DENGAN TOMBOL PDF --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex gap-2">
                    {{-- TOMBOL TAMBAH DATA --}}
                    <a href="{{ route('mahasiswa.create') }}" class="btn-soft-blue-gradient text-decoration-none">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </a>
                    
                    {{-- TOMBOL CETAK PDF --}}
                    <a href="{{ route('mahasiswa.cetak_pdf') }}" 
                       class="btn-soft-blue-gradient text-decoration-none" 
                       style="background: linear-gradient(135deg, #10b981, #059669);"
                       target="_blank">
                        <i class="bi bi-file-pdf"></i> Cetak PDF
                    </a>
                    
                    {{-- TOMBOL PREVIEW PDF --}}
                    <a href="{{ route('mahasiswa.preview_pdf') }}" 
                       class="btn-soft-blue-gradient text-decoration-none" 
                       style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);"
                       target="_blank">
                        <i class="bi bi-eye"></i> Preview PDF
                    </a>
                </div>

                <form action="{{ route('mahasiswa.index') }}" method="GET">
                    <div class="search-box d-flex align-items-center">
                        <i class="bi bi-search text-muted me-2"></i>
                        <input type="text"
                               name="search"
                               class="border-0 bg-transparent"
                               placeholder="Cari NIM, Nama, atau Kelas..."
                               value="{{ request('search') }}">
                        @if(request('search'))
                            <a href="{{ route('mahasiswa.index') }}" class="text-muted">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- TABEL --}}
            @if($mahasiswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr class="text-muted small text-uppercase">
                            <th width="60" class="ps-3">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th>
                            <th width="200" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mhs)
                        <tr>
                            <td class="ps-3 text-muted">
                                {{ ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() + $loop->iteration }}
                            </td>

                            <td class="fw-semibold text-primary">{{ $mhs->nim }}</td>
                            <td>{{ $mhs->nama }}</td>

                            <td><span class="badge-soft">{{ $mhs->kelas }}</span></td>

                            <td>
                                @if($mhs->matakuliah)
                                    <div><span class="matkul-badge">{{ $mhs->matakuliah->kode_mk }}</span></div>
                                    <small class="text-muted">{{ $mhs->matakuliah->nama_mk }}</small>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="aksi-container">
                                    {{-- EDIT --}}
                                    <a href="{{ route('mahasiswa.edit', $mhs->nim) }}"
                                       class="btn-aksi btn-edit text-decoration-none">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    @php
                                        $canDelete = str_ends_with(auth()->user()->email, '@ikmi.ac.id');
                                    @endphp

                                    @if($canDelete)
                                        <form action="{{ route('mahasiswa.destroy', $mhs->nim) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-aksi btn-hapus border-0">
                                                <i class="bi bi-trash3"></i> Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="btn-aksi btn-hapus disabled" 
                                              data-tooltip="Hanya email @ikmi.ac.id yang dapat menghapus data mahasiswa">
                                            <i class="bi bi-trash3"></i> Hapus
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="text-muted">
                    <i class="bi bi-info-circle me-1"></i>
                    Menampilkan {{ $mahasiswas->firstItem() }} - {{ $mahasiswas->lastItem() }}
                    dari {{ $mahasiswas->total() }} data
                </small>
                <div>
                    {{ $mahasiswas->links('pagination::bootstrap-5') }}
                </div>
            </div>

            @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-inbox" style="font-size: 48px; color: #cbd5e1;"></i>
                </div>
                <h5 class="text-muted">Belum ada data mahasiswa</h5>
                <p class="text-muted small">Klik tombol "Tambah Data" untuk memulai</p>
            </div>
            @endif

        </div>
    </div>
</div>

{{-- SCRIPT VALIDASI DELETE --}}
<script>
function confirmDelete(event) {
    let email = "{{ auth()->user()->email }}";

    if (!email.endsWith('@ikmi.ac.id')) {
        event.preventDefault();
        alert("⚠️ AKSES DITOLAK!\n\nHanya email @ikmi.ac.id yang dapat menghapus data mahasiswa.");
        return false;
    }

    return confirm("Yakin ingin menghapus data ini?");
}
</script>

@endsection