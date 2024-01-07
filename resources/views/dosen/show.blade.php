@extends('layouts.app')
@section('content')
  <div class="pt-3">
    <h1 class="h2">Biodata Dosen</h1>
  </div>
  <hr>
  <ul>
    <li>Nama: <strong>{{ $dosen->nama }} </strong></li>
    <li>Nomor Induk: <strong>{{ $dosen->nik }} </strong></li>
    <li>Jurusan: <strong>{{ $dosen->jurusan->nama }} </strong></li>
  </ul>
  <p>Mengajar Matakuliah:</p>
  <ol>
    @foreach ($dosen->matakuliahs as $matakuliah)
      <li>
        {{ $matakuliah->nama }}
        <small>
          (<a href="{{ route('matakuliahs.show', ['matakuliah' => $matakuliah->id]) }}">{{ $matakuliah->kode }}</a>
          - {{ $matakuliah->jumlah_sks }} SKS)
        </small>
      </li>
    @endforeach
  </ol>
@endsection
