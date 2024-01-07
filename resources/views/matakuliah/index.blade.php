@extends('layouts.app')
@section('content')
  <h1 class="display-4 text-center my-2" id="judul">
    Mata Kuliah STMIK Mardira
  </h1>

  <div class="pt-2 pb-4">
    <a href="{{ route('matakuliahs.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
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
        <th>Kode</th>
        <th>Nama Mata Kuliah</th>
        <th>Dosen Pengajar</th>
        <th>Jumlah SKS</th>
        <th>Jurusan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($matakuliahs as $matakuliah)
        <tr>
          <th>{{ $matakuliahs->firstItem() + $loop->iteration - 1 }}</th>
          <td>{{ $matakuliah->kode }}</td>
          <td>{{ $matakuliah->nama }}</td>
          <td>
            <a href="{{ route('dosens.show', ['dosen' => $matakuliah->dosen->id]) }}">
              {{ $matakuliah->dosen->nama }}
            </a>

          </td>
          <td>{{ $matakuliah->jumlah_sks }}</td>
          <td>{{ $matakuliah->jurusan->nama }}</td>
          <td>
            <a href="{{ route('matakuliahs.show', ['matakuliah' => $matakuliah->id]) }}" class="btn btn-primary ">Lihat</a>
            <a href="{{ route('matakuliahs.edit', ['matakuliah' => $matakuliah->id]) }}" class="btn btn-primary" title="Edit Mata Kuliah">Edit</a>
            <form action="{{ route('matakuliahs.destroy', ['matakuliah' => $matakuliah->id]) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('yakin hapus?')" class="btn btn-danger shadow-none btn-hapus"title="Hapus Mata Kuliah" data-name="{{ $matakuliah->nama }}">
                Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row">
    <div class="mx-auto mt-3">
      {{ $matakuliahs->fragment('judul')->links() }}
    </div>
  </div>
@endsection
