@extends('layouts.app')

@section('content')
    <section>

        <div class="container-fluid profil">
            <div class="profile-cart ">
                <h2>حسابي</h2>
                <a href="{{ url('/cart') }}">سلةالمشتريات @if (session('cart'))
                            <?php

                                $cart = session('cart');
                                $cart1=0;
                                        foreach ($cart as  $id => $detail) {
                                                $cart1+=count($cart[$id]);
                                        }
                                ?>
                        ({{ $cart1 }} items)
                    @else
                        (0 items)
                        @endif <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success'); ?>
            @endif

            @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error'); ?>
            @endif
            <div class="d-flex align-items-start profile-nav">
                <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link @if($tab =='profile') active @endif" id="v-pills-home-tab" href="{{ url('home') }}?tab=profile">الملف الشخصي                    </a>
                    <a class="nav-link @if($tab =='favourites') active @endif" id="v-pills-favourites-tab" href="{{ url('home') }}?tab=favourites">مفضلتي</a>
                    <a class="nav-link @if($tab =='downloads') active @endif" id="v-pills-downloads-tab"  href="{{ url('home') }}?tab=downloads">تنزيلاتي</a>
                    {{-- <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                        aria-selected="false">Payments</button> --}}
                    <button class="nav-link" onclick="$('#logoutform').submit()" id="v-pills-signout-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-signout" type="button" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">تسجيل خروج</button>

                    <form id="logoutform" action="{{ route('logout') }}" method="post">
                        @csrf

                    </form>
                </div>
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade @if($tab =='profile') show active @endif" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <p>مرحبا, {{ Auth::user()->name }}</p>

                        <h5 class="gold">
                            @if (Auth::user()->subscription_id != 1)
                                {{ $subscriber ? $subscriber->package->name : ' ' }}
                            @else
                            عادي
                            @endif حزمة
                        </h5>
                        <p>تنزيل الاعتمادات : @if (Auth::user()->subscription_id != 1)
                                {{ $subscriber ? $credit : '0' }}
                            @else
                                0
                            @endif التحميلات</p>
                        @if (Auth::user()->subscription_id != 1)
                            <span class="grey-text">expires on
                                {{ $subscriber ? date('d/m/Y', strtotime($subscriber->end_date)) : ' ' }}</span>
                        @endif
                        @php
                            $today = date('Y-m-d');
                            $today_time = strtotime($today);
                            $expire_time = $subscriber ? strtotime($subscriber->end_date) : strtotime($today);
                            if ($expire_time < $today_time) {
                                echo "<p>Your Package has expire kindly <a href='" . url('packages') . "'>renew</a> </p>";
                            }
                        @endphp
                        <ul class="edit-profile">
                            <form id="profile_form" action="{{ route('update-profile') }}" method="POST">
                                @csrf
                                <li>
                                    <span class="grey-text">Username: </span>
                                    <span class="txt-white"><input type="text" class="" id="name"
                                            readonly name="name" onchange="saveuser()" value="{{ Auth::user()->name }}"> </span>
                                    <a class="profile-update" href="#">[Edit]</a>
                                </li>
                                <li>
                                    <span class="grey-text">Email: </span>
                                    <span class="txt-white"><input type="text" onchange="saveuser()" id="email" readonly name="email"
                                            value="{{ Auth::user()->email }}"></span>
                                    <a class="profile-update" href="#">[Edit]</a>
                                </li>
                                <li>
                                    <span class="grey-text">Password: </span>
                                    <span class="txt-white"><input type="text" onchange="saveuser()" id="password" readonly name="password"
                                            value="*****" required></span>
                                    <a class="profile-update" href="#">[Edit]</a>
                                </li>
                            </form>
                        </ul>
                    </div>


                    {{-- favourite start tab --}}
                    <input type="hidden" id="fav_current_music_id" value="">
                    <div class="tab-pane fade @if($tab =='favourites') show active @endif " id="v-pills-favourites" role="tabpanel"
                        aria-labelledby="v-pills-favourites-tab">
                        <div class="col-lg-12 " style="width:100%">
                            <div class="loader" id="loader">
                                <div class="lds-facebook"><div></div><div></div><div></div></div>
                                <h3>Loading ...</h3>
                            </div>
                            <div class="music-player " id="favourite_playlist" style="visibility: hidden;">
                                <div class="music-list " id="playlist">
                                    <script>
                                        var fav = 0;
                                    </script>
                                    @php
                                        $favo=0;
                                    @endphp
                                    {{--  favourite Songs Start --}}
                                    @foreach ($favourites as $favourite)
                                        @php
                                        $favo++;
                                        @endphp
                                        <div class="music-items favourite">
                                            <div class="items-left">
                                                <div style="display: none;">
                                                    @if (Auth::user())
                                                        <a id="fav_url{{ $favo }}"
                                                            href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"></a>
                                                    @else`
                                                        <a id="fav_url{{ $favo }}"
                                                            href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"></a>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="fav_item{{ $favo }}" value="0">
                                                @if (isset($favourite->songs->image))
                                                    <img src="{{ asset('assets/images/songs/' . $favourite->songs->image) }}"
                                                        alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @else
                                                    <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @endif

                                                {{-- <button class="btn btn-default" > --}}
                                                <i class="fa-solid fa-play" id="fav-icon-play{{ $favo }}"
                                                    onclick="favmusic('{{ $favo }}')"></i>

                                                {{-- </button> --}}


                                                <span class="artist-name">
                                                    <p id="fav_name{{ $favo }}">
                                                        {{ $favourite->songs->name }}
                                                    </p>
                                                    <p id="fav_artist_name{{ $favo }}">
                                                        @foreach ($favourite->songs->artist_name as $art)
                                                            {{ $art->name  }}
                                                        @endforeach
                                                    </p>
                                                </span>
                                                <p class="category" id="fav_category{{ $favo }}">
                                                    @foreach ($favourite->songs->genre as $gen)
                                                        {{ $gen->name  }}
                                                    @endforeach
                                                </p>
                                                <p class="time"><span
                                                        id="fav_currenttime{{ $favo }}"></span> / <span
                                                        id="fav_duration{{ $favo }}"></span></p>



                                                <div class="demo" id="fav_demo{{ $favo }}"
                                                    style="width: 150px;">

                                                    <div id="fav{{ $favo }}" class="waveform"></div>
                                                </div>
                                                <span class="music-price">
                                                    $ {{ $favourite->songs->price }}
                                                </span>
                                            </div>
                                            <div class="items-right">
                                                <span class="music-action" id="fav_action{{ $favo }}">

                                                        @if (Auth::user()->subscription_id == 1)

                                                            <button data-id="{{ $favourite->songs->id }}"  data-duration="fav_duration{{ $favo }}" data-type="0"><i
                                                                    class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"
                                                                data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}" data-name="{{$favourite->songs->demo_audio}}"><i
                                                                    class="fa-solid fa-download download"></i></button>

                                                            <button data-id="{{ $favourite->songs->id }}" data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"><i
                                                                    class="fa-solid fa-share share"></i></button>
                                                        @else
                                                            <button data-id="{{ $favourite->songs->id }}"  data-duration="fav_duration{{ $favo }}" data-type="0"><i
                                                                    class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"
                                                                data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}" data-name="{{$favourite->songs->demo_audio}}"><i
                                                                    class="fa-solid fa-download download"></i></button>

                                                            <button data-id="{{ $favourite->songs->id }}" data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"><i
                                                                    class="fa-solid fa-share share"></i></button>
                                                        @endif




                                                </span>

                                                <script>
                                                    fav++;
                                                    this["fav" + fav] =
                                                        WaveSurfer.create({
                                                            container: "#fav{{ $favo }}",
                                                            loopSelection: true,
                                                            waveColor: "gray",
                                                            progressColor: "white",
                                                            height: 48,
                                                            maxCanvasWidth: 150,
                                                            responsive:true,


                                                        });

                                                    this["fav" + fav].load("{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}");

                                                    var dur = this["fav" + fav].getCurrentTime();

                                                    //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                                                </script>
                                            </div>
                                        </div>
                                    @endforeach
                                         {{--  favourite Songs Ends --}}
                                           {{--  favourite Album Start --}}
                                    @foreach ($favourites_album as $favourite)
                                        @php
                                        $favo++;
                                        @endphp
                                    <div class="music-items favourite">
                                        <div class="items-left">
                                            <div style="display: none;">
                                                @if (Auth::user())
                                                    <a id="fav_url{{ $favo }}"
                                                        href="{{ asset('assets/images/album/' . $favourite->album->demo_audio) }}"></a>
                                                @else`
                                                    <a id="fav_url{{ $favo }}"
                                                        href="{{ asset('assets/images/album/' . $favourite->album->demo_audio) }}"></a>
                                                @endif
                                            </div>
                                            <input type="hidden" id="fav_item{{ $favo }}" value="0">
                                            @if (isset($favourite->album->image))
                                                <img src="{{ asset('assets/images/album/' . $favourite->album->image) }}"
                                                    alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                    max-width="50px;" style="height:50px;width:50px;">
                                            @else
                                                <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                    max-width="50px;" style="height:50px;width:50px;">
                                            @endif

                                            {{-- <button class="btn btn-default" > --}}
                                            <i class="fa-solid fa-play" id="fav-icon-play{{ $favo }}"
                                                onclick="favmusic('{{ $favo }}')"></i>

                                            {{-- </button> --}}


                                            <span class="artist-name">
                                                <p id="fav_name{{ $favo }}">
                                                    {{ $favourite->album->name }}
                                                </p>
                                                <p id="fav_artist_name{{ $favo }}">
                                                    @foreach ($favourite->album->artist_name as $art)
                                                        {{ $art->name  }}
                                                    @endforeach
                                                </p>
                                            </span>
                                            <p class="category" id="fav_category{{ $favo }}">
                                                @foreach ($favourite->album->subcat as $gen)
                                                    {{ $gen->name }}
                                                @endforeach
                                            </p>
                                            <p class="time"><span
                                                    id="fav_currenttime{{ $favo }}"></span> / <span
                                                    id="fav_duration{{ $favo }}"></span></p>



                                            <div class="demo" id="fav_demo{{ $favo }}"
                                                style="width: 150px;">

                                                <div id="fav{{ $favo }}" class="waveform"></div>
                                            </div>
                                            <span class="music-price">
                                                $ {{ $favourite->album->price }}
                                            </span>
                                        </div>
                                        <div class="items-right">
                                            <span class="music-action" id="fav_action{{ $favo }}">

                                                    @if (Auth::user()->subscription_id == 1)

                                                        <button data-id="{{ $favourite->album->id }}"  data-duration="fav_duration{{ $favo }}" data-type="1"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $favourite->album->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $favourite->album->demo) }}" data-name="{{$favourite->album->demo}}"><i
                                                                class="fa-solid fa-download download"></i></button>

                                                        <button data-id="{{ $favourite->album->id }}" data-href="{{ asset('assets/images/album/' . $favourite->album->demo) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $favourite->album->id }}"  data-duration="fav_duration{{ $favo }}" data-type="1"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $favourite->album->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $favourite->album->demo) }}" data-name="{{$favourite->album->demo}}"><i
                                                                class="fa-solid fa-download download"></i></button>

                                                        <button data-id="{{ $favourite->album->id }}" data-href="{{ asset('assets/images/album/' . $favourite->album->demo) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @endif




                                            </span>

                                            <script>
                                                fav++;
                                                this["fav" + fav] =
                                                    WaveSurfer.create({
                                                        container: "#fav{{ $favo }}",
                                                        loopSelection: true,
                                                        waveColor: "gray",
                                                        progressColor: "white",
                                                        height: 48,
                                                        maxCanvasWidth: 150,
                                                        responsive:true,


                                                    });

                                                this["fav" + fav].load("{{ asset('assets/images/album/' . $favourite->album->demo) }}");

                                                var dur = this["fav" + fav].getCurrentTime();

                                                //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                                            </script>
                                        </div>
                                    </div>
                                @endforeach
                                     {{--  favourite Album Ends --}}



                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- favourite ends tab --}}

                    {{-- downloads start tab --}}
                    <div class="tab-pane fade @if($tab =='downloads') show active @endif" id="v-pills-downloads" role="tabpanel"
                        aria-labelledby="v-pills-downloads-tab">
                        <input type="hidden" id="current_music_id" value="">
                        <div class="col-lg-12 " style="width:100%">
                            <div class="loader" id="loader">
                                <div class="lds-facebook"><div></div><div></div><div></div></div>
                                <h3>Loading ...</h3>
                            </div>
                            <div class="music-player" id="downloads_playlist" style="visibility: hidden">
                                <div class="music-list" id="playlist">
                                    <script>
                                        var mux = 0;
                                    </script>
                                     @php
                                     $down=0;
                                     @endphp
                                    {{--  downloads songs start--}}
                                    @foreach ($downloads as $download)
                                        @php
                                        $down++;
                                        @endphp
                                        <div class="music-items downloads">
                                            <div class="items-left">
                                                <div style="display: none;">
                                                    @if (Auth::user())
                                                        <a id="music_url{{ $down}}"
                                                            href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}" download="{{$download->songs->demo_audio}}"></a>
                                                    @else`
                                                        <a id="music_url{{ $down}}"
                                                            href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}" download="{{$download->songs->demo_audio}}"></a>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="music_item{{ $down}}" value="0">
                                                @if (isset($download->songs->image))
                                                    <img src="{{ asset('assets/images/songs/' . $download->songs->image) }}"
                                                        alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @else
                                                    <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @endif

                                                {{-- <button class="btn btn-default" > --}}
                                                <i class="fa-solid fa-play" id="icon-play{{ $down}}"
                                                    onclick="pausemusic('{{ $down}}')"></i>

                                                {{-- </button> --}}


                                                <span class="artist-name">
                                                    <p id="music_name{{ $down}}">
                                                        {{ $download->songs->name }}
                                                    </p>
                                                    <p id="artist_name{{ $down}}">
                                                        @foreach ($download->songs->artist_name as $art)
                                                            {{ $art->name  }}
                                                        @endforeach
                                                    </p>
                                                </span>
                                                <p class="category" id="category{{ $down}}">
                                                    @foreach ($download->songs->genre as $gen)
                                                        {{ $gen->name  }}
                                                    @endforeach
                                                </p>
                                                <p class="time"><span
                                                        id="currenttime{{ $down}}"></span> / <span
                                                        id="duration{{ $down}}"></span></p>



                                                <div class="demo" id="demo{{ $down}}"
                                                    style="width: 150px;">

                                                    <div id="music{{ $down}}" class="waveform"></div>
                                                </div>
                                                <span class="music-price">
                                                    $ {{ $download->songs->price }}
                                                </span>
                                            </div>
                                            <div class="items-right">
                                                <span class="music-action" id="music_action{{ $down}}">

                                                    @if (Auth::user()->subscription_id == 1)
                                                        {{-- <form action="{{ route('add.to.cart', $download->songs->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}

                                                        <button data-id="{{ $download->songs->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}" data-name="{{$download->songs->demo_audio}}"><i
                                                                class="fa-solid fa-download home-download download" ></i></button>

                                                        <button data-id="{{ $download->songs->id }}" data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $download->songs->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}" data-name="{{$download->songs->demo_audio}}"><i
                                                                class="fa-solid fa-download download"></i></button>

                                                        <button data-id="{{ $download->songs->id }}"  data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @endif




                                                </span>
                                            </div>
                                                <script>
                                                    mux++;
                                                    this["music" + mux] =
                                                        WaveSurfer.create({
                                                            container: "#music{{ $down}}",
                                                            loopSelection: true,
                                                            waveColor: "gray",
                                                            progressColor: "white",
                                                            height: 48,
                                                            maxCanvasWidth: 150,
                                                            responsive:true,


                                                        });

                                                    this["music" + mux].load("{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}");
                                                </script>

                                        </div>
                                    @endforeach
                                    {{--  downloads songs ends--}}
                                    {{--  downloads album start--}}
                                    @foreach ($downloads_album as $download)
                                        @php
                                        $down++;
                                        @endphp
                                        <div class="music-items downloads">
                                            <div class="items-left">
                                                <div style="display: none;">
                                                    @if (Auth::user())
                                                        <a id="music_url{{ $down}}"
                                                            href="{{ asset('assets/images/album/' . $download->album->demo) }}"></a>
                                                    @else`
                                                        <a id="music_url{{ $down}}"
                                                            href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"></a>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="music_item{{ $down}}" value="0">
                                                @if (isset($download->album->image))
                                                    <img src="{{ asset('assets/images/album/' . $download->album->image) }}"
                                                        alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @else
                                                    <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @endif

                                                {{-- <button class="btn btn-default" > --}}
                                                <i class="fa-solid fa-play" id="icon-play{{ $down}}"
                                                    onclick="pausemusic('{{ $down}}')"></i>

                                                {{-- </button> --}}


                                                <span class="artist-name">
                                                    <p id="music_name{{ $down}}">
                                                        {{ $download->album->name }}
                                                    </p>
                                                    <p id="artist_name{{ $down}}">
                                                        @foreach ($download->album->artist_name as $art)
                                                            {{ $art->name  }}
                                                        @endforeach
                                                    </p>
                                                </span>
                                                <p class="category" id="category{{ $down}}">
                                                    @foreach ($download->album->subcat as $gen)
                                                        {{ $gen->name  }}
                                                    @endforeach
                                                </p>
                                                <p class="time"><span
                                                        id="currenttime{{ $down}}"></span> / <span
                                                        id="duration{{ $down}}"></span></p>



                                                <div class="demo" id="demo{{ $down}}"
                                                    style="width: 150px;">

                                                    <div id="music{{ $down}}" class="waveform"></div>
                                                </div>
                                                <span class="music-price">
                                                    $ {{ $download->album->price }}
                                                </span>
                                            </div>
                                            <div class="items-right">
                                                <span class="music-action" id="music_action{{ $down}}">

                                                    @if (Auth::user()->subscription_id == 1)
                                                        {{-- <form action="{{ route('add.to.cart', $download->songs->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}

                                                        <button data-id="{{ $download->album->id }}"
                                                            data-href="{{ url('/secure/file/album/' . $download->album->audio) }}" data-name={{$download->album->audio}}><i
                                                                class="fa-solid fa-download home-download download"></i></button>

                                                        <button data-id="{{ $download->album->id }}" data-href="{{ asset('assets/images/album/' . $download->album->demo) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $download->album->id }}"
                                                            data-href="{{ url('/secure/file/album/' . $download->album->audio) }}" data-name={{$download->album->audio}}><i
                                                                class="fa-solid fa-download download"></i></button>

                                                        <button data-id="{{ $download->album->id }}" data-href="{{ asset('assets/images/album/' . $download->album->demo) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @endif




                                                </span>
                                            </div>
                                                <script>
                                                    mux++;
                                                    this["music" + mux] =
                                                        WaveSurfer.create({
                                                            container: "#music{{ $down}}",
                                                            loopSelection: true,
                                                            waveColor: "gray",
                                                            progressColor: "white",
                                                            height: 48,
                                                            maxCanvasWidth: 150,
                                                            responsive:true,


                                                        });

                                                    this["music" + mux].load("{{ asset('assets/images/album/' . $download->album->demo) }}");
                                                </script>

                                        </div>
                                    @endforeach
                                    {{--  downloads album ends--}}




                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- downloads ends tab --}}
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
                </div>
            </div>
        </div>

        </div>
        <div style="display: none">
            @if (session('downloads_file'))

                    @foreach (session('downloads_file') as $id => $detail)
                    {{-- @dd($detail); --}}
                    <a id="downloadLink"  class="downloadLink" href="{{ $detail }}" download>{{ $detail }}</a>
                    @endforeach

            @endif
        </div>
        <div class="modal fade custom-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> أﺿﯾف إﻟﻰ ﺔ ﻋرﺑ ق اﻟﺗﺳو </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>   ﺗﻣت إﺿﺎﻓﺔ ت اﻟﺻو ﻰ إﻟ ﺔ ﻋرﺑ ق اﻟﺗﺳو  </p>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('/cart') }}"><button type="button" class="btn btn-secondary">  اذھب اﻟﻰ ﺔ ﻋرﺑ ق اﻟﺗﺳو </button></a>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> اﺳﺗﻣﻊ اﻟﻰ د اﻟﻣزﯾ                    </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('include-js')

    @if (session('downloads_file'))
        <script>
            // window.onload = function() {
                $(document).ready(function(){
                    var els = document.getElementsByClassName("downloadLink");
                        for(var i = 0; i < els.length; i++)
                        {
                            els[i].click();

                        }

                // $('.downloadLink')[0];
                });
        </script>
    @endif
    <script>
          $(".loader").fadeOut(5000);
        $(document).ready(function() {
            $("input").keyup(
                function(e) {
                    var currentInput = $(this).val();
                    console.log(currentInput);
                    if (e.keyCode === 13) {
                        $('#profile_form').submit();
                    }
                }
            );



        })
        function saveuser(){
        // var currentInput = a.val();
                        $('#profile_form').submit();

                }
        $('.profile-update').click(function(e) {
            console.log();
            $('.edit-profile input').attr('readonly', true);
            $('.edit-profile input').removeClass('border-b');
            $('.edit-profile input#password').val('*****');
            $(this).parent().find('input').addClass('border-b')
            $(this).parent().find('input').attr('readonly', false)
            var id = $(this).parent().find('input').attr('id');

            if (id == 'password') {
                $('#' + id).val('');
            }

        });

        function updatetime(time) {
            var current_music = $('#current_music_id').val();
            $('#currenttime' + current_music).text(formatTimecode(time));
        }
        function favupdatetime(time) {
            var current_music = $('#fav_current_music_id').val();
            $('#fav_currenttime' + current_music).text(formatTimecode(time));
        }
        setTimeout(() => {
            displayTime();
            $('#favourite_playlist').css('visibility','visible');
            $('#downloads_playlist').css('visibility','visible');
        }, 5000);

        function displayTime() {
            for (let index = 1; index <= mux; index++) {
                // console.log(formatTimecode(this["music" + index].getDuration()));

                $('#duration' + index).text(formatTimecode(this["music" + index].getDuration()));
                $('#currenttime' + index).text(formatTimecode(this["music" + index].getCurrentTime()));
            }
            for (let index = 1; index <= fav; index++) {
                // console.log(formatTimecode(this["music" + index].getDuration()));

                $('#fav_duration' + index).text(formatTimecode(this["fav" + index].getDuration()));
                $('#fav_currenttime' + index).text(formatTimecode(this["fav" + index].getCurrentTime()));
            }
        }

        function timerfuc(id) {
            this["music" + id].on("audioprocess", () => {
                const time = this["music" + id].getCurrentTime();
                // currenttime.innerHTML = formatTimecode(time)
                updatetime(time);



                // console.log('dsfaf',time)
            });
             this["music" + id].on('finish', function() {
                // setCurrentSong((currentTrack + 1) % links.length);
                $('#icon-play' + id).removeClass('fa-pause');
                $('#icon-play' + id).addClass('fa-play');
            });
        }

        function favtimerfuc(id) {
            this["fav" + id].on("audioprocess", () => {
                const time = this["fav" + id].getCurrentTime();
                // currenttime.innerHTML = formatTimecode(time)
                favupdatetime(time);



                // console.log('dsfaf',time)
            });
             this["music" + id].on('finish', function() {
                // setCurrentSong((currentTrack + 1) % links.length);
                $('#fav-icon-play' + id).removeClass('fa-pause');
                $('#fav-icon-play' + id).addClass('fa-play');
            });
        }

        function pausemusic(sad) {
            var set = $('#music_item' + sad).val();
            var div = $('#music_item' + sad).parents().find('.music-items').html();
            var musicname = $('#music_name' + sad).text();
            var artistname = $('#artist_name' + sad).text();
            var categoryname = $('#category' + sad).text();
            var currenttime = $('#currenttime' + sad).text();
            var duration = $('#duration' + sad).text();
            var music_url = $('#music_url' + sad).attr('href');
            var music_action = $('#music_action' + sad).html();
            // console.log(music_action);


            $('#duration' + sad).text();
            $('#current_music_id').val(sad);
            for (i = 1; i <= mux; i++) {
                this["music" + i].pause();
                $('#icon-play' + i).removeClass('fa-pause');
                $('#icon-play' + i).addClass('fa-play');
                // $('#demo' + i).css('visibility', 'visible');
                $('#music_item' + i).val(0);

            }
            if (set == 1) {
                this["music" + sad].pause();
                // $('#waveform2').play();
                // wavesurfer.pause();


            } else {
                $('#music_action').empty();
                $('#music_action').append(music_action);
                // $('#demo' + sad).css('visibility', 'hidden');
                // this["music" + sad].load(music_url);
                this["music" + sad].play();
                // this["music" + sad].setMute(true);
                $('#icon-play' + sad).removeClass('fa-play');
                $('#icon-play' + sad).addClass('fa-pause');
                $('#music_name').text(musicname);
                $('#artist_name').text(artistname);
                $('#category').text(categoryname);
                $('#curt_time').text(currenttime);
                $('#time_dur1').text(duration);
                $('#music_item' + sad).val(1);
                // playlist();
                timerfuc(sad);
                // $('#waveform2').play();
                // wavesurfer.load(links[currentTrack].href);
            }
            // playlist(sad);
        }

        function favmusic(sad) {
            var set = $('#fav_item' + sad).val();
            var div = $('#fav_item' + sad).parents().find('.music-items').html();
            var musicname = $('#fav_name' + sad).text();
            var artistname = $('#fav_artist_name' + sad).text();
            var categoryname = $('#fav_category' + sad).text();
            var currenttime = $('#fav_currenttime' + sad).text();
            var duration = $('#fav_duration' + sad).text();
            var music_url = $('#fav_url' + sad).attr('href');
            var music_action = $('#fav_action' + sad).html();
            // console.log(music_action);


            $('#fav_duration' + sad).text();
            $('#fav_current_music_id').val(sad);
            for (i = 1; i <= fav; i++) {
                this["fav" + i].pause();
                $('#fav-icon-play' + i).removeClass('fa-pause');
                $('#fav-icon-play' + i).addClass('fa-play');
                // $('#demo' + i).css('visibility', 'visible');
                $('#fav_item' + i).val(0);

            }
            if (set == 1) {
                this["fav" + sad].pause();
                // $('#waveform2').play();
                // wavesurfer.pause();


            } else {
                $('#fav_action').empty();
                $('#fav_action').append(music_action);
                // $('#demo' + sad).css('visibility', 'hidden');
                // this["music" + sad].load(music_url);
                this["fav" + sad].play();
                // this["music" + sad].setMute(true);
                $('#fav-icon-play' + sad).removeClass('fa-play');
                $('#fav-icon-play' + sad).addClass('fa-pause');
                $('#fav_name').text(musicname);
                // $('#fav_artist_name').text(artistname);
                // $('#fav_category').text(categoryname);
                // $('#fav_curt_time').text(currenttime);
                // $('#fav_time_dur1').text(duration);
                $('#fav_item' + sad).val(1);
                // playlist();
                favtimerfuc(sad);
                // $('#waveform2').play();
                // wavesurfer.load(links[currentTrack].href);
            }
            // playlist(sad);
        }
    </script>
@endpush
