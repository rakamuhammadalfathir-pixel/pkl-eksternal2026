<?php

namespace App\Services;

use App\Models\Kategori;

class KategoriService
{
    public function getAllPaginated($perPage = 5)
    {
        return Kategori::latest()->paginate($perPage);
    }

    public function storeKategori(array $data)
    {
        return Kategori::create($data);
    }

    public function updateKategori($id, array $data)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($data);
        return $kategori;
    }

    public function deleteKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        return $kategori->delete();
    }

    public function bulkDeleteKategori(array $ids)
    {
        return Kategori::whereIn('id', $ids)->delete();
    }
}