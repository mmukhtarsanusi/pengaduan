<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aplikasi Pelaporan Pengaduan Masyarakat</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Pengaduan</th>
        <th>Isi Aduan</th>
        <th>Isi Tanggapan</th>
        <th>Nama Pelapor</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tanggapans as $tanggapan)
        <tr>
          <td>{{ $tanggapan->getNamaPetugas->nama }}</td>
          <td>{{ $tanggapan->getStatusPengaduan->tgl_pengaduan }}</td>
          <td>{{ $tanggapan->getStatusPengaduan->isi_laporan }}</td>
          <td>{{ $tanggapan->tanggapan }}</td>
          <td>{{ $tanggapan->getStatusPengaduan->nik }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>