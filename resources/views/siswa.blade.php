@extends('main')

@section('content')

@if(session('success'))
    <div class="container position-fixed top-0 start-0 end-0 mt-3 d-flex justify-content-center"
         style="z-index: 1050;">
        <div class="alert alert-success alert-dismissible fade show shadow-sm w-auto text-center px-4 py-2"
             role="alert" id="flash-message">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow rounded-4">
                <div class="card-header bg-light position-relative" style="height: 200px;">
                    <h1>Ini halaman Siswa</h1>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
