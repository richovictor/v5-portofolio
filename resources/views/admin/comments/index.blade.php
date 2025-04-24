@extends('admin.layouts.master')
@section('title') @lang('comment - Home') @endsection
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
                             <h5 class="card-title">comment List <span class="text-muted fw-normal ms-2">({{$comments->count()}})</span></h5>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                             {{-- <div>
                                 <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addcommentModal"><i class="bx bx-plus me-1"></i> Add New</a>
                             </div> --}}
                         </div>
                     </div>
                 </div>
                 <!-- end row -->

                 <div class="table-responsive mb-4">
                    <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Text</th>
                                <th scope="col">Commenter</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Media</th>
                                <th scope="col">Visibility</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->text }}</td>
                                    <td>{{ $comment->user->name ?? 'Unknown' }}</td>
                                    <td>{{ $comment->parent_id ? $comment->parent->text : '-' }}</td>
                                    <td>
                                        @if ($comment->media->isNotEmpty())
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#mediaModal-{{ $comment->id }}">
                                                View Media
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-visibility"
                                                type="checkbox"
                                                role="switch"
                                                data-id="{{$comment->id}}"
                                                id="toggle-visibility-{{$comment->id}}"
                                                {{$comment->hidden == 'no' ? 'checked' : ''}}

                                            >
                                            {{-- <h1>{{$comment->media}}</h1> --}}
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal untuk melihat media -->
                                @if ($comment->media->isNotEmpty())
                                    <div class="modal fade" id="mediaModal-{{ $comment->id }}" tabindex="-1" aria-labelledby="mediaModalLabel-{{ $comment->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Media for Comment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach ($comment->media as $media)

                                                     <img src="{{ asset('storage/'.$media->media) }}" class="img-fluid mb-2" alt="Media">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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

<!-- Modal untuk menambahkan comment baru -->
<div class="modal fade" id="addcommentModal" tabindex="-1" aria-labelledby="addcommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcommentModalLabel">Tambah comment Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{ route('admin.comments.store') }}" method="POST">
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
            </form> --}}
        </div>
    </div>
</div>
<!-- end of modal untuk menambahkan comment baru -->

@endsection

@section('script')
<script src="{{ URL::asset('admin/assets/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/pages/datatable-pages.init.js') }}"></script>
<script>
    // Script visibility comment
    document.addEventListener("DOMContentLoaded",function () {
        document.querySelectorAll(".toggle-visibility").forEach(toggle =>{
            toggle.addEventListener("change", function(){

                let commentId = this.getAttribute("data-id");

                fetch(`/admin/comment/toggle-visibility/${commentId}`,{
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data=> {
                    if(data.success)
                    {
                        this.checked = data.hidden ==="yes"
                    } else {
                        alert("Failed to update visibility")
                    }
                })
                .catch(error=>console.error("Error:", error));
            })

        })
    })
</script>
@endsection
