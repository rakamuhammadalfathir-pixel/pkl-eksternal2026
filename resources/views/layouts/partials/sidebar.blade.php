<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 19.5C4 18.837 4.26339 18.2011 4.73223 17.7322C5.20107 17.2634 5.83696 17 6.5 17H20" stroke="#696cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.5 2H20V22H6.5C5.83696 22 5.20107 21.7366 4.73223 21.2678C4.26339 20.7989 4 20.163 4 19.5V4.5C4 3.83696 4.26339 3.20107 4.73223 2.73223C5.20107 2.26339 5.83696 2 6.5 2Z" stroke="#696cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
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