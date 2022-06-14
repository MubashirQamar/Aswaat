@extends('layouts.app')

@section('content')
    <section>

        <div class="container-fluid profil">
            <div class="profile-cart ">
                <h2>My Account</h2>
                <a href="{{ url('/cart') }}">Cart @if (session('cart'))
                        ({{ count(session('cart')) }} items)
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
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">Profile</button>
                    <button class="nav-link" id="v-pills-favourites-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-favourites" type="button" role="tab" aria-controls="v-pills-favourites"
                        aria-selected="false">My Favourites</button>
                    <button class="nav-link" id="v-pills-downloads-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-downloads" type="button" role="tab" aria-controls="v-pills-downloads"
                        aria-selected="false">My Downloads</button>
                    {{-- <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                        aria-selected="false">Payments</button> --}}
                    <button class="nav-link" onclick="$('#logoutform').submit()" id="v-pills-signout-tab"
                        data-bs-toggle="pill" data-bs-target="#v-pills-signout" type="button" role="tab"
                        aria-controls="v-pills-settings" aria-selected="false">Sign Out</button>

                    <form id="logoutform" action="{{ route('logout') }}" method="post">
                        @csrf

                    </form>
                </div>
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <p>Hello, {{ Auth::user()->name }}</p>

                        <h5 class="gold">
                            @if (Auth::user()->subscription_id != -1)
                                {{ $subscriber ? $subscriber->package->name : ' ' }}
                            @else
                                Regular
                            @endif Package
                        </h5>
                        <p>CREDIT BALANCE: @if (Auth::user()->subscription_id != -1)
                                {{ $subscriber ? $credit : '0' }}
                            @else
                                0
                            @endif downloads</p>
                        @if (Auth::user()->subscription_id != -1)
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
                    <div class="tab-pane fade" id="v-pills-favourites" role="tabpanel"
                        aria-labelledby="v-pills-favourites-tab">
                        <div class="col-lg-12 " style="width:100%">
                            <div class="music-player ">
                                <div class="music-list " id="playlist">
                                    <script>
                                        var fav = 0;
                                    </script>
                                    @foreach ($favourites as $favourite)
                                        <div class="music-items favourite">
                                            <div class="items-left">
                                                <div style="display: none;">
                                                    @if (Auth::user())
                                                        <a id="fav_url{{ $loop->iteration }}"
                                                            href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"></a>
                                                    @else`
                                                        <a id="fav_url{{ $loop->iteration }}"
                                                            href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"></a>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="fav_item{{ $loop->iteration }}" value="0">
                                                @if (isset($favourite->songs->image))
                                                    <img src="{{ asset('assets/images/songs/' . $favourite->songs->image) }}"
                                                        alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @else
                                                    <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @endif

                                                {{-- <button class="btn btn-default" > --}}
                                                <i class="fa-solid fa-play" id="fav-icon-play{{ $loop->iteration }}"
                                                    onclick="favmusic('{{ $loop->iteration }}')"></i>

                                                {{-- </button> --}}


                                                <span class="artist-name">
                                                    <p id="fav_name{{ $loop->iteration }}">
                                                        {{ $favourite->songs->name }}
                                                    </p>
                                                    <p id="fav_artist_name{{ $loop->iteration }}">
                                                        @foreach ($favourite->songs->artist_name as $art)
                                                            {{ $art->name . ',' }}
                                                        @endforeach
                                                    </p>
                                                </span>
                                                <p class="category" id="fav_category{{ $loop->iteration }}">
                                                    @foreach ($favourite->songs->genre as $gen)
                                                        {{ $gen->name . ',' }}
                                                    @endforeach
                                                </p>
                                                <p class="time"><span
                                                        id="fav_currenttime{{ $loop->iteration }}"></span> / <span
                                                        id="fav_duration{{ $loop->iteration }}"></span></p>



                                                <div class="demo" id="fav_demo{{ $loop->iteration }}"
                                                    style="width: 150px;">

                                                    <div id="fav{{ $loop->iteration }}" class="waveform"></div>
                                                </div>
                                                <span class="music-price">
                                                    $ . {{ $favourite->songs->price }}
                                                </span>
                                            </div>
                                            <div class="items-right">
                                                <span class="music-action" id="fav_action{{ $loop->iteration }}">
                                                    @if (Auth::user())
                                                        @if (Auth::user()->subscription_id == -1)
                                                            {{-- <form action="{{ route('add.to.cart', $favourite->songs->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}
                                                            <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"
                                                                data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"><i
                                                                    class="fa-solid fa-download download"></i></button>
                                                            {{-- <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-star add-favourite"></i></button> --}}
                                                            <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-share share"></i></button>
                                                        @else
                                                            <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"
                                                                data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"><i
                                                                    class="fa-solid fa-download download"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-star add-favourite"></i></button>
                                                            <button data-id="{{ $favourite->songs->id }}"><i
                                                                    class="fa-solid fa-share share"></i></button>
                                                        @endif
                                                    @else
                                                        <button onclick="location.href='{{ route('login') }}'"><i
                                                                class="fa-solid fa-cart-shopping"></i></button>
                                                        <button data-id="{{ $favourite->songs->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}"><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        {{-- <button onclick="location.href='{{ route('login') }}'"><i
                                                                class="fa-solid fa-star"></i></button> --}}

                                                        <button
                                                            data-href="{{ asset('assets/images/songs/' . $favourite->songs->demo_audio) }}">
                                                            <i class="fa-solid fa-share share"></i></button>
                                                    @endif



                                                </span>

                                                <script>
                                                    fav++;
                                                    this["fav" + fav] =
                                                        WaveSurfer.create({
                                                            container: "#fav{{ $loop->iteration }}",
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





                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- favourite ends tab --}}

                    {{-- downloads start tab --}}
                    <div class="tab-pane fade" id="v-pills-downloads" role="tabpanel"
                        aria-labelledby="v-pills-downloads-tab">
                        <input type="hidden" id="current_music_id" value="">
                        <div class="col-lg-12 " style="width:100%">
                            <div class="music-player">
                                <div class="music-list" id="playlist">
                                    <script>
                                        var mux = 0;
                                    </script>
                                    @foreach ($downloads as $download)
                                        <div class="music-items downloads">
                                            <div class="items-left">
                                                <div style="display: none;">
                                                    @if (Auth::user())
                                                        <a id="music_url{{ $loop->iteration }}"
                                                            href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"></a>
                                                    @else`
                                                        <a id="music_url{{ $loop->iteration }}"
                                                            href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"></a>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="music_item{{ $loop->iteration }}" value="0">
                                                @if (isset($download->songs->image))
                                                    <img src="{{ asset('assets/images/songs/' . $download->songs->image) }}"
                                                        alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @else
                                                    <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                        max-width="50px;" style="height:50px;width:50px;">
                                                @endif

                                                {{-- <button class="btn btn-default" > --}}
                                                <i class="fa-solid fa-play" id="icon-play{{ $loop->iteration }}"
                                                    onclick="pausemusic('{{ $loop->iteration }}')"></i>

                                                {{-- </button> --}}


                                                <span class="artist-name">
                                                    <p id="music_name{{ $loop->iteration }}">
                                                        {{ $download->songs->name }}
                                                    </p>
                                                    <p id="artist_name{{ $loop->iteration }}">
                                                        @foreach ($download->songs->artist_name as $art)
                                                            {{ $art->name . ',' }}
                                                        @endforeach
                                                    </p>
                                                </span>
                                                <p class="category" id="category{{ $loop->iteration }}">
                                                    @foreach ($download->songs->genre as $gen)
                                                        {{ $gen->name . ',' }}
                                                    @endforeach
                                                </p>
                                                <p class="time"><span
                                                        id="currenttime{{ $loop->iteration }}"></span> / <span
                                                        id="duration{{ $loop->iteration }}"></span></p>



                                                <div class="demo" id="demo{{ $loop->iteration }}"
                                                    style="width: 150px;">

                                                    <div id="music{{ $loop->iteration }}" class="waveform"></div>
                                                </div>
                                                <span class="music-price">
                                                    $ . {{ $download->songs->price }}
                                                </span>
                                            </div>
                                            <div class="items-right">
                                                <span class="music-action" id="music_action{{ $loop->iteration }}">

                                                    @if (Auth::user()->subscription_id == -1)
                                                        {{-- <form action="{{ route('add.to.cart', $download->songs->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}

                                                        <button data-id="{{ $download->songs->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"><i
                                                                class="fa-solid fa-download home-download download"></i></button>

                                                        <button data-id="{{ $download->songs->id }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $download->songs->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $download->songs->demo_audio) }}"><i
                                                                class="fa-solid fa-download download"></i></button>

                                                        <button data-id="{{ $download->songs->id }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @endif




                                                </span>
                                            </div>
                                                <script>
                                                    mux++;
                                                    this["music" + mux] =
                                                        WaveSurfer.create({
                                                            container: "#music{{ $loop->iteration }}",
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
            @if (session('download'))
                <a id="downloadLink" href="{{ asset(session('download')) }}" download></a>
            @endif
        </div>
    </section>
@endsection
@push('include-js')
    @if (session('download'))
        <script>
            window.onload = function() {
                document.getElementById('downloadLink').click();


            }
        </script>
    @endif
    <script>
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
        }, 3000);

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
            })
        }

        function favtimerfuc(id) {
            this["fav" + id].on("audioprocess", () => {
                const time = this["fav" + id].getCurrentTime();
                // currenttime.innerHTML = formatTimecode(time)
                favupdatetime(time);



                // console.log('dsfaf',time)
            })
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
