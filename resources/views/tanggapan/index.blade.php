@extends('layouts.master')
@section('content')
  <div class="mt-2">
    <div class="d-flex">
      <h4>Daftar Tanggapan</h4>
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
    <table class="table table-primary mt-2 text-center">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tanggal Tanggapan</th>
          <th scope="col">ID Pengaduan</th>
          <th scope="col">Nama Petugas</th>
          <th scope="col">Tanggapan</th>
          <th scope="col">Status Pengaduan</th>
          <th scope="col" style="width: 140px">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tanggapans as $tanggapan)
          <tr>
            <td scope="row">{{ $tanggapans->firstItem() + $loop->index }}.</td>
            <td>{{ $tanggapan->tgl_tanggapan }}</td>
            <td>{{ $tanggapan->id_pengaduan }}</td>
            <td>{{ $tanggapan->getNamaPetugas->nama }}</td>
            <td>{{ $tanggapan->tanggapan }}</td>
            <td>
              {!! 
                $tanggapan->getStatusPengaduan->status == "0" ? '<span class="badge text-bg-secondary">Pending</span>' :
                ($tanggapan->getStatusPengaduan->status == "Proses" ? '<span class="badge text-bg-warning">Proses</span>' : '<span class="badge text-bg-success">Selesai</span>')
              !!}
            </td>
            <td>
              <a class="text-decoration-none" {{-- href="/pengaduan/edit/{{ $tanggapan->id }}" --}}>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $loop->index }}">
                  <img src="{{ asset('assets/icons/eye.svg') }}" width="20px" alt="">
                </button>
              </a>
              <a class="text-decoration-none" href="/petugas/tanggapan/edit/{{ $tanggapan->id }}">
                <button type="button" class="btn btn-warning btn-sm">
                  <img src="{{ asset('assets/icons/pencil-square.svg') }}" width="20px" alt="">
                </button>
              </a>
              <a class="text-decoration-none" href="/petugas/tanggapan/delete/{{ $tanggapan->id }}" onclick="return confirm('Are you sure to delete?')">
                <button type="button" class="btn btn-danger btn-sm">
                  <img src="{{ asset('assets/icons/trash.svg') }}" width="20px" alt="">
                </button>
              </a>
            </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade" id="detailModal{{ $loop->index }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $loop->index }}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="detailModalLabel{{ $loop->index }}">Detail Pengaduan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img src="{{ asset($tanggapan->getStatusPengaduan->foto) }}" alt="" class="w-100">
                  {{ $tanggapan->getStatusPengaduan->isi_laporan }}
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection