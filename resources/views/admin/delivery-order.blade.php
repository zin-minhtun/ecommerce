@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-12">
                <h4 class="m-0">
                    Delivery Orders
                </h4>
            </div>
        </div>
    </div>
    <!-- /.Content-header -->

    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <strong>{{ $message }}</strong>
                </div>
            @endif            
        </div>
    </div>
@endsection
