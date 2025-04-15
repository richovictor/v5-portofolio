@extends('main')

@section('content')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-center">Profil Siswa</h2>

                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            {{-- FOTO PROFIL --}}
                            <div class="col-md-4 text-center">
                                <div class="position-relative">
                                    <img src="{{ $user->profil?->foto ? asset($user->profil->foto) : 'https://via.placeholder.com/150' }}"
                                         class="rounded-circle img-thumbnail shadow-sm"
                                         alt="Foto Profil"
                                         style="width: 160px; height: 160px; object-fit: cover;">
                                </div>
                                <div class="mt-3">
                                    <input type="file" name="foto" class="form-control form-control-sm w-auto mx-auto">
                                </div>
                            </div>

                            {{-- FORM DATA --}}
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="username" class="form-label fw-semibold">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                               value="{{ old('username', $user->profil->username ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="alamat" class="form-label fw-semibold">Alamat</label>
                                        <input type="text" name="alamat" id="alamat" class="form-control"
                                               value="{{ old('alamat', $user->profil->alamat ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="no_telp" class="form-label fw-semibold">No. Telepon</label>
                                        <input type="text" name="no_telp" id="no_telp" class="form-control"
                                               value="{{ old('no_telp', $user->profil->no_telp ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="instagram" class="form-label fw-semibold">Instagram</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                               value="{{ old('instagram', $user->profil->instagram ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="twitter" class="form-label fw-semibold">Twitter</label>
                                        <input type="text" name="twitter" id="twitter" class="form-control"
                                               value="{{ old('twitter', $user->profil->twitter ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            {{-- TOMBOL SIMPAN --}}
                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                    Simpan
                                </button>
                            </div>
                        </div> <!-- row -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
