<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = Dosen::with('jurusan')->paginate(3);
        return view('dosen.index')->with('dosens', $dosens);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nik' => 'required|alpha_num|size:9|unique:dosens,nik',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        $dosen = Dosen::create($validateData);
        return redirect('/dosens')->with(
            'notif',
            "Data dosen $dosen->nama berhasil di buat"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('dosen.edit', ['dosen' => $dosen, 'jurusans' => $jurusans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validateData = $request->validate([
            'nik' => 'required|alpha_num|size:9|unique:dosens,nik,' . $dosen->id,
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        $dosen->update($validateData);
        return redirect('/dosens')->with(
            'notif',
            "Data dosen $dosen->nama berhasil di update"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect('/dosens')->with(
            'notif',
            "Data dosen $dosen->nama berhasil di HAPUS"
        );
    }
}
