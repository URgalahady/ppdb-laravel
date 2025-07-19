<?php
// app/Models/Kontak.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama', 'subjek', 'pesan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
