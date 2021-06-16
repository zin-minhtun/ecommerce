@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6 col-8">
                <h4 class="m-0">Create Product</h4>
            </div>
            <div class="col-sm-6 col-4">
                <ol class="breadcrumb float-right">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-default">
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
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="price">Price *</label>
                                    <input name="price" type="text" class="form-control" id="price" placeholder="Price" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cost_price">Cost Price</label>
                                    <input name="cost_price" type="text" class="form-control" id="cost_price" placeholder="Cost Price">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="image">Upload Image *</label>
                            <div class="form-group">
                                <input type="file" name="image" id="fileUpload" class="form-control-file" value required>
                            </div>
                        </div>
                        <br>
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Description</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1">Promotion</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2">Configuration</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="form-group">
                                    <label for="description"></label>
                                    <textarea name="description" placeholder="Text..." class="form-control" id="description"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            {{-- Promotion tab section. --}}
                            <div id="menu1" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group p-3">
                                            <div class="form-group">
                                                <label>Make discount on items (Optional)</label>
                                                <div class="float-right custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                                                    <input name="status" id="status" value="1" type="checkbox"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="status"></label>
                                                </div>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#status').on('change', function() {
                                                            if ($('#status').is(':checked')) {
                                                                $('#percentage, #byprice, #dis_num_input, .dis_num_input')
                                                                    .prop('disabled', false)
                                                                $('#dis_num_label').removeAttr('style')
                                                            } else {
                                                                $('#percentage, #byprice, #dis_num_input, .dis_num_input')
                                                                    .prop('disabled', true)
                                                                $('#dis_num_label').css('color', 'darkgray')
                                                            }
                                                        })
                                                    })

                                                </script>
                                            </div>

                                            <div class="form-check" style="border-right: 1px solid rgb(206, 205, 205);">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="radio"
                                                                id="percentage" checked disabled>
                                                            <label class="form-check-label" for="percentage">
                                                                (By Percentage)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="radio"
                                                                id="byprice" disabled>
                                                            <label class="form-check-label" for="byprice">
                                                                (By Price)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-check-input input-group input-group-sm">
                                                            <label id="dis_num_label" class="form-check-label mr-2"
                                                                style="color: darkgray">
                                                                Every item discount by :
                                                            </label>
                                                            <input id="dis_num_input" type="number"
                                                                name="discount_percentage" value="" class="form-control"
                                                                required disabled>
                                                            <span class="input-group-append">
                                                                <button type="button"
                                                                    class="dis_num_input btn btn-info btn-flat" disabled>%</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Configuration tab section. --}}
                            <div id="menu2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group p-3">
                                            <label>Configure Tag <span class="text-muted">(Optional)</span></label>
                                            @forelse ($tags as $tag)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="tags[]"
                                                        value="{{ $tag->id }}" id="{{ $tag->id }}">
                                                    <label class="form-check-label" for="{{ $tag->id }}}">
                                                        {{ $tag->name }}
                                                    </label>
                                                </div>
                                            @empty
                                                <span class="row pl-3 text-muted">No Tag Items !</span>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <!-- ./ Products table -->
@endsection
