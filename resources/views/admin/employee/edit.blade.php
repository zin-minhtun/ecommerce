@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                Edit Employee
                <ol class="breadcrumb float-right">
                    <a href="{{ '/admin/user?page=' . $page }}" class="btn btn-default">
                        <i class="fas fa-angle-left"></i>
                        Back
                    </a>
                </ol>
            </h4>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Employees table -->
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card">
            <!-- form start -->
            <form action="{{ route('admin.user.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{ $employee->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" value="{{ $employee->email }}">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select id="role" name="role_id" class="form-control">
                            <option selected>Select</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @isset($employee->getRole->first()->id) @if($employee->getRole->first()->id == $role->id) selected @endif @endisset>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="update-btn btn btn-success" disabled>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ Employees table -->

    @push('script')
        <script src="{{ asset('js/disable_updatebtn.js') }}"></script>
    @endpush
    
@endsection