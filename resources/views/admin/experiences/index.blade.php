@extends('admin.layouts.master')
@section('title') @lang('experiences - Home') @endsection
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
                             <h5 class="card-title">Experiences List <span class="text-muted fw-normal ms-2">{{(count($experiences))}}</span></h5>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                             <div>
                                 <ul class="nav nav-pills">
                                     <li class="nav-item">
                                         <a class="nav-link active" href="apps-contacts-list" data-bs-toggle="tooltip" data-bs-placement="top" title="List"><i class="bx bx-list-ul"></i></a>
                                     </li>
                                 </ul>
                             </div>

                             {{-- <div class="dropdown">
                                 <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="bx bx-dots-horizontal-rounded"></i>
                                 </a>

                                 <ul class="dropdown-menu dropdown-menu-end">
                                     <li><a class="dropdown-item" href="#">
                                        <button class="btn btn-success" onclick="bulkApprove()">Approve Selected</button>
                                    </a></li>
                                     <li><a class="dropdown-item" href="#"><button class="btn btn-danger" onclick="bulkNotApprove()">Not Approve Selected</button></a></li>
                                 </ul>
                             </div> --}}
                         </div>

                     </div>
                 </div>
                 {{-- <div class="col-md-6 mt-1 mb-3">
                    <div class="container">
                        <h3>Pengaturan Approval</h3>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="approvalSwitch">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Automaticly Approved</label>
                        </div>
                    </div>
                 </div> --}}
                 <!-- end row -->

                 <div class="table-responsive mb-4">
                     <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 50px;">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="checkAll">
                                    </div>
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Agency</th>
                                <th scope="col">Description</th>
                                <th scope="col">Location</th>
                                <th scope="col">created_at</th>
                                <th scropt="col">Images</th>
                                <th style="width: 80px; min-width: 80px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($experiences as $experience)
                            <tr>
                                <th scope="row">
                                    <div class="form-check font-size-16">
                                        <input type="checkbox" class="form-check-input" id="contacexperiencecheck1">
                                        <label class="form-check-label" for="contacexperiencecheck1"></label>
                                    </div>
                                </th>
                                <td>{{$experience->user->name}}</td>
                                <td>{{$experience->position}}</td>
                                <td>{{$experience->agency}}</td>
                                <td>{{$experience->description}}</td>
                                <td>{{$experience->location}}</td>
                                <td>{{$experience->created_at}}</td>
                                <td>
                                    <!-- Teks untuk membuka modal -->
                                    <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#bannerModal-{{ $experience->id }}">
                                        Lihat Gambar Pengalaman
                                    </a>

                                    <!-- Modal Bootstrap -->
                                    <div class="modal fade" id="bannerModal-{{ $experience->id }}" tabindex="-1" aria-labelledby="bannerModalLabel-{{ $experience->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="bannerModalLabel-{{ $experience->id }}">Gambar Aktivitas</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <!-- Gambar Banner -->
                                                    @if ($experience->images->isNotEmpty())
                                                        @foreach ($experience->images as $image)
                                                            <img src="{{ asset('storage/'.$image->image) }}" alt="experience Image" class="img-fluid rounded mb-2">
                                                        @endforeach
                                                    @endif


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
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editActivitiesModal-{{ $experience->id }}" href="#">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $experience->id }}" href="#">
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                <!-- Modal untuk mengedit activities -->
                                <div class="modal fade" id="editActivitiesModal-{{ $experience->id }}" tabindex="-1" aria-labelledby="editSexperienceModalLabel-{{ $experience->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit experience</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('adminIndex.experiences.update', $experience->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <!-- position -->
                                                    <div class="mb-3">
                                                        <label for="position-{{ $experience->id }}" class="form-label">Position</label>
                                                        <input type="text" name="position" id="position-{{ $experience->id }}" class="form-control" value="{{ $experience->position ?? '' }}">
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="mb-3">
                                                        <label for="agency-{{ $experience->id }}" class="form-label">Agency</label>
                                                        <textarea name="agency" id="agency-{{ $experience->id }}" class="form-control" rows="3">{{ $experience->description ?? '' }}</textarea>
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="mb-3">
                                                        <label for="description-{{ $experience->id }}" class="form-label">Description</label>
                                                        <textarea name="description" id="description-{{ $experience->id }}" class="form-control" rows="3">{{ $experience->description ?? '' }}</textarea>
                                                    </div>

                                                    <!-- Location -->
                                                    <div class="mb-3">
                                                        <label for="location-{{ $experience->id }}" class="form-label">Location</label>
                                                        <input type="text" name="location" id="location-{{ $experience->id }}" class="form-control" value="{{ $experience->location ?? '' }}">
                                                    </div>

                                                    <!-- Gambar -->
                                                    <div class="mb-3">
                                                        <label for="images-{{ $experience->id }}" class="form-label">Gambar</label>
                                                        <input type="file" name="images" id="images-{{ $experience->id }}" class="form-control">
                                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
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
                                <!-- end of mengedit activities modal -->

                                <!-- Modal untuk menghapus activities -->
                                <div class="modal fade" id="modalDelete-{{ $experience->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel-{{ $experience->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDeleteLabel-{{ $experience->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus <strong>{{ $experience->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                <form action="{{ route('adminIndex.experiences.destroy', $experience->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of modal untuk menghapus experience -->

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showMedia(media) {
        const baseUrl = "{{ asset('storage') }}/"; // Base URL pointing to public/storage

        if (media.length > 0) {
            let mediaList = media
                .map(item => {
                    const filePath = `${baseUrl}${item.file_path}`; // Build full URL

                    if (item.media_type === 'image') {
                        // Jika file adalah gambar
                        return `<img src="${filePath}" alt="Media Image" style="width: 100%; max-width: 300px; margin-bottom: 10px; border-radius: 8px;">`;
                    } else if (item.media_type === 'video') {
                        // Jika file adalah video
                        return `<video controls style="width: 100%; max-width: 300px; margin-bottom: 10px; border-radius: 8px;">
                                    <source src="${filePath}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>`;
                    }
                    return `<p>Unsupported file type: ${item.media_type}</p>`;
                })
                .join('');

            // Tampilkan dengan SweetAlert
            Swal.fire({
                title: 'Media List',
                html: `<div style="text-align: center;">${mediaList}</div>`,
                icon: 'info',
                confirmButtonText: 'OK',
                width: '600px',
            });
        } else {
            Swal.fire({
                title: 'No Media Available',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
    }

    function showTags(tags) {
        if (tags.length > 0) {
            // Map tags menjadi elemen HTML
            let tagList = tags
                .map(tag => {
                    return `<span class="badge bg-primary" style="margin-right: 5px; margin-bottom: 5px;">${tag.name}</span>`;
                })
                .join('');

            // Tampilkan dengan SweetAlert
            Swal.fire({
                title: 'Tags List',
                html: `<div style="text-align: center;">${tagList}</div>`,
                icon: 'info',
                confirmButtonText: 'OK',
                width: '400px', // Lebar alert
            });
        } else {
            Swal.fire({
                title: 'No Tags Available',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
    }

    function confirmStatusUpdate(postId, currentStatus) {
        // Tampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda menyetujui postingan ini?',
            text: `Status saat ini: ${currentStatus}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                // Lakukan update status via AJAX atau API
                updateStatus(postId);
            }
        });
    }

    // Fungsi untuk melakukan update status
    function confirmStatusUpdate(postId, currentStatus) {
        const isApproved = currentStatus === 'approved';

        Swal.fire({
            title: isApproved
                ? 'Postingan sudah disetujui. Apakah Anda ingin mengubahnya menjadi tidak disetujui?'
                : 'Apakah Anda menyetujui postingan ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                // Jika approved maka ubah jadi "not approved", jika tidak ubah jadi "approved"
                const newStatus = isApproved ? 'not approved' : 'approved';
                updateStatus(postId, newStatus);
            }
        });
    }

    // Fungsi untuk melakukan update status
    function updateStatus(postId, newStatus) {
        fetch(`/admin/post/update-status/${postId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Pastikan CSRF token tersedia
            },
            body: JSON.stringify({
                status: newStatus, // Kirim status baru
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: `Status postingan telah diubah menjadi ${newStatus}.`,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then(() => {
                        location.reload(); // Reload halaman untuk memperbarui tabel
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat memperbarui status.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Tidak dapat terhubung ke server.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
            });
    }



</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



@endsection
