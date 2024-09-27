@extends('app')
@section('title', 'Chat')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Chat</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Chat</li>
            </ul>
        </div>
    </div>
</section>

<section class="profile-section user-setting-section mt-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div id="mycontainer">
                    <aside>
                        <ul>
                            @foreach($chatted_users as $chat)
                            <li class="active_chat_{{$chat->id}} remove_style">
                                @if($chat->receiver_id == Auth::user()->id)
                                @php
                                $data = get_single_row('users', 'id', $chat->sender_id, '', '', '', '');
                                $last_receiver_id = $chat->sender_id;
                                @endphp
                                @else
                                @php
                                $data = get_single_row('users', 'id', $chat->receiver_id, '', '', '', '');
                                $last_receiver_id = $chat->receiver_id;
                                @endphp
                                @endif
                                <div class="btn_main">
                                    <div class="btn_user">
                                        <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="title user_img">
                                            @if(!empty($data->profile_image))
                                            <img src="{{ asset('assets/app_images') }}/{{$data->profile_image}}" alt="" style="width: 40px; border-radius: 50%;">
                                            @else
                                            <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="" style="width: 40px; border-radius: 50%;">
                                            @endif
                                        </a>
                                        <a href="javascript:void(0)" data-id="{{$chat->id}}" data-rec-id="{{$last_receiver_id}}" class="btn_change_chat user_name">
                                            <div>
                                                <h2>{{ $data->username }}</h2>
                                                <h3 class="text-white">
                                                    {{ $data->iam }}
                                                </h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="btn_chat">
                                        <a href="javascript:void(0)" data-id="{{$chat->id}}" class="btn_delete_chat" title="Delete messages (Cannot be undone)"><i class="fas fa-trash"></i></a>
                                        <a href="javascript:void(0)" data-id="{{$last_receiver_id}}" class="btn_report_user_modalbox" title="Report User (Asking for money / Spam or Scam)"><i class="fas fa-flag"></i></a>
                                    </div>
                                </div>
                            </li>
                            @php
                            $last_chat_id = $chat->id;
                            @endphp
                            @endforeach
                        </ul>
                    </aside>
                    <main>
                        <div class="msg_body" id="showchatuser"></div>
                        @if(!empty($last_chat_id))
                        <footer class="footer_section">
                            <div class="newslater_section">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="newslater-container">
                                                <div class="newslater-wrapper">
                                                    <form class="newslater-form" id="chat_form">
                                                        <input type="text" name="message" id="chat_message" placeholder="Type your message...">
                                                        <button type="button" id="btn_save_chat"><i class="fab fa-telegram-plane"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" name="last_chat_id" id="last_chat_id" value="@if(!empty($last_chat_id)) {{$last_chat_id}} @endif">
<input type="hidden" name="last_receiver_id" id="last_receiver_id" value="@if(!empty($last_receiver_id)) {{$last_receiver_id}} @endif">
<input type="hidden" name="chat_id" id="chat_id" value="@if(!empty($chat_id)) {{ $chat_id }} @endif">
<input type="hidden" name="receiver_id" id="receiver_id" value="@if(!empty($receiver_id)) {{ $receiver_id }} @endif">

@endsection
@push('scripts')
<script>
    var my_id = $("#chat_id").val();
    my_id = my_id.trim();
    if(my_id != ""){
        $(".active_chat_"+my_id).addClass('active_chat');
    }else{
        var last_chat_id = $("#last_chat_id").val();
        last_chat_id = last_chat_id.trim();
        $(".active_chat_"+last_chat_id).addClass('active_chat');
    }
    $(document).ready(function() {
        show_chats('onload', '', '');
    });

    $(document).on("click" , ".btn_change_chat" , function() {
        $(".remove_style").removeClass('active_chat');
        show_chats('change_chat', $(this).attr("data-id"), $(this).attr("data-rec-id"));
        $(".active_chat_"+$(this).attr("data-id")).addClass('active_chat');
    });

    function show_chats(action="", cId="", rId="" ){
        if(action == "onload"){
            if(typeof ($("#chat_id").val()) == "undefined" || $("#chat_id").val() == "") {
                var chat_id = $("#last_chat_id").val();
                var receiver_id = $("#last_receiver_id").val();
            }else{
                var chat_id = $("#chat_id").val();
                var receiver_id = $("#receiver_id").val();
            }
        }else if(action == "change_chat"){
            var chat_id = cId;
            var receiver_id = rId;
        }
        $.ajax({
            url:'{{ url('get_chats') }}',
            type: 'POST',
            dataType:'json',
            data: {"_token": "{{ csrf_token() }}", "chat_id": chat_id, "receiver_id": receiver_id },
            success:function(status){
                if(status.msg=='success') {
                    $(".msg_body").html(status.response);
                    // var p =  $('#chat').prop("scrollHeight");
                    $("#chat").animate({scrollTop: $('#chat').prop("scrollHeight")}, 500);
                }
            }
        });
    }

    $('#chat_message').keypress(function (e) {
        if (e.which == 13) {
            $("#btn_save_chat").click();
            return false;
        }
    });
    $(document).on("click" , "#btn_save_chat" , function() {
        $("#btn_save_chat").prop('disabled', 'true');
        var chat_id = $("#chatted_id").val();
        var receiver_id = $("#chatted_user_id").val();
        var message = $("#chat_message").val();
        $.ajax({
            url:'{{ url('save_chats') }}',
            type: 'POST',
            dataType:'json',
            data: {"_token": "{{ csrf_token() }}", "chat_id": chat_id, "receiver_id": receiver_id, "message": message },
            success:function(status){
                if(status.msg=='success') {
                    $("#chat_message").val('');
                    $('#btn_save_chat').prop("disabled", false);
                    show_chats('change_chat', chat_id, receiver_id);
                } else if(status.msg == 'error') {
                    $("#btn_save_chat").prop('disabled', false);
                    toastr.error(status.response,"Error");
                } else if(status.msg == 'lvl_error') {
                    $("#btn_save_chat").prop('disabled', false);
                    var message = "";
                    $.each(status.response, function (key, value) {
                        message += value+"<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
</script>
@endpush