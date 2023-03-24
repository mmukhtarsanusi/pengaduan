@extends('layouts.master')
@section('content')
  <div class="mt-2">
    <div class="d-flex">
      <h4>Daftar Masyarakat</h4>
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
          <th scope="col">NIK</th>
          <th scope="col">Nama</th>
          <th scope="col">Username</th>
          <th scope="col">Nomor Telepon</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($masyarakats as $masyarakat)
          <tr>
            <td scope="row">{{ $masyarakats->firstItem() + $loop->index }}.</td>
            <td>{{ $masyarakat->nik }}</td>
            <td>{{ $masyarakat->nama }}</td>
            <td>{{ $masyarakat->username }}</td>
            <td>{{ $masyarakat->telp }}</td>
            <td>
              <a class="text-decoration-none" href="/petugas/masyarakat/delete/{{ $masyarakat->id }}" onclick="return confirm('Are you sure to delete?')">
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