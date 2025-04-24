@extends('main')

@section('content')

@if(session('success'))
    <div class="position-fixed top-3 start-50 translate-middle-x mt-3"
         style="z-index: 1050; max-width: 480px;">
        <div class="alert alert-success alert-dismissible fade show shadow-sm w-auto text-center px-4 py-2"
             role="alert" id="flash-message">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="container mt-5 pt-5">
    <div class="card shadow-sm">
        {{-- Section 1: Cover & Profile --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="position-relative bg-light" style="height: 170px; overflow: hidden">
            {{-- Tampilkan gambar cover --}}
            <img src="{{ $profil?->cover_image ? asset($profil->cover_image) : asset('uploads/cover_profile/cover_profile.png') }}"
                 alt="Cover"
                 class="position-absolute top-0 start-0"
                 style="width: 100%; height:100%; object-fit:cover; pointer-events:none;">

            {{-- Tombol pensil (trigger file input) --}}
            {{-- <button id="editCoverBtn" class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" style="z-index: 20;">
                <i class="bi bi-pencil"></i>
            </button> --}}

            {{-- @if ($profil?->cover)
            <form action="{{ route('profil.hapusCover') }}" method="POST" class="position-absolute bottom-0 end-0 m-2" style="z-index: 20;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">
                    Hapus Cover
                </button>
            </form>
            @endif --}}

            {{-- Form upload tersembunyi --}}
            <form id="coverForm" action="{{ route('profil.uploadCover') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="cover" id="coverInput" accept="image/*">
            </form>
        </div>

        <div class="card-body pt-0">
            <div class="row g-4 align-items-center">
                <div class="col-12 col-md-auto text-center position-relative" style="margin-top: -60px; z-index: 10;">
                    <img src="{{ $profil?->profile_image ? asset($profil->profile_image) : asset('uploads/foto_profile/foto_profile.png') }}" alt="Foto Profil"
                    class="rounded-circle border border-4 border-white shadow"
                    style="width: 112px; height: 112px; object-fit: cover; position: relative; z-index: 10;">
                </div>
                <div class="col">
                    <h4 class="fw-bold mb-0">{{$user->name}}</h4>
                    <p class="mb-1 text-muted">Siswa di SMKN 5 Kota Malang</p>
                    <p class="mb-2 text-secondary">
                        Kota Malang, Jawa Timur, Indonesia •
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#kontakModal" style="cursor: pointer;">
                          Informasi Kontak
                        </a>
                      </p>

                    <!-- Modal Informasi Kontak -->
                    <div class="modal fade" id="kontakModal" tabindex="-1" aria-labelledby="kontakModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">

                            <div class="modal-content shadow-lg rounded-4 border-0">
                                <!-- Header -->
                                <div class="modal-header bg-gradient bg-primary text-white rounded-top-4">
                                    <h5 class="modal-title fw-semibold" id="kontakModalLabel">
                                        <i class="bi bi-person-lines-fill me-2"></i> Informasi Kontak
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>

                                <!-- Body -->
                                <div class="modal-body px-5 py-4">
                                    <div class="row g-4">
                                        {{-- Email --}}
                                        <div class="col-12 col-md-6">
                                            <label for="email" class="form-label fw-medium">Email Anda</label>
                                            <div class="form-control shadow-sm">
                                                <a href="mailto:{{ $user->email }}" target="_blank" class="text-reset">{{ $user->email }}</a>
                                            </div>
                                        </div>

                                        {{-- Nomor Telepon --}}
                                        <div class="col-12 col-md-6">
                                            <label for="notelp" class="form-label fw-medium">Nomor Telepon</label>
                                            <div class="form-control shadow-sm">
                                                <a href="tel:{{ $profil->phone_number ?? '' }}" target="_blank" class="text-reset">{{ $profil->phone_number ?? '-' }}</a>
                                            </div>
                                        </div>

                                        {{-- Instagram --}}
                                        <div class="col-12 col-md-6">
                                            <label for="instagram" class="form-label fw-medium">Instagram</label>
                                            <div class="form-control shadow-sm">
                                                @if (!empty($profil->link_instagram))
                                                    <a href="{{ $profil->link_instagram }}" target="_blank" class="text-reset">{{ $profil->instagram ?? '-' }}</a>
                                                @else
                                                    {{ $profil->instagram ?? '-' }}
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Twitter --}}
                                        <div class="col-12 col-md-6">
                                            <label for="twitter" class="form-label fw-medium">Twitter</label>
                                            <div class="form-control shadow-sm">
                                                @if (!empty($profil->link_twitter))
                                                    <a href="{{ $profil->link_twitter }}" target="_blank" class="text-reset">{{ $profil->twitter ?? '-' }}</a>
                                                @else
                                                    {{ $profil->twitter ?? '-' }}
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Facebook --}}
                                        <div class="col-12 col-md-6">
                                            <label for="facebook" class="form-label fw-medium">Facebook</label>
                                            <div class="form-control shadow-sm">
                                                @if (!empty($profil->link_facebook))
                                                    <a href="{{ $profil->link_facebook }}" target="_blank" class="text-reset">{{ $profil->facebook ?? '-' }}</a>
                                                @else
                                                    {{ $profil->facebook ?? '-' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="modal-footer px-5 py-3 bg-light rounded-bottom-4">
                                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i> Tutup
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal Kemampuan -->
                    <div class="modal fade" id="kemampuanModal" tabindex="-1" aria-labelledby="kemampuanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content shadow-lg rounded-4 border-0">

                                <!-- Header -->
                                <div class="modal-header bg-gradient bg-info text-white rounded-top-4">
                                    <h5 class="modal-title fw-semibold" id="kemampuanModalLabel">
                                        <i class="bi bi-person-check-fill me-2"></i> Kemampuan yang Dimiliki
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>

                                <!-- Body -->
                                <div class="modal-body px-5 py-4">
                                    <div class="row g-3">
                                        <form action="{{ route('selectedskills.update', ['id'=>$user->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @php
                                                $options = ['Web Developer', 'CSS', 'HTML', 'JavaScript', 'PHP', 'Laravel, Pemeliharaan dan perakitan computer, Jaringan Komputer, Desainer UI/UX, Pengembang web'];
                                                $selected = explode(',', $selectedSkills->skills ?? '');
                                            @endphp

                                            <div class="row g-3">
                                                @foreach ($options as $option)
                                                    <div class="col-md-6">
                                                        <div class="form-check border rounded p-3 bg-light shadow-sm">
                                                            <input
                                                                class="form-check-input"
                                                                type="checkbox"
                                                                name="skills[]"
                                                                id="skill_{{ Str::slug($option) }}"
                                                                value="{{ $option }}"
                                                                {{ in_array($option, $selected) ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-medium" for="skill_{{ Str::slug($option) }}">
                                                                {{ $option }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="text-end mt-4">
                                                <button type="submit" class="btn btn-success px-4">
                                                    <i class="bi bi-save me-1"></i> Simpan Kemampuan
                                                </button>
                                            </div>
                                        </form>


                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="modal-footer px-5 py-3 bg-light rounded-bottom-4">
                                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i> Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Sertifikat -->
                    <div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content shadow rounded-4 border-0">

                                <!-- Modal Header -->
                                <div class="modal-header bg-primary text-white rounded-top-4">
                                    <h5 class="modal-title" id="sertifikatModalLabel">
                                        <i class="bi bi-award-fill me-2"></i> Tambah Sertifikat
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>

                                <!-- Modal Body -->
                                <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body px-5 py-4">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label fw-medium">Judul Sertifikat</label>
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Pelatihan Laravel" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="agency" class="form-label fw-medium">Lembaga Penerbit</label>
                                                <input type="text" class="form-control" id="agency" name="agency" placeholder="Contoh: Dicoding, BNSP" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="location" class="form-label fw-medium">Lokasi / Tempat</label>
                                                <input type="text" class="form-control" id="location" name="location" placeholder="Contoh: Jakarta / Online">
                                            </div>

                                            <div class="col-md-12">
                                                <label for="description" class="form-label fw-medium">Deskripsi</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Tuliskan deskripsi atau ringkasan pelatihan..."></textarea>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="images" class="form-label fw-medium">Upload Gambar Sertifikat</label>
                                                <input class="form-control" type="file" name="images[]" id="images" accept="image/*" multiple>
                                                <small class="text-muted">Anda bisa memilih lebih dari satu gambar.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer px-5 py-3 bg-light rounded-bottom-4">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-save me-1"></i> Simpan Sertifikat
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tambah Aktivitas -->
                    <div class="modal fade" id="aktivitasModal" tabindex="-1" aria-labelledby="aktivitasModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content shadow-lg rounded-4 border-0">
                                    <!-- Header -->
                                    <div class="modal-header bg-primary text-white rounded-top-4">
                                        <h5 class="modal-title" id="aktivitasModalLabel">
                                            <i class="bi bi-calendar-event-fill me-2"></i> Tambah Aktivitas
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body px-5 py-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="title" class="form-label">Judul Aktivitas</label>
                                                <input type="text" class="form-control shadow-sm" name="title" id="title" placeholder="Contoh: Pelatihan Kepemimpinan" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="location" class="form-label">Lokasi</label>
                                                <input type="text" class="form-control shadow-sm" name="location" id="location" placeholder="Contoh: Bandung, Indonesia">
                                            </div>
                                            <div class="col-12">
                                                <label for="description" class="form-label">Deskripsi</label>
                                                <textarea class="form-control shadow-sm" name="description" id="description" rows="4" placeholder="Jelaskan aktivitas yang dilakukan..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="images" class="form-label">Unggah Gambar (Opsional)</label>
                                                {{-- <input class="form-control shadow-sm" type="file" id="images" name="images[]" multiple accept="image/*">
                                                <small class="text-muted">Maksimal 2MB per gambar. Format: jpg, jpeg, png.</small> --}}
                                                <label for="imageInput" class="form-label">Upload Gambar</label>
                                                <div class="input-group">
                                                    <input type="file" name="images[]" id="imageInput" accept="image/*" capture="environment" class="form-control" multiple>

                                                    <span class="input-group-text bg-white">
                                                        <i class="bi bi-camera-fill text-primary" style="cursor: pointer;" onclick="document.getElementById('imageInput').click()"></i>
                                                    </span>
                                                </div>
                                                <small class="text-muted">Pilih dari galeri atau ambil gambar langsung.</small>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer px-5 py-3 bg-light rounded-bottom-4">
                                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Batal
                                        </button>
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="bi bi-save me-1"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- SUmber Informasi -->


                    <!-- Modal Tambah Pengalaman -->
                    <div class="modal fade" id="pengalamanModal" tabindex="-1" aria-labelledby="pengalamanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <form action="{{ route('experiences.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content shadow-lg rounded-4 border-0">
                                    <!-- Header -->
                                    <div class="modal-header bg-primary text-white rounded-top-4">
                                        <h5 class="modal-title" id="pengalamanModalLabel">
                                            <i class="bi bi-briefcase-fill me-2"></i> Tambah Pengalaman Kerja
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>

                                    <!-- Body -->
                                    <div class="modal-body px-5 py-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="position" class="form-label">Posisi</label>
                                                <input type="text" class="form-control shadow-sm" name="position" id="position" placeholder="Contoh: Web Developer" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agency" class="form-label">Perusahaan / Instansi</label>
                                                <input type="text" class="form-control shadow-sm" name="agency" id="agency" placeholder="Contoh: PT Teknologi Digital" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                                <input type="date" class="form-control shadow-sm" name="start_date" id="start_date" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="end_date" class="form-label">Tanggal Selesai</label>
                                                <input type="date" class="form-control shadow-sm" name="end_date" id="end_date">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="location" class="form-label">Lokasi</label>
                                                <input type="text" class="form-control shadow-sm" name="location" id="location" placeholder="Contoh: Jakarta, Indonesia">
                                            </div>
                                            <div class="col-12">
                                                <label for="description" class="form-label">Deskripsi</label>
                                                <textarea class="form-control shadow-sm" name="description" id="description" rows="3" placeholder="Jelaskan tanggung jawab atau proyek yang dikerjakan..."></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="images" class="form-label">Unggah Gambar (Opsional)</label>
                                                <input class="form-control shadow-sm" type="file" id="images" name="images[]" multiple accept="image/*">
                                                <small class="text-muted">Maksimal 2MB per gambar. Format: jpg, jpeg, png.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer px-5 py-3 bg-light rounded-bottom-4">
                                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Batal
                                        </button>
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="bi bi-save me-1"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('img/smk5.png') }}" alt="Logo SMK5"
                             style="width: 60px; height: 60px; object-fit: contain; margin-right: 10px;">
                        {{-- <p class="mb-0">SMKN 5 Kota Malang</p> kalo mo sejajar uncomment--}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Terbuka untuk bekerja --}}
        <div class="card-body border-top">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="mb-1 text-muted small">Terbuka untuk bekerja</p>
                    <div class="mt-2">
                        @php
                            $skills = explode(',', $selectedSkills->skills ?? '');
                            // dd($skills);
                        @endphp

                        @if (!empty($selectedSkills) && !empty($selectedSkills->skills))
                            @foreach ($skills as $skill)
                                <span class="badge bg-primary text-light me-1 mb-1">{{ trim($skill) }}</span>
                            @endforeach
                        @else
                            <span class="text-muted small">Belum ada skill yang ditambahkan</span>
                        @endif
                    </div>

                </div>
                {{-- <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="modal" data-bs-target="#kemampuanModal">
                    <i class="bi bi-pencil"></i>
                </button> --}}

            </div>
        </div>

        {{-- Section Tambahan --}}
        <div class="card-body border-top">
            <h5 class="fw-bold mb-4">Pengalaman</h5>
            @forelse ($experiences as $exp)
                <div class="border rounded p-4 mb-4 shadow-sm bg-white">
                    <div class="d-flex align-items-start mb-2">
                        {{-- Gambar Dummy Perusahaan --}}
                        {{-- <div class="me-3">
                            <img src="https://via.placeholder.com/48" class="rounded" alt="Company Logo">
                        </div> --}}
                        <div>
                            <h6 class="fw-bold mb-1">{{ $exp->position }}</h6>
                            <span class="text-muted">{{ $exp->agency }} &middot; Magang</span><br>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} -
                                {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Sekarang' }} &middot;
                                {{ \Carbon\Carbon::parse($exp->start_date)->diffInMonths($exp->end_date ?? now()) }} bln
                            </small><br>
                            <small class="text-muted">{{ $exp->location }} &middot; Di lokasi</small>
                        </div>
                    </div>

                    <p class="mb-2">{{ $exp->description }}</p>

                    {{-- Skill Dummy --}}
                    {{-- <p class="mb-2">
                        <i class="bi bi-gem me-1"></i>
                        <span>Tax, Tax Accounting dan <strong>+2 keahlian</strong></span>
                    </p> --}}

                    {{-- Gambar Sertifikat (PostImages) --}}
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($exp->images as $img)
                            <div class="d-flex align-items-center">
                                <a href="{{ asset('storage/' . $img->image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt="sertifikat" class="img-thumbnail rounded" style="height: 64px;">
                                </a>
                                <span class="ms-2 small">Sertifikat</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada pengalaman kerja yang dimasukkan.</p>
            @endforelse

        </div>

        <div class="card-body border-top">
            <h5 class="fw-bold mb-4">Sertifikat</h5>

            @forelse ($certificates as $cert)
                <div class="border rounded p-4 mb-4 shadow-sm bg-white">
                    <h6 class="fw-bold mb-1">{{ $cert->title }}</h6>
                    <small class="text-muted">{{ $cert->agency }} &middot; {{ $cert->location }}</small>

                    @if ($cert->description)
                        <p class="mt-2 mb-2">{{ $cert->description }}</p>
                    @endif

                    {{-- Gambar Sertifikat --}}
                    <div class="d-flex flex-wrap gap-3 mt-2">
                        @foreach ($cert->images as $img)
                            <div class="d-flex align-items-center">
                                <a href="{{ asset('storage/' . $img->image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt="sertifikat" class="img-thumbnail rounded" style="height: 64px;">
                                </a>
                                <span class="ms-2 small">{{ basename($img->image) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <p class="text-muted">Belum ada sertifikat yang ditambahkan.</p>
            @endforelse
        </div>

        <div class="card-body border-top">
            <h5 class="fw-bold mb-4">Aktivitas</h5>

        @forelse ($activities as $act)
            <div class="border rounded p-4 mb-4 shadow-sm bg-white">
                <h6 class="fw-bold mb-1">{{ $act->title }}</h6>
                <small class="text-muted">{{ $act->location }}</small>

                @if ($act->description)
                    <p class="mt-2 mb-0">{{ $act->description }}</p>
                @endif
                <div class="d-flex flex-wrap gap-3 mt-2">
                    @foreach ($act->images as $img)
                        <div class="d-flex align-items-center">
                            <a href="{{ asset('storage/' . $img->image) }}" target="_blank">
                                <img src="{{ asset('storage/' . $img->image) }}" alt="sertifikat" class="img-thumbnail rounded" style="height: 64px;">
                            </a>
                            <span class="ms-2 small">{{ basename($img->image) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada aktivitas yang ditambahkan.</p>
        @endforelse

        </div>
    </div>
</div>

@push('scripts')
<script>
    setTimeout(() => {
        const alert = document.getElementById('flash-message');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        }
    }, 3000);

    document.getElementById('editCoverBtn').addEventListener('click', function () {
        document.getElementById('coverInput').click();
    });

    document.getElementById('coverInput').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.getElementById('coverForm').submit();
        }
    });

</script>
@endpush

@endsection
