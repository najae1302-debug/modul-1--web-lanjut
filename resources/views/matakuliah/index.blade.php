@extends('layouts.app')

@section('content')

<style>
/* Soft styling - GREEN THEME */
.bg-soft-gradient-green {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    border-bottom: 1px solid #bbf7d0;
}

.table-clean thead {
    background-color: #f0fdf4;
    border-bottom: 2px solid #bbf7d0;
}

.table-clean tbody tr:hover {
    background-color: #f0fdf4;
    transition: 0.2s;
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

/* Badge soft green */
.badge-soft-green {
    background-color: #dcfce7;
    color: #166534;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    display: inline-block;
    border: 1px solid #bbf7d0;
}

/* Tombol soft green */
.btn-soft-green {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: white;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2);
}

.btn-soft-green:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
    transform: translateY(-1px);
    box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);
    color: white;
}

.btn-soft-green-outline {
    background-color: #f0fdf4;
    color: #166534;
    border: 1px solid #bbf7d0;
    padding: 0.6rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-soft-green-outline:hover {
    background-color: #dcfce7;
    color: #166534;
    border-color: #86efac;
}

/* Tombol aksi */
.btn-group-soft-green {
    display: flex;
    gap: 6px;
    justify-content: center;
}

.btn-soft-warning-green {
    background-color: #fef9c3;
    color: #854d0e;
    border: 1px solid #facc15;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.btn-soft-warning-green:hover {
    background-color: #854d0e;
    color: white;
    border-color: #854d0e;
}

.btn-soft-danger-green {
    background-color: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fca5a5;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    border: none;
}

.btn-soft-danger-green:hover {
    background-color: #b91c1c;
    color: white;
    border-color: #b91c1c;
}

/* Search box */
.search-box-green {
    border: 1px solid #bbf7d0;
    border-radius: 12px;
    padding: 0.5rem 1rem;
    transition: all 0.2s;
    background-color: white;
    display: flex;
    align-items: center;
}

.search-box-green:focus-within {
    border-color: #4ade80;
    box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.1);
}

.search-box-green input {
    outline: none;
    width: 250px;
    border: none;
    background: transparent;
}

.search-box-green input::placeholder {
    color: #94a3b8;
}

/* Alert search green */
.alert-search-green {
    background-color: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 30px;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-search-green small {
    color: #166534;
}

.alert-search-green a {
    color: #dc2626;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

/* Pagination soft green */
.pagination {
    gap: 5px;
}

.pagination .page-link {
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    color: #166534;
    background-color: #f0fdf4;
    transition: all 0.2s;
}

.pagination .page-link:hover {
    background-color: #dcfce7;
    color: #14532d;
}

.pagination .active .page-link {
    background-color: #22c55e;
    color: white;
}

/* Empty state */
.empty-state-green {
    text-align: center;
    padding: 3rem 0;
}

.empty-state-green i {
    font-size: 4rem;
    color: #86efac;
    margin-bottom: 1rem;
}

.empty-state-green h4 {
    color: #166534;
    margin-bottom: 1rem;
}

/* Info text */
.text-info-soft-green {
    color: #166534;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.text-info-soft-green i {
    color: #4ade80;
}
</style>

<div class="container mt-4 mb-5">
    <div class="card shadow-sm border-0">

        {{-- HEADER SOFT GREEN --}}
        <div class="card-header bg-soft-gradient-green d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="bg-white rounded-circle p-2 me-3 shadow-sm" style="border: 2px solid #bbf7d0;">
                    <i class="bi bi-journal-text" style="color: #97ddb1; font-size: 1.2rem;"></i>
                </div>
                <div>
                    <h5 class="fw-semibold text-gray-800 mb-0">
                        Data Mata Kuliah
                    </h5>
                    <small class="text-muted">Kelola data mata kuliah</small>
                </div>
            </div>

            @if(request('search'))
            <div class="alert-search-green">
                <i class="bi bi-search" style="color: #16a34a;"></i>
                <small>
                    Hasil pencarian: "<strong>{{ request('search') }}</strong>"
                </small>
                <a href="{{ route('matakuliah.index') }}" class="ms-2" title="Hapus filter">
                    <i class="bi bi-x-circle-fill"></i>
                </a>
            </div>
            @endif
        </div>

        <div class="card-body">

            {{-- TOOLBAR --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <a href="{{ route('matakuliah.create') }}" class="btn-soft-green text-decoration-none">
                    <i class="bi bi-plus-circle"></i> Tambah Data Mata Kuliah
                </a>

                <form action="{{ route('matakuliah.index') }}" method="GET">
                    <div class="search-box-green">
                        <i class="bi bi-search" style="color: #a9e7c0; margin-right: 0.5rem;"></i>
                        <input type="text"
                               name="search"
                               placeholder="Cari Kode atau Nama Mata Kuliah..."
                               value="{{ request('search') }}">
                        @if(request('search'))
                            <a href="{{ route('matakuliah.index') }}" class="text-muted">
                                <i class="bi bi-x-circle-fill" style="color: #dc2626;"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- INFO TOTAL --}}
            <div class="mb-3 text-info-soft-green">
                <i class="bi bi-info-circle"></i>
                Total: <strong>{{ $matakuliahs->total() }}</strong> mata kuliah
            </div>

            {{-- TABEL --}}
            @if($matakuliahs->count() > 0)
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr class="text-muted small text-uppercase">
                            <th width="60" class="ps-3">No</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="200" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matakuliahs as $mk)
                        <tr>
                            <td class="ps-3 text-muted">
                                {{ ($matakuliahs->currentPage() - 1) * $matakuliahs->perPage() + $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge-soft-green">
                                    <i class="bi bi-tag me-1"></i> {{ $mk->kode_mk }}
                                </span>
                            </td>

                            <td class="fw-semibold">
                                {{ $mk->nama_mk }}
                            </td>

                            <td class="text-center">
                                <div class="btn-group-soft-green">
                                    <a href="{{ route('matakuliah.edit', $mk->kode_mk) }}"
                                       class="btn-soft-warning-green text-decoration-none">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form action="{{ route('matakuliah.destroy', $mk->kode_mk) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-soft-danger-green border-0">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
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
                    Menampilkan {{ $matakuliahs->firstItem() }} - {{ $matakuliahs->lastItem() }}
                    dari {{ $matakuliahs->total() }} data
                </small>
                <div>
                    {{ $matakuliahs->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </div>
            </div>

            @else
            <div class="empty-state-green">
                <i class="bi bi-journal-x"></i>
                <h4 class="text-muted">Tidak ada data ditemukan</h4>
                <a href="{{ route('matakuliah.create') }}" class="btn-soft-green text-decoration-none">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </a>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection