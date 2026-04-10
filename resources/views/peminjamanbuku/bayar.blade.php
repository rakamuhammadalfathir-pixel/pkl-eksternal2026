@extends('layouts.user.peminjamanbuku')

@section('title', 'Pembayaran Denda')

@section('page-style')
<style>
    .payment-container { display: flex; align-items: center; justify-content: center; min-height: 60vh; }
    .payment-card { max-width: 450px; width: 100%; }
</style>
@endsection

@section('content')
<div class="payment-container">
    <div class="card payment-card text-center p-4">
        <div class="card-body">
            <div class="mb-4">
                <i class="bx bx-wallet text-primary" style="font-size: 4rem;"></i>
            </div>
            <h4 class="fw-bold">Pembayaran Denda</h4>
            <p class="text-muted">Buku: <strong>{{ $peminjaman->buku->judul }}</strong></p>
            
            <div class="bg-label-danger p-3 rounded mb-4">
                <span class="d-block text-muted mb-1">Total Denda</span>
                <h2 class="mb-0 fw-bold">Rp {{ number_format($denda, 0, ',', '.') }}</h2>
            </div>

            <button class="btn btn-primary btn-lg w-100 mb-3" id="pay-button">
                <i class="bx bx-credit-card me-2"></i> Bayar Sekarang
            </button>
            
            <a href="{{ route('peminjaman.history') }}" class="text-muted small">Kembali ke Riwayat</a>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                Swal.fire('Berhasil!', 'Pembayaran telah diterima.', 'success')
                    .then(() => window.location.href = "{{ route('peminjaman.history') }}");
            },
            onPending: function(result) {
                Swal.fire('Pending', 'Segera selesaikan pembayaran Anda.', 'info')
                    .then(() => window.location.href = "{{ route('peminjaman.history') }}");
            },
            onError: function(result) {
                Swal.fire('Gagal', 'Pembayaran tidak dapat diproses.', 'error');
            }
        });
    });
</script>
@endsection