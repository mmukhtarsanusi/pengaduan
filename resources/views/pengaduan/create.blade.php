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
  <div class="d-flex justify-content-center">
    <div class="card w-50 mt-5">
      <div class="card-body">
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mt-2">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Tanggal :</strong>
                  <input type="date" name="tgl_pengaduan" class="form-control">
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <strong>Isi Laporan :</strong>
                  <textarea name="isi_laporan" class="form-control" cols="30" rows="4"></textarea>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
                <strong>Foto :</strong>
                <div class="input-group mb-3">
                  <input type="file" name="foto" class="form-control" id="inputGroupFile02">
                  <input type="hidden" name="nik" class="form-control" value="{{ Auth::guard('masyarakat')->user()->nik }}">
                  <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <a href="{{ route('pengaduan.index') }}" class="btn btn-success">Kembali</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection