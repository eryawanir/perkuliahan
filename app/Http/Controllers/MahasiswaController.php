<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mahasiswa::with('jurusan')->orderBy('nama')->paginate(3);
        return view('mahasiswa.index')->with('mahasiswas', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nim' => 'required|alpha_num|size:9|unique:mahasiswas,nim',
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);

        $mahasiswa = Mahasiswa::create($validateData);
        return redirect('/mahasiswas')->with(
            'notif',
            "Data mahasiswa $mahasiswa->nama berhasil di daftarkan"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $matakuliahs = $mahasiswa->matakuliahs->sortBy('nama');
        return view('mahasiswa.show', [
            'mahasiswa' => $mahasiswa,
            'matakuliahs' => $matakuliahs,
        ]);
    }
    public function ambilMatakuliah(Mahasiswa $mahasiswa)
    {
        $matakuliahs = Matakuliah::where('jurusan_id', $mahasiswa->jurusan_id)
            ->orderBy('nama')->get();
        $matakuliahs_sudah_diambil = $mahasiswa->matakuliahs
            ->pluck('id')->all();
        return view(
            'mahasiswa.ambil-matakuliah',
            [
                'mahasiswa' => $mahasiswa,
                'matakuliahs' => $matakuliahs,
                'matakuliahs_sudah_diambil' => $matakuliahs_sudah_diambil,
            ]
        );
    }
    public function daftarkanMahasiswa(Matakuliah $matakuliah)
    {

        $mahasiswas = Mahasiswa::where('jurusan_id', $matakuliah->jurusan_id)
            ->orderBy('nama')->get();
        $mahasiswas_sudah_terdaftar = $matakuliah->mahasiswas
            ->pluck('id')->all();
        return view(
            'matakuliah.daftarkan-mahasiswa',
            [
                'matakuliah' => $matakuliah,
                'mahasiswas' => $mahasiswas,
                'mahasiswas_sudah_terdaftar' => $mahasiswas_sudah_terdaftar,
            ]
        );
    }
    public function prosesAmbilMatakuliah(Request $request, Mahasiswa $mahasiswa)
    {

        $matakuliah_jurusan =
            Matakuliah::where('jurusan_id', $mahasiswa->jurusan_id)
            ->pluck('id')->toArray();

        $validateData = $request->validate([
            'matakuliah.*' => 'distinct|in:' . implode(',', $matakuliah_jurusan),
        ]);

        $mahasiswa->matakuliahs()->sync($validateData['matakuliah'] ?? []);
        return redirect(route(
            'mahasiswas.show',
            ['mahasiswa' => $mahasiswa->id]
        ))->with('notif', 'Matakuliah berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('mahasiswa.edit', [
            'mahasiswa' => $mahasiswa,
            'jurusans' => $jurusans,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validateData = $request->validate([
            'nim' => 'required|alpha_num|size:9|unique:mahasiswas,nim,
            ' . $mahasiswa->id,
            'nama' => 'required',
            'jurusan_id' => 'required|exists:App\Models\Jurusan,id',
        ]);
        $mahasiswa->update($validateData);
        return redirect('/mahasiswas')->with(
            'notif',
            "Data mahasiswa $mahasiswa->nama berhasil di update"
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect('/mahasiswas')->with(
            'notif',
            "Data mahasiswa $mahasiswa->nama berhasil di HAPUS"
        );
    }
}
