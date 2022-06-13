@extends('layouts.app')

@section('content')
    <section>
        <div class="main-section album">



            <div class=" album-container">

                <div class="row">



                    @if($count == 0)
                    <h4 class="text-album"><b>Unable to find search result for "{{ $_GET['searchmusic'] }}"</b></h4>
                    @else
                    <h4 class="text-album"><b>Showing Result For "{{ $_GET['searchmusic'] }}"</b></h4>
                    <div class="col-lg-12 ">
                        <div class="music-player">

                            <div class="music-filter">

                                <form method="GET" id="filter-form" class="filter-form">
                                    <select name="sort" class="sort-filter">
                                        {{-- <option>Sort by ASWAT list</option> --}}
                                        <option @if ($sort == 'top') selected @endif value="top">Top Download
                                        </option>
                                        <option @if ($sort == 'newest') selected @endif value="newest">Newest
                                        </option>

                                    </select>

                                    <select name="instrument" class="sort-filter">
                                        <option @if ($instrument == 1) selected @endif value="newest" value="1">
                                            Vocal & Instrumental </option>
                                        <option @if ($instrument == 2) selected @endif value="2">Vocal Only
                                        </option>
                                        <option @if ($instrument == 3) selected @endif value="3">Instruments
                                        </option>

                                    </select>

                                    <select name="bpm" class="sort-filter">
                                        <option>BPM</option>
                                        <option @if ($bpm == 'slow') selected @endif value="slow">Slow
                                        </option>
                                        <option @if ($bpm == 'medslow') selected @endif value="medslow">Med-Slow
                                        </option>
                                        <option @if ($bpm == 'medium') selected @endif value="medium">Medium
                                        </option>
                                        <option @if ($bpm == 'medfast') selected @endif value="medfast">Med-Fast
                                        </option>
                                        <option @if ($bpm == 'fast') selected @endif value="fast">Fast
                                        </option>
                                    </select>

                                    <select name="duration" class="sort-filter">
                                        <option>Any Duration</option>
                                        <option @if ($duration == 1) selected @endif value="1">10 - 30 sec
                                        </option>
                                        <option @if ($duration == 2) selected @endif value="2">30 - 50 sec
                                        </option>
                                        <option @if ($duration == 3) selected @endif value="3">50+ sec
                                        </option>
                                    </select>
                                    <input type="hidden" value="{{ $search }}" name="searchmusic">
                                </form>

                            </div>
                            <input type="hidden" id="current_album_id" value="">
                            <div class="music-list" id="playlist">
                                {{-- albums Start --}}
                                <script>
                                    var alb = 0;
                                </script>
                                @foreach ($albums as $alb)
                                    <div class="music-items">
                                        <div class="items-left">
                                            <div style="display: none;">
                                                @if (Auth::user())
                                                    <a id="album_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/album/' . $alb->demo) }}"></a>
                                                @else`
                                                    <a id="album_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/album/' . $alb->demo) }}"></a>
                                                @endif
                                            </div>
                                            <input type="hidden" id="album_item{{ $loop->iteration }}" value="0">
                                            @if (isset($alb->image))
                                                <img src="{{ asset('assets/images/album/' . $alb->image) }}"
                                                    alt="Upload Icon" data-holder-rendered="true" max-height="10px;"
                                                    max-width="50px;" style="height:50px;width:50px;">
                                            @else
                                                <img src="{{ asset('assets/images/upload.png') }}" max-height="10px;"
                                                    max-width="50px;" style="height:50px;width:50px;">
                                            @endif

                                            {{-- <button class="btn btn-default" > --}}
                                            <i class="fa-solid fa-play" id="icon-play{{ $loop->iteration }}"
                                                onclick="pausealbum('{{ $loop->iteration }}')"></i>

                                            {{-- </button> --}}


                                            <span class="artist-name">
                                                <p id="album_name{{ $loop->iteration }}">{{ $alb->name }}</p>
                                                <p id="artist_name{{ $loop->iteration }}">

                                                    {{ $alb->artist_name }}

                                                </p>
                                            </span>
                                            <p class="category" id="category{{ $loop->iteration }}">

                                                {{ $alb->cat_name }}

                                            </p>
                                            <p class="time"><span
                                                    id="alb_currenttime{{ $loop->iteration }}"></span> /
                                                <span id="alb_duration{{ $loop->iteration }}"></span>
                                            </p>



                                            <div class="demo" id="demo{{ $loop->iteration }}"
                                                style="width: 150px;">

                                                <div id="album{{ $loop->iteration }}" class="waveform"></div>
                                            </div>
                                            <span class="music-price">
                                                SR . {{ $alb->price }}
                                            </span>
                                        </div>
                                        <div class="items-right">


                                            <span class="music-action" id="album_action{{ $loop->iteration }}">
                                                @if (Auth::user())
                                                    @if (Auth::user()->subscription_id == -1)
                                                        {{-- <form action="{{ route('add.to.cart', $alb->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $alb->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $alb->demo) }}"><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-star add-favourite"></i></button>
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $alb->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $alb->demo) }}"><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-star add-favourite"></i></button>
                                                        <button data-id="{{ $alb->id }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @endif
                                                @else
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-cart-shopping"></i></button>
                                                    <button data-id="{{ $alb->id }}"
                                                        data-href="{{ asset('assets/images/album/' . $alb->demo) }}"><i
                                                            class="fa-solid fa-download download"></i></button>
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-star"></i></button>

                                                    <button data-href="{{ asset('assets/images/album/' . $alb->demo) }}">
                                                        <i class="fa-solid fa-share share"></i></button>
                                                @endif



                                            </span>
                                        </div>
                                        @if (Auth::user())
                                            <script>
                                                alb++;
                                                this["album" + alb] =
                                                    WaveSurfer.create({
                                                        container: "#album{{ $loop->iteration }}",
                                                        loopSelection: true,
                                                        waveColor: "gray",
                                                        progressColor: "white",
                                                        height: 48,
                                                        maxCanvasWidth: 150,
                                                        responsive: true,

                                                    });

                                                this["album" + alb].load("{{ asset('assets/images/album/' . $alb->demo) }}");

                                                var dur = this["album" + alb].getCurrentTime();

                                                //  $('#time'+alb).text(parseFloat(this["album"+alb].getDuration(),2));
                                            </script>
                                        @else
                                            <script>
                                                alb++;
                                                this["album" + alb] =
                                                    WaveSurfer.create({
                                                        container: "#album{{ $loop->iteration }}",
                                                        loopSelection: true,
                                                        waveColor: "gray",
                                                        progressColor: "white",
                                                        height: 48,
                                                        maxCanvasWidth: 150,
                                                        responsive: true,


                                                    });

                                                this["album" + alb].load("{{ asset('assets/images/album/' . $alb->demo) }}");
                                            </script>
                                        @endif
                                    </div>
                                @endforeach
                                {{-- albums Ends --}}

                                {{-- Music Start --}}
                                <script>
                                    var mux = 0;
                                </script>
                                @foreach ($music as $mus)
                                    <div class="music-items">
                                        <div class="items-left">
                                            <div style="display: none;">
                                                @if (Auth::user())
                                                    <a id="music_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"></a>
                                                @else`
                                                    <a id="music_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"></a>
                                                @endif
                                            </div>
                                            <input type="hidden" id="music_item{{ $loop->iteration }}" value="0">
                                            @if (isset($mus->image))
                                                <img src="{{ asset('assets/images/songs/' . $mus->image) }}"
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
                                                <p id="music_name{{ $loop->iteration }}">{{ $mus->name }}</p>
                                                <p id="artist_name{{ $loop->iteration }}">
                                                    @foreach ($mus->artist_name as $art)
                                                        {{ $art->name . ',' }}
                                                    @endforeach
                                                </p>
                                            </span>
                                            <p class="category" id="category{{ $loop->iteration }}">
                                                @foreach ($mus->genre as $gen)
                                                    {{ $gen->name . ',' }}
                                                @endforeach
                                            </p>
                                            <p class="time"><span
                                                    id="currenttime{{ $loop->iteration }}"></span> /
                                                <span id="duration{{ $loop->iteration }}"></span>
                                            </p>



                                            <div class="demo" id="demo{{ $loop->iteration }}"
                                                style="width: 150px;">

                                                <div id="music{{ $loop->iteration }}" class="waveform"></div>
                                            </div>
                                            <span class="music-price">
                                                SR . {{ $mus->price }}
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
                                                        <button data-id="{{ $mus->id }}"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-type="0"><i
                                                                class="fa-solid fa-star @if (in_array($mus->id, $favourite)) yellow @endif add-favourite"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                                            <i class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $mus->id }}"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-type="0"><i
                                                                class="fa-solid fa-star @if (in_array($mus->id, $favourite)) yellow @endif  add-favourite"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                                            <i class="fa-solid fa-share share"></i></button>
                                                    @endif
                                                @else
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-cart-shopping"></i></button>
                                                    <button data-id="{{ $mus->id }}"
                                                        data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}"><i
                                                            class="fa-solid fa-download download"></i></button>
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-star"></i></button>

                                                    <button data-id="{{ $mus->id }}"
                                                        data-href="{{ asset('assets/images/songs/' . $mus->demo_audio) }}">
                                                        <i class="fa-solid fa-share share"></i></button>
                                                @endif



                                            </span>
                                            @if (Auth::user())
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
                                                            width: 150,
                                                            responsive: true,


                                                        });

                                                    this["music" + mux].load("{{ asset('assets/images/songs/' . $mus->demo_audio) }}");

                                                    var dur = this["music" + mux].getCurrentTime();

                                                    //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                                                </script>
                                            @else
                                                <script>
                                                    mux++;
                                                    this["music" + mux] =
                                                        WaveSurfer.create({
                                                            container: "#music{{ $loop->iteration }}",
                                                            loopSelection: true,
                                                            waveColor: "gray",
                                                            progressColor: "white",
                                                            height: 50,
                                                            maxCanvasWidth: 150,
                                                            responsive: true,



                                                        });

                                                    this["music" + mux].load("{{ asset('assets/images/songs/' . $mus->demo_audio) }}");
                                                </script>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                {{-- Music Ends --}}
                            </div>


                        </div>






                    </div>
                    @endif
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade custom-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Added to cart!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
    </section>
@endsection
@push('include-js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.4/wavesurfer.min.js"></script> --}}

    <script>
        var wavesurfer, current_album_id,current_music_id;
        // Init on DOM ready
        function updatetime(time) {
            var current_album = $('#current_album_id').val();
            $('#currenttime' + current_album).text(formatTimecode(time));
        }
        function updatealbtime(time) {
            var current_album = $('#current_album_id').val();
            $('#alb_currenttime' + current_album).text(formatTimecode(time));
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
            current_album_id = $('#current_album_id').val();

            wavesurfer.on('play', function() {
                document.querySelector('#bottom-play').style.display = 'none';
                document.querySelector('#bottom-pause').style.display = '';
                // pausealbum(current_album_id);
                $('#icon-play' + current_album_id).removeClass('fa-play');
                $('#icon-play' + current_album_id).addClass('fa-pause');
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
                // pausealbum(current_album_id);
                $('#icon-play' + current_album_id).removeClass('fa-pause');
                $('#icon-play' + current_album_id).addClass('fa-play');
                // console.log('pause');
            });
        });
        setTimeout(() => {
            displayTime();
        }, 3000);

        function displayTime() {
            for (let index = 1; index <= alb; index++) {
                // console.log(formatTimecode(this["album" + index].getDuration()));

                $('#alb_duration' + index).text(formatTimecode(this["album" + index].getDuration()));
                $('#alb_currenttime' + index).text(formatTimecode(this["album" + index].getCurrentTime()));
            }
            for (let index = 1; index <= mux; index++) {
                // console.log(formatTimecode(this["album" + index].getDuration()));

                $('#duration' + index).text(formatTimecode(this["music" + index].getDuration()));
                $('#currenttime' + index).text(formatTimecode(this["music" + index].getCurrentTime()));
            }
        }

        function timerfuc(id) {
            this["music" + id].on("audioprocess", () => {
                const time = this["music" + id].getCurrentTime();
                // currenttime.innerHTML = formatTimecode(time)
                updatealbtime(time);
                // console.log('dsfaf',time)
            });
            this["album" + id].on("audioprocess", () => {
                const time = this["album" + id].getCurrentTime();
                // currenttime.innerHTML = formatTimecode(time)
                updatealbtime(time);
                // console.log('dsfaf',time)
            });
            this["album" + id].on('finish', function() {
                // setCurrentSong((currentTrack + 1) % links.length);
                $('#icon-play' + id).removeClass('fa-pause');
                $('#icon-play' + id).addClass('fa-play');
            });
            this["music" + id].on('finish', function() {
                // setCurrentSong((currentTrack + 1) % links.length);
                $('#icon-play' + id).removeClass('fa-pause');
                $('#icon-play' + id).addClass('fa-play');
            });
        }

        function pausealbum(sad) {
            var set = $('#album_item' + sad).val();
            var div = $('#album_item' + sad).parents().find('.album-items').html();
            var albumname = $('#album_name' + sad).text();
            var artistname = $('#artist_name' + sad).text();
            var categoryname = $('#category' + sad).text();
            var currenttime = $('#currenttime' + sad).text();
            var duration = $('#duration' + sad).text();
            var album_url = $('#album_url' + sad).attr('href');
            var album_action = $('#album_action' + sad).html();
            // console.log(album_action);


            $('#duration' + sad).text();
            $('#current_album_id').val(sad);
            for (i = 1; i <= alb; i++) {
                this["album" + i].pause();
                $('#icon-play' + i).removeClass('fa-pause');
                $('#icon-play' + i).addClass('fa-play');
                // $('#demo' + i).css('visibility', 'visible');
                $('#album_item' + i).val(0);

            }
            if (set == 1) {
                this["album" + sad].pause();
                // $('#waveform2').play();
                // wavesurfer.pause();


            } else {
                $('#album_action').empty();
                $('#album_action').append(album_action);
                // $('#demo' + sad).css('visibility', 'hidden');
                this["album" + sad].load(album_url);
                this["album" + sad].play();
                // this["album" + sad].setMute(true);
                $('#icon-play' + sad).removeClass('fa-play');
                $('#icon-play' + sad).addClass('fa-pause');
                $('#album_name').text(albumname);
                $('#artist_name').text(artistname);
                $('#category').text(categoryname);
                $('#curt_time').text(currenttime);
                $('#time_dur1').text(duration);
                $('#album_item' + sad).val(1);
                // playlist();
                timerfuc(sad);
                // $('#waveform2').play();
                // wavesurfer.load(links[currentTrack].href);
            }
            // playlist(sad);
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
        function bottomplaypause() {

            var current_album = $('#current_album_id').val();
            var set = $('#album_item' + current_album).val();
            var album_url = $('#album_url' + current_album).attr('href');
            if (set == 1) {
                // $('#demo'+sad).css('visibility','hidden');
                // this["album" + current_album].load(album_url);
                this["album" + current_album].pause();
                $('#demo' + current_album).css('visibility', 'visible');
                $('#icon-play' + current_album).removeClass('fa-pause');
                $('#icon-play' + current_album).addClass('fa-play');
                // $('#waveform2').play();

                wavesurfer.pause();
                $('#album_item' + current_album).val(0);

            } else {
                $('#demo' + current_album).css('visibility', 'hidden');

                this["album" + current_album].play();
                this["album" + current_album].setMute(true);
                $('#icon-play' + current_album).removeClass('fa-play');
                $('#icon-play' + current_album).addClass('fa-pause');

                $('#album_item' + current_album).val(1);

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
@endpush
