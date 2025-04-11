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
                        <h2 class="fw-bold mb-3 text-uppercase">Verifikasi Email</h2>
                        
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success">
                                Link verifikasi telah dikirim ke email Anda.
                            </div>
                        @endif

                        <p class="text-white-50 mb-4">
                            Silakan cek email Anda dan klik link verifikasi untuk mengaktifkan akun.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-lg w-100 mb-3">
                                Kirim Ulang Link Verifikasi
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
