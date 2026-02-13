@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-journal-text me-2"></i>Data Mata Kuliah
                    </h4>
                    <a href="{{ route('matakuliah.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Data
                    </a>
                </div>
                
                <div class="card-body">
                    <!-- Search Bar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <form action="{{ route('matakuliah.index') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari kode atau nama mata kuliah..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-outline-success" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    @if(request('search'))
                                    <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Total Data: {{ $matakuliahs->total() }}
                            </div>
                        </div>
                    </div>

                    <!-- Alert Message -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th width="50" class="text-center">No</th>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th class="text-center">SKS</th>
                                    <th class="text-center">Semester</th>
                                    <th width="120" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($matakuliahs as $index => $mk)
                                <tr>
                                    <td class="text-center">{{ ($matakuliahs->currentPage() - 1) * $matakuliahs->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-dark">{{ $mk->kode_mk }}</span>
                                    </td>
                                    <td>{{ $mk->nama_mk }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill px-3 py-1">
                                            {{ $mk->sks }} SKS
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info rounded-pill px-3 py-1">
                                            Semester {{ $mk->semester }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('matakuliah.edit', $mk->kode_mk) }}" 
                                               class="btn btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('matakuliah.destroy', $mk->kode_mk) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" 
                                                        onclick="return confirm('Hapus data ini?')" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-journal-x" style="font-size: 3rem;"></i>
                                            <p class="mt-3">Belum ada data mata kuliah</p>
                                            @if(request('search'))
                                            <p class="small">Tidak ditemukan hasil untuk "{{ request('search') }}"</p>
                                            <a href="{{ route('matakuliah.index') }}" class="btn btn-sm btn-outline-success">
                                                Tampilkan Semua
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($matakuliahs->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan {{ $matakuliahs->firstItem() ?? 0 }} - {{ $matakuliahs->lastItem() ?? 0 }} 
                            dari {{ $matakuliahs->total() }} data
                        </div>
                        <nav>
                            {{ $matakuliahs->appends(['search' => request('search')])->links() }}
                        </nav>
                    </div>
                    @endif
                </div>
                
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="bi bi-lightbulb me-1"></i>
                        Validasi: SKS (1-6), Semester (1-8), Kode MK unik
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection