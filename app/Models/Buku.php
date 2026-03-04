<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang', 'penerbit', 'tahun', 'stok', 'kategori_id', 'rak_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
}
