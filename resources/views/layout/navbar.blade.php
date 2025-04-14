<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/dashboard" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="/img/logo.png" alt="">
        <h1 class="sitename">PortoVolio</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/dashboard" class="{{request()->is('dashboard')?'active' : ''}}">Beranda<br></a></li>
          <li><a href="#about">Tentang</a></li>
          {{-- <li><a href="#services">Layanan</a></li> --}}
          <li><a href="#portfolio">Portofolio</a></li>
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
            <li><a href="{{ route('laman.siswa') }}" class="{{ request()->is('siswa') ? 'active' : '' }}">Siswa</a></li>
            @endauth
          </li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      {{-- Jika belum login --}}
@guest
<a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">Masuk</a>
@endguest

{{-- Jika sudah login --}}
@auth
<div class="dropdown ms-3">
  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-person-circle fs-4"></i>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="{{ route('laman.siswa') }}">Profil Saya</a></li>
    <li>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item">Keluar</button>
      </form>
    </li>
  </ul>
</div>
@endauth


    </div>
  </header>