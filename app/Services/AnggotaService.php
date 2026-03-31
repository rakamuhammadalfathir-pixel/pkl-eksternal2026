<?php

namespace App\Services;

use App\Models\User;
use App\Models\Anggota;

class AnggotaService
{
    public function getPaginatedAnggota($search, $perPage = 10)
    {
        return Anggota::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                                ->orWhereHas('user', function ($q) use ($search) {
                                    $q->where('email', 'like', '%' . $search . '%');
                                });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function toggleUserRole($userId)
    {
        $user = User::findOrFail($userId);
        $user->role = ($user->role === 'admin') ? 'customer' : 'admin';
        $user->save();
        
        return $user;
    }

    public function deleteAnggota($id)
    {
        $anggota = Anggota::findOrFail($id);
        return $anggota->delete();
    }

    public function bulkDeleteAnggota(array $ids)
    {
        return Anggota::whereIn('id', $ids)->delete();
    }
}