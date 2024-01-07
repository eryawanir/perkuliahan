<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>LSP Perkuliahan</title>
  <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

  <!-- NAVBAR -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light
bg-white py-3">
    <div class="container pb-3">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav m-auto">
          <li class="nav-item ">
            <a class="nav-link px-4" href="{{ route('jurusans.index') }}">
              Jurusan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-4" href="{{ route('dosens.index') }}">
              Dosen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-4" href="{{ route('mahasiswas.index') }}">
              Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link px-4" href="{{ route('matakuliahs.index') }}">
              MataKuliah</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-3" style="min-height:550px">
    <div class="row">
      <div class="col-12">

        @yield('content')

      </div>
    </div>
  </div>

</body>

</html>
