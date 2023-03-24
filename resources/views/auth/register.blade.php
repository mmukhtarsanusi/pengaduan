@extends('layouts.login')
@section('content')
    <div class="register-form">
      <div class="auth-vector">
        {{-- <img src="{{ asset('assets/vectors/register-vector.svg') }}" alt="" width="200px"> --}}
      </div>
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
      <div>
        <form action="/register" method="POST">
          @csrf
          <h1 class="auth-title">Registrasi</h1>
          <p class="auth-title">Sihlakan isi untuk membuat akun</p>
          <div class="form-input">
            <label class="auth-label" for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="auth-input">
          </div>
          <div class="form-input">
            <label class="auth-label" for="username">Username</label>
            <input type="text" name="username" id="username" class="auth-input">
          </div>
          <div class="form-input">
            <label class="auth-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="auth-input">
          </div>
          <div class="form-input">
            <label class="auth-label" for="telp">Nomor Telepon</label>
            <input type="number" name="telp" id="telp" class="auth-input">
          </div>
          <div class="form-input">
            <label class="auth-label" for="nik">NIK</label>
            <input type="number" name="nik" id="nik" class="auth-input">
          </div>
          <button type="submit" class="auth-button">Register</button>
        </form>
        <p class="auth-sign"><a href="{{ route('login') }}">Sudah punya akun?</a></p>
      </div>
    </div>
@endsection
