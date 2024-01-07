<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = Jurusan::withCount('mahasiswas')->get();
        return view('jurusan.index')->with('jurusans', $jurusans);
    }

    public function dosen($jurusan_id)
    {
        $dosens = Dosen::where('jurusan_id', $jurusan_id)->orderBy('nama')
            ->paginate(5);
        $nama_jurusan = Jurusan::find($jurusan_id)->nama;
        return view('dosen.index', [
            'dosens' => $dosens,
            'nama_jurusan' => $nama_jurusan,
        ]);
    }

    public function mahasiswa($jurusan_id)
    {
        $mahasiswas = Mahasiswa::where('jurusan_id', $jurusan_id)->orderBy('nama')
            ->paginate(5);
        $nama_jurusan = Jurusan::find($jurusan_id)->nama;
        return view('mahasiswa.index', [
            'mahasiswas' => $mahasiswas,
            'nama_jurusan' => $nama_jurusan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'kepala_jurusan' => 'required',
        ]);
        $jurusan = Jurusan::create($validateData);
        return redirect('/jurusans')->with(
            'notif',
            "Data jurusan $jurusan->nama berhasil di buat"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'kepala_jurusan' => 'required',
        ]);
        $jurusan->update($validateData);
        return redirect('/jurusans')->with(
            'notif',
            "Data jurusan $jurusan->nama berhasil di update"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect('/jurusans')->with(
            'notif',
            "Data jurusan $jurusan->nama berhasil di HAPUS"
        );
    }
}
