@extends('layouts.master')
@section('content')
  @if ($errors->any())
    <div class="alert alert-danger mt-4">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <form action="{{ route('tanggapan.store', ['id_pengaduan' => $pengaduan->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <a href="{{ route('pengaduan.indexPetugas') }}" class="btn btn-success mt-2">Kembali</a>
    <div class="mt-2 d-flex">
      <div class="row col-md-6">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Tanggal :</strong>
            <input type="date" name="tgl_tanggapan" class="form-control">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Status :</strong>
            <div class="d-flex">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status1" value="proses" checked>
                <label class="form-check-label" for="status1">
                  Proses
                </label>
              </div>
              <div class="form-check ms-5">
                <input class="form-check-input" type="radio" name="status" id="status2" value="selesai">
                <label class="form-check-label" for="status2">
                  Selesai
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
          <div class="form-group">
            <strong>Tanggapan :</strong>
            <textarea name="tanggapan" class="form-control" cols="30" rows="4"></textarea>
          </div>
        </div>
        <input type="hidden" name="id_petugas" class="form-control" value="{{ Auth::guard('petugas')->user()->id }}">
        <input type="hidden" name="id_pengaduan" class="form-control" value="{{ $pengaduan->id }}">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      
      <div class="col-md-1"></div>

      <div class="card col-md-5">
        <img src="{{ asset($pengaduan->foto) }}" alt="foto aduan" class="w-100">
        <div class="card-body">
          <p class="card-text">{{ $pengaduan->isi_laporan }}</p>
        </div>
      </div>
    </div>
  </form>
@endsection