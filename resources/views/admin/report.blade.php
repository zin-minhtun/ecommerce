@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h4 class="m-0">
                Reports
                <span>
                    <input id="year" type="text" class="form-control col-md-1 col-2 float-right yearpicker" name="year"
                        value="">
                    <span style="font-size: 18px; line-height: 35px;" for="year" class="mr-2 float-right">Year
                        :</span>
                </span>
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="small-box elevation-2" style="background-color: rgb(214, 234, 248);">
                <div id="gross_sale" class="inner">
                    <h4 class="text-success">{{ $result['gross_sale'] }} Ks<sup
                            style="font-size: 20px"></sup></h4>
                    <p>Gross Sales</p>
                    <p class="text-success">(+{{ $result['gross_sale'] }})</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box elevation-2" style="background-color: rgb(214, 234, 248);">
                <div id="discount" class="inner">
                    <h4 class="text-danger">
                        {{ $diff = $result['gross_sale'] - $result['net_sale'] }}
                        Ks<sup style="font-size: 20px"></sup></h4>
                    <p>Discounts</p>
                    <p class="text-danger">(+{{ $diff }})</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars text-danger"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box elevation-2" style="background-color: rgb(214, 234, 248);">
                <div id="net_sale" class="inner">
                    <h4 class="text-success">{{ $result['net_sale'] }} Ks<sup
                            style="font-size: 20px"></sup></h4>
                    <p>Net Sales</p>
                    <p class="text-success">(+{{ $result['net_sale'] }})</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars text-success"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box elevation-2" style="background-color: rgb(214, 234, 248);">
                <div id="gross_profit" class="inner">
                    <h4 class="text-primary">
                        {{ $gross_profit = $result['gross_sale'] - $result['actual_cost'] }}
                        Ks<sup style="font-size: 20px"></sup></h4>
                    <p>Gross Profit</p>
                    <p class="text-primary">(+{{ $gross_profit }})</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars text-info"></i>
                </div>
            </div>
        </div>
        {{-- {{ json_encode($data) }} --}}
        <div class="card w-100">
            <div class="card-header">
                <h5 class="card-title">Sales Report (By Date)</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="reportTable" class="table table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Gross Sale</th>
                            <th>Discount</th>
                            <th>Net Sale</th>
                            <th>Gross Profit</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set year picker
            $('.yearpicker').yearpicker({
                year: new Date().getFullYear(),
                endYear: new Date().getFullYear(),
            })

            var input_y = new Date().getFullYear();
            $('.yearpicker').on('change', function () {
                input_y = $(this).val()
                $.ajax({
                    url: '{{ route('admin.ajax.homereport') }}',
                    type: 'GET',
                    data: {
                        input_year: input_y
                    },
                    success: function (response) {
                        $('#gross_sale').children('h4')
                            .text(response.gross_sale + ' Ks')
                        $('#gross_sale').children('p:last-child')
                            .text('(+' + response.gross_sale + ')')
                        $('#discount').children('h4')
                            .text(response.gross_sale - response.net_sale)
                        $('#discount').children('p:last-child')
                            .text('(+' + (response.gross_sale - response.net_sale) + ')')
                        $('#net_sale').children('h4')
                            .text(response.net_sale)
                        $('#net_sale').children('p:last-child')
                            .text('(+' + response.net_sale + ')')
                        $('#gross_profit').children('h4')
                            .text(response.gross_sale - response.actual_cost)
                        $('#gross_profit').children('p:last-child')
                            .text('(+' + (response.gross_sale - response.actual_cost) + ')')
                    }
                })
                reportDT.ajax.reload()
            })
            // /. Set year picker

            var reportDT = $("#reportTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.ajax.getreports') }}",
                    data: function (data) {
                        data.input_year = input_y
                    }
                },

                order: [
                    [0, 'desc'],
                ],
                columns: [{
                        data: 'created_at',
                    },
                    {
                        data: 'total_price',
                    },
                    {
                        data: 'discount',
                    },
                    {
                        data: 'net_sale',
                    },
                    {
                        data: 'total_cost',
                    }
                ],
            })
        })

    </script>
    @endsection
