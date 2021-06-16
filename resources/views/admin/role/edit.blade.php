@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                Edit Role
                <ol class="breadcrumb float-right">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-default">
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
            <form action="{{ route('admin.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{ $role->name }}">
                    </div>
                    <div class="form-group">
                        <label>Select Permission</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="create_access" id="create_check" @if(in_array('create_access', json_decode($role->permissions))) checked @endif>
                            <label class="form-check-label" for="create_check">
                                Create
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="edit_access" id="edit_check" @if(in_array('edit_access', json_decode($role->permissions))) checked @endif>
                            <label class="form-check-label" for="edit_check">
                                Edit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="delete_access" id="delete_check" @if(in_array('delete_access', json_decode($role->permissions))) checked @endif>
                            <label class="form-check-label" for="delete_check">
                                Delete
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ Employees table -->
@endsection