@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow">
        
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people me-2"></i>
                Mahasiswa yang mengambil {{ $matakuliah->nama_mk }}
            </h5>
            <a href="{{ route('matakuliah.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">

            @if($mahasiswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-info text-center">
                        <tr>
                            <th width="60">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mhs)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-dark">
                                    {{ $mhs->nim }}
                                </span>
                            </td>
                            <td>{{ $mhs->nama }}</td>
                            <td>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $mhs->kelas }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="alert alert-success mt-3">
                <i class="bi bi-info-circle me-1"></i>
                Total Mahasiswa: <strong>{{ $mahasiswas->count() }}</strong>
            </div>

            @else
            <div class="alert alert-warning text-center">
                <i class="bi bi-exclamation-circle me-2"></i>
                Belum ada mahasiswa yang mengambil mata kuliah ini.
            </div>
            @endif

        </div>
    </div>

</div>
@endsection
