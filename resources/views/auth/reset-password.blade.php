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

            <h2 class="fw-bold mb-3 text-uppercase">Reset Password</h2>
            <p class="text-white-50 mb-4">Masukkan password baru kamu</p>

            {{-- Alert sukses --}}
            @if (session('status'))
            <div class="alert alert-success text-start">
                {{ session('status') }}
            </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">

              <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="typePassword" placeholder="Password Baru">
                  <button type="button" class="btn btn-outline-light" id="togglePassword">
                    <i class="fas fa-eye" id="iconPassword"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3">
                <div class="input-group">
                  <input type="password" name="password_confirmation" class="form-control form-control-lg" id="typePasswordConfirm" placeholder="Konfirmasi Password Baru">
                  <button type="button" class="btn btn-outline-light" id="togglePasswordConfirm">
                    <i class="fas fa-eye" id="iconPasswordConfirm"></i>
                  </button>
                </div>
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

              <button class="btn btn-outline-light btn-lg w-100" type="submit">Reset Password</button>
            </form>

            <div class="mt-4">
              <p class="mb-0">Ingat password lama? <a href="{{ route('login') }}" class="text-white-50 fw-bold">Login</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility for the password field (Password Baru)
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('typePassword');
    const icon = document.getElementById('iconPassword');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });

    // Toggle password visibility for the confirmation password field (Konfirmasi Password Baru Anda)
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirmInput = document.getElementById('typePasswordConfirm');
    const iconConfirm = document.getElementById('iconPasswordConfirm');

    togglePasswordConfirm.addEventListener('click', function () {
      const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordConfirmInput.setAttribute('type', type);
      iconConfirm.classList.toggle('fa-eye');
      iconConfirm.classList.toggle('fa-eye-slash');
    });
  });
</script>
@endpush

@endsection
