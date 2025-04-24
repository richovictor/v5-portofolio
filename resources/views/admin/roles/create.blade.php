@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New Role</h4>
            </div>
            <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <form action="{{route('admin.role.store')}}" action="POST">
                                @csrf
                            <div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Role Name</label>
                                    <input class="form-control" type="text" name="role" id="example-text-input">
                                </div>
                                <button class="btn btn-primary" type="submit">Create Role</button>
                            </div>
                            </form>
                        </div>
                    </div>


            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('admin/assets/js/app.min.js') }}"></script>
@endsection
