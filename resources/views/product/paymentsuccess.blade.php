@extends('welcome')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="m-3">
            @if($message = Session::get('success'))
            <script>
                // $(function() {
                //     $('#exampleModalCenter').modal('show');
                // });
                alert()
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
            </div>
        </div>
    </div>
</div>
@endsection