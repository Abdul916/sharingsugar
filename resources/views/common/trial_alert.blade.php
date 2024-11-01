@php($trial = trial_checker())
@if($trial['status'] != 0)
{{$trial['message']}} Please subscribe to a <a href="{{url('membership')}}">membership plan</a> to continue using our services.
</div>
@endif