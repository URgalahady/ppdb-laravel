<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{


protected $fillable = [
    'nama', 'tempat_lahir', 'tanggal_lahir', 'asal_sekolah',
    'jurusan_id', 'foto', 'ijazah', 'akta', 'user_id', 'status'
];


  public function user() {
    return $this->belongsTo(User::class);
    
}
public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

}

