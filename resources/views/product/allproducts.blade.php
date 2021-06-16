@extends('welcome')

@section('content')
<div class="row">
    <!-- BEGIN SEARCH RESULT -->
    <div class="col-md-12">
        <div class="search">
            <div class="">
                <div class="row">
                    <!-- BEGIN FILTERS -->
                    <div class="col-md-3">
                        <form action="{{ url('/search') }}" method="GET" class="my-2 my-lg-0">
                            <div class="input-group">
                                <input name="query" class="form-control py-2 border-right-0 border" type="search" value="{{ Request::input('query') }}" placeholder="Search Products" aria-label="Search" id="myInput">
                                <span class="input-group-append">
                                    <button id="mySearchBtn" class="btn btn-primary btn-outline-light border-left-0 border" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br>
                        <!-- END SEARCH INPUT -->
                        <h5 class="grid-title"><i class="fa fa-filter"></i> Filter
                            <!-- <a href="{{ route('all-products') }}" title="Reset"><i class="fas fa-sync-alt float-right text-success mr-2"></i></a>
                 -->
                            <a class="filter-toggle btn btn-light float-right" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="true" aria-controls="multiCollapseExample1"><i class="fas fa-bars"></i></a>
                        </h5>


                        <div class="col">
                            <div class="collapse multi-collapse @isset($filtered_products) show @endisset @isset($input_categories) show @endisset" id="multiCollapseExample1">
                                <!-- <div class="card card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
      </div> -->
                                <!-- BEGIN FILTER BY CATEGORY -->

                                <h5 class="mt-3 mb-3">By category:
                                </h5>
                                <form action="{{ route('filter-by-category') }}" method="get">
                                    @csrf

                                    @foreach($categories as $category)
                                    <div class="checkbox">
                                        <label><input name="categories[]" value="{{ $category->id }}" type="checkbox" class="icheck" @isset($input_categories) @if(in_array($category->id, $input_categories)) checked @endif @endisset> {{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                    <button id="mycollapse" type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-search"></i> Filter</button>
                                </form>
                                <!-- END FILTER BY CATEGORY -->
                            </div>
                        </div>

                        <hr>


                        <div class="padding"></div>
                    </div>
                    <!-- END FILTERS -->

                    <!-- BEGIN RESULT -->
                    <div class="col-md-9">
                        <div class="row">
                            <h4 class="mt-2 ml-3"><i class="fa fa-file-o"></i>@isset($product_items) All Products @endisset @empty($product_items) Filter Result <a href="{{ route('all-products') }}" title="Reset"><i class="fas fa-sync-alt text-success ml-2"></i></a>@endempty</h4>
                        <!-- Start Order By -->
                        <div class="btn-group ml-auto">
                            <button type="button" class="btn btn-default dropdown-toggle mr-2" data-toggle="dropdown">
                                Order by <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="{{ route('order-by', 'name') }}">Name</a></li>
                                <li><a class="dropdown-item" href="{{ route('order-by', 'price') }}">Price</a></li>
                                <li><a class="dropdown-item" href="#">View</a></li>
                                <li><a class="dropdown-item" href="#">Rating</a></li>
                            </ul>
                        </div>
                        <!-- End Order By -->

                        </div>
                        <div class="padding"></div>
                        
                        <div class="row">
                        <!-- Retrieve all product items -->
                            @isset($product_items)
                                @foreach($product_items as $product)
                                <div class="col-md-3 col-sm-6 col-6">
                                    <div class="product-grid">
                                        <div class="product-image">
                                            <a href="{{ route('show-detail', $product->id) }}" class="image"><img    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                            <!-- <span class="product-sale-label">sale!</span> -->
                                        </div>
                                        <div class="product-content">
                                            <h6><a style="text-decoration: none; color:rgb(61, 61, 61);" href="#">{{ substr($product->name, 0, 20) }}{{ strlen($product->name) > 20 ? '...' : '' }}</a></h6>
                                            <h5 class="text-danger">{{ $product->price }} - KS</h5>
                                            <ul class="product-links">
                                                <li><a href="{{ route('show-detail', $product->id) }}"><i class="fa fa-eye fa-sm text-default"></i></a></li>
                                                <li><a href="{{ route('add.wishlist', $product->id) }}"><i class="fa fa-heart fa-sm text-danger"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endisset
                        <!-- End Retrieve all product items -->
                        
                        <!-- Order by -->
                        @isset($query)
                        @switch($query)
                        @case('name')
                        @foreach($orderby_name_items as $product)
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('show-detail', $product->id) }}" class="image"><img    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                    <!-- <span class="product-sale-label">sale!</span> -->
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">{{ $product->name }}</a></h3>
                                    <div class="price"><span>{{ $product->price }}</span> $75.99</div>
                                    <ul class="product-links">
                                        <li><a href="{{ route('show-detail', $product->id) }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href=""><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @break

                        @case('price')
                        @foreach($orderby_price_items as $product)
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('show-detail', $product->id) }}" class="image"><img    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                    <!-- <span class="product-sale-label">sale!</span> -->
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">{{ $product->name }}</a></h3>
                                    <div class="price"><span>{{ $product->price }}</span> $75.99</div>
                                    <ul class="product-links">
                                        <li><a href="{{ route('show-detail', $product->id) }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href=""><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @break
                        @endswitch
                        @endisset
                        <!-- End Order by -->

                        <!-- Filtered product items by categories -->
                        @isset($filtered_products)
                        @foreach($filtered_products as $product)
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('show-detail', $product->id) }}" class="image"><img    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                    <!-- <span class="product-sale-label">sale!</span> -->
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">{{ $product->name }}</a></h3>
                                    <div class="price"><span>{{ $product->price }}</span> $75.99</div>
                                    <ul class="product-links">
                                        <li><a href="{{ route('show-detail', $product->id) }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href=""><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endisset
                        <!-- End Filtered product items by categories -->

                        <!-- Product Search -->
                        @isset($search_query_result)
                        @if(count($search_query_result) > 0)
                        @foreach($search_query_result as $product)
                        <div class="col-md-3 col-sm-6 col-6">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('show-detail', $product->id) }}" class="image"><img    src="{{ asset('/images/' . $product->gallery) }}"></a>
                                    <!-- <span class="product-sale-label">sale!</span> -->
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#">{{ $product->name }}</a></h3>
                                    <div class="price"><span>{{ $product->price }}</span> $75.99</div>
                                    <ul class="product-links">
                                        <li><a href="{{ route('show-detail', $product->id) }}"><i class="fa fa-eye"></i></a></li>
                                        <li><a href=""><i class="fa fa-heart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="container">
                            <div class="mx-auto">No match items found.</div>
                        </div>
                        @endif
                        @endisset
                        <!-- End Product Search -->
                        </div>
                        
                        <!-- BEGIN PAGINATION -->
                        <ul class="pagination">
                            <li class="disabled"><a href="#">«</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                        <!-- END PAGINATION -->
                    </div>
                    <!-- END RESULT -->
                </div>
            </div>
        </div>
    </div>
    <!-- END SEARCH RESULT -->
</div>
@endsection