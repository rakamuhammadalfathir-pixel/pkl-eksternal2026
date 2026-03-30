<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme w-100" id="layout-navbar">
    <div class="container-xxl d-flex align-items-center justify-content-between">
        
        <div class="navbar-nav align-items-center">
            <a href="{{ route('home') }}" class="app-brand-link gap-2 text-decoration-none">
                <span class="app-brand-logo demo">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 32px; width: auto;">
                </span>
                <span class="app-brand-text demo menu-text fw-bold text-heading ms-2" style="font-size: 1.5rem; letter-spacing: -0.5px;">E-Perpus</span>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center flex-grow-1" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center m-auto d-none d-lg-flex gap-2">
                @auth
                    @if(Auth::user()->role == 'customer')
                        <li class="nav-item">
                            <a class="nav-link px-4 fw-medium {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 fw-medium {{ request()->routeIs('katalog.index') ? 'active' : '' }}" href="{{ route('katalog.index') }}">Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-4 fw-medium {{ request()->routeIs('wishlist.index') ? 'active' : '' }}" href="{{ route('wishlist.index') }}">Wishlist</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle px-4 fw-medium" href="javascript:void(0)" id="navTransaksi" data-bs-toggle="dropdown">
                                Transaksi
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start shadow-lg border-0 mt-3 p-2">
                                <li>
                                    <a class="dropdown-item rounded-2 py-2" href="{{ route('peminjamanbuku.index') }}">
                                        <i class="icon-base ri-book-open-line me-2 text-primary"></i>Pinjam Buku
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded-2 py-2" href="{{ route('peminjaman.history') }}">
                                        <i class="icon-base ri-history-line me-2 text-primary"></i>Riwayat
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                @guest
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('login') }}" class="btn btn-link text-heading fw-semibold me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-5 shadow-primary">Daftar</a>
                    </li>
                @else
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online border-2 border-primary shadow-sm">
                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" class="rounded-circle" style="object-fit: cover;" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3 p-2">
                            <li>
                                <div class="dropdown-item p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}" class="rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-bold d-block text-heading">{{ Auth::user()->name }}</span>
                                            <small class="text-muted text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">{{ Auth::user()->role }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item rounded-2 py-2" href="{{ route('admin.dashboard') }}"><i class="icon-base ri-dashboard-line me-2 text-primary"></i> Dashboard Admin</a></li>
                            @endif
                            <li><a class="dropdown-item rounded-2 py-2" href="{{ route('profile.index') }}"><i class="icon-base ri-user-settings-line me-2 text-primary"></i> Profil Saya</a></li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item rounded-2 py-2 text-danger">
                                        <i class="icon-base ri-logout-circle-r-line me-2"></i> Keluar
                                    </button>
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
    /* Fixed Glassmorphism Style */
    #layout-navbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1080;
        height: 80px;
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px) saturate(180%);
        -webkit-backdrop-filter: blur(12px) saturate(180%);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
    }

    /* Modern Link Styling */
    .nav-link {
        color: #433d52 !important;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: #696cff !important;
        transform: translateY(-1px);
    }

    /* Indicator Link Aktif (Garis di bawah) */
    .nav-link.active {
        color: #696cff !important;
        font-weight: 700 !important;
    }

    .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 1.5rem;
        right: 1.5rem;
        height: 3px;
        background: #696cff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(105, 108, 255, 0.4);
    }

    /* Shadow & Animasi Dropdown */
    .dropdown-menu {
        min-width: 240px;
        border-radius: 15px !important;
        animation: navFadeIn 0.3s ease;
    }

    @keyframes navFadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .shadow-primary {
        box-shadow: 0 4px 14px 0 rgba(105, 108, 255, 0.39) !important;
    }

    .app-brand-link:hover .app-brand-logo img {
        transform: rotate(-10deg) scale(1.1);
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
</style>