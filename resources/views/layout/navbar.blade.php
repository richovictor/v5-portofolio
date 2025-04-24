<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/dashboard" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="/img/logo.png" alt="">
        <h1 class="sitename">PortoVolio</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="{{request()->is('dashboard')?'active' : ''}}">Beranda<br></a></li>
          <li><a href="{{ url('/dashboard#about') }}">Tentang</a></li>
          {{-- <li><a href="#services">Layanan</a></li> --}}
          <li><a href="{{ url('/dashboard#portfolio') }}">Portofolio</a></li>
          {{-- <li><a href="#team">Tim</a></li> --}}
          {{-- <li><a href="/blog">Blog</a></li> --}}
          {{-- <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li class="listing-dropdown"><a href="#"><span>Listing Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <a href="#">Column 1 link 1</a>
                <a href="#">Column 1 link 2</a>
                <a href="#">Column 1 link 3</a>
              </li>
              <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 3 link 1</a>
                <a href="#">Column 3 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 4 link 1</a>
                <a href="#">Column 4 link 2</a>
                <a href="#">Column 4 link 3</a>
              </li>
              <li>
                <a href="#">Column 5 link 1</a>
                <a href="#">Column 5 link 2</a>
                <a href="#">Column 5 link 3</a>
              </li>
            </ul> --}}
            @auth
            <li><a href="{{ route('profile.index') }}" class="{{ request()->is('siswa') ? 'active' : '' }}">Siswa</a></li>
            @endauth
          </li>
          <li><a href="{{ url('/dashboard#contact') }}">Kontak</a></li>
          @guest
          <a href="{{ route('login') }}" class="btn btn-outline-white d-flex align-items-center gap-2">
            <i class="fa-solid fa-right-to-bracket"></i> Login
          </a>

          @endguest
          @auth
          <li class="dropdown">
            <a href="#">
              <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=0D8ABC&color=fff' }}"
                alt="Profil" class="rounded-circle" width="28" height="28" style="object-fit: cover;">
              <i class="bi bi-chevron-down toggle-dropdown ms-1"></i>
            </a>
            <ul>
              <li><a href="{{ route('profile.index') }}">Profil Saya</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="dropdown-item bg-transparent border-0 p-0 ps-2">Keluar</button>
                </form>
              </li>
            </ul>
          </li>
          @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>
