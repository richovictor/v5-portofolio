@extends('admin.layouts.master')
@section('title') Admin - Dashboard @endsection
@section('css')

<link href="{{ URL::asset('/admin/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">

@endsection
@section('content')


<div class="vh-100">
    <div class="row ">
        <div class="col-xl-12 col-md-12 card">
            <!-- card -->
            <div class="align-items-center text-center my-4">
                <h1>Selamat Datang Admin</h4>
                <br>
                <span id="current-time"></span>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/allchart.js') }}"></script>
<script src="{{ URL::asset('/admin/assets/libs/admin-resources/admin-resources.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('/admin/assets/js/pages/dashboard.init.js') }}"></script>
<script src="{{ URL::asset('/admin/assets/js/app.min.js') }}"></script>
<script>
    // Fungsi untuk menampilkan jam saat ini
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const formattedTime = now.toLocaleTimeString(); // Format waktu lokal (HH:MM:SS)
        currentTimeElement.textContent = `Jam Saat Ini: ${formattedTime}`;
    }

    // Memperbarui waktu setiap detik
    setInterval(updateTime, 1000);
    updateTime(); // Panggil sekali saat halaman dimuat
</script>
@endsection
