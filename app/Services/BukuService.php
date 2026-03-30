<?php

namespace App\Services;

use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuService
{
    /**
     * Logika untuk menyimpan atau mengupdate buku (termasuk upload foto)
     */
    public function upsertBuku(array $data, $id = null)
    {
        // Jika ada ID, berarti update. Jika tidak, buat baru.
        $buku = $id ? Buku::findOrFail($id) : new Buku();

        // Mengolah Foto
        if (isset($data['foto'])) {
            // Hapus foto lama jika sedang update
            if ($id && $buku->foto) {
                $this->deleteFoto($buku->foto);
            }

            $file = $data['foto'];
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('buku', $namaFile, 'public');
            $buku->foto = $namaFile;
        }

        // Isi data lainnya
        $buku->judul = $data['judul'];
        $buku->pengarang = $data['pengarang'];
        $buku->sinopsis = $data['sinopsis'] ?? null;
        $buku->penerbit = $data['penerbit'];
        $buku->tahun = $data['tahun'];
        $buku->stok = $data['stok'];
        $buku->kategori_id = $data['kategori_id'];
        $buku->rak_id = $data['rak_id'];

        $buku->save();
        return $buku;
    }

    /**
     * Logika hapus buku beserta fotonya
     */
    public function deleteBuku($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->foto) {
            $this->deleteFoto($buku->foto);
        }
        return $buku->delete();
    }

    /**
     * Helper untuk menghapus file fisik
     */
    private function deleteFoto($fileName)
    {
        if (Storage::disk('public')->exists('buku/' . $fileName)) {
            Storage::disk('public')->delete('buku/' . $fileName);
        }
    }
}