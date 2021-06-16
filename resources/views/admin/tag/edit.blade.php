@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                Edit Tag
                <ol class="breadcrumb float-right">
                    <a href="{{ '/admin/tag?page=' . $page }}" class="btn btn-default">
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
            <form action="{{ route('admin.tag.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{ $tag->name }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="update-btn btn btn-success" disabled>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ Employees table -->
@endsection