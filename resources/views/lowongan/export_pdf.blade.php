<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Lowongan</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f59e0b;
        }
        .header h2 {
            color: #f59e0b;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .report-date {
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }
        th {
            background-color: #f59e0b;
            color: white;
            text-align: left;
            padding: 8px;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .status-aktif {
            color: #065f46;
            font-weight: bold;
        }
        .status-ditutup {
            color: #b91c1c;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .logo img {
            height: 50px;
        }
        .gaji {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="logo">
        <!-- Replace with your actual logo path -->
        <img src="{{ public_path('images/logo.png') }}" alt="Company Logo">
    </div>
    
    <div class="header">
        <h2>Laporan Data Lowongan</h2>
        <div class="report-date">Dicetak pada: {{ now()->format('d F Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Gaji</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lowongans as $index => $lowongan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $lowongan->judul }}</td>
                <td>{{ $lowongan->deskripsi }}</td>
                <td>{{ $lowongan->kategori }}</td>
                <td>{{ $lowongan->lokasi }}</td>
                <td class="gaji">Rp{{ number_format($lowongan->gaji, 0, ',', '.') }}</td>
                <td class="status-{{ strtolower($lowongan->status) }}">
                    {{ $lowongan->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div>Total Lowongan: {{ $lowongans->count() }}</div>
        <div>Sistem Gowork - {{ date('Y') }}</div>
    </div>
</body>
</html>