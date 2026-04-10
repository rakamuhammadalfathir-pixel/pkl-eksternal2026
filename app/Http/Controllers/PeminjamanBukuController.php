<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 
use App\Services\MidtransService;
use App\Services\PeminjamanBukuService;

class PeminjamanBukuController extends Controller
{
    protected $peminjamanService;

    public function __construct(PeminjamanBukuService $peminjamanService)
    {
        $this->peminjamanService = $peminjamanService;
    }

    public function index()
    {
        $peminjamanbuku = $this->peminjamanService->getAntrean();
        return view('peminjamanbuku.index', compact('peminjamanbuku'));
    }

    public function add(Request $request)
    {
        $result = $this->peminjamanService->tambahkanKeAntrean($request->buku_id);
        return redirect()->back()->with($result['status'], $result['pesan']);
    }

    public function remove(Request $request)
    {
        $this->peminjamanService->hapusDariAntrean($request->id);
        return redirect()->back()->with('success', 'Buku dihapus dari antrean.');
    }

    public function clear()
    {
        $this->peminjamanService->kosongkanAntrean();
        return redirect()->back()->with('success', 'Antrean dikosongkan.');
    }
    
    public function checkout()
    {
        $result = $this->peminjamanService->prosesCheckout(auth()->id());
        
        if ($result['status'] === 'error') {
            return redirect()->back()->with('error', $result['pesan']);
        }

        return redirect()->route('peminjaman.history')->with('success', $result['pesan']);
    }

    public function kembalikanBuku($id)
    {
        $result = $this->peminjamanService->prosesPengembalian($id);
        return redirect()->back()->with('success', $result['pesan']);
    }

    public function history()
    {
        $history = $this->peminjamanService->getRiwayatUser(auth()->id());

        if ($history === null) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
        }

        return view('peminjamanbuku.history', compact('history'));
    }

    public function bayarDenda($id)
    {
        // Mengambil data peminjaman beserta relasi anggota (user) dan buku
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);
        
        // Keamanan: Cek apakah denda memang ada dan belum dibayar
        if ($peminjaman->total_denda <= 0 || $peminjaman->status_pembayaran === 'settlement') {
            return redirect()->route('peminjaman.history')->with('error', 'Tidak ada denda yang perlu dibayar.');
        }

        // Jika belum ada snap_token di database, buat baru ke Midtrans
        if (!$peminjaman->snap_token) {
            $midtransService = new MidtransService();
            try {
                $token = $midtransService->createDendaToken($peminjaman);
                $peminjaman->update(['snap_token' => $token]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal terhubung ke Midtrans: ' . $e->getMessage());
            }
        }

        return view('peminjamanbuku.pembayaran', [
            'snapToken' => $peminjaman->snap_token,
            'peminjaman' => $peminjaman
        ]);
    }

    public function bayar($id)
    {
        $peminjaman = Peminjaman::with('pengembalian', 'buku')->findOrFail($id);
        $denda = abs($peminjaman->pengembalian->denda);

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = 'Mid-server-Yt9YG4WnH1kNNHqlFgj-eUPw';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'DENDA-' . $peminjaman->kode_transaksi . '-' . time(),
                'gross_amount' => $denda,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $peminjaman->id,
                    'price' => $denda,
                    'quantity' => 1,
                    'name' => 'Denda Keterlambatan: ' . $peminjaman->buku->judul,
                ]
            ]
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Arahkan ke view pembayaran atau kirim token ke view
        return view('peminjamanbuku.bayar', compact('peminjaman', 'snapToken', 'denda'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                
                // Cari data peminjaman berdasarkan order_id yang dikirim Midtrans
                $peminjaman = \App\Models\Peminjaman::find($request->order_id);

                if ($peminjaman && $peminjaman->pengembalian) {
                    // Update kolom yang baru kita buat tadi
                    $peminjaman->pengembalian->update([
                        'status_denda' => 'Lunas',
                        'tanggal_bayar' => now()
                    ]);
                }
            }
        }
    }
}