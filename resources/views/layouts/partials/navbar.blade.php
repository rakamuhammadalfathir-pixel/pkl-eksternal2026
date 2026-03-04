<nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              {{-- <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                </div>
              </div>
              <!-- /Search --> --}}

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                          @if (Route::has('login'))
                              <div class="navbar-nav align-items-center d-flex flex-row">
                                  @auth
                                      @if(Auth::user()->role == 'admin')
                                          <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-primary me-3">
                                              <i class="bx bx-shield-quarter me-1"></i> Panel Admin
                                          </a>
                                      @else
                                          <a href="{{ url('/keranjang') }}" class="nav-link me-3">
                                              <i class="bx bx-cart me-1"></i> Keranjang
                                          </a>
                                      @endif

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
                                      <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary me-2">Masuk</a>
                                      <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Daftar</a>
                                  @endauth
                              </div>
                          @endif
                      </ul>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>