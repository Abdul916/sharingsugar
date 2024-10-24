{{-- <div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div> --}}
<div class="overlay"></div>
<a href="javascript:void(0)" class="scrollToTop">
    <i class="fas fa-angle-up"></i>
</a>
<header class="header-section">
    <div class="container">
        <div class="header-wrapper">
            <div class="logo">
                <a href="{{ url('home') }}">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                </a>
            </div>
            <ul class="menu">
                @guest
                @else
                <li><a href="{{ url('chat') }}">Messages</a></li>
                @endguest
                <li><a href="{{ url('faqs') }}">FAQs</a></li>
                <li><a href="{{ url('blog') }}">Blog</a></li>
                <li><a href="{{ url('members') }}">Members</a></li>
                <li><a href="{{ url('membership') }}">Membership</a></li>
                <li><a href="{{ url('contact_us') }}">Contact Us</a></li>
                {{-- <li><a href="{{ url('about_us') }}">About Us</a></li> --}}

                {{-- <li>
                    <div class="serch-icon">
                        <i class="fas fa-search"></i>
                    </div>
                </li> --}}
                {{-- <li>
                    <div class="language-select">
                        <select class="select-bar">
                            <option value="">EN</option>
                            <option value="">IN</option>
                            <option value="">BN</option>
                        </select>
                    </div>
                </li> --}}

                @guest
                @else
                <li class="nav-item">
                    @php
                    $unread_notifications = get_complete_table('notifications', 'notify_user_id', Auth::user()->id, '', '1', '', '');
                    $all_notifications = get_complete_table('notifications', 'notify_user_id', Auth::user()->id, '', '', '', '');
                    @endphp
                    <a href="javascript:void(0)" class="nav-link text-light" id="navbarDropdown" role="button" data-toggle="" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i> <span class="badge notify_badge">({{count($unread_notifications)}})</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="head text-light" id="usernotification">
                            <div class="notification-body">
                                <div class="header-area">
                                    <h4>
                                        Notifications ({{count($unread_notifications)}})
                                    </h4>
                                    <div class="links">
                                        <a href="javascript:void(0)" class="btn_read_delete_notifications" data-action="read_all" data-id="0">Mak all as Read</a>
                                    </div>
                                </div>
                                <div class="notification-list">
                                    @foreach($all_notifications as $notify)
                                    @php
                                    $data = get_single_row('users', 'id', $notify->user_id, '', '', '', '');
                                    @endphp
                                    <div class="single-list @if($notify->status == "1") unread_notify @endif">
                                        <div class="img">
                                            @if(!empty($data->profile_image))
                                            <img src="{{ asset('assets/app_images')}}/{{$data->profile_image}}" alt="">
                                            @else
                                            <img src="{{ asset('assets/images/user-demo.png') }}" alt="">
                                            @endif
                                            {{-- <span class="active"></span> --}}
                                        </div>
                                        <div class="content">
                                            <div class="left">
                                                <a href="javascript:void(0)" class="btn_read_delete_notifications" data-action="read_one" data-id="{{$notify->id}}" data-user-id="{{$data->unique_id}}" data-type="{{$notify->type}}">
                                                    <h5>{{$data->username}} {{$notify->message}}</h5>
                                                    <span>{{$notify->created_at}}</span>
                                                </a>
                                            </div>
                                            <div class="right">
                                                <a href="javascript:void(0)" class="btn_read_delete_notifications" data-action="delete_one" data-id="{{$notify->id}}"><i class="fas fa-trash text-danger"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <a href="javascript:void(0)" class="view-all-link btn_read_delete_notifications" data-action="delete_all" data-id="0">Delete all read notifications</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="separator">
                    <span>|</span>
                </li>
                @endguest

                <li class="user-profile">
                    <a href="javascript:void(0)">
                        @guest
                        <img src="{{ asset('assets/images/user-demo.png') }}" alt="">
                        @else
                        {{Auth::user()->username}}
                        @if(!empty(Auth::user()->profile_image))
                        <img src="{{ asset('assets/app_images') }}/{{Auth::user()->profile_image}}" alt="" style="width: 40px; border-radius: 50%;">
                        @else
                        <img src="{{ asset('assets/images/user-demo.png') }}" alt="">
                        @endif
                        @endguest
                    </a>
                    <ul class="submenu">
                        @guest
                        <li><a href="{{ url('login') }}"><span>Login</span></a></li>
                        <li><a href="{{ url('register') }}"><span>Register</span></a></li>
                        @else
                        <li><a href="{{ url('profile') }}"><span>Profile</span></a></li>
                        <li><a href="{{ url('requests') }}"><span>Requests</span></a></li>
                        <li><a href="{{ url('logout') }}"><span>Logout</span></a></li>
                        @endguest
                    </ul>
                </li>
            </ul>
            <div class="header-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
{{-- <div class="search-overlay">
    <div class="close"><i class="fas fa-times"></i></div>
    <form action="#">
        <input type="text" placeholder="Write what you want..">
    </form>
</div> --}}
