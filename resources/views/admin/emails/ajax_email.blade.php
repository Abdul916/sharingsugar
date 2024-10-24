<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Dispatched Email</h5>
    </div>
    <div class="modal-body">
        <form id="edit_plan_form" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Title</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="title" class="form-control" value="{{ $email['title'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Body</strong></label>
                <div class="col-sm-8">
                   {!! $email['body'] !!}
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    </div>
</div>