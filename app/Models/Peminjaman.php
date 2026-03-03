<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = ['kode_transaksi', 'anggota_id', 'tgl_pinjam', 'tgl_harus_kembali', 'status'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
