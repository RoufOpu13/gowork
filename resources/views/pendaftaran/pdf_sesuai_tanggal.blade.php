<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran Pekerjaan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #333;
            margin: 2cm;
        }

        .letter-head {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #f59e0b;
            padding-bottom: 10px;
        }

        .letter-head img {
            height: 80px;
            margin-bottom: 10px;
        }

        .letter-head h1 {
            font-size: 16pt;
            margin: 5px 0;
            color: #f59e0b;
        }

        .letter-head p {
            margin: 3px 0;
            font-size: 11pt;
        }

        .letter-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin: 30px 0 10px 0;
            text-decoration: underline;
        }

        .report-date {
            text-align: center;
            font-size: 10pt;
            margin-bottom: 20px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11pt;
        }

        th {
            background-color: #f59e0b;
            color: white;
            text-align: left;
            padding: 8px;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .status {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            display: inline-block;
        }

        .status-diterima {
            background-color: #38a169;
        }

        .status-ditolak {
            background-color: #e53e3e;
        }

        .status-menunggu {
            background-color: #dd6b20;
        }

        .letter-footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10pt;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="letter-head">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Perusahaan">
        <h1>{{ strtoupper(Auth::user()->nama_perusahaan ?? (Auth::user()->name ?? 'PT. GOWORK INDONESIA')) }}</h1>
        <p>Jl. Contoh No. 123, Kota Bandung, Jawa Barat</p>
        <p>Telp: (022) 1234567 | Email: info@gowork.id</p>
    </div>

    <div class="letter-title">LAPORAN PENDAFTARAN PEKERJAAN</div>

    <div class="report-date">
        @if ($tanggalMulai && $tanggalSelesai)
            Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d F Y') }} -
            {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d F Y') }}<br>
        @endif
        Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pekerja</th>
                <th>Judul Lowongan</th>
                <th>Perekrut</th>
                <th>Pengalaman</th>
                <th>Keahlian</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftarans as $i => $daftar)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $daftar->user->name ?? '-' }}</td>
                    <td>{{ $daftar->lowongan->judul ?? '-' }}</td>
                    <td>{{ $daftar->lowongan->user->name ?? '-' }}</td>
                    <td>{{ $daftar->pengalaman }}</td>
                    <td>{{ $daftar->keahlian }}</td>
                    <td>{{ \Carbon\Carbon::parse($daftar->tanggal_pendaftaran)->format('d-m-Y') }}</td>
                    <td>
                        <span class="status status-{{ strtolower($daftar->status) }}">
                            {{ ucfirst($daftar->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data pendaftaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="letter-footer">
        Total Pendaftar: {{ $pendaftarans->count() }}<br>
        Sistem Gowork - {{ date('Y') }}
    </div>
</body>

</html>
