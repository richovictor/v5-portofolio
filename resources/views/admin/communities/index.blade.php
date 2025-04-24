@extends('admin.layouts.master')
@section('title') @lang('communitie - Home') @endsection
@section('css')
<link href="{{ URL::asset('admin/assets/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('admin/assets/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                 <div class="row align-items-center">
                     <div class="col-md-6">
                         <div class="mb-3">
                             <h5 class="card-title">communitie List <span class="text-muted fw-normal ms-2">({{$communities->count()}})</span></h5>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                             <div>
                                 <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addcommunitieModal"><i class="bx bx-plus me-1"></i> Add New</a>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- end row -->

                 <div class="table-responsive mb-4">
                     <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                         <thead>
                         <tr>
                             <th scope="col">Name</th>
                             <th style="width: 80px; min-width: 80px;">Action</th>
                         </tr>
                         </thead>
                         <tbody>
                            @foreach ($communities as $communitie )
                                <tr>
                                    <td>{{ $communitie->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editcommunitieModal-{{ $communitie->id }}" href="#">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $communitie->id }}" href="#">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                    <!-- Modal untuk mengedit communitie -->
                                    <div class="modal fade" id="editcommunitieModal-{{ $communitie->id }}" tabindex="-1" aria-labelledby="editcommunitieModalLabel-{{ $communitie->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit communitie</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.communities.update', $communitie->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Nama -->
                                                        <div class="mb-3">
                                                            <label for="name-{{ $communitie->id }}" class="form-label">Nama</label>
                                                            <input type="text" name="name" id="name-{{ $communitie->id }}" class="form-control" value="{{ $communitie->name }}" required>
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
                                    <!-- end of mengedit communitie modal -->

                                    <!-- Modal untuk menghapus communitie -->
                                    <div class="modal fade" id="modalDelete-{{ $communitie->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel-{{ $communitie->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDeleteLabel-{{ $communitie->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus <strong>{{ $communitie->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                    <form action="{{ route('admin.communities.destroy', $communitie->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of modal untuk menghapus communitie -->
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

<!-- Modal untuk menambahkan communitie baru -->
<div class="modal fade" id="addcommunitieModal" tabindex="-1" aria-labelledby="addcommunitieModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcommunitieModalLabel">Tambah communitie Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.communities.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of modal untuk menambahkan communitie baru -->

@endsection

@section('script')
<script src="{{ URL::asset('admin/assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/pages/datatable-pages.init.js') }}"></script>
@endsection
