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
        <div class="position-relative bg-light" style="height: 170px; overflow: hidden">
            {{-- Tampilkan gambar cover --}}
            <img src="{{ $profil?->cover ? asset($profil->cover) : asset('storage/cover.jpg') }}"
                 alt="Cover"
                 class="position-absolute top-0 start-0"
                 style="width: 100%; height:100%; object-fit:cover; pointer-events:none;">
        
            {{-- Tombol pensil (trigger file input) --}}
            <button id="editCoverBtn" class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm" style="z-index: 20;">
                <i class="bi bi-pencil"></i>
            </button>

            @if ($profil?->cover)
            <form action="{{ route('profil.hapusCover') }}" method="POST" class="position-absolute bottom-0 end-0 m-2" style="z-index: 20;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">
                    Hapus Cover
                </button>
            </form>
            @endif
            
            {{-- Form upload tersembunyi --}}
            <form id="coverForm" action="{{ route('profil.uploadCover') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" name="cover" id="coverInput" accept="image/*">
            </form>
        </div>                

        <div class="card-body pt-0">
            <div class="row g-4 align-items-center">
                <div class="col-12 col-md-auto text-center position-relative" style="margin-top: -60px; z-index: 10;">
                    <img src="{{ $profil?->foto ? asset($profil->foto) : asset('storage/foto_profil.jpg') }}" alt="Foto Profil"
                    class="rounded-circle border border-4 border-white shadow"
                    style="width: 112px; height: 112px; object-fit: cover; position: relative; z-index: 10;">
                </div>
                <div class="col">
                    <h4 class="fw-bold mb-0">{{Auth::user()->name}}</h4>
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
                        <form action="{{ route('profil.updateKontak') }}" method="POST" class="w-100">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="kontakModalLabel">Edit Informasi Kontak</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body px-4 py-3">
                                <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email (akun login)</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $email }}" readonly>
                                </div>
                                <div class="col-12 col-md-6 mt-3 mt-md-0">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="notelp" name="no_telp" value="{{ $profil -> no_telp ?? ''}}" placeholder="Masukkan nomor telepon aktif">
                                </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between px-4 py-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
  
                    <div class="d-flex flex-wrap gap-2">
                        {{-- <button class="btn btn-outline-primary btn-sm">Terbuka untuk</button> --}}
                        <a href="{{ route('profil.siswa') }}" class="btn btn-outline-primary btn-sm">Tambah bagian profil</a>
                        <button class="btn btn-outline-primary btn-sm">Optimalkan profil Anda</button>
                        <button class="btn btn-outline-primary btn-sm">Sumber Informasi</button>
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/logo_smk5.png') }}" alt="Logo SMK5"
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
                    <p class="mb-1 fw-semibold">Peran Web Designer dan Pengembang Web</p>
                    <a href="#" class="text-primary small text-decoration-none">Tampilkan detail</a>
                </div>
                <button class="btn btn-sm btn-light rounded-circle">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
        </div>

        {{-- Section Tambahan --}}
        <div class="card-body border-top">
            <h5 class="fw-bold mb-3">[Section Lainnya]</h5>
            <p class="text-muted mb-0">Tempatkan konten lain di sini, seperti pengalaman kerja, pendidikan, sertifikat, dll.</p>
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
