@extends('welcome')

@section('content')
<div class="container">
    <form id="cart-submit-form" action="{{ route('add-to-cart', $product) }}" method="post">
        @csrf

        @auth
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endauth
        <input id="qty-addto-cart" type="text" name="quantity" value="1" style="display:none;">
    </form>
    <form id="buy-form" action="{{ route('buy.product', $product) }}" method="post">
        @csrf

        @auth
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        @endauth
        <input id="qty-buy" type="text" name="quantity" value="1" style="display:none;">
    </form>
    <div class="container__col-1 product-detail">
        <img src="{{ asset('/images/' . $product->gallery) }}" alt="">
    </div>
    <div class="container__col-2 product-detail">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (session('status-error'))
        <div class="alert alert-danger">
            {{ session('status-error') }}
        </div>
        @endif
        <div class="box">
            <div class="float-right">
                <a class="btn btn-default" href="{{ route('all-products') }}">
                    <i class="fas fa-angle-left"></i>
                    Back
                </a>
            </div>
            <!-- Product Description -->
            <div class="product-description">
                <span>{{ $product->category }}</span>
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
            </div>
            <div class="row container">
                <!-- Product Pricing, Increment/Decrement buttons-->
                <div class="product-price">
                    <span>{{ $product->price }} $</span>
                    <button id="minus" class="btn quantity-btn" href="#">
                        <i class="fas fa-minus"></i>
                    </button>
                    <span style="margin: 0 10px;" id="value">1</span>
                    <button id="plus" class="btn quantity-btn" href="#">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <!-- alert if your input quantity must not greater than '0' -->
            @if($errors->has('quantity'))
            <div class="text-danger mb-3">{{ $errors->first('quantity') }}</div>
            @endif
            <button onclick="document.getElementById('cart-submit-form').submit()" class="btn cart-btn">AddToCart</button>
            <button onclick="document.getElementById('buy-form').submit()" class="btn buy-btn">BuyNow</button>
        </div>
    </div>
</div>
@endsection