@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="row">
            <div class="col-sm-6 col-8">
                <h4 class="m-0">Create Role</h4>
            </div>
            <div class="col-sm-6 col-4">
                <ol class="breadcrumb float-right">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-default">
                        <i class="fas fa-angle-left"></i>
                        Back
                    </a>
                </ol>
            </div>
        </div>
</div>
<!-- /.content-header -->

<!-- Products table -->
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
                <!-- <img width="100px" height="100px" src="{{ asset('images/' . Session::get('image')) }}"> -->
            </div>
        @endif
        <div class="card">
            <!-- form start -->
            <form action="{{ route('admin.role.store') }}" method="POST" enctype="multipart/form-data">
                @csrf    
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Select Permission</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="create_access" id="create_check">
                            <label class="form-check-label" for="create_check">
                                Create
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_access" id="edit_check">
                            <label class="form-check-label" for="edit_check">
                                Edit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_access" id="delete_check">
                            <label class="form-check-label" for="delete_check">
                                Delete
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ Products table -->
@endsection