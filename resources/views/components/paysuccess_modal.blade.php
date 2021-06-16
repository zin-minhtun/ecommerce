<!-- Payment Success Modal Box -->

@if($message = Session::get('paysuccess'))
<script>
    $(function() {
        $('#exampleModalCenter').modal('show');
    });
</script>
@endif

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
                <h5>{{ $message }}</h5>
            </div>
            <a href="/" style="text-decoration: none; margin: auto; width: 100%;" class="bg-light text-success text-center border-0 p-3">Show Order Details</a>
        </div>
    </div>
</div>

<!-- /. Payment Success Modal Box -->