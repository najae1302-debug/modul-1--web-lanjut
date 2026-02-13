@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="bi bi-people"></i> Data Mahasiswa
        </h4>
        
        <!-- Tampilkan info search jika ada -->
        @if(request('search'))
        <div class="alert alert-info py-1 mb-0">
            <small>
                <i class="bi bi-search"></i> 
                Hasil pencarian: "{{ request('search') }}"
                <a href="{{ route('mahasiswa.index') }}" class="text-danger ms-2">
                    <i class="bi bi-x-circle"></i> Clear
                </a>
            </small>
        </div>
        @endif
    </div>
    
    <div class="card-body">
        <!-- Toolbar: Tambah + Search -->
        <div class="row mb-4">
            <div class="col-md-6">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Data Mahasiswa
                </a>
            </div>
            
            <div class="col-md-6">
                <!-- Search Form -->
                <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Cari NIM, Nama, Kelas, atau Mata Kuliah..." 
                               value="{{ request('search') }}"
                               aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                        @if(request('search'))
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        @if($mahasiswas->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Mata Kuliah</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswas as $index => $mhs)
                    <tr>
                        <td class="text-center">{{ ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() + $loop->iteration }}</td>
                        <td><strong class="text-primary">{{ $mhs->nim }}</strong></td>
                        <td>{{ $mhs->nama }}</td>
                        <td><span class="badge bg-info">{{ $mhs->kelas }}</span></td>
                        <td>{{ $mhs->matakuliah }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <!-- Tombol Detail -->
                                <a href="#" class="btn btn-info btn-sm" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#detailModal{{ $mhs->nim }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                                
                                <!-- Tombol Edit -->
                                <a href="{{ route('mahasiswa.edit', $mhs->nim) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('mahasiswa.destroy', $mhs->nim) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Modal Detail (Opsional) -->
                            <div class="modal fade" id="detailModal{{ $mhs->nim }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Detail Mahasiswa</h5>
                                            <button type="button" class="btn-close btn-close-white" 
                                                    data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4">NIM</dt>
                                                <dd class="col-sm-8">{{ $mhs->nim }}</dd>
                                                
                                                <dt class="col-sm-4">Nama</dt>
                                                <dd class="col-sm-8">{{ $mhs->nama }}</dd>
                                                
                                                <dt class="col-sm-4">Kelas</dt>
                                                <dd class="col-sm-8">{{ $mhs->kelas }}</dd>
                                                
                                                <dt class="col-sm-4">Mata Kuliah</dt>
                                                <dd class="col-sm-8">{{ $mhs->matakuliah }}</dd>
                                                
                                                <dt class="col-sm-4">Dibuat</dt>
                                                <dd class="col-sm-8">{{ $mhs->created_at->format('d/m/Y H:i') }}</dd>
                                                
                                                <dt class="col-sm-4">Diupdate</dt>
                                                <dd class="col-sm-8">{{ $mhs->updated_at->format('d/m/Y H:i') }}</dd>
                                            </dl>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" 
                                                    data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $mahasiswas->firstItem() }} - {{ $mahasiswas->lastItem() }} 
                dari {{ $mahasiswas->total() }} data
            </div>
            
            <nav>
                {{ $mahasiswas->appends(['search' => request('search')])->links() }}
            </nav>
        </div>
        
        @else
        <!-- Tidak ada data -->
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-database-exclamation" style="font-size: 4rem; color: #6c757d;"></i>
            </div>
            <h4 class="text-muted">Tidak ada data ditemukan</h4>
            @if(request('search'))
            <p class="text-muted">Tidak ditemukan hasil untuk pencarian "{{ request('search') }}"</p>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary mt-2">
                <i class="bi bi-arrow-left"></i> Lihat Semua Data
            </a>
            @else
            <p class="text-muted">Belum ada data mahasiswa. Silakan tambah data baru.</p>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-success mt-2">
                <i class="bi bi-plus-circle"></i> Tambah Data Pertama
            </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection