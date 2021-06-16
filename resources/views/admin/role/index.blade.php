@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                <form action="{{ route('admin.multi-role.delete') }}" method="post">
                    @csrf
                    <input id="form-role" type="hidden" name="delete_id" value>

                    Roles
                    <a href="{{ route('admin.roleall.delete') }}" class="delete-all-btn btn btn-sm ml-3 btn-danger d-none" title="Delete All">
                        <i class="fas fa-trash-alt"></i>
                        Delete All
                    </a>
                    <button type="submit" class="single-delete-btn btn btn-sm ml-3 btn-danger d-none" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                        Delete
                    </button>

                    <ol class="breadcrumb float-right">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus-square"></i>
                            Create
                        </a>
                    </ol>
                </form>
            </h4>
        </div>
    </div>
</div>
<!-- /.Content-header -->

<!-- Employees table -->
<div class="row">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <table class="table table-center table-hover">
                <tr>
                    <th class="text-center">
                        @if($roles->count() > 0)
                        <div class="form-check">
                            <input id="checkall" class="form-check-input" type="checkbox">
                        </div>
                        @endif
                    </th>
                    <th>ID</th>
                    <th>Role</th>
                    <th class="text-center">Employee</th>
                    <th class="text-center">Action</th>
                </tr>
                @foreach($roles as $role)
                <tr>
                    <td class="text-center">
                        <div class="form-check">
                            <input class="cb-element form-check-input" type="checkbox" value="{{ $role->id }}">
                        </div>
                    </td>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td class="text-center">{{ $role->getUser->count() }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-success bg-success" title="Edit">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<!-- ./ Employees table -->

@endsection