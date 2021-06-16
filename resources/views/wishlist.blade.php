@extends('welcome')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="m-3">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
                <!-- <img width="100px" height="100px" src="{{ asset('images/' . Session::get('image')) }}"> -->
            </div>
        @endif
            <!-- Shopping cart table -->
            <div class="card">
                <div class="card-header">
                    <h5>Your Wishlist</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <!-- Set columns width -->
                                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                    <th class="text-center py-3 px-4" style="width: 100px;">Price</th>
                                    <th class="text-center py-3 px-4" style="width: 100px;">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($wishlist_items as $item)
                                <style>
                                    .table-inactive td {
                                        background-color: #ffeae7;
                                        color: #b9b9b9;
                                    }
                                    .table-inactive td .media {
                                        pointer-events: none;
                                    }
                                    .table-inactive td a, 
                                    .table-inactive .price, 
                                    .table-inactive td small {
                                        color: #cf0707;
                                    }
                                </style>
                                    @isset($item->getProducts()->withTrashed()->first()->id)
                                    <tr class="{{ $item->getProducts()->withTrashed()->first()->trashed() ? 'table-inactive' : '' }}">
                                        <td class="p-4">
                                            <div class="media align-items-center">
                                                <img src="{{ $item->getProducts()->withTrashed()->first()->trashed() ? asset('images/static/shopee.png') : asset('images/'.$item->getProducts()->withTrashed()->first()->gallery) }}" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                                <div class="media-body">
                                                    <a href="#" style="text-decoration: none" class="d-block text-bold">{{ $item->getProducts()->withTrashed()->first()->name }}</a>
                                                    <small>
                                                        <span class="">Description:</span>
                                                        <span class="">{{ substr($item->getProducts()->withTrashed()->first()->description, 0, 50) }}</span> &nbsp;
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price text-center font-weight-semibold align-middle p-2">{{ $item->getProducts()->withTrashed()->first()->price }}</td>
                                        <td class="text-center align-middle px-0"><a href="{{ route('wishlist.delete', $item->id) }}" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                                    </tr>
                                    @endisset
                                    @empty
                                    <tr>
                                        <td class="p-4 text-center text-danger" colspan="5">
                                                Opps! No Wishlist Items.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- / Shopping cart table -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection