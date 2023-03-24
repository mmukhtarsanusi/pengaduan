<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
  <title>Pelaporan Pengaduan Masyarakat</title>
</head>
<body>

  <nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      @if (Auth::guard('masyarakat')->user())
        <a class="navbar-brand" href="{{ route('masyarakat.landing') }}"><img src="{{asset('assets/vectors/logo.png')}}" alt="APPM" width="30px"></a>
      @else
        <a class="navbar-brand" href="{{ route('petugas.landing') }}"><img src="{{asset('assets/vectors/logo.png')}}" alt="APPM" width="30px"></a>
      @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          @if (Auth::guard('masyarakat')->user())
            <a class="{{ request()->is('pengaduan') ? 'active' : '' }} nav-link" href="{{ route('pengaduan.index') }}">Daftar Aduan</a>
          @endif
          @if (Auth::guard('petugas')->user())
            <a class="{{ request()->is('petugas/pengaduan') ? 'active' : '' }} nav-link" href="{{ route('pengaduan.indexPetugas') }}">Daftar Pengaduan</a>
            <a class="{{ request()->is('petugas/tanggapan') ? 'active' : '' }} nav-link" href="{{ route('tanggapan.index') }}">Daftar Tanggapan</a>
            <a class="{{ request()->is('petugas/masyarakat') ? 'active' : '' }} nav-link" href="{{ route('masyarakat.index') }}">Daftar Masyarakat</a>
            <a class="{{ request()->is('petugas/petugas') ? 'active' : '' }} nav-link" href="{{ route('petugas.index') }}">Daftar Petugas</a>
            <a class="{{ request()->is('petugas/generate_pdf') ? 'active' : '' }} nav-link" href="{{ route('generate.pdf') }}">Generate PDF</a>
          @endif
            <a class="nav-link" href="{{ route('logout') }}" >Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>
