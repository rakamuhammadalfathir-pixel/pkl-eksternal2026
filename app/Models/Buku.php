<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    protected $fillable = ['judul', 'pengarang','sinopsis', 'penerbit', 'tahun', 'stok', 'kategori_id', 'rak_id', 'foto'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    
    protected static function booted()
    {
        static::deleting(function ($buku) {
            if ($buku->foto) {
                Storage::disk('public')->delete('buku/' . $buku->foto);
            }
        });
    }

    public function wishedBy() 
    {
        return $this->belongsToMany(User::class, 'wishlists', 'buku_id', 'user_id');
    }
}
