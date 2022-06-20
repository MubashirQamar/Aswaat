@extends('layouts.app')
@section('content')
<main>

    <section class="home-section clearfix" id="home">


        <!--begin container -->

        <div class="container h-100-per">



            <!--begin row -->

            <div class="row align-items-center h-100-per">



                <!--begin col-md-6-->





                <!--begin newsletter_form_box -->



                <div class="col-xlg-4 col-lg-4 col-md-12 col-sm-12 col-xsm-12">

                    <!--begin newsletter-form -->
                    <div class="heading text-center">
                        <h2>
                            Original Creators need
                        </h2>

                        <h1>ORIGINAL</h1>
                        <h1 class="heading-space">SOUND</h1>
                    </div>
                    <div class="banner-btn text-center ">
                        <a href="{{ route('register') }}" class="custom-btn secondary-btn">Start Now</a>
                        <a href="{{ url('/packages') }}" class="custom-btn secondary-btn"> Pricing </a>

                    </div>

                    <div class="heading banner-lower-heading text-center">
                        <h6>1,000+ ORIGINAL</h6>
                        <h6>SOUND TRACKS & SOUND EFFECTS</h6>
                    </div>

                </div>

                <div class="banner-logo">
                    <img src="{{asset('frontend/images/logo.png')}}" class="logo" />

                </div>
                <!--end newsletter-form -->


                <!--end newsletter_form_box -->





                <!--end col-md-6-->



                <!--begin col-md-5-->



                <!--end col-md-5-->




            </div>




            <!--end row -->



        </div>

        <!--end container -->



    </section>

    <section class="platform-icons">

        <div class="container">

            <div class="text-center">

                <h2 class="title">SAY GOODBYE TO COPYRIGHT STRIKES!</h2>
                <h4 class="subtitle">GET COMMERCIAL LICENSE FOR USING AUDIO FILES IN YOUR VIDEOS</h4>

            </div>

            <ul class="platforms">

                <li><i class="fa-solid fa-check"></i>Youtube</li>
                <li><i class="fa-solid fa-check"></i>Vimeo</li>
                <li><i class="fa-solid fa-check"></i>Facebook</li>
                <li><i class="fa-solid fa-check"></i>Twitter</li>
                <li><i class="fa-solid fa-check"></i>Instagram</li>
                <li><i class="fa-solid fa-check"></i>Snapchat</li>
                <li><i class="fa-solid fa-check"></i>Tiktok</li>
                <li><i class="fa-solid fa-check"></i>Twitch</li>
                <li><i class="fa-solid fa-check"></i>Commercials</li>
                <li><i class="fa-solid fa-check"></i>Cinema & Films</li>
                <li><i class="fa-solid fa-check"></i>Podcasts</li>
                <li><i class="fa-solid fa-check"></i>Websites</li>
                <li><i class="fa-solid fa-check"></i>Applications</li>
                <li><i class="fa-solid fa-check"></i>Games</li>
                <li><i class="fa-solid fa-check"></i>Presentations</li>
                <li><i class="fa-solid fa-check"></i>Client Work</li>
                <li><i class="fa-solid fa-check"></i>Weddings</li>
                <li><i class="fa-solid fa-check"></i>Any Future Platform</li>


            </ul>

            <div class="py-5 text-center">
                <a href="{{ route('register') }}" class="custom-btn primary-btn"> Start Free Now </a>
            </div>

        </div>

    </section>

    <section id="music-section">

        <div class="music-section">

            <div class="sidenav">

                <ul class="music-menu">

                    {{-- <li>
                            <a href="{{ url('/') }}" class="">Music</a>
                    </li>

                    <li>
                        <a href="{{ url('/') }}?type=soundtrack" class="">Soundtrack</a>
                    </li>
                    @foreach ($music_type as $mustype)
                    <li>
                        <a href="{{ url('/') }}?type={{ $mustype->id }}" class="">{{ $mustype->name }}</a>
                    </li>
                    @endforeach --}}
                    @foreach($albums as $album)
                    <li @if($music_type_id==$album->id) class="active" @endif>
                        <a href="{{ url('/') }}?type=0&id={{ $album->id }}" class="">{{ $album->name }}</a>
                    </li>
                    @endforeach




                </ul>


            </div>

            <div class="music-player">

                <div class="music-filter">

                    <form method="GET" id="filter-form" class="filter-form">
                        <select name="sort" class="sort-filter">
                            {{-- <option>Sort by ASWAT list</option> --}}
                            <option @if($sort=='top' ) selected @endif value="top">Top Download</option>
                            <option @if($sort=='newest' ) selected @endif value="newest">Newest </option>

                        </select>

                        <select name="instrument" class="sort-filter">
                            <option @if($instrument==1) selected @endif value="newest" value="1">Vocal & Instrumental </option>
                            <option @if($instrument==2) selected @endif value="2">Vocal Only </option>
                            <option @if($instrument==3) selected @endif value="3">Instruments</option>

                        </select>

                        <select name="bpm" class="sort-filter">
                            <option @if($bpm==0) selected @endif value="0">BPM</option>
                            <option @if($bpm=="slow" && !is_numeric($bpm)) selected @endif value="slow">Slow </option>
                            <option @if($bpm=="medslow" && !is_numeric($bpm)) selected @endif value="medslow">Med-Slow </option>
                            <option @if($bpm=="medium" && !is_numeric($bpm)) selected @endif value="medium">Medium </option>
                            <option @if($bpm=="medfast" && !is_numeric($bpm)) selected @endif value="medfast">Med-Fast </option>
                            <option @if($bpm=="fast" && !is_numeric($bpm)) selected @endif value="fast">Fast </option>
                        </select>

                        <select name="duration" class="sort-filter">
                            <option>Any Duration</option>
                            <option @if($duration==1) selected @endif value="1">10 - 30 sec </option>
                            <option @if($duration==2) selected @endif value="2">30 - 50 sec </option>
                            <option @if($duration==3) selected @endif value="3">50+ sec </option>
                        </select>
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="music_type_id" value="{{ $music_type_id }}">
                    </form>

                </div>


                <input type="hidden" id="current_music_id" value="">
                {{-- Music  start --}}

                @if ($type != 'soundtrack' || $type!=0)
                <div class="music-list" id="playlist">
                    <script>
                        var mux = 0;
                    </script>
                    @foreach ($music as $mus)
                    <div class="music-items">
                        <div class="items-left">
                            <div style="display: none;">
                                @if (Auth::user())
                                <a id="music_url{{ $loop->iteration }}" href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"></a>
                                @else`
                                <a id="music_url{{ $loop->iteration }}" href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"></a>
                                @endif
                            </div>
                            <input type="hidden" id="music_item{{ $loop->iteration }}" value="0">
                            @if (isset($mus->image))
                            <img src="{{ asset('assets/images/songs/' . $mus->image) }}" alt="Upload Icon" data-holder-rendered="true" max-height="10px;" max-width="50px;" style="height:50px;width:50px;">
                            @else
                            <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;" max-width="50px;" style="height:50px;width:50px;">
                            @endif

                            {{-- <button class="btn btn-default" > --}}
                            <i class="fa-solid fa-play" id="icon-play{{ $loop->iteration }}" onclick="pausemusic('{{ $loop->iteration }}')"></i>

                            {{-- </button> --}}


                            <span class="artist-name">
                                <p id="music_name{{ $loop->iteration }}">{{ $mus->name }}</p>
                                <p id="artist_name{{ $loop->iteration }}">
                                    @foreach ($mus->artist_name as $art)
                                    {{ $art->name  }}
                                    @endforeach
                                </p>
                            </span>
                            <p class="category" id="category{{ $loop->iteration }}">
                                @foreach ($mus->genre as $gen)
                                {{ $gen->name  }}
                                @endforeach
                            </p>
                            <p class="time"><span id="currenttime{{ $loop->iteration }}"></span> /
                                <span id="duration{{ $loop->iteration }}"></span>
                            </p>



                            <div class="demo" id="demo{{ $loop->iteration }}" style="width: 150px;">

                                <div id="music{{ $loop->iteration }}" class="waveform"></div>
                            </div>
                            <span class="music-price">
                                $ {{ $mus->price }}
                            </span>
                        </div>
                        <div class="items-right">
                            <span class="music-action" id="music_action{{ $loop->iteration }}">
                                @if (Auth::user())
                                @if (Auth::user()->subscription_id == -1)
                                {{-- <form action="{{ route('add.to.cart', $mus->id) }}">
                                @csrf
                                <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                </form> --}}
                                <button data-id="{{ $mus->id }}"><i class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i class="fa-solid fa-download download"></i></button>
                                <button data-id="{{ $mus->id }}" data-type="0"><i class="fa-solid fa-star @if (in_array($mus->id , $favourite)) yellow @endif add-favourite"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                    <i class="fa-solid fa-share share"></i></button>
                                @else
                                <button data-id="{{ $mus->id }}"><i class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i class="fa-solid fa-download download"></i></button>
                                <button data-id="{{ $mus->id }}" data-type="0"><i class="fa-solid fa-star @if(in_array($mus->id , $favourite)) yellow @endif  add-favourite"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                    <i class="fa-solid fa-share share"></i></button>
                                @endif
                                @else
                                <button onclick="location.href='{{ route('login') }}'"><i class="fa-solid fa-cart-shopping"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i class="fa-solid fa-download download"></i></button>
                                <button onclick="location.href='{{ route('login') }}'"><i class="fa-solid fa-star"></i></button>

                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                    <i class="fa-solid fa-share share"></i></button>
                                @endif



                            </span>

                            <script>
                                mux++;
                                             this["music" + mux] =
                                                    WaveSurfer.create({
                                                        container: "#music"+mux,
                                                        loopSelection: true,
                                                        waveColor: "gray",
                                                        progressColor: "white",
                                                        height: 48,
                                                        maxCanvasWidth: 150,
                                                        width: 150,
                                                        responsive: true,
                                
                                
                                                    });
                                
                                                this["music" + mux].load("{{ asset('assets/images/songs/' . $mus->demo_audio) }}");

                                //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                            </script>

                        </div>
                    </div>
                    @endforeach





                </div>
                {{-- Music End --}}


                {{-- sound track Start --}}
                @else
                <div class="music-list" id="playlist">
                    <script>
                        var mux = 0;
                    </script>
                    @foreach ($music as $mus)
                    <div class="music-items">
                        <div class="items-left">
                            <div style="display: none;">
                                @if (Auth::user())
                                <a id="music_url{{ $loop->iteration }}" href="{{ asset('assets/images/album/' . $mus->demo) }}"></a>
                                @else`
                                <a id="music_url{{ $loop->iteration }}" href="{{ asset('assets/images/album/' . $mus->demo) }}"></a>
                                @endif
                            </div>
                            <input type="hidden" id="music_item{{ $loop->iteration }}" value="0">
                            @if (isset($mus->image))
                            <img src="{{ asset('assets/images/album/' . $mus->image) }}" alt="Upload Icon" data-holder-rendered="true" max-height="10px;" max-width="50px;" style="height:50px;width:50px;">
                            @else
                            <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;" max-width="50px;" style="height:50px;width:50px;">
                            @endif

                            {{-- <button class="btn btn-default" > --}}
                            <i class="fa-solid fa-play" id="icon-play{{ $loop->iteration }}" onclick="pausemusic('{{ $loop->iteration }}')"></i>

                            {{-- </button> --}}


                            <span class="artist-name">
                                <p id="music_name{{ $loop->iteration }}">{{ $mus->name }}</p>
                                <p id="artist_name{{ $loop->iteration }}">

                                    {{ $mus->artist_name }}

                                </p>
                            </span>
                            <p class="category" id="category{{ $loop->iteration }}">

                                {{ $mus->cat_name }}

                            </p>
                            <p class="time"><span id="currenttime{{ $loop->iteration }}"></span> /
                                <span id="duration{{ $loop->iteration }}"></span>
                            </p>



                            <div class="demo" id="demo{{ $loop->iteration }}">

                                <div id="music{{ $loop->iteration }}" class="waveform"></div>
                            </div>
                            <span class="music-price">
                                $ {{ $mus->price }}
                            </span>
                        </div>
                        <div class="items-right">
                            <span class="music-action" id="music_action{{ $loop->iteration }}">
                                @if (Auth::user())
                                @if (Auth::user()->subscription_id == -1)
                                {{-- <form action="{{ route('add.to.cart', $mus->id) }}">
                                @csrf
                                <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                </form> --}}
                                <button data-id="{{ $mus->id }}"><i class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i class="fa-solid fa-download download"></i></button>
                                <button data-id="{{ $mus->id }}" data-type="1"><i class="fa-solid fa-star add-favourite"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i class="fa-solid fa-share share"></i></button>
                                @else
                                <button data-id="{{ $mus->id }}"><i class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i class="fa-solid fa-download download"></i></button>
                                <button data-id="{{ $mus->id }}" data-type="1"><i class="fa-solid fa-star add-favourite"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i class="fa-solid fa-share share"></i></button>
                                @endif
                                @else
                                <button onclick="location.href='{{ route('login') }}'"><i class="fa-solid fa-cart-shopping"></i></button>
                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i class="fa-solid fa-download download"></i></button>
                                <button onclick="location.href='{{ route('login') }}'"><i class="fa-solid fa-star"></i></button>

                                <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"> <i class="fa-solid fa-share share"></i></button>
                                @endif
                                <script>
                                    mux++;
                                                this["music" + mux] =
                                                    WaveSurfer.create({
                                                        container: "#music"+mux,
                                                        loopSelection: true,
                                                        waveColor: "gray",
                                                        progressColor: "white",
                                                        height: 48,
                                                        maxCanvasWidth: 150,
                                                        width: 150,
                                                        responsive: true,
                                
                                
                                                    });
                                
                                                this["music" + mux].load("{{ asset('assets/images/album/' . $mus->demo) }}");
    
                                    //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                                </script>


                            </span>

                        </div>
                    </div>
                    @endforeach





                </div>
                {{-- sound track Ends --}}
                @endif


            </div>

        </div>

        <div class="playin-music" style="display: none">

            <div class="music-items current">

                <img src="{{ asset('frontend/images/song.jpg') }}">
                <i class="fa-solid fa-play " id="bottom-play" onclick="wavesurfer.playPause();bottomplaypause();"></i>
                <i class="fa-solid fa-pause" style="display: none;" id="bottom-pause" onclick="wavesurfer.playPause();bottomplaypause();"></i>

                <span>
                    <p id="music_name">Song Title</p>
                    <p id="artist_name">Artist Name</p>
                </span>
                <p class="category" id="category">Category</p>
                <p class="time"><span id="curt_time">00:00</span>/ <span id="time_dur1">00:00</span></p>



                <div class="demo">
                    <div id="waveform2"></div>
                </div>


                <span class="music-action" id="music_action">

                    <button><i class="fa-solid fa-download"></i></button>
                    <button><i class="fa-solid fa-star"></i></button>
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-share"></i></button>

                </span>


            </div>

        </div>

    </section>

    <!-- Modal -->
    <div class="modal fade custom-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Added to cart!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Song Name has been added to cart.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/cart') }}"><button type="button" class="btn btn-secondary">Go To
                            Cart</button></a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Listen To More</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @if (session('success'))
            <button id="successbtn" style="display: none" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
            <script>
                setTimeout(() => {
                    $('#successbtn').click();
                }, 1000);
                //   alert('asd');
            </script>
        @endif --}}


</main>
@endsection
@push('include-js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.4/wavesurfer.min.js"></script> --}}

<script>
    // function fetchsongs(){
    //         for (let index = 1; index <= mux; index++) {
    //             var song = $('#music_url'+index).attr('href');
    //         this["music" + index] =
    //                 WaveSurfer.create({
    //                     container: "#music"+index,
    //                     loopSelection: true,
    //                     waveColor: "gray",
    //                     progressColor: "white",
    //                     height: 48,
    //                     maxCanvasWidth: 150,
    //                     width: 150,
    //                     responsive: true,


    //                 });

    //             this["music" + index].load(song);

    //         }
    //     }
    //     fetchsongs();
    var wavesurfer, current_music_id,totalmux=mux;
    // Init on DOM ready
    function updatetime(time) {
        var current_music = $('#current_music_id').val();
        $('#currenttime' + current_music).text(formatTimecode(time));
    }
    document.addEventListener('DOMContentLoaded', function() {
        wavesurfer = WaveSurfer.create({
            container: "#waveform2",
            waveColor: "black",
            progressColor: "white",
            height: 48,
            fillParent: false,
            // Define a minimum amount of pixels that should be used
            // to draw a single second of the sound. This defines a
            // specific width to the
            minPxPerSec: 5
        });
        current_music_id = $('#current_music_id').val();

        wavesurfer.on('play', function() {
            document.querySelector('#bottom-play').style.display = 'none';
            document.querySelector('#bottom-pause').style.display = '';
            // pausemusic(current_music_id);
            $('#icon-play' + current_music_id).removeClass('fa-play');
            $('#icon-play' + current_music_id).addClass('fa-pause');
            // console.log('play');
        });
        wavesurfer.on("audioprocess", () => {
            const time = wavesurfer.getCurrentTime();
            // currentTime.innerHTML = formatTimecode(time)
            updatetime(wavesurfer.getCurrentTime());
            $('#curt_time').text(formatTimecode(time));

            // console.log('dsfaf',time)
        })
        wavesurfer.on('pause', function() {
            document.querySelector('#bottom-play').style.display = '';
            document.querySelector('#bottom-pause').style.display = 'none';
            pausemusic(current_music_id);
            $('#icon-play' + current_music_id).removeClass('fa-pause');
            $('#icon-play' + current_music_id).addClass('fa-play');
            // console.log('pause');
        });
    });
    setTimeout(() => {
        displayTime();
    }, 15000);

    function displayTime() {
        for (let index = 1; index <= mux; index++) {
            // console.log(formatTimecode(this["music" + index].getDuration()));

            $('#duration' + index).text(formatTimecode(this["music" + index].getDuration()));
            $('#currenttime' + index).text(formatTimecode(this["music" + index].getCurrentTime()));
        }
    }

    function timerfuc(id) {
        this["music" + id].on("audioprocess", () => {
            const time = this["music" + id].getCurrentTime();
            // currenttime.innerHTML = formatTimecode(time)
            updatetime(time);



            // console.log('dsfaf',time)
        })
        this["music" + id].on('finish', function() {
            // setCurrentSong((currentTrack + 1) % links.length);
            $('#icon-play' + id).removeClass('fa-pause');
            $('#icon-play' + id).addClass('fa-play');
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
        for (i = 1; i <= totalmux; i++) {
            console.log(i);
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

    function bottomplaypause() {

        var current_music = $('#current_music_id').val();
        var set = $('#music_item' + current_music).val();
        var music_url = $('#music_url' + current_music).attr('href');
        if (set == 1) {
            // $('#demo'+sad).css('visibility','hidden');
            // this["music" + current_music].load(music_url);
            this["music" + current_music].pause();
            $('#demo' + current_music).css('visibility', 'visible');
            $('#icon-play' + current_music).removeClass('fa-pause');
            $('#icon-play' + current_music).addClass('fa-play');
            // $('#waveform2').play();

            wavesurfer.pause();
            $('#music_item' + current_music).val(0);

        } else {
            $('#demo' + current_music).css('visibility', 'hidden');

            this["music" + current_music].play();
            this["music" + current_music].setMute(true);
            $('#icon-play' + current_music).removeClass('fa-play');
            $('#icon-play' + current_music).addClass('fa-pause');

            $('#music_item' + current_music).val(1);

        }

    }


    // Bind controls
    function playlist() {


        // document.addEventListener('DOMContentLoaded', function() {
        let links = document.querySelectorAll('#playlist  a');

        let currentTrack = 0;

        let setCurrentSong = function(index) {
            links[currentTrack].classList.remove('active');
            currentTrack = index;
            links[currentTrack].classList.add('active');
            wavesurfer.load(links[currentTrack].href);
        };

        // Load the track on click
        Array.prototype.forEach.call(links, function(link, index) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                setCurrentSong(index);
            });
        });

        // let playPause = document.querySelector('#playPause');
        // playPause.addEventListener('click', function() {
        //     wavesurfer.playPause();
        // });

        // Toggle play/pause text


        // The playlist links


        // Load a track by index and highlight the corresponding link


        // Play on audio load
        wavesurfer.on('ready', function() {
            wavesurfer.play();
        });

        // wavesurfer.on('error', function(e) {
        //     console.warn(e);
        // });

        // Go to the next track on finish
        wavesurfer.on('finish', function() {
            // setCurrentSong((currentTrack + 1) % links.length);
        });

        // Load the first track
        setCurrentSong(currentTrack);
        // });
    }
</script>
@if($scroll == 1 )
<script>
    $(document).ready(function() {

        $('html, body').animate({
            scrollTop: $("#music-section").offset().top
        }, 'smooth');
        // var elmntToView = document.getElementById("music-section");
        //     elmntToView.scrollIntoView({behavior: "smooth"});
    })
</script>
@endif
@endpush
