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
              <h2 class="fw-bold mb-3 text-uppercase">Register</h2>
              <p class="text-white-50 mb-4">Silahkan isi form untuk membuat akun baru!</p>
  
              <form action="{{route('registration.submit')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <input type="text" name="name" class="form-control form-control-lg" id="typeName" placeholder="Nama Lengkap">
                </div>

                <div class="mb-3">
                  <input type="nisn" name="nisn" class="form-control form-control-lg" id="typeNisn" placeholder="NISN">
                </div>
  
                <div class="mb-3">
                  <input type="email" name="email" class="form-control form-control-lg" id="typeEmail" placeholder="Email">
                </div>
  
                <div class="mb-3">
                  <div class="input-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="typePasswordX" placeholder="Password">
                    <button type="button" class="btn btn-outline-light" id="togglePassword">
                      <i class="fas fa-eye" id="iconPassword"></i>
                    </button>
                  </div>
                </div>
  
                <button class="btn btn-outline-light btn-lg w-100" type="submit">Daftar</button>
  
                {{-- <div class="d-flex justify-content-center text-center mt-4">
                  <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                  <a href="#" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                </div> --}}
              </form>

              {{-- Tampilkan error validasi --}}
              @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif

              <div class="mt-4">
                <p class="mb-0">Sudah memiliki akun? <a href="/login" class="text-white-50 fw-bold">Login</a></p>
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
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('typePasswordX');
    const icon = document.getElementById('iconPassword');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  });
</script>
@endpush

@endsection