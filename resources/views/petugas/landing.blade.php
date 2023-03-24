@extends('layouts.master')
@section('content')

<div class="card text-center border-primary mt-5">
    <div class="card-header border-primary">
        <h5 class="data-nama">{{ Auth::guard('petugas')->user()->nama }}</h5>
        <h6 class="data-level">{{ Auth::guard('petugas')->user()->level }}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card bg-danger">
                <div class="card-body">
                  <h5 class="card-title">Pengaduan</h5>
                  <h3 class="card-text">{{ $totalPengaduan}}</h3>
                </div>
              </div>
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">
              <div class="card bg-warning">
                <div class="card-body">
                  <h5 class="card-title">Proses</h5>
                  <h3 class="card-text">{{$aduanProses}}</h3>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-success">
                  <div class="card-body">
                    <h5 class="card-title">Selesai</h5>
                    <h3 class="card-text">{{$aduanSelesai}}</h3>
                  </div>
                </div>
              </div>
          </div>
    </div>
    <div class="card text-center mt-3">
        <div class="card-header">
          <h6>Masyarakat</h6>
        </div>
        <div class="card-body">
            <table class="table table border-primary mt-2 text-center">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Nomor Telepon</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($masyarakats as $masyarakat)
                    <tr>
                      <td scope="row">{{ $masyarakats->firstItem() + $loop->index }}.</td>
                      <td>{{ $masyarakat->nama }}</td>
                      <td>{{ $masyarakat->telp }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
      </div>
</div>
@endsection

