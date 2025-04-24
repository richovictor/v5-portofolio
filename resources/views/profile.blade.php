@extends('main')

@section('content')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp

<div class="container py-5 my-2">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-center">Profile Siswa</h2>

                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update' ,['id' =>$user->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row g-4">
                            {{-- FOTO PROFIL --}}
                            <div class="col-md-4 text-center my-2">
                                <div class="position-relative mb-3">
                                    <img src="{{ $profile?->profile_image ? asset($profile->profile_image) : asset('uploads/foto_profile/foto_profile.png') }}"
                                         class="rounded-circle img-thumbnail shadow-sm"
                                         style="width: 160px; height: 160px; object-fit: cover;"
                                         alt="Foto Profil">
                                </div>
                                <label for="cover" class="form-label fw-semibold">Foto Profil</label>
                                <input type="file" name="profile_image" class="form-control form-control-sm w-auto mx-auto">
                            </div>
                            <div class="col-md-8 text-center justify-content-end my-2">
                                <div class="position-relative mb-3">
                                    <img src="{{ $profile?->cover_image ? asset($profile->cover_image) : asset('uploads/cover_profile/cover_profile.png') }}"
                                         class=" shadow-sm"
                                         style="width: 160px; height: 160px; object-fit: cover;"
                                         alt="Foto Cover">
                                </div>
                                <label for="cover" class="form-label fw-semibold">Foto Cover</label>
                                <input type="file" name="cover_image" id="cover_image" class="form-control">
                            </div>
                            {{-- FORM DATA --}}
                            <div class="col-md-12">
                                <div class="row g-3">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <label for="username" class="form-label fw-semibold">Username</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                               value="{{ old('username', $user->profile->username ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label fw-semibold">No. Telepon</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                               value="{{ old('phone_number', $user->profile->phone_number ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="instagram" class="form-label fw-semibold">Username Instagram</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control"
                                               value="{{ old('instagram', $user->profile->instagram ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="link_instagram" class="form-label fw-semibold">Link Instagram</label>
                                        <input type="url" name="link_instagram" id="link_instagram" class="form-control"
                                               value="{{ old('link_instagram', $user->profile->link_instagram ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="twitter" class="form-label fw-semibold">Username Twitter</label>
                                        <input type="text" name="twitter" id="twitter" class="form-control"
                                               value="{{ old('twitter', $user->profile->twitter ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="link_twitter" class="form-label fw-semibold">Link Twitter</label>
                                        <input type="url" name="link_twitter" id="link_twitter" class="form-control"
                                               value="{{ old('link_twitter', $user->profile->link_twitter ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="facebook" class="form-label fw-semibold">Username facebook</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control"
                                               value="{{ old('facebook', $user->profile->facebook ?? '') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="link_facebook" class="form-label fw-semibold">Link Facebook</label>
                                        <input type="url" name="link_facebook" id="link_facebook" class="form-control"
                                               value="{{ old('link_facebook', $user->profile->link_facebook ?? '') }}">
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

                    {{-- HAPUS FOTO --}}
                    @if($user->profile?->foto)
                        <form action="{{ route('profile.hapusFoto') }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
