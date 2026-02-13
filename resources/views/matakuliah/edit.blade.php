<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-white">
                        <h3 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Edit Data Mata Kuliah
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        <!-- Error Messages -->
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">Error!</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Form -->
                        <form action="{{ route('matakuliah.update', $matakuliah->kode_mk) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                           <div class="mb-3">
    <label class="form-label">Kode Mata Kuliah</label>
    <input type="text"
           class="form-control"
           value="{{ $matakuliah->kode_mk }}"
           readonly>
    <small class="text-muted">Kode MK tidak dapat diubah</small>
</div>

                            
 <div class="mb-3">
    <label class="form-label">Nama Mata Kuliah</label>
    <input type="text"
           name="nama_mk"
           class="form-control @error('nama_mk') is-invalid @enderror"
           value="{{ old('nama_mk', $matakuliah->nama_mk) }}"
           required>

    @error('nama_mk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SKS <span class="text-danger">*</span></label>
                                    <select name="sks" class="form-control @error('sks') is-invalid @enderror" required>
                                        <option value="">Pilih SKS</option>
                                        @for($i = 1; $i <= 6; $i++)
                                        <option value="{{ $i }}" 
                                            {{ old('sks', $matakuliah->sks) == $i ? 'selected' : '' }}>
                                            {{ $i }} SKS
                                        </option>
                                        @endfor
                                    </select>
                                    @error('sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Semester <span class="text-danger">*</span></label>
                                    <select name="semester" class="form-control @error('semester') is-invalid @enderror" required>
                                        <option value="">Pilih Semester</option>
                                        @for($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" 
                                            {{ old('semester', $matakuliah->semester) == $i ? 'selected' : '' }}>
                                            Semester {{ $i }}
                                        </option>
                                        @endfor
                                    </select>
                                    @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="alert alert-info mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small>
                                            <i class="bi bi-clock"></i> 
                                            <strong>Dibuat:</strong> {{ $matakuliah->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small>
                                            <i class="bi bi-arrow-clockwise"></i> 
                                            <strong>Diupdate:</strong> {{ $matakuliah->updated_at->format('d/m/Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <div>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-check-circle"></i> Update Data
                                    </button>
                                    <a href="{{ route('matakuliah.create') }}" class="btn btn-outline-success ms-2">
                                        <i class="bi bi-plus-circle"></i> Tambah Baru
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>