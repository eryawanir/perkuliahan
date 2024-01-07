<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Matakuliah::with('dosen', 'jurusan')->paginate(3);
        return view('matakuliah.index')->with('matakuliahs', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();
        return view('matakuliah.create', [
            'jurusans' => $jurusans,
            'dosens' => $dosens,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode' => 'required|alpha_num|size:5|unique:matakuliahs,kode',
            'nama' => 'required',
            'dosen_id' => 'required|exists:App\Models\Dosen,id',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks' => 'required|digits_between:1,6',
        ]);
        $matakuliah = Matakuliah::create($validateData);
        return redirect('/matakuliahs')->with(
            'notif',
            "Data matakuliah $matakuliah->nama berhasil ditambahkan"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        $mahasiswas = $matakuliah->mahasiswas->sortBy('nama');
        return view(
            'matakuliah.show',
            [
                'matakuliah' => $matakuliah,
                'mahasiswas' => $mahasiswas,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matakuliah $matakuliah)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        $dosens = Dosen::orderBy('nama')->get();
        return view(
            'matakuliah.edit',
            [
                'matakuliah' => $matakuliah,
                'jurusans' => $jurusans,
                'dosens' => $dosens,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        $validateData = $request->validate([
            'kode' => 'required|alpha_num|size:5|unique:matakuliahs,kode,'
                . $matakuliah->id,
            'nama' => 'required',
            'dosen_id' => 'required|exists:App\Models\Dosen,id',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
            'jumlah_sks' => 'required|digits_between:1,6',
        ]);

        $matakuliah->update($validateData);
        return redirect('/matakuliahs')->with(
            'notif',
            "Data matakuliah $matakuliah->nama berhasil di update"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect('/matakuliahs')->with(
            'notif',
            "Data matakuliah $matakuliah->nama berhasil di HAPUS"
        );
    }
}
