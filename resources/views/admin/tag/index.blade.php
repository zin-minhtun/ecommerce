@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-12 col-12">
            <h4 class="m-0">
                <form action="{{ route('admin.multi-tag.delete') }}" method="post">
                    @csrf
                    <input id="form-role" type="hidden" name="delete_id" value>
                    Tags
                    <ol class="breadcrumb float-right">
                        <input type="button" class="btn btn-sm btn-danger mr-2" id='delete_record' value='Delete'>
                        <a href="{{ route('admin.tag.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus-square"></i>
                            Create
                        </a>
                    </ol>
                </form>
            </h4>
        </div>
    </div>
</div>
<!-- /.Content-header -->

<!-- Employees table -->
<div class="row">
    <div class="col-md-12">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card p-4">
            <table id="tagTable" class="table table-center table-hover w-100">
                <thead>
                    <tr>
                        <th>
                            @if($tags->count() > 0)
                                <input type="checkbox" class='cb-checkall mr-2' id='cb-checkall'>Select
                            @endif
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- ./ Employees table -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var dataTable = $('#tagTable').DataTable({
            bStateSave: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ajax.gettags') }}",
            columns: [{
                    className: "cb-element",
                    data: 'checkbox',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'action',
                    searchable: false,
                    orderable: false
                },
            ]
        });

        $('#tagTable').on('page.dt', function () {
            $('.cb-checkall').prop('checked', false);
        })

        // Check all 
        $('.cb-checkall').click(function () {
            if ($(this).is(':checked')) {
                $('.delete_check').prop('checked', true);
            } else {
                $('.delete_check').prop('checked', false);
            }
        });

        $('#delete_record').click(function () {

            var deleteids_arr = [];
            // Read all checked checkboxes
            $("input:checkbox[class=delete_check]:checked").each(function () {
                deleteids_arr.push($(this).val());
            });

            // Check checkbox checked or not
            if (deleteids_arr.length > 0) {
                // Confirm alert
                var confirmdelete = confirm("Do you really want to Delete records?");
                if (confirmdelete == true) {
                    $.ajax({
                        url: '{{ route('admin.ajax.deletetags') }}',
                        type: 'POST',
                        data: {
                            delete_type: 'multiple',
                            deleteids_arr: deleteids_arr
                        },
                        success: function (response) {
                            // var res = JSON.parse(response)
                            // console.log(response)
                            dataTable.ajax.reload()
                            $('.cb-checkall').prop('checked', false);
                        }
                    });
                }
            }
        })

        // Checkbox checked
        $('#tagTable tbody').on('click', '.cb-element', function () {
            var length = $('.delete_check').length;
            // Total checked checkboxes
            var totalchecked = 0;
            $('.delete_check').each(function () {
                if ($(this).is(':checked')) {
                    totalchecked += 1;
                }
            });

            // Checked unchecked checkbox
            if (totalchecked == length) {
                $(".cb-checkall").prop('checked', true);
            } else {
                $('.cb-checkall').prop('checked', false);
            }
        })
    })

</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">

@endsection
