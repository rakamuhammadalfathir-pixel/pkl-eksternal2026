<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['user_id','nama', 'alamat', 'telepon'];
    
    protected $casts = [
        'alamat' => 'string',
        'telepon' => 'string',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
