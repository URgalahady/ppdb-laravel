<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{


protected $fillable = [
    'user_id',
    'gelombang_id', 
    'jurusan_id',
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'asal_sekolah',
    'foto',
    'ijazah',
    'akta',
    'status',
    'tahap'
];

// Relasi ke user
public function user()
{
    return $this->belongsTo(User::class);
}

// Relasi ke gelombang
public function gelombang()
{
    return $this->belongsTo(Gelombang::class);
}

// Relasi ke jurusan
public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

}

