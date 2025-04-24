@extends("main")

@section("content")

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Portofolio Vohi5ma</h1>
            <p data-aos="fade-up" data-aos-delay="100">Wadah untuk setiap siswa menunjukkan identitas, karya, dan keahliannya</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="{{route('login')}}" class="btn-get-started">Masuk <i class="bi bi-arrow-right"></i></a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Tentang Kami</h3>
              <h2>Selamat datang di platform portofolio digital siswa SMKN 5 Malang! </h2>
              <p>
                Portofolio Vohi5ma adalah wadah bagi siswa-siswi kreatif dan berbakat untuk memamerkan karya-karya terbaik mereka. Platform ini menjadi jembatan yang menghubungkan bakat muda dengan dunia industri kreatif, pendidikan tinggi, dan peluang karir yang menjanjikan.
              </p>
              <div class="text-center text-lg-start">
                <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Yuk! Gabung</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="/img/about.jpg" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Values Section -->
    <section id="values" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Fitur Utama</h2>
        <p>Yang Dapat Anda Temukan<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="/img/values-1.png" class="img-fluid" alt="">
              <h3>Profil siswa</h3>
              <p>Halaman profil yang menampilkan informasi pribadi, minat, dan keahlian siswa.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="/img/values-2.png" class="img-fluid" alt="">
              <h3>Portofolio siswa</h3>
              <p>Galeri karya-karya terbaik siswa dalam berbagai bidang.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="/img/values-3.png" class="img-fluid" alt="">
              <h3>Grafik aktivitas Siswa</h3>
              <p>Keaktivan siswa dalam menginputkan karya sebagai bentuk <em>branding</em> dirinya </p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->

    <!-- portofolio section -->
    <section id="portfolio" class="recent-posts section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portofolio</h2>
        <p>Branding Kompetensi Siswa Kami</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-5">
            @foreach ($users as $user)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="{{ $user->profile->profile_image ?? asset('uploads/foto_profile/foto_profile.png') }}" class="img-fluid" alt="">
                            <span class="post-date">{{$user->name}}</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                        <h3 class="post-title">{{$user->profile->username ?? '...'}}</h3>

                        <div class="meta d-flex align-items-center">
                            <div class="d-flex align-items-center">
                            @php
                                $skills = explode(',', $user->selectedSkills->skills ?? '');
                                // dd($skills);
                            @endphp
                            @if (!empty($user->selectedSkills) && !empty($user->selectedSkills->skills))
                            <i class="bi bi-person"></i>
                                @foreach ($skills as $skill)
                                    {{-- <span class="badge bg-primary text-light me-1 mb-1">{{ trim($skill) }}</span> --}}
                                        <span class="ps-2">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <span class="text-muted small">Belum ada skill yang ditambahkan</span>
                            @endif
                            </div>
                            <span class="px-3 text-black-50">/</span>

                        </div>

                        <hr>
                        <a href="{{route('profile.view',['id'=>$user->id])}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->
            @endforeach

        </div>
        <div class="text-center">
            <a href="{{route('allstudent.seeall')}}">
                <button class="btn btn-primary">See All</button>
            </a>

        </div>

      </div>

    </section>
    <!-- end of portofolio Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p>Frequently Asked Questions</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Apa itu fitur portofolio seperti LinkedIn di website ini?</h3>
                <div class="faq-content">
                  <p>Fitur ini memungkinkan pengguna membuat profil profesional lengkap dengan informasi seperti pengalaman kerja, pendidikan, sertifikat, dan keterampilan—mirip dengan LinkedIn—langsung di dalam platform ini.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Bagaimana cara menambahkan pengalaman kerja ke portofolio saya?</h3>
                <div class="faq-content">
                  <p>Kamu bisa menambahkan pengalaman kerja melalui tombol “Tambah Pengalaman” pada halaman profil. Isikan posisi, nama instansi, tanggal mulai dan selesai, serta deskripsi pekerjaan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Apakah saya bisa mengunggah sertifikat dan dokumen pendukung?</h3>
                <div class="faq-content">
                  <p>Ya, kamu bisa mengunggah sertifikat yang sudah kamu dapatkan melalui fitur “Tambah Sertifikat”, dan juga menyisipkan gambar atau dokumen pendukung lainnya.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-container">

              <div class="faq-item">
                <h3>Apakah saya bisa memilih keterampilan yang saya kuasai?</h3>
                <div class="faq-content">
                  <p>Tentu! Di bagian “Kemampuan”, kamu bisa mencentang keterampilan yang sesuai dengan keahlianmu. Data ini akan tampil di profil dan bisa dilihat oleh pengunjung lain.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Bagaimana saya bisa mengonversi portofolio saya menjadi CV dalam format PDF?</h3>
                <div class="faq-content">
                  <p>Kamu dapat menggunakan fitur “Unduh CV” yang akan mengonversi semua data portofolio menjadi file PDF yang rapi dan profesional, siap digunakan untuk melamar pekerjaan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Apakah portofolio saya dapat dilihat oleh publik?</h3>
                <div class="faq-content">
                  <p>Iya dong</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

            </div>
          </div>
        </div>
      </div>

    </section><!-- /Faq Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Clients</h2>
        <p>We work with best clients<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container text-center d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          {{-- <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday</p>
                  <p>9:00AM - 05:00PM</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div> --}}

          <div class="col-lg-12 ">
            <form action="{{route('email.submit')}}" method="post" >
                @csrf
                @method('POST')
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-12 text-center">
                  {{-- <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div> --}}

                  <button class="btn btn-primary" type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
@endsection
