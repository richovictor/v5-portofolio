@extends('main')

@section('content')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp

<section class="vh-100 gradient-custom d-flex align-items-center justify-content-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white rounded-4 shadow-lg">
          <div class="card-body p-5 text-center">

            <h2 class="fw-bold mb-3 text-uppercase">Lupa Password</h2>
            <p class="text-white-50 mb-4">Masukkan email untuk reset password</p>

            {{-- Alert sukses --}}
            @if (session('status'))
            <div class="alert alert-success text-start">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
              @csrf
              <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
              </div>

              {{-- Alert error validasi --}}
            @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

              <button class="btn btn-outline-light btn-lg w-100" type="submit">Kirim Link Reset</button>
            </form>

            <div class="mt-4">
              <p class="mb-0">Kembali ke halaman <a href="{{ route('login') }}" class="text-white-50 fw-bold">Login</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
