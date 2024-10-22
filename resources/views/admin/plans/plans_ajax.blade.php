<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title">Edit Membership Plan</h5>
    </div>
    <div class="modal-body">
        <form id="edit_plan_form" method="post">
            @csrf
            <input type="hidden" name="id" class="form-control" value="{{ $plan['id'] }}">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Title</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" value="{{ $plan['name'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Subtitle</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="subtitle" value="{{ $plan['subtitle'] }}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Plan Type</strong></label>
                <div class="col-sm-8">
                    <select class="form-control" name="plan_type">
                        <option value="1" @if($plan['plan_type'] == '1') selected @endif>Monthly</option>
                        <option value="2" @if($plan['plan_type'] == '2') selected @endif>Quarterly</option>
                        <option value="3" @if($plan['plan_type'] == '3') selected @endif>Half Year</option>
                        <option value="4" @if($plan['plan_type'] == '4') selected @endif>Yearly</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Percentage Off</strong></label>
                <div class="col-sm-8">
                    <input type="number" min="0" max="99" name="off_percent" value="{{ $plan['off_percent'] }}" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Price</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="price" class="form-control" value="{{ $plan['price'] }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label"><strong>Description</strong></label>
                <div class="col-sm-8">
                    <textarea name="description" class="form-control">{{ $plan['description'] }}</textarea>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_plan_button">Save Changes</button>
    </div>
</div>