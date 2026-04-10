<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function createDendaToken($peminjaman)
    {
        // 1. Transaction Details
        // ID di Midtrans harus unik, kita gabungkan ID peminjaman dengan timestamp
        $params = [
            'transaction_details' => [
                'order_id'     => 'DENDA-' . $peminjaman->id . '-' . time(),
                'gross_amount' => (int) $peminjaman->total_denda, 
            ],
            'customer_details' => [
                'first_name' => $peminjaman->user->name,
                'email'      => $peminjaman->user->email,
            ],
            'item_details' => [
                [
                    'id'       => 'FINE-' . $peminjaman->id,
                    'price'    => (int) $peminjaman->total_denda,
                    'quantity' => 1,
                    'name'     => 'Denda Keterlambatan: ' . $peminjaman->buku->judul,
                ]
            ],
        ];

        return Snap::getSnapToken($params);
    }
}