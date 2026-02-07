<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Laravel - {{ $mata_kuliah ?? 'Web Lanjut' }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 800px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #667eea;
        }

        .header h1 {
            color: #2d3748;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .highlight {
            color: #667eea;
            font-weight: bold;
        }

        .mahasiswa-info {
            font-size: 1.2rem;
            color: #4a5568;
        }

        .card {
            background: linear-gradient(135deg, #4299e1, #667eea);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .detail-item {
            background: rgba(255,255,255,0.15);
            padding: 15px;
            border-radius: 10px;
        }

        .detail-label {
            font-size: 0.85rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #e2e8f0;
        }

        .detail-value {
            font-size: 1.1rem;
            margin-top: 5px;
        }

        .tugas-list {
            background: #f7fafc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
        }

        .tugas-list li {
            background: white;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 8px;
            border-left: 4px solid #4299e1;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            color: #718096;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>🖥️ <span class="highlight">Modul 1</span> – Praktikum Laravel</h1>
        <p class="mahasiswa-info">
            Selamat datang, <strong>{{ $nama ?? 'Mahasiswa' }}</strong>!
        </p>
    </div>

    <div class="card">
        <h2>📚 {{ $mata_kuliah ?? 'Pemrograman Web Lanjut' }}</h2>

        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Kode MK</div>
                <div class="detail-value">{{ $kode_mk ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">SKS</div>
                <div class="detail-value">{{ $sks ?? '-' }} SKS</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Dosen</div>
                <div class="detail-value">{{ $dosen ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Semester</div>
                <div class="detail-value">{{ $semester ?? '-' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Jadwal</div>
                <div class="detail-value">
                    {{ $hari ?? '-' }}, {{ $waktu ?? '-' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Ruangan</div>
                <div class="detail-value">{{ $ruangan ?? '-' }}</div>
            </div>
        </div>
    </div>

    @isset($list_tugas)
        @if(count($list_tugas) > 0)
        <div class="tugas-list">
            <h3>📝 Daftar Tugas</h3>
            <ul>
                @foreach($list_tugas as $i => $tugas)
                    <li>✅ Tugas {{ $i + 1 }}: {{ $tugas }}</li>
                @endforeach
            </ul>

            @isset($nilai_minimal)
                <p><strong>Nilai Minimal:</strong> {{ $nilai_minimal }}</p>
            @endisset

            @isset($total_pertemuan)
                <p><strong>Total Pertemuan:</strong> {{ $total_pertemuan }} kali</p>
            @endisset
        </div>
        @endif
    @endisset

    <div class="footer">
        <p>Praktikum Modul 1 – Web Lanjut</p>
        <p>Laravel 12 | LatihanController</p>
    </div>

</div>
</body>
</html>
