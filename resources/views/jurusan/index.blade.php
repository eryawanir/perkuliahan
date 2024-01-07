@extends('layouts.app')

@section('content')
  <h1 class="display-4 text-center my-1">Daftar Jurusan STMIK Mardira </h1>
  <div class="pt-2 pb-2">
    <a href="{{ route('jurusans.create') }}" class="btn btn-primary">
      + Tambah Jurusan</a>
  </div>
  @if (session()->has('notif'))
    <div class="alert alert-info">
      {{ session()->get('notif') }}
    </div>
  @endif
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
    @foreach ($jurusans as $jurusan)
      <div class="col">
        <div class="card h-100">

          <div class="card-body text-center">
            <h3 class="card-title py-1">{{ $jurusan->nama }}</h3>
            <hr>

            <div class="card-text py-1">Kepala Jurusan:
              <b>{{ $jurusan->kepala_jurusan }}</b>
            </div>
            <div class="card-text pb-4">Total Mahasiswa: {{ $jurusan->mahasiswas_count }}

            </div>
            <a href="{{ route('jurusans.edit', ['jurusan' => $jurusan->id]) }}" class="btn btn-primary d-inline-block mb-3 " title="Edit Jurusan">
              Edit <i class="fa fa-edit fa-fw"></i>
            </a>
            <a href="{{ route('jurusan-dosen', ['jurusan_id' => $jurusan->id]) }}" class="btn btn-primary d-block">Dosen</a>
            <a href="{{ route('jurusan-mahasiswa', ['jurusan_id' => $jurusan->id]) }}" class="btn btn-primary d-block mt-2">Mahasiswa</a>
            <form action="{{ route('jurusans.destroy', ['jurusan' => $jurusan->id]) }}" method="POST">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin Hapus? Data mahsiswa, matakuliah, dosen yg terhubugn dgn jurusan ini akan ikut terhapus')" class="btn btn-danger shadow-none btn-hapus mt-2" title="Hapus Jurusan" data-name="{{ $jurusan->nama }}" data-table="jurusan">
                Hapus <i class="fa fa-trash fa-fw"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
