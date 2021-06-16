@extends('welcome')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mt-2">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <strong>{{ $message }}</strong>
                        <!-- <img width="100px" height="100px" src="{{ asset('images/' . Session::get('image')) }}"> -->
                    </div>
                @endif
                <!-- Shopping cart table -->
                <div class="card">
                    <div class="card-header">
                        <h5>Shopping Cart</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover">
                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp;
                                            Details</th>
                                        <th class="text-center py-3 px-4" style="width: 100px;">Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                        <th class="text-center py-3 px-4" style="width: 100px;">Total</th>
                                        <th class="text-center py-3 px-4" style="width: 100px;">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                        $related_products = [];
                                    @endphp
                                    @forelse($cart_items as $item)
                                        @php
                                            if ($item->getProduct->first()->getTags->first() != null) {
                                                $related_p = $item->getProduct->first()->getTags->first()->getProducts;
                                                foreach ($related_p->except([$related_p->first()->id]) as $key => $value) {
                                                    $key = $value->id;
                                                    $related_products[$key] = $value;
                                                }
                                            }
                                        @endphp
                                        <div class="class" style="display: none;">
                                            {{ $total += $item->getProduct->first()->price * $item->quantity }}
                                        </div>
                                        <tr>
                                            <td class="p-4">
                                                <div class="media align-items-center">
                                                    <img src="{{ asset('/images/' . $item->getProduct->first()->gallery) }}"
                                                        class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                                    <div class="media-body">
                                                        <a href="#"
                                                            class="d-block text-dark">{{ $item->getProduct->first()->name }}</a>
                                                        <small>
                                                            <span class="text-muted">Color:</span>
                                                            <span
                                                                class="ui-product-color ui-product-color-sm align-text-bottom"
                                                                style="background:#e81e2c;"></span> &nbsp;
                                                            <span class="text-muted">Size: </span> EU 37 &nbsp;
                                                            <span class="text-muted">Ships from: </span> China
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center font-weight-semibold align-middle p-2">
                                                {{ $item->getProduct->first()->price }} - KS</td>
                                            <td class="align-middle text-center">
                                                <!-- Product Pricing, Increment/Decrement buttons-->
                                                <div class="product-price-cart">
                                                    <a href="{{ route('update-cart', ['dec', $item->id]) }}"
                                                        class="btn btn-dec quantity-btn">
                                                        <i class="fas fa-minus"></i>
                                                        <input class="input-dec" type="hidden"
                                                            value="{{ $item->quantity }}">
                                                    </a>

                                                    <span style="margin: 0 5px;"
                                                        class="cart-qty-value">{{ $item->quantity }}</span>

                                                    <a href="{{ route('update-cart', ['inc', $item->id]) }}"
                                                        class="btn btn-inc quantity-btn">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                </div>
                                                <!-- <input type="text" class="form-control text-center" value="{{ $item->quantity }}"> -->
                                            </td>
                                            <td class="text-center font-weight-semibold align-middle p-2">
                                                {{ $item->getProduct->first()->price * $item->quantity }} - KS</td>
                                            <td class="text-center align-middle px-0"><a
                                                    href="{{ route('remove-cart-item', $item->id) }}"
                                                    class="shop-tooltip close float-none text-danger" title=""
                                                    data-original-title="Remove">×</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="p-4 text-center text-danger" colspan="5">
                                                Opps! No Cart Items.
                                            </td>
                                        </tr>
                                    @endforelse
                                    <script>
                                        $(document).ready(function(e) {
                                            $('.btn-dec').on('click', function(e) {
                                                if ($(this).children('.input-dec').val() == 1) {
                                                    e.preventDefault()
                                                }
                                            })
                                        })

                                    </script>
                                </tbody>
                            </table>
                        </div>
                        <!-- / Shopping cart table -->

                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4 col-md-4 col-12">
                                <label class="text-muted font-weight-normal">Promocode</label>
                                <input type="text" placeholder="ABC" class="form-control">
                            </div>
                            <div class="d-flex">
                                <div class="text-right mt-4 mr-5">
                                    <label class="text-muted font-weight-normal m-0">Discount</label>
                                    <div class="text-large"><strong>$20</strong></div>
                                </div>
                                <div class="text-right mt-4">
                                    <label class="text-muted font-weight-normal m-0">Total price</label>
                                    <div class="text-large"><strong>{{ $total }} - KS</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end m-2">
                            <a href="{{ route('all-products') }}" type="button"
                                class="btn btn-md btn-default md-btn-flat mt-2">Back to shopping</a>
                            <a href="{{ route('checkout') }}" type="button"
                                class="btn btn-md btn-success mt-2 @if ($total==0) d-none @endif">Proceed to Checkout</a>
                        </div>
                        <hr>
                        <h5 class="text-bold">{{ $related_products != null ? 'Related Products' : '' }}</h5>
                        <div class="row">
                            @foreach ($related_products as $product)
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="{{ route('show-detail', $product->id) }}" class="image"><img
                                                    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                            <!-- <span class="product-sale-label">sale!</span> -->
                                        </div>
                                        <div class="product-content">
                                            <h6><a style="text-decoration: none; color:rgb(61, 61, 61);"
                                                    href="#">{{ substr($product->name, 0, 20) }}{{ strlen($product->name) > 20 ? '...' : '' }}</a>
                                            </h6>
                                            <h5 class="text-danger">{{ $product->price }} - KS</h5>
                                            <ul class="product-links">
                                                <li><a href="{{ route('show-detail', $product->id) }}"><i
                                                            class="fa fa-eye fa-sm text-default"></i></a></li>
                                                <li><a href="{{ route('add.wishlist', $product->id) }}"><i
                                                            class="fa fa-heart fa-sm text-danger"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
