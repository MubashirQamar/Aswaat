<nav class="navbar navbar-expand-lg custom-nav sticky-top">



    <div class="container-fluid">



        <!-- begin logo -->

        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{asset('frontend/images/logo.png')}}" class="logo"/></a>

        <!-- end logo -->





        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>

        </button>



        <div class="collapse navbar-collapse justify-content-between" id="navbarScroll">



            <!-- begin navbar-nav -->

            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll justify-content-center">



                <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }} "><a class="nav-link" href="{{ url('/') }}">الرئيسية</a></li>



                <li class="nav-item {{ (request()->is('sound-tracks')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/sound-tracks') }}">موسيقى تصويرية</a></li>



                <li class="nav-item {{ (request()->is('sound-effects')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/sound-effects') }}">مؤثرات صوتية</a></li>

            </ul>

        </div>


        <div class="end-box">
            <a  href="{{ route('register') }}" class="custom-btn primary-btn"> ابدأ الآن </a>

            <a class="{{ (request()->is('/packages')) ? 'active' : '' }}" href="{{ url('/packages') }}">الأسعار</a>
            @if (Auth::user() && Auth::user()->is_admin == 0)
            <a href="{{ url('/home') }}"><i class="fa-solid fa-user"></i>   حسابي</a>
            @else
            <a href="{{ route('login') }}"><i class="fa-solid fa-user"></i> تسجيل الدخول</a>

                @endif

            <div class="dropdown" style="display: none">
                <img src="{{ asset('frontend/images/usa.png') }}" onclick="customDropdown()" class="dropbtn">
                <div id="myDropdown" class="dropdown-content">
                    {{-- <a href="#"><img src="{{ asset('frontend/images/spain.png') }}">Spanish</a> --}}
                    {{-- <a href="#"><img src="{{ asset('frontend/images/india.png') }}">Hindi</a> --}}
                    <a href="#"><img src="{{ asset('frontend/images/saudia.png') }}">العربية</a>
                    <a href="#"><img src="{{ asset('frontend/images/usa.png') }}">English</a>
                </div>
            </div>

            <a href="javascript:void(0)" onclick="openNav()"><i class="fa-solid fa-magnifying-glass"></i></a>

        </div>
        {{-- search bar starts --}}
        <div id="searchpanel" class="searchnav">

            <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->

            {{-- <ul class="nav nav-pills justify-content-center mb-3 search-tab" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="music-tab" data-bs-toggle="pill" data-bs-target="#music"
                        type="button" role="tab" aria-controls="music" aria-selected="true">Home</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sfx-tab" data-bs-toggle="pill" data-bs-target="#sfx"
                        type="button" role="tab" aria-controls="sfx" aria-selected="false">SFX</button>
                </li>

            </ul> --}}
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="music" role="tabpanel" aria-labelledby="music-tab">

                    <form action="{{ url('search') }}" method="GET" class="search-form">

                        <div class="search-group">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="searchmusic" placeholder="البحث">
                            <button>Clear</button>
                        </div>

                    </form>

                </div>
                <div class="tab-pane fade" id="sfx" role="tabpanel" aria-labelledby="sfx-tab">
                    <form class="search-form">

                        <div class="search-group">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input type="text" name="searchmusic" placeholder="Search SFX">
                            <button>Clear</button>
                        </div>

                    </form>
                </div>
            </div>

            <ul class="menu-list">
                <li>
                    <a href="{{ url('/sound-tracks') }}" class="menu-link">موسيقى تصويرية</a>
                </li>

                <li>

                    <a href="{{ url('/sound-effects') }}" class="menu-link">مؤثرات صوتية</a>

                </li>






            </ul>

            <ul class="menu-list-inner">

                <li><a href="{{ url('/about') }}">من نحن</a></li>
                <li><a href="{{ url('/contact') }}">وسائل التواصل</a></li>



            </ul>

            <div class="side-menu-GDPR">

                <ul>
                    <li><a href="{{ url('/terms') }}">الشروط والأحكام</a></li>
                    <li><a href="{{ url('/privacy') }}">سياسة الخصوصية</a></li>
                </ul>

            </div>

            <ul class="sidebar-social">

                <li><a href="#"><a href="https://www.youtube.com/channel/UCSuD056zHna4Nq9CCPeJSMg" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="https://www.instagram.com/aswwatcom/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                {{-- <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li> --}}
                <li><a href="https://mobile.twitter.com/aswwatcom?s=11&t=iTg8fP612PaOZ6AV2rZ3-g" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>

            </ul>


        </div>
         {{-- search bar ends --}}

    </div>



</nav>
