<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = ['peminjaman_id', 'tgl_kembali_aktual', 'denda'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
