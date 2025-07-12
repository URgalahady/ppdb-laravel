<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_berakhir',
        'is_active'
    ];

    // Relasi ke tabel pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    // Scope untuk gelombang aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
    protected static function boot()
{
    parent::boot();

    static::deleting(function($gelombang) {
        if ($gelombang->is_active) {
            throw new \Exception('Tidak bisa menghapus gelombang aktif');
        }
        
        if ($gelombang->pendaftarans()->count() > 0) {
            throw new \Exception('Ada pendaftaran di gelombang ini');
        }
    });
}
}
