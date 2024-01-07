@extends('layouts.app')
@section('content')
  <h1 class="display-4 text-center my-2" id="judul">
    Mahasiswa STMIK Mardira
  </h1>

  @if (request()->routeIs('jurusan-mahasiswa'))
    <h3 class="display-7 text-center my-0" id="judul">
      Jurusan {{ $nama_jurusan }}
    </h3>
  @endif
  <div class="pt-1 pb-2">
    <a href="{{ route('mahasiswas.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
  </div>
  @if (session()->has('notif'))
    <div class="alert alert-info">
      {{ session()->get('notif') }}
    </div>
  @endif
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Jurusan Mahasiswa</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($mahasiswas as $mahasiswa)
        <tr>
          <th>{{ $mahasiswas->firstItem() + $loop->iteration - 1 }}</th>
          <td>{{ $mahasiswa->nim }}</td>
          <td>{{ $mahasiswa->nama }}</td>
          <td>{{ $mahasiswa->jurusan->nama }}</td>
          <td>
            <a href="{{ route('mahasiswas.show', ['mahasiswa' => $mahasiswa->id]) }}" class="btn btn-primary ">Lihat</a>
            <a href="{{ route('mahasiswas.edit', ['mahasiswa' => $mahasiswa->id]) }}" class="btn btn-primary" title="Edit Mahasiswa">Edit</a>
            <form action="{{ route('mahasiswas.destroy', ['mahasiswa' => $mahasiswa->id]) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-danger shadow-none btn-hapus" title="Hapus Mahasiswa" data-name="{{ $mahasiswa->nama }}">
                Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="mx-auto mt-3">
      {{ $mahasiswas->fragment('judul')->links() }}
    </div>
  </div>
@endsection
