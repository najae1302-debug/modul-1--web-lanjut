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
            font-size: 22px;
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
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        td {
            padding: 6px;
            border: 1px solid #ddd;
            text-align: center;
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
        <p>Total Mata Kuliah: <strong>{{ $total_matakuliah }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matakuliah as $index => $mk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mk->kode_mk }}</td>
                <td style="text-align:left;">{{ $mk->nama_mk }}</td>
                <td>{{ $mk->sks }}</td>
                <td>{{ $mk->semester }}</td>
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