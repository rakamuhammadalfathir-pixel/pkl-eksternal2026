@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
    <h4 class="mb-2 text-center">Selamat Datang! 👋</h4>
    <p class="mb-4 text-center">Silakan masuk untuk memulai petualangan membaca</p>

    <form id="formAuthentication" action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required autofocus />
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Kata Sandi</label>
                <a href="#"><small>Lupa Sandi?</small></a>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············" required autocomplete="new-password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                <label class="form-check-label" for="remember-me"> Ingat Saya </label>
            </div>
        </div>
        <button class="btn btn-primary d-grid w-100 shadow-sm" type="submit">Masuk Sekarang</button>
    </form>

    <p class="text-center mt-3">
        <span>Belum memiliki akun?</span>
        <a href="{{ route('register') }}"><span>Daftar di sini</span></a>
    </p>
@endsection