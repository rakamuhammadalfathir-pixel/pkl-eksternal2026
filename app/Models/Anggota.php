<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['user_id', 'nik', 'nama', 'alamat', 'telepon', 'jenis_kelamin'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
