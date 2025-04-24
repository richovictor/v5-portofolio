@extends('admin.layouts.master')
@section('title') @lang('report - Home') @endsection
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
                             <h5 class="card-title">Report List <span class="text-muted fw-normal ms-2">({{$reports->count()}})</span></h5>
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
                             {{-- <div>
                                 <a href="{{route('register')}}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
                             </div> --}}

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
                                <th scope="col">Name Reporter</th>
                                <th scope="col">Type</th>
                                <th scope="col">Reason</th>
                                <th scope="col">Teks / Target</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacreportcheck{{ $report->id }}">
                                            <label class="form-check-label" for="contacreportcheck{{ $report->id }}"></label>
                                        </div>
                                    </th>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <a href="#" class="d-block text-body fw-bold">{{ $report->reporter->name }}</a>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $report->type }}</td>
                                    <td>{{ $report->reason }}</td>

                                    <td>
                                        @if ($report->type === 'comment' && isset($report->targetComment))
                                            {{ $report->targetComment->text }}
                                        @elseif ($report->type === 'post' && isset($report->targetPost))
                                            <a href="{{ route('postingan.full', ['id' => $report->targetPost->id]) }}">
                                                <button class="btn btn-primary">Click Here</button>
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <!-- Tombol Hide/Unhide -->
                                                @if ($report->type === 'post' && isset($report->targetPost))
                                                    <li>
                                                        <form action="{{ route('admin.post.toggleVisibility', ['id' => $report->targetPost->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">
                                                                {{ $report->targetPost->hidden === 'no' ? 'Hide Post' : 'Unhide Post' }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                @elseif ($report->type === 'comment' && isset($report->targetComment))
                                                    <li>
                                                        <form action="{{ route('admin.comment.toggleVisibility', ['id' => $report->targetComment->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item">
                                                                {{ $report->targetComment->hidden === 'no' ? 'Hide Comment' : 'Unhide Comment' }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endif

                                                <!-- Tombol Delete -->
                                                <li>
                                                    <form action="{{ route('admin.report.destroy', ['id' => $report->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus report ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
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
