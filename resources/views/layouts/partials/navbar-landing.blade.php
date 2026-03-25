<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme w-100" id="layout-navbar">
    <div class="container-xxl d-flex align-items-center justify-content-between">
        
        <div class="navbar-nav align-items-center">
            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 30px; width: auto;">
                </span>
                <span class="app-brand-text demo menu-text fw-bolder text-capitalize text-dark ms-2">E-Perpus</span>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center flex-grow-1" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center m-auto d-none d-lg-flex">
                @auth
                    @if(Auth::user()->role == 'customer')
                        <li class="nav-item">
                            <a class="nav-link px-3 fw-bold {{ request()->routeIs('home') ? 'active text-primary' : 'text-secondary' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 fw-bold {{ request()->routeIs('katalog.index') ? 'active text-primary' : 'text-secondary' }}" href="{{ route('katalog.index') }}">Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 fw-bold {{ request()->routeIs('wishlist.index') ? 'active text-primary' : 'text-secondary' }}" href="{{ route('wishlist.index') }}">Wishlist</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-3 fw-bold text-secondary" href="javascript:void(0)" id="navTransaksi" data-bs-toggle="dropdown">
                                Transaksi
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start shadow-sm border-0">
                                <li><a class="dropdown-item" href="{{ route('peminjamanbuku.index') }}"><i class="bx bx-book-open me-2"></i>Pinjam Buku</a></li>
                                <li><a class="dropdown-item" href="{{ route('peminjaman.history') }}"><i class="bx bx-history me-2"></i>Riwayat</a></li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-link text-dark fw-bold me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">Daftar</a>
                    </li>
                @else
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" class="w-px-40 h-auto rounded-circle" style="object-fit: cover; height: 40px !important;" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <div class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" class="w-px-40 h-auto rounded-circle" style="object-fit: cover; height: 40px !important;" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block text-dark">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><div class="dropdown-divider"></div></li>
                            @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bx bx-grid-alt me-2"></i> Dashboard Admin</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bx bx-user me-2"></i> Profil Saya</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bx bx-power-off me-2"></i> Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Mengunci Navbar di Atas */
    #layout-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        width: 100% !important;
        z-index: 1080;
        margin: 0 !important;
        padding: 0 !important;
        height: 70px; /* Tinggi standar navbar */
        background: #ffffff !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }

    /* Memberi jarak konten agar tidak 'nyelip' di bawah navbar */
    body {
        padding-top: 70px !important;
    }

    /* Gaya Link Aktif */
    .nav-link.active {
        color: #696cff !important;
        position: relative;
    }
    .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 15%;
        width: 70%;
        height: 3px;
        background: #696cff;
        border-radius: 10px;
    }

    /* Hilangkan bayangan bawaan Sneat yang mengganggu */
    .navbar-detached {
        box-shadow: none !important;
    }

    /* Agar logo dan avatar tidak gepeng */
    .avatar img {
        object-fit: cover;
    }   
    /* Tambahkan ini di dalam tag <style> yang sudah ada */
    .app-brand-logo img {
        display: block;
        transition: all 0.2s ease-in-out;
    }

    /* Jika ingin logo sedikit membesar saat dihover */
    .app-brand-link:hover .app-brand-logo img {
        transform: scale(1.1);
    }
</style>