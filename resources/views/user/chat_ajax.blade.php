<header>
    <div>
        <h2>{{ get_single_value('users', 'username', $chatted_user_id) }}</h2>
        <h3>already {{ check_record_existing('chat', 'chatted_id', $chatted_id, '', '', '', '', '', '') }} messages</h3>
    </div>
    <input type="hidden" name="chatted_id" id="chatted_id" value="{{$chatted_id}}">
    <input type="hidden" name="chatted_user_id" id="chatted_user_id" value="{{$chatted_user_id}}">
</header>
<ul id="chat">
    @foreach($chats as $chat)
    @php
    $data = get_single_row('users', 'id', $chat->sender_id, '', '', '', '');
    @endphp
    @if($chat->sender_id != Auth::user()->id)
    <li class="you">
        <div class="entete">
            {{-- <span class="status green"></span> --}}
            {{-- <h2>{{ $data->username }}</h2> --}}
            @if(!empty($data->profile_image))
            <img src="{{ asset('assets/app_images') }}/{{$data->profile_image}}" alt="" style="width: 40px; border-radius: 50%;">
            @else
            <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="" style="width: 40px; border-radius: 50%;">
            @endif
        </div>
        <div class="triangle"></div>
        <div class="message">{{ $chat->message }}</div>
        <br><h2>{{ $chat->created_at }}</h2>
    </li>
    @else
    <li class="me">
        <div class="entete">
            @if(!empty($data->profile_image))
            <img src="{{ asset('assets/app_images') }}/{{$data->profile_image}}" alt="" style="width: 40px; border-radius: 50%;">
            @else
            <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="" style="width: 40px; border-radius: 50%;">
            @endif
            {{-- <h2>{{ $data->username }}</h2> --}}
            {{-- <span class="status blue"></span> --}}
        </div>
        <div class="triangle"></div>
        <div class="message">{{ $chat->message }}</div>
        <br><h2>{{ $chat->created_at }}</h2>
    </li>
    @endif
    @endforeach
</ul>

