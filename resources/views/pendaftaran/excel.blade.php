<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Calon Pekerja</th>
            <th>Perekrut</th>
            <th>Lowongan</th>
            <th>Pengalaman</th>
            <th>Keahlian</th>
            <th>Tanggal Pendaftaran</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pendaftaran as $i => $daftar)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $daftar->user->name ?? 'Tidak Diketahui' }}</td>
                <td>{{ $daftar->lowongan->user->name ?? 'Tidak Diketahui' }}</td>
                <td>{{ $daftar->lowongan->judul }}</td>
                <td>{{ $daftar->pengalaman }}</td>
                <td>{{ $daftar->keahlian }}</td>
                <td>{{ \Carbon\Carbon::parse($daftar->tanggal_pendaftaran)->format('d-m-Y') }}</td>
                <td>{{ $daftar->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
