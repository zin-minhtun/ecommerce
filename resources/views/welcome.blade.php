<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <style>
        #grad1 {
            background: linear-gradient(135deg, rgb(240, 137, 69) 20%, rgb(14, 36, 138) 80%);
        }

    </style>
</head>

<body class="bg-default">
    @include('components.paysuccess_modal')
    <header>
        <nav id="grad1" class="navbar fixed-top navbar-expand-md navbar-dark shadow p-3 bg-white">
            <a class="navbar-brand" href="#">
                <h3 class="my-auto mx-auto font-weight-bold">Shopee</h3>
            </a>

            <!-- cart item -->
            <a href="{{ route('cart.index') }}">
                <img src="{{ asset('images/static/shopping-cart.png') }}" alt="Logo" width="40px">
            </a>
            @isset($total_cart_item)
                <span style="margin-top: -20px; margin-right:auto;"
                    class="ml-n2 translate-middle badge border border-light rounded-circle bg-danger p-1">{{ $total_cart_item }}</span>
            @endisset
            <span style="margin-top: -20px; margin-right:auto; visibility: hidden;"
                class="badge pull-left badge-pill bg-danger">0</span>

            <a class="mr-3" style="text-decoration: none" href="{{ route('cart.index') }}">
                <p class="my-auto mx-auto text-light">About</p>
            </a>
            <a class="mr-2" style="text-decoration: none" href="{{ route('cart.index') }}">
                <p class="my-auto mx-auto text-light">Contact</p>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all-products') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wishlist.index') }}" tabindex="-1"
                            aria-disabled="true">Wishlist</a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item dropdown mr-2">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ url('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                </ul>
                <form action="{{ url('/search') }}" method="GET" class="form-inline my-2 my-lg-0">
                    <!-- <input id="myInput" name="query" class="form-control mr-sm-2" type="search" placeholder="Search" value="{{ Request::input('query') }}" aria-label="Search">
                    <button id="mySearchBtn" class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button> -->
                    <!-- <div class="input-group">
                        <input name="query" class="form-control py-2 border-right-0 border" type="search" value="{{ Request::input('query') }}" placeholder="Search" aria-label="Search" id="myInput">
                        <span class="input-group-append">
                            <button id="mySearchBtn" class="btn btn-outline-light border-left-0 border" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div> -->
                    <ul class="navbar-nav mr-auto ml-0">
                        @if(Route::has('login'))
                            @auth
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.report.home') }}"><i
                                            class="fas fa-chart-bar"></i> Back Office</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('login') }}">Log in</a></li>
                                @if(Route::has('register'))
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </form>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="com-md-12" style="margin-top: 80px;">
            <!-- crousel start -->
            @isset($products)
                <div class="bd-example">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach($random_products as $product)
                                <div
                                    class="carousel-item {{ $product->id == $random_products->first()->id ? 'active' : '' }}">
                                    <img src="{{ asset('/images/' . $product->gallery) }}"
                                        class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $product->name }}</h5>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- crousel end -->

                <h3 class="row justify-content-center my-4">Special Sales</h3>
                <div class="row">
                    @foreach($shuffle_items as $product)
                        <div class="col-md-3 col-sm-6 col-6 position-relative top-0">
                            @if(isset($product->getProductPricing->first()->discount_percentage) )
                                <div class="product-grid mx-n2" style="border: 4px solid rgb(19, 43, 179);">
                                    {!! $product->getDiscountPrice() != null ?
                                    '<div class="ribbon-wrapper">
                                        <div class="ribbon bg-danger text-sm">' .
                                            $product->getProductPricing->first()->discount_percentage . ' %'
                                            . '</div>
                                    </div>' : '' !!}
                                    <div class="product-image">
                                        <a href="{{ route('show-detail', $product->id) }}"
                                            class="image"><img
                                                src="{{ asset('/images/' . $product->gallery) }}"></a>
                                        <!-- <span class="product-sale-label">sale!</span> -->
                                    </div>
                                    <div class="product-content">
                                        <h6 class="text-left">
                                            <a style="text-decoration: none; color:rgb(61, 61, 61);"
                                                href="{{ route('show-detail', $product->id) }}">{{ substr($product->name, 0, 18) }}{{ strlen($product->name) > 18 ? '...' : '' }}</a>
                                        </h6>
                                        <h6 class="text-danger text-left">
                                            {!! $product->getDiscountPrice() != null ? '<del>' . $product->price . '-
                                                KS</del>' : $product->price !!}
                                        </h6>
                                        <h6 class="text-dark text-left">
                                                {!! $product->getDiscountPrice() != null ? $product->getDiscountPrice()
                                                . '
                                                - KS' : '' !!}
                                        </h6>
                                        <ul class="product-links">
                                            <li><a
                                                    href="{{ route('show-detail', $product->id) }}"><i
                                                        class="fa fa-eye fa-sm text-default"></i></a></li>
                                            <li><a
                                                    href="{{ route('add.wishlist', $product->id) }}"><i
                                                        class="fa fa-heart fa-sm text-danger"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- product grid start -->
                <h3 class="row justify-content-center my-4">Best Seller Items</h3>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3 col-sm-6 col-6 position-relative top-0">
                            <div class="product-grid mx-n2">
                                {!! $product->getDiscountPrice() != null ?
                                '<div class="ribbon-wrapper">
                                    <div class="ribbon bg-danger text-sm">' .
                                        $product->getProductPricing->first()->discount_percentage . ' %'
                                        . '</div>
                                </div>' : '' !!}
                                <div class="product-image">
                                    <a href="{{ route('show-detail', $product->id) }}"
                                        class="image"><img
                                            src="{{ asset('/images/' . $product->gallery) }}"></a>
                                    <!-- <span class="product-sale-label">sale!</span> -->
                                </div>
                                <div class="product-content">
                                    <h6 class="text-left">
                                        <a style="text-decoration: none; color:rgb(61, 61, 61);"
                                            href="{{ route('show-detail', $product->id) }}">{{ substr($product->name, 0, 18) }} {{ strlen($product->name) > 18 ? '...' : '' }}</a>
                                    </h6>
                                    <h6 class="text-danger text-left">
                                        {!! $product->getDiscountPrice() != null ? '<del>' . $product->price . '-
                                            KS</del>' : $product->price . ' - Ks' !!}
                                    </h6>
                                    <h6 class="text-dark text-left">
                                            {!! $product->getDiscountPrice() != null ? $product->getDiscountPrice()
                                            . '
                                            - KS' : '<br>' !!}
                                    </h6>
                                    <ul class="product-links">
                                        <li><a
                                                href="{{ route('show-detail', $product->id) }}"><i
                                                    class="fa fa-eye fa-sm text-default"></i></a></li>
                                        <li><a
                                                href="{{ route('add.wishlist', $product->id) }}"><i
                                                    class="fa fa-heart fa-sm text-danger"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset

            @yield('content')
        </div>
    </div>
</body>

</html>
