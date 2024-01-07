<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'nama', 'jurusan_id'];


    public function matakuliahs()
    {
        return $this->hasMany(Matakuliah::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
