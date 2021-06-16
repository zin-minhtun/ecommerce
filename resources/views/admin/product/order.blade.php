@extends('layouts.master')
<?php
//dd($orders)
?>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6 col-4">
                <h4 class="m-0">Orders</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-4">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                        Order by <span class="caret"></span>
                    </button>
                </div>
            </div>

            <div class="col-sm-6 col-8">
                <ol class="breadcrumb float-right">
                    <a class="btn btn-sm btn-success mr-2 bg-primary"><i class="fas fa-file-export"></i> Export</a>
                </ol>
            </div>
        </div>
    </div>
    </div>
    <!-- /.content-header -->

    <!-- Products table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table class="table text-center table-hover">
                    <tr style="font-size: small;">
                        <th>ID</th>
                        <th class="text-left">Customer</th>
                        <!-- <th class="text-left">Product</th>
                        <th>Quantity</th> -->
                        <th class="text-left">Phone</th>
                        <!-- <th>Address</th>
                        <th>City</th> -->
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                        <th class="d-none"></th>
                    </tr>
                    <?php
                    // asort($orders)
                    ?>
                    <style>
                        #hover-item:hover {
                            color: #cc0808;
                        }
                    </style>
                    @foreach ($orders as $key => $order)
                        <tr @if (reset($order)['order_info']->state == null) id="hover-item" style="border-left: 3px solid blue; background-color: #E1E9F6;" @endif">
                            <td>{{ reset($order)['order_info']->id }}</td>
                            <td class="product text-left">{{ reset($order)['order_info']->name }}</td>
                            <td class="text-left">
                                <i class="fas fa-phone fa-sm text-green mr-2"></i>
                                {{ reset($order)['order_info']->phone }}
                            </td>
                            <td>{{ reset($order)['order_info']->created_at }}</td>
                            <td>
                                <a data-toggle="modal" data-target="{{ '#myModal' . reset($order)['order_info']->id }}"
                                    class="btn btn-sm btn-success" title="View Detail"><i class="fas fa-eye"></i> Detail</a>
                                <a id="submit" onclick="confirmBtn(`{{ reset($order)['order_info']->id }}`)"
                                    class="btn btn-sm btn-info text-white @if (reset($order)['order_info']->state == 'confirm') disabled @endif" title="Confirm Order"><i class="fas fa-check"></i> Confirm</a>
                                <a onclick="deleteBtn(`{{ reset($order)['order_info']->id }}`)"
                                    class="btn btn-sm btn-danger mr-2 @if (reset($order)['order_info']->state == 'confirm') disabled @endif" title="Reject"><i class="fas fa-ban"></i> Reject</a>
                            </td>
                            <td class="d-none">
                                <form id="confirmForm" action="{{ route('admin.confirm.order') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value>
                                </form>
                                <form id="deleteForm" action="{{ route('admin.delete.order') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="{{ 'myModal' . reset($order)['order_info']->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #EAE8E8;">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Order Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="background-color: #FAFAFA;">
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">Order Refreence:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->id }}</div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">Customer Name:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->name }}</div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">Phone:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->phone }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">Address:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->address }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">City:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->city }}</div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12 pt-1 pb-3 mt-2 mb-3 mx-auto bg-success">
                                                <div class="col text-bold" style="border-bottom: 1px dashed grey;">
                                                    Product
                                                </div>
                                                <div class="text-bold" style="border-bottom: 1px dashed grey;">
                                                    Qty
                                                </div>
                                                @foreach ($order as $item)
                                                    <div class="w-100 pt-2"></div>
                                                    <div class="col"><a href="http://"
                                                            class="text-white {{ $item['product']->deleted_at != null ? 'text-danger' : '' }}">{{ $item['product']->name }}
                                                            {{ $item['product']->deleted_at != null ? '(Deleted Stock item)' : '' }}</a>
                                                    </div>
                                                    <div
                                                        class="text-white {{ $item['product']->deleted_at != null ? 'text-danger' : '' }}">
                                                        {{ $item['quantity'][0] }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row col-md-12">
                                                <div class="col-md-6 col-6 text-bold">Ordering Date:</div>
                                                <div class="col-md-6 col-6">{{ reset($order)['order_info']->created_at }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a style="text-decoration: none;" data-toggle="modal"
                                        data-target="{{ '#receiptModal' . reset($order)['order_info']->id }}"
                                        class="border-0 p-3 btn-block btn-danger text-center">Check Receipt</a>

                                    <!-- Receipt Image Modal -->
                                    <div class="modal fade" id="{{ 'receiptModal' . reset($order)['order_info']->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title text-bold" id="exampleModalLongTitle">Check
                                                        Receipt !</h5>
                                                </div>
                                                <div class="modal-body" style="background-color: #FAFAFA;">
                                                    <img width="100%" height="500px"
                                                        src="{{ asset('images/payment-receipt/' . reset($order)['order_info']->payment_receipt) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                    <script>
                        function confirmBtn(id) {
                            var conf = confirm('Confirm this record?')
                            if (conf) {
                                $('#confirmForm input[name="order_id"]').val(id)
                                $('#confirmForm').submit()
                            }
                        }

                        function deleteBtn(id) {
                            var conf = confirm('Delete this record?')
                            if (conf) {
                                $('#deleteForm input[name="order_id"]').val(id)
                                $('#deleteForm').submit()
                            }
                        }

                    </script>
                </table>
            </div>
            <div class="float-right">
                @php
                    $current_url = str_replace(url('/'), '', url()->current());
                @endphp
                @if ($orders->lastPage() > 1)
                    <ul class="pagination">
                        <li class="page-item {{ $orders->currentPage() == 1 ? ' disabled' : '' }}">
                            <a href="{{ $current_url . $orders->url(1) }}" class="page-link">Previous</a>
                        </li>
                        @for ($i = 1; $i <= $orders->lastPage(); $i++)
                            <li class="page-item {{ $orders->currentPage() == $i ? ' active' : '' }}">
                                <a href="{{ $current_url . $orders->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $orders->currentPage() == $orders->lastPage() ? ' disabled' : '' }}">
                            <a href="{{ $current_url . $orders->url($orders->currentPage() + 1) }}" class="page-link">Next</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <!-- ./ Products table -->
@endsection
