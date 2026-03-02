<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang', 'penerbit', 'tahun', 'stok'];

    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
}
