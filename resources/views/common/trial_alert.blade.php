@php($trial = trial_checker())
@if($trial['status'] != 0)
    <div class="alert alert-warning fade show" role="alert">
        <strong>Warning!</strong> {{$trial['message']}} Please subscribe to a <a href="{{url('membership')}}">membership plan</a> to continue using our services unintrupted.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif