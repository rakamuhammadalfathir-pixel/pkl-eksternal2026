<?php

namespace App\Services;

use App\Models\Rak;

class RakService
{
    public function getPaginatedRak($perPage = 10)
    {
        return Rak::latest()->paginate($perPage);
    }

    public function storeRak(array $data)
    {
        return Rak::create($data);
    }

    public function updateRak($id, array $data)
    {
        $rak = Rak::findOrFail($id);
        $rak->update($data);
        return $rak;
    }

    public function deleteRak($id)
    {
        $rak = Rak::findOrFail($id);
        return $rak->delete();
    }

    public function bulkDeleteRak(array $ids)
    {
        return Rak::whereIn('id', $ids)->delete();
    }
}