@extends('layouts.app')
@section('content')
  <h1 class="display-4 text-center mt-3 mb-0 " id="judul">
    Data Dosen STMIK Mardira
  </h1>
  @if (request()->routeIs('jurusan-dosen'))
    <h3 class="display-5 text-center my-0" id="judul">
      Jurusan {{ $nama_jurusan }}
    </h3>
  @endif
  <div class="t-5 pb-4">
    <a href="{{ route('dosens.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
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
        <th>NIK</th>
        <th>Nama Dosen</th>
        <th>Jurusan Dosen</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dosens as $dosen)
        <tr>
          <th>{{ $dosens->firstItem() + $loop->iteration - 1 }}</th>
          <td>{{ $dosen->nik }}</td>
          <td>{{ $dosen->nama }}</td>
          <td>{{ $dosen->jurusan->nama }}</td>
          <td>
            <a href="{{ route('dosens.show', ['dosen' => $dosen->id]) }}" class="btn btn-primary ">Lihat</a>
            <a href="{{ route('dosens.edit', ['dosen' => $dosen->id]) }}" class="btn btn-primary" title="Edit Dosen">Edit</a>
            <form action="{{ route('dosens.destroy', ['dosen' => $dosen->id]) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin hapus? data matakuliah yang berkaitan dengan dosen ini akan terhapus juga')" class="btn btn-danger shadow-none btn-hapus" title="Hapus Dosen" data-name="{{ $dosen->nama }}" data-table="dosen">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="mx-auto mt-3">
      {{ $dosens->fragment('judul')->links() }}
    </div>
  </div>
@endsection
