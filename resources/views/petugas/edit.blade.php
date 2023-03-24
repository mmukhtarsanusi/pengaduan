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
  <form action="{{ route('petugas.update', ['id' => $petugas->id]) }}" method="POST">
    @csrf
    <div class="mt-2">
      <a href="{{ route('petugas.index') }}" class="btn btn-success">Kembali</a>
      <div class="row col-md-6">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Nama :</strong>
            <input type="text" name="nama" class="form-control" value="{{ $petugas->nama }}">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Password :</strong>
            <input type="password" name="password" class="form-control" value="{{ $petugas->password }}">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Nomor Telepon :</strong>
            <input type="number" name="telp" class="form-control" value="{{ $petugas->telp }}">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Level :</strong>
            <select name="level" class="form-control">
              <option value="Petugas" @if($petugas->level == "Petugas") selected @endif>Petugas</option>
              <option value="Admin" @if($petugas->level == "Admin") selected @endif>Admin</option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </form>
@endsection