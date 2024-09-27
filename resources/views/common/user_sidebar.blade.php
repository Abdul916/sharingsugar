<div class="col-xl-4 col-md-5">
    <div class="left-profile-area">
        <div class="profile-about-box">
            <div class="top-bg"></div>
            <div class="p-inner-content">
                <div class="profile-img">
                    @if(!empty(Auth::user()->profile_image))
                    <img src="{{ asset('assets/app_images') }}/{{Auth::user()->profile_image}}" alt="" style="width: 100px; border-radius: 50%;">
                    @else
                    <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="">
                    @endif
                    <div class="active-online"></div>
                </div>
                <h5 class="name" style="color: #d72993">{{Auth::user()->username}}</h5>
                <span>{{Auth::user()->email}}</span>
                <ul class="p-b-meta-one">
                    <li>
                        <span>{{ number_format(Auth::user()->age, 0)}} Years Old</span>
                    </li>
                    <li>
                        <span> <i class="fas fa-map-marker-alt"></i>{{Auth::user()->city}}, {{Auth::user()->country}}</span>
                    </li>
                </ul>
                {{-- <div class="p-b-meta-two">
                    <div class="left">
                        <div class="icon">
                            <i class="far fa-heart"></i>
                        </div> 257
                    </div>
                    <div class="right">
                        <a href="#" class="custom-button">
                            <i class="fab fa-cloudversify"></i> Get Premium
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <button class="collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <span>My Profile</span>
                    <div class="t-icon">
                        <i class="fas fa-plus"></i>
                        <i class="fas fa-minus"></i>
                    </div>
                </button>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <ul class="links">
                        <li><a class="active" href="{{ url('profile') }}">Profile</a></li>
                        <li><a href="{{ url('change_password') }}">Change Password</a></li>
                        <li><a href="{{ url('my_photos') }}">My Photos</a></li>
                        <li><a href="{{ url('user_membership') }}">Membership</a></li>
                        <li><a href="{{ url('favorites') }}">Favorites</a></li>
                        <li><a href="{{ url('requests') }}">Requests</a></li>
                        <li><a href="{{ url('privacy_settings') }}">Privacy Settings</a></li>
                        <li><a href="{{ url('public_profile') }}/{{Auth::user()->unique_id}}">View Public Profile</a></li>
                        <li><a href="{{ url('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>