@extends('layouts.master')
@section('content')
  <div class="mt-2">
    <div class="d-flex">
      <h4>Daftar Pengaduan</h4>
    </div>
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <table class="table table-primary mt-2 ">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tanggal Pengaduan</th>
          <th scope="col">Nama</th>
          <th scope="col">Isi Laporan</th>
          <th scope="col">Foto</th>
          <th scope="col">Status</th>
          <th scope="col" style="width: 100px">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pengaduans as $pengaduan)
          <tr>
            <td scope="row">{{ $pengaduans->firstItem() + $loop->index }}.</td>
            <td>{{ $pengaduan->tgl_pengaduan }}</td>
            <td>{{ $pengaduan->masyarakat->nama }}</td>
            <td>{{ $pengaduan->isi_laporan }}</td>
            <td>
              @if ($pengaduan->foto != "-")
                <img src="{{ asset($pengaduan->foto) }}" alt="foto aduan" width="100px">
              @else
                {{ $pengaduan->foto }}
              @endif
            </td>
            <td>
              {!!
                $pengaduan->status == "0" ? '<span class="badge text-bg-secondary">Pending</span>' :
                ($pengaduan->status == "Proses" ? '<span class="badge text-bg-warning">Proses</span>' : '<span class="badge text-bg-success">Selesai</span>')
              !!}
            </td>
            <td>
              <a class="text-decoration-none" href="/petugas/tanggapan/create/{{ $pengaduan->id }}">
                <button type="button" class="btn btn-warning btn-sm">
                  <img src="{{ asset('assets/icons/pencil-square.svg') }}" width="20px" alt="">
                </button>
              </a>
              <a class="text-decoration-none" href="/pengaduan/delete/{{ $pengaduan->id }}" onclick="return confirm('Are you sure to delete?')">
                <button type="button" class="btn btn-danger btn-sm">
                  <img src="{{ asset('assets/icons/trash.svg') }}" width="20px" alt="">
                </button>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
