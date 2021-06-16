@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-12 col-4">
                <h4 class="m-0">
                    Products
                    <ol class="breadcrumb float-right">
                        <a class="btn btn-sm btn-success mr-2 bg-primary"><i class="fas fa-file-export"></i> Export</a>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-sm btn-success"><i
                                class="fas fa-plus-square"></i> Create</a>
                    </ol>
                    <div class="btn-group float-right">
                        <button type="button" class="btn btn-sm mr-2 dropdown-toggle" data-toggle="dropdown">
                            Order by <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ route('admin.order-by', 'name') }}">Name</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.order-by', 'price') }}">Price</a></li>
                        </ul>
                    </div>
                </h4>
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
                <table class="table table-valign-middle table-sm table-hover">
                    <tr style="line-height: 40px;">
                        <th class="text-center">Image</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Cost Price</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Discount Price</th>
                        <th class="text-center">Un/Publish</th>
                        <th>Actions</th>
                    </tr>
                    @isset($products)
                        @foreach ($products as $product)
                            @php
                                // dd()
                            @endphp
                            <tr>
                                <td class="text-center">
                                    <img width="50px" height="40px" src="{{ asset('images/' . $product->gallery) }}" alt="">
                                </td>
                                <td class="text-center">{{ $product->id }}</td>
                                <td class="product text-center">{{ $product->name }}</td>
                                <td class="text-center">
                                    {{ $product->price }}
                                </td>
                                <td class="text-center">
                                    {{ $product->cost_price }}
                                </td>
                                <td class="text-center">
                                    {!! $product->getDiscountPrice() != null ? $product->getProductPricing->first()->discount_percentage . ' %' : '-' !!}
                                </td>
                                <td class="text-center">
                                    {{ $product->getDiscountPrice() != null ? $product->getDiscountPrice() : '-' }}
                                </td>
                                <td class="text-center">
                                    <div
                                        class="custom-control custom-switch custom-switch-off-default custom-switch-on-success">
                                        <input name="status" id="{{ $product->id }}" value="1" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="row text-center">
                                        <form id="form_update" action="{{ route('admin.product.edit', $product->id) }}"
                                            method="get">
                                            @csrf
                                            <input type="hidden" name="page" value={{ $products->currentPage() }}>
                                            <button type="submit" class="btn btn-sm btn-default mr-2" title="Update"><i
                                                    class="fas text-green fa-edit"></i></button>
                                        </form>
                                        <form id="form_delete" action="{{ route('admin.product.destroy', $product->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-default" title="Delete"><i
                                                    class="fas text-danger fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    <!-- Order by -->
                    @isset($query)
                        @switch($query)
                            @case('name')
                                @foreach ($orderby_name_items as $product)
                                    <tr>
                                        <td class="number text-center">{{ $product->id }}</td>
                                        <td class="product">{{ $product->name }}</td>
                                        <td>{{ $product->price }} - KS</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success mr-2 bg-success" title="Edit"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @break

                            @case('price')
                                @foreach ($orderby_price_items as $product)
                                    <tr>
                                        <td class="number text-center">{{ $product->id }}</td>
                                        <td class="product">{{ $product->name }}</td>
                                        <td>{{ $product->price }} - KS</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success mr-2 bg-success" title="Edit"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @break
                        @endswitch
                    @endisset
                    <!-- End Order by -->
                </table>
            </div>
            <div class="float-right">
                {{ $products->onEachSide(3)->links() }}
            </div>
        </div>
    </div>
    <!-- ./ Products table -->
@endsection
