<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header h3 {
            color: #7f8c8d;
            font-weight: normal;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 11px;
        }
        .info-cetak {
            margin-bottom: 20px;
            text-align: right;
            font-size: 11px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $judul }}</h1>
        <h3>{{ $institusi }}</h3>
    </div>
    
    <div class="info-cetak">
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>
        <p>Total Mahasiswa: <strong>{{ $total_mahasiswa }}</strong> orang</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>Ditambahkan Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->kelas }}</td>
                <td>{{ $mhs->matakuliah->nama_mk ?? '-' }}</td>
                <td>{{ $mhs->user->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Cirebon, {{ $tanggal_cetak }}</p>
        <p>Ketua Program Studi</p>
        <br><br>
        <p><strong>Dr. Ahmad Syarif, M.Kom</strong></p>
    </div>
</body>
</html>