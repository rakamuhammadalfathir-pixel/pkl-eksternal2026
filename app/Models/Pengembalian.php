<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pengembalian extends Model
{
    protected $fillable = ['peminjaman_id', 'tgl_kembali_aktual', 'denda'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function getDendaAttribute($value)
    {
        // Hitung denda secara real-time berdasarkan tanggal
        if ($this->peminjaman && $this->tgl_kembali_aktual) {
            $tglHarusKembali = Carbon::parse($this->peminjaman->tgl_harus_kembali);
            $tglKembaliAktual = Carbon::parse($this->tgl_kembali_aktual);
            $dendaPerHari = 1000;

            if ($tglKembaliAktual->gt($tglHarusKembali)) {
                $selisihHari = $tglKembaliAktual->diffInDays($tglHarusKembali);
                return $selisihHari * $dendaPerHari;
            }
        }
        return $value; // Jika tidak ada perhitungan, kembalikan nilai dari database
    }
}
