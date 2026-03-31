<?php

namespace App\Services;

use App\Models\Pengembalian;

class PengembalianService
{
    /**
     * Mengambil data pengembalian dengan pencarian dan relasi.
     */
    public function getPaginatedPengembalian($search, $perPage = 15)
    {
        return Pengembalian::with(['peminjaman.anggota'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('peminjaman', function ($q) use ($search) {
                    $q->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhereHas('anggota', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                    });
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Menghapus satu data pengembalian.
     */
    public function deletePengembalian($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return $pengembalian->delete();
    }

    /**
     * Menghapus banyak data pengembalian sekaligus.
     */
    public function bulkDeletePengembalian(array $ids)
    {
        return Pengembalian::whereIn('id', $ids)->delete();
    }
}