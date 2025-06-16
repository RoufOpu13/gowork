<!DOCTYPE html>
<html>
<head>
    <title>Data Penggajian</title>
    <style>
        /* Atur style sesuai kebutuhan (misalnya table borders, font, dsb) */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Penggajian</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Manajemen</th>
                <th>Gaji</th>
                <th>Tanggal Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggajian as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->manajemen ? $data->manajemen->users->name : 'Tidak Ada Data' }}</td>
                <td>{{ number_format($data->gaji, 0, ',', '.') }}</td>
                <td>{{ date('d-m-Y', strtotime($data->tanggal_pembayaran)) }}</td>
                <td>{{ $data->status_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
