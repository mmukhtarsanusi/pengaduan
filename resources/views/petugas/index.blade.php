@extends('layouts.master')
@section('content')
  <div class="mt-2">
    <div class="d-flex">
      <h4>Daftar Petugas</h4>
      <a href="{{ route('petugas.create') }}" class="btn btn-success ms-auto">
        <img src="{{ asset('assets/icons/plus-lg.svg') }}" width="20px" alt="">
        Tambah Petugas
      </a>
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
          <th scope="col">Nama</th>
          <th scope="col">Username</th>
          <th scope="col">Nomor Telepon</th>
          <th scope="col">Level</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($petugass as $petugas)
          <tr>  
            <td scope="row">{{ $petugass->firstItem() + $loop->index }}.</td>
            <td>{{ $petugas->nama }}</td>
            <td>{{ $petugas->username }}</td>
            <td>{{ $petugas->telp }}</td>
            <td>{{ $petugas->level }}</td>
            <td>
              <a class="text-decoration-none" href="/petugas/petugas/edit/{{ $petugas->id }}">
                <button type="button" class="btn btn-warning btn-sm">
                  <img src="{{ asset('assets/icons/pencil-square.svg') }}" width="20px" alt="">
                </button>
              </a>
              <a class="text-decoration-none" href="/petugas/petugas/delete/{{ $petugas->id }}" onclick="return confirm('Are you sure to delete?')">
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