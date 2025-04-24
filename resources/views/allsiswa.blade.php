@extends("main")

@section("content")
    <!-- portofolio section -->
    <section id="portfolio" class="recent-posts section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Portofolio</h2>
          <p>Branding Kompetensi Siswa Kami</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="container mb-4 col-5">
                <form action="{{ route('allstudent.seeall') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau keahlian..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
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
                            <a href="{{route('profile.view',['id'=>$user->id])}}" class="readmore stretched-link">
                                <span>Read More</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>

                          </div>

                      </div>
                  </div><!-- End post item -->
              @endforeach

          </div>

        </div>

      </section>
      <!-- end of portofolio Section -->
@endsection
