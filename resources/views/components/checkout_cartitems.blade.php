@if($is_from_cart)
    <?php 
        global $total;
        $total += $checkout_product['product']->price * $checkout_product['quantity'] 
    ?>
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0">{{ $checkout_product['product']->name }}</h6>
            <small class="text-muted">Price: {{ $checkout_product['product']->price }} KS <i style="opacity: 50%;" class="fas fa-times"></i> {{ $checkout_product['quantity'] }}</small>
        </div>
        <span class="text-muted">{{ $checkout_product['product']->price * $checkout_product['quantity'] }} KS</span>
    </li>
@else
    @foreach($cart_items as $item)
        <?php 
            global $total;
            $total += $item->getProduct->first()->price * $item->quantity
        ?>
        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0">{{ $item->getProduct->first()->name }}</h6>
                <small class="text-muted">Price: {{ $item->getProduct->first()->price }} KS <i style="opacity: 50%;" class="fas fa-times"></i> {{ $item->quantity }}</small>
            </div>
            <span class="text-muted">{{ $item->getProduct->first()->price * $item->quantity }} KS</span>
        </li>
    @endforeach
@endif