<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['nama_jurusan', 'kuota', 'penuh'];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

public function updateStatusPenuh()
{
    $jumlahPendaftar = $this->pendaftarans()->count();
    $this->penuh = $this->kuota <= 0;
    $this->save();
}

}