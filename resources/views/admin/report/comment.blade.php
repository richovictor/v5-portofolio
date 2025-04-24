@extends('users.partials.app')

@section('title', 'View Report')

@section('style')
    <style>
        .card {
            height: 100%;
            background-color: #252837 !important;
        }

        .card-body {
        flex-grow: 1; /* Membuat body card mengisi ruang yang tersedia */
        }

        .card-img-top {
            height: auto;
            min-height: 200px; /* Tinggi minimal gambar */
            max-height: 600px; /* Tinggi maksimal gambar */
            object-fit: cover;
            padding: 0;
            margin: 0;
        }

        h5.card-title {
            margin: 0 !important; /* Hilangkan margin */
            padding: 0 !important; /* Hilangkan padding */
        }




        .card-footer {
            margin-top: 0; /* Hilangkan jarak antara deskripsi dan footer */
            padding-top: 0; /* Pastikan jarak antara footer dan deskripsi menyatu */
            background-color: #252837;
        }

        .card-text {
            margin-bottom: 0; /* Menghilangkan margin bawah pada teks deskripsi */
            color:white;
        }

        .reported-comment {
            background-color: #ffeb3b;
            border-left: 5px solid red;
            padding: 10px;
        }
        .reported {
            border-left: 3px solid red; /* Contoh: beri border merah di sebelah kiri */
            background-color: #ffe6e6; /* Contoh: beri background merah muda */
        }
        .badge {
            position: absolute;
            bottom: -12px; /* Menempatkan badge di bawah gambar */
            left: 50%; /* Posisi di tengah secara horizontal */
            transform: translateX(-50%); /* Menggeser badge ke tengah */
            z-index: 1; /* Memastikan badge berada di atas elemen lain */
            background-color: #28a745; /* Warna hijau sesuai dengan kategori */
            padding: 5px 15px;
            font-size: 12px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Memberikan sedikit bayangan */
        }
    </style>
    <style>

        .action-icons {
            padding: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            outline: none;
        }

        .action-btn .fa {
            color: white; /* Warna tengah ikon */
            text-shadow:
                -1px -1px 0 black, /* Bayangan kiri atas */
                1px -1px 0 black,  /* Bayangan kanan atas */
                -1px 1px 0 black,  /* Bayangan kiri bawah */
                1px 1px 0 black;   /* Bayangan kanan bawah */
        }

        /* .left-icons .fa-heart {
            color: red;
        } */
        .like-button.liked {
            color: red; /* Liked button color */
        }
        .w-input-comment{
            width: 50% !important;
            overflow: hidden;
        }

        #mediaModal{
            background-color: rgba(0, 0, 0, 0.1) !important;
        }
        .modal {
            display: none;
            position: fixed;
            top: 80%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content-view-post {
            display: flex !important;
            flex-direction: row !important; /* Menyusun elemen secara horizontal */
            width: auto !important;
            max-width: 90%;
            height: 90% !important;
            margin: auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-picture-post{
            width: 30px;
            height: 30px;
            margin: 3px;
        }

        .name-post {
            margin: 0; /* Pastikan tidak ada margin bawaan */
            /* display: flex; */
            align-items: center; /* Center secara vertikal */
            font-size: 12px;
            display: inline !important;
        }

        .time-post {
            margin: 0;
            padding: 0;
            font-size: 10px
        }
        .footer-comment{
            margin: 0 !important;
            padding: 0 !important;

        }
        .inline-flex-container {
            display: inline-flex;
            align-items: center;
            gap: 5px; /* Tambahkan jarak antar elemen */
            margin: 0;
            padding: 0;

        }

        .inline-flex-container-column {
            display: inline-flex;
            align-items: flex-start;
            gap: 5px; /* Tambahkan jarak antar elemen */
            margin: 0;
            padding: 0;
            flex-direction: column
            ;
        }
        @media (max-width: 768px) {
            .modal-content-view-post {
                flex-direction: column; /* Mengubah ke susunan vertikal untuk layar kecil */
            }
        }


        .modal-left {
            flex: 1;
            position: relative;
        }

        .modal-right {
            flex: 1;
            /* padding: 10px; */
            overflow-y: auto;
        }

        .media-display {
            width: 100%;
            height: auto;
            max-width: 100%;
            max-height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .arrow-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .arrow-button:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        #prevMedia {
            left: 10px;
        }

        #nextMedia {
            right: 10px;
        }

        .comments-section {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 60px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
        }
        #mediaDisplay {
            display: flex;
            align-items: center !important;
            justify-content: center !important;
            height: 100vh; /* Tinggi penuh viewport */
            background-color: black !important;
        }

        @media (max-width: 768px) {
            .modal-content-view-post {
                flex-direction: column;
            }

            .modal-left,
            .modal-right {
                width: 100%;
            }
        }

        .countLikes {
            font-size: 10px;
            font-weight: bold;
        }

        .dateUpload {
            font-size: 10px;

        }
    </style>
@endsection

@section('content')

    <div id="index" class="pt-4 " style="background-color: #282e3c !important; " >
        <div class="container">
            <div class="row d-flex flex-wrap justify-content-center">
                @foreach ($posts as $post)
                    <div class="card mx-3 mb-4 post-card" data-post-id="{{ $post['id'] }}"  data-media='@json($post['media'])' style="width: 18rem; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div class="position-relative" >
                            @if (count($post['media']) > 0)
                                @php $firstMedia = $post['media'][0]; @endphp
                                @if (strpos($firstMedia['file_path'], '.mp4') !== false)
                                    <video class="card-img-top" style="object-fit: cover; height: 200px;" controls>
                                        <source src="{{ asset('storage/' . $firstMedia['file_path']) }}" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ asset('storage/' . $firstMedia['file_path']) }}" class="card-img-top" alt="Media Post" style="object-fit: cover; height: 200px;">
                                @endif
                            @endif
                            <span class="badge bg-success position-absolute" style="border-radius: 12px; padding: 5px 15px; font-size: 12px; bottom: -12px; left: 50%; transform: translateX(-50%);">#{{ $post['tag_post'] }}</span>
                        </div>
                        <div class="card-body mb-5 pb-4 d-flex flex-column gap-2 text-center justify-content-between">
                            <div class="text-light mb-0 pb-0" style="font-size: 12px;">
                                <i class="bi bi-clock mb-0 pb-0"></i> 2 hari yang lalu &nbsp;&nbsp; <i class="bi bi-eye"></i> 0
                            </div>
                            <div class="mt-0">
                                <p class="h5 card-title mt-0 mb-0 pt-0 pb-0 text-light">{{ $post['description'] }}</p>
                            </div>
                        </div>
                        <div class="card-footer text-light d-flex justify-content-between align-items-center mt-0" style="background-color: #252837;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-circle me-2" style="font-size: 18px;"></i>
                                <a href="{{ route('profile.view', ['id' => $post['post_creator_id']]) }}" class="text-light" style="font-size: 14px; text-decoration: none;">
                                    {{ $post['post_creator_name'] }}
                                </a>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-heart me-1 like-button {{ $post['isLikedByUser'] ? 'liked' : '' }}" style="font-size: 18px;" data-post-id="{{$post['id']}}" data-like-id="{{ $post['like_id'] }}"></i>
                                <span style="font-size: 14px;">{{ $post['total_likes'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- @if(count($posts) > 0)
                    <div class="post-list">
                        @foreach($posts as $post)
                            <div class="post-card">
                                <h3>{{ $post['description'] }}</h3>
                                <p>Dibuat oleh: {{ $post['post_creator_name'] }}</p>
                                <p>Tag: {{ $post['tag_post'] }}</p>
                                <p>Total Likes: {{ $post['total_likes'] }}</p>
                                <div>
                                    @foreach($post['tags'] as $tag)
                                        <span>Tagged: {{ $tag['name'] }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Tidak ada hasil ditemukan.</p>
                @endif --}}


            <!-- Modal Container -->
            <div id="mediaModal" class="modal">
                <div class="modal-content modal-content-view-post">
                    <!-- Sisi Kiri (Media) -->
                    <div class="modal-left">
                        <button id="prevMedia" class="arrow-button">&lt;</button>
                        <img id="mediaDisplay" class="media-display" alt="Media Display" style="display: none;" />
                        {{-- <video id="videoDisplay" class="media-display" controls style="display: none;"></video> --}}
                        <div id="mediaDisplay" class="media-display-container vh-100 align-items-center justify-content-center" style="background-color:black !important;">
                            <video id="videoDisplay" class="media-display" controls style="visibility:hidden;"></video>
                        </div>
                        <button id="nextMedia" class="arrow-button">&gt;</button>
                    </div>
                    <!-- Sisi Kanan (Komentar) -->
                    <div class="modal-right">
                        <div id="uploaderSection"></div>
                        <div id="postDescription" class="mt-3"></div>
                        <div id="commentsSection" class="pb-5 mb-5"></div>
                        {{-- <div class="d-flex align-items-center gap-2 justify-items-center border-bottom" >
                            <img src="{{asset('storage/upload/profile/')}}" alt="Profile Logo" />
                            <p class="fw-bold post-uploader-name">Loading...</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 justify-items-center" >
                            <img src="{{asset('storage/upload/profile/')}}" alt="Profile Logo" />
                            <h3 id="postDescription" class="post-description">Loading...</h3>
                        </div> --}}
                        <div id="commentsSection" class="comments-section"></div>
                        <div></div>
                        <div id="deleteCommentModal" class="modal align-items-center justify-content-center" style="display: none;">
                            <div class="modal-content modal-content-report-or-delete">
                                <p class="text-danger text-center"></p>
                                <button id="confirmDeleteComment" class="btn btn-danger">Ya</button>
                                <button onclick="document.getElementById('deleteCommentModal').style.display = 'none';" class="btn btn-secondary">Batal</button>
                            </div>
                        </div>


                        <div class="row position-absolute w-input-comment align-items-center ms-2" style="bottom: 0; background: #fff; border-top: 1px solid #ddd;">
                            <div class="action-icons d-flex align-items-center justify-content-between">
                                <!-- Left Section -->
                                <div class="left-icons  align-items-center ">
                                    {{-- <button class="btn action-btn">
                                        <i class="fa fa-heart fa-outline like-button like-button"></i>
                                    </button>
                                    <button class="btn action-btn">
                                        <i class="fa fa-comment fa-outline"></i>
                                    </button>
                                    <button class="btn action-btn">
                                        <i class="fa fa-paper-plane fa-outline"></i>
                                    </button> --}}
                                    <div class="countLikes mb-0 pb-0" id="countLikes"></div>
                                    <div class="dateUpload text-muted mt-1 pt-0" id="dateUpload"></div>
                                </div>
                                <!-- Right Section -->
                                <div class="right-icons">
                                    <button class="btn action-btn">
                                        <i class="fa fa-bookmark fa-outline"></i>
                                    </button>
                                </div>
                            </div>

                            <form id="commentForm" action="{{ route('comments.store') }}" method="POST" class="d-flex align-items-center w-100">
                                @csrf
                                <input id="fk_post_id_input" type="hidden" value="" name="fk_post_id">
                                <input type="hidden" value="{{ Auth::id() }}" name="fk_user_id">
                                <input type="hidden" value="" name="parent_id">

                                <!-- Emoji Section -->
                                <div class="me-2">
                                    <button type="button" class="btn btn-link p-0" style="font-size: 24px;" data-bs-toggle="modal" data-bs-target="#emoticonModal">😊</button>
                                </div>

                                <!-- Input Text -->
                                <div class="flex-grow-1">
                                    <textarea name="text" id="commentInputed" class="form-control border-0" placeholder="Tambahkan komentar..." form="commentForm" rows="1" style="resize: none;"></textarea>
                                </div>

                                <div class="modal fade" id="emoticonModal" tabindex="-1" aria-labelledby="emoticonModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="emoticonModalLabel">Pilih Emoticon</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-wrap">
                                                    <!-- List of Emoticons -->
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">😊</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">😂</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">😍</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">😢</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">😎</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">👍</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">🔥</button>
                                                    <button type="button" class="btn btn-link fs-4 emoticon-btn">💯</button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="ms-2">
                                    <button type="submit" id="addCommentButton" class="btn text-primary " style="background:transparent;">Post</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const BASE_URL = "{{ asset('') }}";
        const mediaModal = document.getElementById('mediaModal');
        const mediaDisplay = document.getElementById('mediaDisplay'); // Display untuk media (gambar atau video)
        const videoDisplay = document.getElementById('videoDisplay'); // Video elemen
        const commentsSection = document.getElementById('commentsSection'); // Tempat komentar
        const commentInput = document.getElementById('commentInput'); // Input komentar
        const addCommentButton = document.getElementById('addCommentButton'); // Tombol kirim komentar

        let mediaIndex = 0; // Indeks media aktif
        let mediaList = []; // Daftar media dalam satu post

        // Event untuk setiap card (post-card)
        document.querySelectorAll('.post-card').forEach(card => {
            card.addEventListener('click', () => {
                const mediaData = card.dataset.media; // Ambil data media dari atribut dataset
                const postId = card.dataset.postId; // Ambil ID post dari atribut dataset
                const hiddenInput = document.getElementById('fk_post_id_input'); // Pilih input hidden dengan ID baru

                mediaList = JSON.parse(mediaData); // Parse JSON menjadi array objek
                mediaIndex = 0; // Reset indeks media

                // Update nilai input hidden
                if (hiddenInput) {
                    hiddenInput.value = postId;
                }

                loadMedia(); // Tampilkan media pertama
                loadComments(); // Tampilkan komentar

                mediaModal.style.display = 'flex'; // Tampilkan modal
            });
        });


        // Navigasi media sebelumnya
        document.getElementById('prevMedia').addEventListener('click', () => {
            mediaIndex = (mediaIndex - 1 + mediaList.length) % mediaList.length; // Navigasi melingkar
            loadMedia();
        });

        // Navigasi media berikutnya
        document.getElementById('nextMedia').addEventListener('click', () => {
            mediaIndex = (mediaIndex + 1) % mediaList.length; // Navigasi melingkar
            loadMedia();
        });

        // Fungsi untuk memuat media ke dalam modal
        function loadMedia() {
            if (mediaList.length === 0) return;
            const currentMedia = mediaList[mediaIndex]; // Ambil media berdasarkan indeks
            mediaDisplay.innerHTML = ''; // Bersihkan mediaDisplay
            videoDisplay.innerHTML = ''; // Bersihkan videoDisplay
            // Tampilkan media sesuai tipe
            if (currentMedia.media_type === 'video') {
                const videoElement = document.createElement('video');
                videoElement.setAttribute('controls', 'true');
                videoElement.style.width = 'auto'; // Lebar penuh
                videoElement.style.height = '50%'; // Tinggi 80%
                videoElement.style.objectFit = 'cover'; // Sesuaikan isi
                videoElement.style.alignItems ='center';
                videoElement.style.justifyContent ='center';
                videoElement.style.visibility = 'visible';
                videoDisplay.src = `${BASE_URL}storage/${currentMedia.file_path}`;
                videoDisplay.style.display = 'block';
                videoDisplay.style.visibility = 'visible';
                mediaDisplay.style.display = 'none';
                mediaDisplay.style.visibility = 'visible';
                mediaDisplay.appendChild(videoElement);
                // console.log('Media path:', `/storage/${currentMedia.file_path}`);
                // console.log('Image URL:', `${BASE_URL}storage/${currentMedia.file_path}`);
            } else {
                mediaDisplay.src = `${window.location.origin}/storage/${currentMedia.file_path}`;
                mediaDisplay.style.display = 'block';
                videoDisplay.style.display = 'none'; // Sembunyikan video
                mediaDisplay.style.width = 'auto'; // Lebar penuh
                mediaDisplay.style.height = '100%'; // Tinggi 80%
                mediaDisplay.style.objectFit = 'contain'; // Sesuaikan isi
                mediaDisplay.style.display = 'block';
                videoDisplay.style.display = 'none';
                // mediaDisplay.appendChild(imgElement);
                // console.log('Media path:', `/storage/${currentMedia.file_path}`);
                // console.log('Image URL:', `${window.location.origin}/storage/${currentMedia.file_path}`);

            }
        }

        // Fungsi untuk memuat komentar
        function loadComments() {
            commentsSection.innerHTML = ''; // Bersihkan komentar

            const postId = document.getElementById('fk_post_id_input').value; // Ambil ID post dari input hidden

            if (!postId) {
                console.error('Post ID tidak ditemukan!');
                return;
            }

            // Fetch data dari API
            fetch(`/comment/${postId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data komentar.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.data) {
                        const postData = data.data;
                        // console.log(postData)
                        // Tampilkan informasi uploader
                        const uploaderSection = document.getElementById('uploaderSection');
                        uploaderSection.innerHTML = `
                            <div class="d-flex align-items-center gap-2 justify-items-center border-bottom p-2">
                                <img src="${postData.uploader.profile_picture}" alt="Profile Picture" class="rounded-circle profile-picture-post"  />
                                <p class="fw-semibold name-post ">${postData.uploader.username}</p>
                            </div>
                        `;

                        // Tampilkan deskripsi post
                        const postDescription = document.getElementById('postDescription');
                        postDescription.innerHTML = '';

                        const descriptionWrapper = document.createElement('div');
                        descriptionWrapper.className = 'd-flex align-items-start gap-2 p-2 mb-0';

                        const countLikes = document.getElementById('countLikes');
                        countLikes.innerHTML = `
                            <span>${postData.likes_count} likes</span>
                        `;

                        const dateUpload = document.getElementById('dateUpload');
                        dateUpload.innerHTML = `
                            <span>${postData.created_date} </span>
                        `;

                        // Buat elemen gambar
                        const profileImage = document.createElement('img');
                        profileImage.src = postData.uploader.profile_picture; // Foto profil dari data
                        profileImage.alt = 'Profile Picture';
                        profileImage.className = 'rounded-circle profile-picture-post mt-2 ms-1 '; // Sesuaikan dengan class CSS

                        // Buat elemen deskripsi teks
                        const descriptionText = document.createElement('p');
                        descriptionText.className = 'description-text mb-0'; // Tambahkan class CSS untuk styling
                        descriptionText.innerHTML = `
                        <div class="">
                            <div class="inline-flex-container">
                                <p class="fw-semibold name-post mb-0">${postData.uploader.username}</p>
                                <span class="name-post">${postData.description}</span></br>
                            </div>
                            <div class="footer-comment">
                                <span class="text-muted  time-post">${formatTimeDifference(postData.created_at)}</span>
                            </div>
                        </div>`;

                        // Tambahkan elemen gambar dan teks ke wrapper
                        descriptionWrapper.appendChild(profileImage);
                        descriptionWrapper.appendChild(descriptionText);

                        // Tambahkan wrapper ke `postDescription`
                        postDescription.appendChild(descriptionWrapper);

                        const comments = postData.comments;

                        // Buat map untuk mempermudah pencarian child comments
                        const commentsMap = {};
                        comments.forEach(comment => {
                            commentsMap[comment.id] = comment;
                        });

                        // Fungsi untuk membuat elemen komentar
                        function createCommentElement(comment, isReply = false) {
                            const commentElement = document.createElement('div');
                            commentElement.className = `comment py-0 my-0 flex ${isReply ? 'reply-comment' : ''} ${comment.is_reported ? 'reported' : ''}`;
                            commentElement.innerHTML = `
                                <div class="d-flex align-items-start gap-1 mt-0 px-2 py-0">
                                    <img src="${comment.author.profile_picture}" alt="Author Profile Picture" class="rounded-circle profile-picture-post mt-2 ms-1" />
                                    <div class="inline-flex-container-column">
                                        <div >
                                            <p class="fw-semibold name-post mb-0">${comment.author.username}</p>
                                            <span class="name-post">${comment.text}</span></br>
                                        </div>
                                        <div class="footer-comment text-start">
                                            <span class="text-muted time-post">${formatTimeDifference(comment.created_at)}</span>
                                            <span class="text-muted time-post reply-btn" data-comment-id="${comment.id}" data-username="${comment.author.username}" data-parent-id="${comment.parent_id || ''}" style="cursor: pointer; color: blue;">Reply</span>
                                            <span class="text-muted time-post delete-comment-btn" data-author-id="${comment.author.id}" data-comment-id="${comment.id}" data-author-id="${comment.author.id}" style="cursor: pointer; color: blue;">...</span>
                                        </div>
                                    </div>
                                </div>`;

                            // Tambahkan event listener untuk tombol delete-comment-btn
                            const deleteBtn = commentElement.querySelector('.delete-comment-btn');
                            deleteBtn.addEventListener('click', function () {
                                const currentUserId = document.querySelector('meta[name="current-user-id"]').content;
                                const commentAuthorId = deleteBtn.getAttribute('data-author-id');

                                const modal = document.getElementById('deleteCommentModal');
                                const modalContent = modal.querySelector('.modal-content-report-or-delete');
                                const confirmDeleteBtn = modal.querySelector('#confirmDeleteComment');
                                const cancelBtn = modal.querySelector('.btn-secondary');
                                // modalContent.innerHTML = `
                                // <div></div>
                                //     <p class="text-danger text-center"></p>
                                //     <button id="confirmDeleteComment" class="btn btn-danger">Ya</button>
                                //     <button onclick="document.getElementById('deleteCommentModal').style.display = 'none';" class="btn btn-secondary">Batal</button>
                                // `;
                                // Tentukan pesan modal dan tampilkan/ sembunyikan tombol
                                if (currentUserId === commentAuthorId) {
                                    modalContent.querySelector('p').textContent = 'Apakah Anda yakin ingin menghapus komentar ini?';
                                    confirmDeleteBtn.style.display = 'inline-block'; // Tampilkan tombol "Ya"
                                    cancelBtn.style.display = 'inline-block'; // Tampilkan tombol "Batal"
                                } else {
                                    modalContent.querySelector('p').textContent = 'Laporkan komentar ini?';
                                    confirmDeleteBtn.style.display = 'none'; // Sembunyikan tombol "Ya"
                                    cancelBtn.style.display = 'none'; // Sembunyikan tombol "Batal"

                                    // Periksa apakah form sudah ada, jika ada tidak perlu menambahkan ulang
                                    if (!document.getElementById('reportForm')) {
                                        // Tambahkan form untuk laporan
                                        modalContent.innerHTML += `
                                        @if(Auth::check() )
                                            <form id="reportForm" method="POST" action="{{route('report.store')}}" class="mt-3">
                                                @csrf
                                                <textarea name="reason" class="form-control mb-2" placeholder="Masukkan alasan laporan Anda" required></textarea>
                                                <input type="hidden" name="target_id" value="${deleteBtn.getAttribute('data-comment-id')}">
                                                <input type="hidden" name="type" value="comment">
                                                <input type="hidden" name="status" value="pending">
                                                <input type="hidden" name="reporter_id" value="{{Auth::user()->id}}">
                                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                                                <button type="button" onclick="cancelReport()" class="btn btn-secondary">Batal</button>
                                            </form>
                                            @endif
                                        `;
                                    }
                                }

                                // Tampilkan modal
                                modal.style.display = 'flex';
                                document.getElementById('confirmDeleteComment').setAttribute('data-comment-id', deleteBtn.getAttribute('data-comment-id'));
                            });


                            return commentElement;
                        }


                        // Render semua komentar parent
                        comments.forEach(comment => {
                            if (!comment.parent_id) {
                                const parentCommentElement = createCommentElement(comment);

                                // Periksa apakah komentar ini memiliki child comments
                                const childComments = comments.filter(c => c.parent_id === comment.id);
                                if (childComments.length > 0) {
                                    const viewRepliesElement = document.createElement('div');
                                    viewRepliesElement.className = 'view-replies text-muted';
                                    viewRepliesElement.style.cursor = 'pointer';
                                    viewRepliesElement.innerHTML = `
                                        <div class="d-flex align-items-center">
                                            <hr class=" me-2 ms-5" style="width:5% !important; border-color: black; border-width: 1px; border-style: solid;" />
                                            <span class="text-muted time-post ">View replies (${childComments.length})</span>
                                        </div>
                                    `;

                                    const childCommentsContainer = document.createElement('div');
                                    childCommentsContainer.className = 'child-comments-container ms-5';
                                    childCommentsContainer.style.display = 'none';

                                    childComments.forEach(childComment => {
                                        const childCommentElement = createCommentElement(childComment, true);
                                        childCommentsContainer.appendChild(childCommentElement);
                                    });

                                    viewRepliesElement.addEventListener('click', function () {
                                        if (childCommentsContainer.style.display === 'none') {
                                            childCommentsContainer.style.display = 'block';
                                            this.querySelector('span').textContent = 'Hide replies';
                                        } else {
                                            childCommentsContainer.style.display = 'none';
                                            this.querySelector('span').textContent = `View replies (${childComments.length})`;
                                        }
                                    });

                                    parentCommentElement.appendChild(viewRepliesElement);
                                    parentCommentElement.appendChild(childCommentsContainer);
                                }

                                commentsSection.appendChild(parentCommentElement);
                            }
                        });

                        if (comments.length === 0) {
                            const noCommentElement = document.createElement('p');
                            noCommentElement.className = 'no-comment text-muted';
                            noCommentElement.textContent = 'Belum ada komentar.';
                            commentsSection.appendChild(noCommentElement);
                        }

                        const replyButton = document.querySelectorAll('.reply-btn');
                            replyButton.forEach(button => {
                                button.addEventListener('click', function () {
                                    const commentId = this.getAttribute('data-comment-id');
                                    const username = this.getAttribute('data-username');
                                    const parentId = this.getAttribute('data-parent-id'); // Ambil parent_id jika ada

                                    const parentIdInput = document.querySelector('input[name="parent_id"]');
                                    parentIdInput.value = parentId ? parentId : postId; // Tetapkan parent_id jika ada, atau gunakan postId jika tidak ada

                                    const commentInput = document.getElementById('commentInputed');
                                    commentInput.value = `@${username} `;
                                    commentInput.focus();
                                    commentInput.style.color = 'blue';
                            });
                        });

                        const commentInput = document.getElementById('commentInputed');
                        commentInput.addEventListener('input', function () {
                            const parentIdInput = document.querySelector('input[name="parent_id"]');
                            if (!this.value.startsWith('@')) {
                                parentIdInput.value = '';
                                this.style.color = '';
                            }
                        });

                    } else {
                        console.error('Data post tidak ditemukan.');
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengambil data:', error);
                });
        }
        function cancelReport() {
            // Hapus formulir laporan jika ada
            const reportForm = document.getElementById('reportForm');
            if (reportForm) {
                reportForm.remove();
            }
            // Tutup modal
            document.getElementById('deleteCommentModal').style.display = 'none';
        }
        // Fungsi menghapus dan melaporkan
        document.getElementById('confirmDeleteComment').addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');

            // Lakukan permintaan penghapusan komentar ke server
            fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Sembunyikan modal dan hapus komentar dari UI
                        document.getElementById('deleteCommentModal').style.display = 'none';
                        document.querySelector(`.delete-comment-btn[data-comment-id="${commentId}"]`).closest('.comment').remove();
                    } else {
                        alert('Gagal menghapus komentar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus komentar');
                });
        });


        // fungsi merubah waktu
        function formatTimeDifference(dateString) {
            const givenDate = new Date(dateString);
            const now = new Date();
            const diffInMs = now - givenDate; // Selisih dalam milidetik
            const diffInMinutes = Math.floor(diffInMs / (1000 * 60)); // Selisih dalam menit
            const diffInHours = Math.floor(diffInMinutes / 60); // Selisih dalam jam
            const diffInDays = Math.floor(diffInHours / 24); // Selisih dalam hari

            if (diffInMinutes < 60) {
                return `${diffInMinutes}m`; // Jika kurang dari 1 jam, tampilkan dalam format "Xm"
            } else if (diffInHours < 24) {
                return `${diffInHours}h`; // Jika kurang dari 24 jam, tampilkan dalam format "Xh"
            } else if (diffInDays < 7) {
                return `${diffInDays}d`; // Jika kurang dari 7 hari, tampilkan dalam format "Xd"
            } else {
                const diffInWeeks = Math.floor(diffInDays / 7); // Selisih dalam minggu
                return `${diffInWeeks}w`; // Jika 7 hari atau lebih, tampilkan dalam format "Xw"
            }
        }

        // Fungsi untuk menambahkan komentar baru
        addCommentButton.addEventListener('click', () => {
            const commentText = commentInput.value.trim(); // Ambil teks input

            if (commentText) {
                const newComment = document.createElement('div');
                newComment.className = 'comment';
                newComment.innerHTML = `<strong>Anda:</strong> ${commentText}`;
                commentsSection.appendChild(newComment); // Tambahkan komentar baru

                commentInput.value = ''; // Kosongkan input
            }
        });

        // Event untuk menutup modal saat klik di luar konten
        mediaModal.addEventListener('click', (event) => {
            if (event.target === mediaModal) {
                mediaModal.style.display = 'none'; // Sembunyikan modal
                mediaDisplay.innerHTML = ''; // Bersihkan mediaDisplay
                videoDisplay.innerHTML = ''; // Bersihkan videoDisplay
            }
        });

        // Event upload comment
        $(document).ready(function(){
            $('#commentForm').on('submit', function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let formData = $(this).serialize();
                // console.log(formData);
                // console.log($('#commentInput').val())
                $.ajax({

                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data:formData,
                    // success: function(response) {
                    //     alert('sukses');
                    // },
                    error: function (xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
                loadComments();
            });
        })

        // Event tambah emoticon
        document.addEventListener('DOMContentLoaded', function () {
            const emoticonButtons = document.querySelectorAll('.emoticon-btn');
            const commentInput = document.getElementById('commentInputed');

            emoticonButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const emoticon = this.textContent;
                    commentInput.value += emoticon; // Append the selected emoticon
                    commentInput.focus(); // Refocus on the input
                });
            });
        });
    </script>

    <script>
        // pengaturan likes
        $(document).on('click', '.like-button', function() {
            const button = $(this);
            const postId = button.data('post-id');
            const likeId = button.data('like-id');
            const isLiked = button.hasClass('liked');

            if (isLiked) {
                // Hapus Like
                $.ajax({
                    url: `/likes/${likeId}`, // Kirim ID like
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        button.removeClass('liked');
                        button.data('like-id', null); // Reset like_id
                    }
                });
            } else {
                // Tambah Like
                $.ajax({
                    url: '/likes',
                    type: 'POST',
                    data: {
                        fk_post_id: postId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        button.addClass('liked');
                        button.data('like-id', response.like_id); // Set like_id dari respon
                    }
                });
            }
        });
        // Seleksi semua tombol dengan class like-button
        document.addEventListener("DOMContentLoaded", function () {
            // Seleksi semua tombol dengan class like-button
            document.querySelectorAll(".like-button").forEach(button => {
                button.addEventListener("click", function () {
                    const postId = this.closest(".like-button").getAttribute("data-post-id"); // ID Post
                    const likeId = this.closest(".like-button").getAttribute("data-like-id"); // ID Like jika ada

                    // Tentukan URL untuk menyukai atau menghapus suka
                    const url = likeId ? `/likes/${likeId}` : "/likes";
                    const method = likeId ? "DELETE" : "POST";

                    // Kirim permintaan AJAX
                    fetch(url, {
                        method: method,
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: method === "POST" ? JSON.stringify({ fk_post_id: postId }) : null
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Toggle kelas liked
                                this.classList.toggle("liked");

                                // Update atribut like-id
                                if (data.action === "liked") {
                                    this.setAttribute("data-like-id", data.like_id);
                                } else {
                                    this.removeAttribute("data-like-id");
                                }
                            }
                        })
                        .catch(error => console.error("Error:", error));
                });
            });
        });

    </script>


@endsection
