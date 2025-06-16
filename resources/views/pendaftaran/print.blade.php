<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pendaftaran Pekerjaan</title>
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
            margin-bottom: 30px;
            border-bottom: 2px solid #f59e0b;
            padding-bottom: 15px;
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

        .letter-body {
            margin: 30px 0;
        }

        .letter-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 30px;
            text-decoration: underline;
        }

        .letter-content {
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .data-table th {
            background-color: #f8fafc;
            text-align: left;
            padding: 8px 12px;
            border: 1px solid #ddd;
            width: 30%;
        }

        .data-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }

        .letter-footer {
            margin-top: 50px;
            text-align: right;
        }

        .signature-area {
            margin-top: 60px;
            text-align: center;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid #333;
            margin: 0 auto;
            padding-top: 5px;
        }

        .status-badge {
            padding: 3px 10px;
            border-radius: 3px;
            font-weight: bold;
        }

        .status-diterima {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .status-menunggu {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>
    <div class="letter-head">
        <!-- Replace with your actual logo path -->
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Perusahaan">
        <h1>{{ strtoupper($daftar->lowongan->user->nama_perusahaan ?? ($daftar->lowongan->user->name ?? 'PT. PERUSAHAAN TIDAK DIKETAHUI')) }}
        </h1>
        <p>Jl. Contoh No. 123, Kota Bandung, Jawa Barat</p>
        <p>Telp: (022) 1234567 | Email: info@gowork.id</p>
    </div>

    <div class="letter-body">
        <div class="letter-title">SURAT KONFIRMASI PENDAFTARAN PEKERJAAN</div>

        <div class="letter-content">
            <p>Dengan ini menerangkan bahwa:</p>
        </div>

        <table class="data-table">
            <tr>
                <th>Nama Pekerja</th>
                <td>{{ $daftar->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Perekrut</th>
                <td>{{ $daftar->lowongan->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Judul Lowongan</th>
                <td>{{ $daftar->lowongan->judul ?? '-' }}</td>
            </tr>
            <tr>
                <th>Pengalaman Kerja</th>
                <td>{{ $daftar->pengalaman }}</td>
            </tr>
            <tr>
                <th>Keahlian</th>
                <td>{{ $daftar->keahlian }}</td>
            </tr>
            <tr>
                <th>Tanggal Pendaftaran</th>
                <td>{{ \Carbon\Carbon::parse($daftar->tanggal_pendaftaran)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <th>Status Pendaftaran</th>
                <td>
                    <span class="status-badge status-{{ strtolower($daftar->status) }}">
                        {{ ucfirst($daftar->status) }}
                    </span>
                </td>
            </tr>
        </table>

        <div class="letter-content">
            <p>Telah terdaftar dalam sistem rekrutmen kami. Proses selanjutnya akan diinformasikan melalui kontak yang
                tertera.</p>
        </div>
    </div>

    <div class="letter-footer">
        <div>Bandung, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>

        <div class="signature-area">
            <div class="signature-line"></div>
            <p>Hormat kami,</p>
            <p><strong>{{ strtoupper($daftar->lowongan->user->nama_perusahaan ?? ($daftar->lowongan->user->name ?? 'PT. PERUSAHAAN TIDAK DIKETAHUI')) }}</strong>
            </p>
        </div>
    </div>
</body>

</html>
