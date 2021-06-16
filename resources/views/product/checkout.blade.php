@extends('welcome')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="m-3">
            <!-- Checkout -->
            <div class="card">
                <div class="card-header">
                    <h5>Checkout</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 order-md-2 mb-4">
                            @if(!isset($checkout_product))
                                <h5 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Your cart</span>
                                    <span class="badge badge-secondary badge-pill">@isset($total_cart_item) {{ $total_cart_item }} @endisset</span>
                                </h5>
                            @endif
                            <form class="card p-3">
                                <span class="text-muted mb-2 mt-2">OrderID # <?php echo substr(str_shuffle('0123456789'),1,5);?></span>
                                <ul class="list-group mb-3">

                                    <?php 
                                        global $total;
                                        $total = 0;
                                    ?>

                                    @if(isset($checkout_product))
                                        @include('components.checkout_cartitems', [
                                            'is_from_cart' => true,
                                            'checkout_product' => $checkout_product,
                                        ])
                                    @else
                                        @include('components.checkout_cartitems', ['is_from_cart' => false])
                                    @endif

                                </ul>
                                <div class="d-flex mb-3">
                                    <div class="mr-auto">
                                        <label class="text-muted font-weight-normal m-0">Discount</label>
                                        <div class="text-large"><strong>$20</strong></div>
                                    </div>
                                    <div class="">
                                        <label class="text-muted font-weight-normal m-0">Sub Total</label>
                                        <div class="text-large"><strong>{{ $total }} - KS</strong></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 order-md-1">
                            <h5 class="mb-3">Billing address</h5>
                            <form action="{{ route('place-order') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="phone">Phone</label>
                                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone Number" required>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <label for="city">City</label>
                                        <input name="city" type="text" class="form-control" id="city" placeholder="City" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="textarea">Address</label>
                                    <textarea name="address" class="form-control" id="textarea" rows="3"></textarea>
                                </div>

                                <hr class="mt-4 mb-4">

                                <h5 class="mb-3">Payment</h5>

                                <div class="d-block my-3">
                                <input name="payment_id" value="1" type="hidden" class="radio custom-control-input">
                                    <div class="to-show">
                                        <div class="form-group">
                                            <label for="payment_receipt">Upload Receipt</label>
                                            <div class="form-group">
                                                <input type="file" name="payment_receipt" id="payment_receipt" class="form-control-file" required>
                                            </div>
                                        </div>
                                        <a href="" data-toggle="modal" data-target="#exampleModalCenter">How to make a payment?</a>
                                    </div>
                                </div>
                                @if($message = Session::get('success'))
                                <script>
                                    $(function() {
                                        $('#exampleModalCenter').modal('show');
                                    });
                                </script>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $message }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <div class="float-right">
                                    <a href="/cart" type="button" class="btn btn-md btn-default md-btn-flat mt-2 mr-3 @if($total == 0) d-none @endif">Back to cart</a>
                                    <button type="submit" class="btn btn-md btn-primary mt-2 @if($total == 0) d-none @endif">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection