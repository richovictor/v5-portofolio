@extends('admin.layouts.master')
@section('title') @lang('User - Home') @endsection
@section('css')
<link href="{{ URL::asset('admin/assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('admin/assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
<style>
    .profile-header {
        height: 50px !important; /* Sesuaikan tinggi elemen */
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover; /* Gambar memenuhi elemen tanpa stretch */
        background-position: center; /* Posisi gambar di tengah */
        background-repeat: no-repeat; /* Hindari pengulangan gambar */
        aspect-ratio: 18 / 6; /* Untuk menjaga rasio 3:1 */
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                 <div class="row align-items-center">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <h5 class="card-title">User List <span class="text-muted fw-normal ms-2">({{$users->count()}})</span></h5>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                             <div>
                                 <ul class="nav nav-pills">
                                     <li class="nav-item">
                                         <a class="nav-link active" href="apps-contacts-list" data-bs-toggle="tooltip" data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                                     </li>
                                     {{-- <li class="nav-item">
                                         <a class="nav-link" href="apps-contacts-grid" data-bs-toggle="tooltip" data-bs-placement="top" title="Grid"><i class="bx bx-grid-alt"></i></a>
                                     </li> --}}
                                 </ul>
                             </div>
                             <div>
                                 <a href="{{route('registration.process')}}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
                             </div>

                             <div class="dropdown">
                                 <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="bx bx-dots-horizontal-rounded"></i>
                                 </a>

                                 <ul class="dropdown-menu dropdown-menu-end">
                                     <li><a class="dropdown-item" href="#">Action</a></li>
                                     <li><a class="dropdown-item" href="#">Another action</a></li>
                                     <li><a class="dropdown-item" href="#">Something else here</a></li>
                                 </ul>
                             </div>
                         </div>

                     </div>
                 </div>
                 <!-- end row -->

                 <div class="table-responsive mb-4">
                     <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                         <thead>
                         <tr>
                             <th scope="col" style="width: 50px;">
                                 <div class="form-check font-size-16">
                                     <input type="checkbox" class="form-check-input" id="checkAll">
                                     <label class="form-check-label" for="checkAll"></label>
                                 </div>
                             </th>
                             <th scope="col">Name</th>
                             <th scope="col">Email</th>
                             <th scope="col">Role</th>
                             <th scope="col">Banner</th>
                             <th style="width: 80px; min-width: 80px;">Action</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach ($users as $user )
                                <tr>
                                    <th scope="row">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                            <label class="form-check-label" for="contacusercheck1"></label>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <!-- Foto Profil -->

                                            <img src="{{ $user->profile?->profile_image ? asset($user->profile->profile_image) : asset('uploads/foto_profile/foto_profile.png') }}" alt="Photo not uploaded"
                                            class="avatar-sm rounded-circle me-3">


                                            <!-- Nama dan Nickname -->
                                            <div>
                                                <a href="#" class="d-block text-body fw-bold">{{ $user->name }}</a>
                                                @if (!empty($user->profile) && !empty($user->profile->nickname))
                                                    <span class="text-muted">{{ $user->profile->nickname }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{$user->email}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @foreach($user->roles as $role)
                                                <a href="#" class="badge bg-primary-subtle text-primary">
                                                    {{ $role->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Teks untuk membuka modal -->
                                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#bannerModal-{{ $user->id }}">
                                            Lihat Gambar Banner
                                        </a>

                                        <!-- Modal Bootstrap -->
                                        <div class="modal fade" id="bannerModal-{{ $user->id }}" tabindex="-1" aria-labelledby="bannerModalLabel-{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="bannerModalLabel-{{ $user->id }}">Gambar Banner</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <!-- Gambar Banner -->
                                                        <img src="{{ $user->profile?->cover_image ? asset($user->profile->cover_image) : asset('uploads/foto_profile/foto_profile.png') }}" alt="Banner Image" class="img-fluid rounded">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRoles-{{$user->id}}" href="#">
                                                        Change Roles
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}" href="#">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $user->id }}" href="#">
                                                        Delete
                                                    </a>
                                                </li>
                                                {{-- <li>
                                                    @if ($user->suspend == 'no')
                                                        <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalSuspend-{{ $user->id }}" href="#">
                                                            Suspend Account
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item text-success" data-bs-toggle="modal" data-bs-target="#modalUnsuspend-{{ $user->id }}" href="#">
                                                            Unsuspend Account
                                                        </a>
                                                    @endif
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </td>
                                    <!-- Modal untuk ganti roles user -->
                                    <div class="modal fade" id="modalRoles-{{ $user->id }}" tabindex="-1" aria-labelledby="modalRoles-{{$user->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Ubah Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- Form untuk update role -->
                                                <form action="{{ route('adminIndex.user.role', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Pilihan Role -->
                                                        <div class="mb-3">
                                                            <label for="roles-{{ $user->id }}" class="form-label">Pilih Role</label>
                                                            <select name="roles[]" id="roles-{{ $user->id }}" class="form-select" multiple>
                                                                @foreach($roles as $role)
                                                                    <option value="{{ $role->name }}"
                                                                        {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <small class="text-muted">Tekan <kbd>Ctrl</kbd> untuk memilih lebih dari satu role.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of ganti roles user -->

                                    <!-- Modal untuk mengedit user -->
                                    <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('adminIndex.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Nama -->
                                                        <div class="mb-3">
                                                            <label for="name-{{ $user->id }}" class="form-label">Nama</label>
                                                            <input type="text" name="name" id="name-{{ $user->id }}" class="form-control" value="{{ $user->name }}" required>
                                                        </div>

                                                        <!-- Nickname -->
                                                        <div class="mb-3">
                                                            <label for="nickname-{{ $user->id }}" class="form-label">Nickname</label>
                                                            <input type="text" name="nickname" id="nickname-{{ $user->id }}" class="form-control" value="{{ $user->profile->nickname ?? '' }}">
                                                        </div>

                                                        <!-- Foto Profil -->
                                                        <div class="mb-3">
                                                            <label for="photo_profiles-{{ $user->id }}" class="form-label">Foto Profil</label>
                                                            <input type="file" name="photo_profiles" id="photo_profiles-{{ $user->id }}" class="form-control">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto profil.</small>
                                                        </div>

                                                        <!-- Foto Banner -->
                                                        <div class="mb-3">
                                                            <label for="photo_banner-{{ $user->id }}" class="form-label">Foto Banner</label>
                                                            <input type="file" name="photo_banner" id="photo_banner-{{ $user->id }}" class="form-control">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto banner.</small>
                                                        </div>

                                                        <!-- Password -->
                                                        <div class="mb-3">
                                                            <label for="password-{{ $user->id }}" class="form-label">password</label>
                                                            <input type="text" name="password" id="password-{{ $user->id }}" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of mengedit user modal -->

                                    <!-- Modal untuk menghapus user -->
                                    <div class="modal fade" id="modalDelete-{{ $user->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDeleteLabel-{{ $user->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus <strong>{{ $user->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                    <form action="{{ route('adminIndex.user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of modal untuk menghapus user -->

                                    {{-- <!-- Modal Suspend -->
                                    <div class="modal fade" id="modalSuspend-{{ $user->id }}" tabindex="-1" aria-labelledby="modalSuspendLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalSuspendLabel">Suspend Account</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to suspend {{ $user->name }}'s account?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('adminIndex.user.suspend', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of modal suspend -->

                                    <!-- Modal Unsuspend -->
                                    <div class="modal fade" id="modalUnsuspend-{{ $user->id }}" tabindex="-1" aria-labelledby="modalUnsuspendLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalUnsuspendLabel">Unsuspend Account</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to unsuspend {{ $user->name }}'s account?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('adminIndex.user.unsuspend', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Unsuspend</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of modal unsuspend --> --}}

                                </tr>
                            @endforeach
                         </tbody>
                     </table>
                     <!-- end table -->
                 </div>
                 <!-- end table responsive -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ URL::asset('admin/assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script> --}}
<script src="{{ URL::asset('admin/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/pages/datatable-pages.init.js') }}"></script>
@endsection
