@extends('admin.layouts.master')
@section('title') @lang('User - Home') @endsection
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
                             <h5 class="card-title">Post List <span class="text-muted fw-normal ms-2">{{(count($posts))}}</span></h5>
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
                                 <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add New</a>
                             </div> --}}

                             <div class="dropdown">
                                 <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                     <i class="bx bx-dots-horizontal-rounded"></i>
                                 </a>

                                 <ul class="dropdown-menu dropdown-menu-end">
                                     <li><a class="dropdown-item" href="#">
                                        <button class="btn btn-success" onclick="bulkApprove()">Approve Selected</button>
                                    </a></li>
                                     <li><a class="dropdown-item" href="#"><button class="btn btn-danger" onclick="bulkNotApprove()">Not Approve Selected</button></a></li>
                                 </ul>
                             </div>
                         </div>

                     </div>
                 </div>
                 <div class="col-md-6 mt-1 mb-3">
                    <div class="container">
                        <h3>Pengaturan Approval</h3>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="approvalSwitch">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Automaticly Approved</label>
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
                                    </div>
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Media</th>
                                <th scope="col">Tags People</th>
                                <th scope="col">Tags Post</th>
                                <th scope="col">Categories</th>
                                <th style="width: 80px; min-width: 80px;">Status</th>
                                <th scope="col">Visibility</th> <!-- Tambahan kolom -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input post-checkbox" value="{{ $post['post_id'] }}" id="contacusercheck{{ $post['post_id'] }}">
                                            <label class="form-check-label" for="contacusercheck{{ $post['post_id'] }}"></label>
                                        </div>
                                    </th>
                                    <td>
                                        <a href="#" class="text-body">{{ $post['post_creator_name'] }}</a>
                                    </td>
                                    <td>{{ $post['description'] }}</td>
                                    <td>
                                        @if (count($post['media']) > 0)
                                            <a href="javascript:void(0)" class="text-success" onclick="showMedia({{ json_encode($post['media']) }})">Available</a>
                                        @else
                                            <span class="text-danger">Not Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($post['tags']) > 0)
                                            <a href="javascript:void(0)" class="text-primary" onclick="showTags({{ json_encode($post['tags']) }})">Available</a>
                                        @else
                                            <span class="text-danger">Not Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $post['tag_post'] }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $post['category_name'] }}</span>
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-sm {{ $post['status'] == 'approved' ? 'btn-success' : 'btn-danger' }}"
                                            onclick="confirmStatusUpdate({{ $post['post_id'] }}, '{{ $post['status'] }}')">
                                            {{ ucfirst($post['status']) }}
                                        </button>
                                    </td>
                                    <!-- Tombol Toggle Visibility -->
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-visibility"
                                                type="checkbox"
                                                role="switch"
                                                data-id="{{ $post['post_id'] }}"
                                                id="toggle-visibility-{{ $post['post_id'] }}"
                                                {{ $post['hidden'] == 'no' ? 'checked' : '' }}>
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
<script>
    fetch('/posts/bulk-not-approve', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ post_ids: selectedIds }) // selectedIds adalah array ID postingan
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    showConfirmButton: true,
                    timer: 3000
                }).then(() => {
                    location.reload(); // Reload halaman setelah SweetAlert ditutup
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                    showConfirmButton: true
                });
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan coba lagi nanti.',
                showConfirmButton: true
            });
        });

</script>
<script>
    function getSelectedPostIds() {
        // Ambil semua checkbox yang dipilih
        const selected = Array.from(document.querySelectorAll('.post-checkbox:checked'))
            .map(checkbox => checkbox.value); // Ambil nilai ID dari checkbox

        return selected;
    }

    function bulkApprove() {
        const selectedIds = getSelectedPostIds();
        if (selectedIds.length === 0) {
            alert('Pilih postingan terlebih dahulu.');
            return;
        }

        // Kirim data ke server menggunakan AJAX
        fetch('/posts/bulk-approve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ post_ids: selectedIds })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Postingan berhasil diapprove!');
                    location.reload(); // Reload halaman
                } else {
                    alert('Terjadi kesalahan.');
                }
            });
    }

    function bulkNotApprove() {
        const selectedIds = getSelectedPostIds();
        if (selectedIds.length === 0) {
            alert('Pilih postingan terlebih dahulu.');
            return;
        }

        // Kirim data ke server menggunakan AJAX
        fetch('/posts/bulk-not-approve', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ post_ids: selectedIds })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Postingan berhasil di-not approve!');
                    location.reload(); // Reload halaman
                } else {
                    alert('Terjadi kesalahan.');
                }
            });
    }
</script>
<script>
    //script auto approve
    $(document).ready(function () {
        // Cek status awal dari database
        $.get("{{ route('admin.setApproval.getApprovalMode') }}", function (data) {
            if (data.mode === 'auto') {
                $('#approvalSwitch').prop('checked', true);
            } else {
                $('#approvalSwitch').prop('checked', false);
            }
        });

        // Toggle switch untuk mengubah mode approval
        $('#approvalSwitch').change(function () {
            let route = $(this).is(':checked')
                ? "{{ route('admin.setApproval.setToAutomaticly') }}"
                : "{{ route('admin.setApproval.setToManual') }}";

            $.post(route, {_token: "{{ csrf_token() }}"}, function (response) {
                alert(response.message);
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-visibility").forEach(toggle => {
            toggle.addEventListener("change", function () {
                let postId = this.getAttribute("data-id");

                fetch(`/admin/post/toggle-visibility/${postId}`, {
                    method: "PATCH",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.checked = data.hidden === "yes"; // Toggle berdasarkan response
                    } else {
                        alert("Failed to update visibility.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>


@endsection
