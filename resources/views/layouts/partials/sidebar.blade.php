<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 35px; height: auto;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">E-Perpus</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @auth
            @if(Auth::user()->role == 'admin')
                {{-- MENU DASHBOARD ADMIN --}}
                <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Data E-Perpustakaan</span>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.kategori.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-category"></i>
                        <div>Kategori</div>
                    </a>
                </li>
                
                <li class="menu-item {{ request()->routeIs('admin.rak.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.rak.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-grid-alt"></i>
                        <div>Rak</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.buku.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book"></i>
                        <div>Buku</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.anggota.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div>Anggota</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Transaksi</span>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.peminjaman.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-transfer"></i>
                        <div>Peminjaman</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pengembalian.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-rotate-left"></i>
                        <div>Pengembalian</div>
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</aside>
<style>
    .app-brand-link {
        display: flex;
        align-items: center;
    }
    .app-brand-logo img {
        /* Sesuaikan ukuran jika logo Anda terlalu besar/kecil */
        max-height: 35px; 
        object-fit: contain;
    }
</style>