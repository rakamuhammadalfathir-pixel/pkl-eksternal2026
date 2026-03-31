<?php

namespace App\Services;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Exception;

class PeminjamanService
{
    public function getPaginatedPeminjaman($search, $perPage = 15)
    {
        return Peminjaman::with(['anggota', 'buku'])
            ->when($search, function ($query, $search) {
                return $query->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('buku', function ($q) use ($search) {
                        $q->where('judul', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function approvePeminjaman($id)
    {
        return DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::findOrFail($id);
            $buku = Buku::findOrFail($peminjaman->buku_id);

            if ($buku->stok <= 0) {
                throw new Exception('Stok buku habis, tidak bisa disetujui.');
            }

            $peminjaman->update(['status' => 'Pinjam']);
            $buku->decrement('stok');

            return true;
        });
    }

    public function rejectPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return $peminjaman->update(['status' => 'Ditolak']);
    }

    public function deletePeminjaman($id)
    {
        return DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::findOrFail($id);

            // Jika statusnya sedang dipinjam, kembalikan stok buku dulu
            if (strtolower($peminjaman->status) === 'pinjam') {
                $buku = Buku::find($peminjaman->buku_id);
                if ($buku) {
                    $buku->increment('stok');
                }
            }

            return $peminjaman->delete();
        });
    }

    public function bulkDeletePeminjaman(array $ids)
    {
        return Peminjaman::whereIn('id', $ids)->delete();
    }
}