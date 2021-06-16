@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                Employees
                <ol class="breadcrumb float-right">
                    <!-- <a class="btn btn-sm btn-success mr-2 bg-primary"><i class="fas fa-file-export"></i> Export</a> -->
                    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus-square"></i> Create</a>
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
            <table class="table table-hover">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Role</th>
                    <th>Action</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ isset($user->getRole->first()->name) ? $user->getRole->first()->name : '-' }}</td>
                        <td class="text-center">
                            <div class="row">
                                <form id="form_update" action="{{ route('admin.user.edit', $user->id) }}" method="get">
                                    @csrf 
                                    <input type="hidden" name="page" value={{ $users->currentPage() }}>
                                    <button type="submit" class="btn btn-sm btn-success mr-2" title="Update"><i class="fas fa-edit"></i></button>
                                </form>
                                <form id="form_delete" action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="float-right">
            {{ $users->onEachSide(3)->links() }}
        </div>
    </div>
</div>
<!-- ./ Employees table -->
@endsection