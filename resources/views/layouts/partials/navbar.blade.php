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

                    {{-- 4. User Dropdown Profile --}}
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                {{-- PERBAIKAN: Foto di Tombol Lingkaran Kecil --}}
                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"  alt="user-avatar"  class="w-px-40 h-auto rounded-circle avatar-clean" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                {{-- PERBAIKAN: Foto di Dalam Menu Dropdown --}}
                                                <img src="{{ Auth::user()->avatar ? asset('uploads/avatars/' . Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"  alt="user-avatar"  class="w-px-40 h-auto rounded-circle avatar-clean" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            {{-- Nama otomatis terupdate dari DB --}}
                                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                            <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li><div class="dropdown-divider"></div></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">Profile</span>
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
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Daftar</a>
                    </li>
                @endauth
            @endif
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</nav>
<style>
    .avatar-clean {
        object-fit: cover !important; /* Jaga rasio gambar, potong bagian tepi */
        object-position: center center !important; /* Fokuskan potongan di tengah */
        width: 100% !important; /* Ikuti lebar bingkai */
        height: 100% !important; /* Ikuti tinggi bingkai */
    }
</style>