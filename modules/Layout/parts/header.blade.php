<!-- Preloader -->
@php
    $site_favicon = setting_item('site_favicon');
@endphp
@if(setting_item('enable_preloader'))
    <div class="preloader bc-preload">
        <span class="text">{{ __("LOADING") }}</span>
        @if($site_favicon)
            <img class="icon" src="{{ get_file_url($site_favicon, 'full') }}" alt="{{ setting_item("site_title") }}" />
        @endif
    </div>
@endif

@php
    $header_class = $header_style = $row->header_style ?? 'normal';
    $logo_id = setting_item("logo_id");
    if($header_style == 'header-style-two'){
        $logo_id = setting_item('logo_white_id');
    }
    if(empty($is_home) && $header_style == 'normal' && empty($disable_header_shadow)){
        $header_class .= ' header-shaddow';
    }
@endphp
@if($header_style == 'normal')
    <!-- Header Span -->
    <span class="header-span"></span>
@endif
<!-- Main Header-->
<header class="main-header {{ $header_class }}">
    <div class="top-menu d-flex">

    </div>
    <!-- Main box -->
    <div class="main-box">
        <!--Nav Outer -->
        <div class="nav-outer">
            <div class="logo-box">
                <div class="logo">
                    <a href="{{ home_url() }}">
                        @if($logo_id)
                            @php $logo = get_file_url($logo_id,'full') @endphp
                            <img src="{{ $logo }}" alt="{{setting_item("site_title")}}">
                        @else
                            <img src="{{ asset('/images/logo.svg') }}" alt="logo">
                        @endif
                    </a>
                </div>
            </div>

            <nav class="nav main-menu">
                <?php generate_menu('primary') ?>
            </nav>
            <!-- Main Menu End-->
        </div>

        <div class="outer-box">
            <ul class="multi-lang">
                @include('Language::frontend.switcher-dropdown')
            </ul>
            <a href="{{route('user.wishList.index')}}" class="menu-btn mr-3 ml-2">
                @if(auth()->check())
                    <span class="count wishlist_count text-center">{{(int) auth()->user()->wishlist_count}}</span>
                @endif
                <span class="icon la la-bookmark-o"></span>
            </a>
            @if(!(isset($exception) && $exception->getStatusCode() == 404))
                <!-- Login/Register -->
                <div class="btn-box">
                    @if(!Auth::id())
                        <a href="{{url('login')}}" class="theme-btn btn-style-three login">{{ __("Login") }}</a>
                        <a href="{{url('register')}}" class="theme-btn btn-style-three login">{{ __("Register") }}</a>
                    @else
                        <div class="login-item dropmenu-right dropdown show">
                            <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if($avatar_url = Auth::user()->getAvatarUrl())
                                    <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                                @else
                                    <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                                @endif
                                <span class="full-name">{{__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])}}</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">
                                <li class="menu-hr"><a href="{{route('user.dashboard')}}">{{__("Dashboard")}}</a></li>
                                @if(Modules\Gig\Models\Gig::isEnable())
                                <li >
                                    @has_permission('gig_manage')
                                        <a href="{{route('seller.dashboard')}}">{{__("Seller Dashboard")}}</a>
                                        <a href="{{route('seller.all.gigs')}}">{{__("Gigs")}}</a>
                                        <a href="{{route('seller.orders')}}">{{__("Gig Orders")}}</a>
                                    @else
                                        <a href="{{route('buyer.orders')}}">{{__("Gig Orders")}}</a>
                                    @end_has_permission
                                </li>
                                @endif
                                @if(is_employer())
                                    <li class="menu-hr"><a href="{{ route('user.profile.index') }}">{{__("My profile")}}</a></li>
                                    <li class="menu-hr"><a href="{{ route('user.company.profile') }}">{{__("Company profile")}}</a></li>

                                    <li class="menu-hr"><a href="{{route('user.manage.jobs')}}">{{__("Manage Jobs")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.applicants')}}">{{__("All Applicants")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.wishList.index')}}"> {{__("Shortlisted")}}</a></li>
                                @endif

                                @if(is_candidate() && !is_admin())
                                    @if(\Modules\Gig\Models\Gig::isEnable() && \Modules\Payout\Models\VendorPayout::isEnable())
                                        <li class="menu-hr"><a href="{{route('payout.candidate.index')}}">{{__("Payouts")}}</a></li>
                                    @endif
                                    <li class="menu-hr"><a href="{{ route('user.profile.index') }}">{{__("My profile")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.applied_jobs')}}">{{__("Applied Jobs")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.wishList.index')}}"> {{__("Shortlisted")}}</a></li>
                                    <li class="menu-hr"><a href="{{route('user.following.employers')}}">{{__("Following Employers")}}</a></li>
                                @endif
                                <li class="menu-hr"><a href="{{route('user.my-contact')}}">{{__("My Contact")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.change_password')}}">{{__("Change password")}}</a></li>
                                @if(is_admin())
                                    <li class="menu-hr"><a href="{{url('/admin')}}">{{__("Admin Dashboard")}}</a></li>
                                @endif
                                <li class="menu-hr">
                                    <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    @endif
                    @if(is_employer())
                        <div class="d-flex align-items-center">
                            <a href="{{ route('user.create.job') }}" class="theme-btn @if($header_style == 'header-style-two') btn-style-five @else btn-style-one @endif @if(!auth()->check()) bc-call-modal login @endif">{{ __("Job Post") }}</a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo">
            <a href="{{ url(app_get_locale(false,'/')) }}">
                @if($logo_id = setting_item("logo_id"))
                    @php $logo = get_file_url($logo_id,'full') @endphp
                    <img src="{{ $logo }}" alt="{{setting_item("site_title")}}">
                @else
                    <img src="{{ asset('/images/logo.svg') }}" alt="logo">
                @endif
            </a>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Login/Register -->
                <div class="login-box d-flex">
                    {{-- @if(!Auth::id())
                        <a href="#" class="bc-call-modal login"><span class="icon-user"></span></a>
                    @else --}}
                    @if(!Auth::id())
                        <a href="{{url('login')}}" class="theme-btn btn-style-three login px-sm-3 px-2 py-1 mr-1">Login</a>
                        <a href="{{url('register')}}" class="theme-btn btn-style-three login px-sm-3 px-2 py-1">{{ __("Register") }}</a>
                    @else
                        <a href="#" class="is_login dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($avatar_url = Auth::user()->getAvatarUrl())
                                <img class="avatar" src="{{$avatar_url}}" alt="{{ Auth::user()->getDisplayName()}}">
                            @else
                                <span class="avatar-text">{{ucfirst( Auth::user()->getDisplayName()[0])}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu text-left" aria-labelledby="dropdownMenuUser">

                            <li class="menu-hr"><a href="{{route('user.dashboard')}}">{{__("Dashboard")}}</a></li>
                            @if(Modules\Gig\Models\Gig::isEnable())
                                <li >
                                    @has_permission('gig_manage')
                                    <a href="{{route('seller.dashboard')}}">{{__("Seller Dashboard")}}</a>
                                    <a href="{{route('seller.all.gigs')}}">{{__("Gigs")}}</a>
                                    <a href="{{route('seller.orders')}}">{{__("Gig Orders")}}</a>
                                    @else
                                        <a href="{{route('buyer.orders')}}">{{__("Gig Orders")}}</a>
                                        @end_has_permission
                                </li>
                            @endif
                            @if(is_employer())
                                <li class="menu-hr"><a href="{{ route('user.profile.index') }}">{{__("My profile")}}</a></li>
                                <li class="menu-hr"><a href="{{ route('user.company.profile') }}">{{__("Company profile")}}</a></li>

                                <li class="menu-hr"><a href="{{route('user.manage.jobs')}}">{{__("Manage Jobs")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.applicants')}}">{{__("All Applicants")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.wishList.index')}}"> {{__("Shortlisted")}}</a></li>
                            @endif

                            @if(is_candidate() && !is_admin())
                                @if(\Modules\Gig\Models\Gig::isEnable() && \Modules\Payout\Models\VendorPayout::isEnable())
                                    <li class="menu-hr"><a href="{{route('payout.candidate.index')}}">{{__("Payouts")}}</a></li>
                                @endif
                                <li class="menu-hr"><a href="{{ route('user.profile.index') }}">{{__("My profile")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.applied_jobs')}}">{{__("Applied Jobs")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.wishList.index')}}"> {{__("Shortlisted")}}</a></li>
                                <li class="menu-hr"><a href="{{route('user.following.employers')}}">{{__("Following Employers")}}</a></li>
                            @endif
                            <li class="menu-hr"><a href="{{route('user.my-contact')}}">{{__("My Contact")}}</a></li>
                            <li class="menu-hr"><a href="{{route('user.change_password')}}">{{__("Change password")}}</a></li>
                            @if(is_admin())
                                <li class="menu-hr"><a href="{{url('/admin')}}">{{__("Admin Dashboard")}}</a></li>
                            @endif
                            <li class="menu-hr">
                                <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                            </li>
                        </ul>
                    @endif
                </div>

                <a href="#nav-mobile" class="mobile-nav-toggler"><span class="flaticon-menu-1"></span></a>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>
</header>
<!--End Main Header -->

