@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <h4 class="mb-2 text-center">Petualangan dimulai! 🚀</h4>
    <p class="mb-4 text-center">Buat akun Anda untuk akses koleksi digital</p>

    <form id="formAuthentication" action="{{ route('register') }}" method="POST" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="username" name="name" placeholder="Masukkan nama Anda" required autofocus />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required />
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Kata Sandi</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password-confirm">Konfirmasi Kata Sandi</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="············" required autocomplete="new-password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100 shadow-sm">Daftar Akun</button>
    </form>

    <p class="text-center mt-3">
        <span>Sudah memiliki akun?</span>
        <a href="{{ route('login') }}"><span>Masuk saja</span></a>
    </p>
@endsection