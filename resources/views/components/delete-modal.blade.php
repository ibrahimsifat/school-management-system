@props(['data', 'id'])
<div class="modal fade" id="exampleModalCenter{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Do you want to delete this
                    <strong>{{ $data }}</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- <div class="modal-body">
                {{ $data }}
            </div> --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ $href }}" type="button" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<script src={{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ url('public/plugins/jquery/jquery.min.js') }}></script>
