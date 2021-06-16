@extends('welcome')

@section('content')

@if($search_query_result->count() > 0)
@foreach($search_query_result as $result)
<div id="myProducts" class="container">
    <div class="container__col-1 product-detail">
        <img src="{{ $result->gallery }}" alt="">
    </div>
    <div class="container__col-2 product-detail">
        <div class="box">
            <!-- Product Description -->
            <div class="product-description">
                <span>{{ $result->category }}</span>
                <h3>{{ $result->name }}</h3>
                <p>{{ $result->description }}</p>
            </div>

            <!-- Product Pricing -->
            <div class="product-price">
                <span>{{ $result->price }} $</span>
            </div>

            <a href="http://" class="cart-btn">AddToCart</a>
            <a href="http://" class="buy-btn">BuyNow</a>
        </div>
    </div>
</div>
@endforeach
@else
<div style="line-height: 100px;" class="d-flex justify-content-around">No matching item found...</div>
@endif

@endsection