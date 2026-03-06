<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            @if (Route::has('login'))
                @auth
                    {{-- 1. Tombol LIHAT WEBSITE: Muncul HANYA jika Admin sedang di Panel Admin --}}
                    @if(Auth::user()->role == 'admin' && request()->is('admin/*'))
                        <li class="nav-item me-3">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('home') }}">
                                <i class="bx bx-world me-1"></i> Lihat Website
                            </a>
                        </li>
                    @endif

                    {{-- 2. Tombol PANEL ADMIN: Muncul HANYA jika Admin sedang di halaman Home/User --}}
                    @if(Auth::user()->role == 'admin' && (request()->is('home') || request()->is('/')))
                        <li class="nav-item me-3">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.dashboard') }}">
                                <i class="bx bx-shield-quarter me-1"></i> Panel Admin
                            </a>
                        </li>
                    @endif

                    {{-- 3. Menu Keranjang: Hanya untuk User biasa --}}
                    @if(Auth::user()->role !== 'admin')
                        <li class="nav-item me-3">
                            <a href="{{ route('keranjang.index') }}" class="nav-link">
                                <i class="menu-icon bx bx-shopping-cart"></i> Keranjang Saya
                            </a>
                        </li>
                    @endif

                    {{-- 4. User Dropdown Profile --}}
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Tombol jika Belum Login --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Daftar</a>
                    </li>
                @endauth
            @endif
        </ul>

        {{-- Form Logout (Tetap di luar UL agar tidak merusak layout) --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>