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
                        <h2 class="fw-bold mb-3 text-uppercase">Verifikasi Berhasil</h2>
                        <p class="text-white-50 mb-4">
                            Selamat! Email Anda berhasil diverifikasi. Silakan login untuk melanjutkan.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg w-100">
                            Login Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
