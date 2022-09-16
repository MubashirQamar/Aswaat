@extends('layouts.app')

@section('content')
    <section>
        <div class="main-section album">



            <div class=" album-container">

                <div class="row">
                    <h2 class="text-album"><span>{{ $album->name }} </span></h2>




                    <div class="col-lg-12 ">
                        <div class="music-player">

                            <div class="music-filter">

                                <form method="GET" id="filter-form" class="filter-form">
                                    <select name="sort" id="sort" class="sort-filter">
                                        {{-- <option>Sort by ASWAT list</option> --}}
                                        <option @if($sort=='top' ) selected @endif value="top">الأكثر تحميلاً</option>
                                        <option @if($sort=='newest' ) selected @endif value="newest">الجديد </option>

                                    </select>

                                    <select name="instrument" id="instrument" class="sort-filter">
                                        <option @if($instrument==1) selected @endif value="newest" value="1">معزوفات غنائية </option>
                                        <option @if($instrument==2) selected @endif value="2">اصوات بشرية </option>
                                        <option @if($instrument==3) selected @endif value="3">معزوفات موسيقية</option>

                                    </select>

                                    <select name="bpm" id="bpm" class="sort-filter">
                                        <option @if($bpm==0) selected @endif value="0">السرعة</option>
                                        <option @if($bpm=="slow" && !is_numeric($bpm)) selected @endif value="slow">بطيئ </option>
                                        <option @if($bpm=="medslow" && !is_numeric($bpm)) selected @endif value="medslow">بطيئ متوسط </option>
                                        <option @if($bpm=="medium" && !is_numeric($bpm)) selected @endif value="medium">متوسط </option>
                                        <option @if($bpm=="medfast" && !is_numeric($bpm)) selected @endif value="medfast">سريع متوسط </option>
                                        <option @if($bpm=="fast" && !is_numeric($bpm)) selected @endif value="fast">سريع جدا </option>
                                    </select>

                                    <select name="duration" id="duration" class="sort-filter">
                                        <option>مدة حرة</option>
                                        <option @if($duration==1) selected @endif value="1">10-30 ثواني </option>
                                        <option @if($duration==2) selected @endif value="2">30-50 ثواني </option>
                                        <option @if($duration==3) selected @endif value="3">50+ ثواني </option>
                                    </select>


                                </form>

                            </div>
                            <input type="hidden" id="current_music_id" value="">
                            <input type="hidden" id="album_id" value="{{ $album_id }}">
                            <div class="loader" id="loader">
                                <div class="lds-facebook"><div></div><div></div><div></div></div>
                                <h3>Loading ...</h3>
                            </div>
                            <div class="music-list" id="playlist" style="visibility: hidden;">
                                <script>
                                    var mux = 0;
                                </script>
                                @foreach ($music as $mus)
                                    <div class="music-items">
                                        <div class="items-left">
                                            <div style="display: none;">
                                                @if (Auth::user())
                                                    <a id="music_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/album/' . $mus->demo) }}"></a>
                                                @else`
                                                    <a id="music_url{{ $loop->iteration }}"
                                                        href="{{ asset('assets/images/album/' . $mus->demo) }}"></a>
                                                @endif
                                            </div>
                                            <input type="hidden" id="music_item{{ $loop->iteration }}" value="0">
                                            @if (isset($mus->image))
                                                <img src="{{ asset('assets/images/album/' . $mus->image) }}"
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

                                                    {{ $mus->artist_name }}

                                                </p>
                                            </span>
                                            <p class="category" id="category{{ $loop->iteration }}">

                                                {{ $mus->cat_name }}

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
                                                $ {{ $mus->price }}
                                            </span>
                                        </div>
                                        <div class="items-right">


                                            <span class="music-action" id="music_action{{ $loop->iteration }}">
                                                @if (Auth::user())
                                                    @if (Auth::user()->subscription_id == 1)
                                                        {{-- <form action="{{ route('add.to.cart', $mus->id) }}">
                                                        @csrf
                                                        <button type="submit"><i class="fa-solid fa-download add-to-cart"></i></button>

                                                    </form> --}}
                                                        <button data-id="{{ $mus->id }}"  data-duration="duration{{ $loop->iteration }}"  data-type="1"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $mus->demo) }}" data-name={{$mus->demo}}><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-type="1"><i
                                                                class="fa-solid fa-star @if(in_array($mus->id , $favourite)) yellow @endif add-favourite"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i
                                                                class="fa-solid fa-share share"></i></button>
                                                    @else
                                                        <button data-id="{{ $mus->id }}" data-duration="duration{{ $loop->iteration }}"  data-type="1"><i
                                                                class="fa-solid fa-cart-shopping add-to-cart"></i></button>
                                                        <button data-id="{{ $mus->id }}"
                                                            data-href="{{ asset('assets/images/album/' . $mus->demo) }}" data-name={{$mus->demo}}><i
                                                                class="fa-solid fa-download download"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-type="1"><i
                                                                class="fa-solid fa-star @if(in_array($mus->id , $favourite)) yellow @endif add-favourite"></i></button>
                                                        <button data-id="{{ $mus->id }}" data-href="{{ asset('assets/images/album/' . $mus->demo) }}"><i
                                                                class="fa-solid fa-share share" ></i></button>
                                                    @endif
                                                @else
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-cart-shopping"></i></button>
                                                    <button data-id="{{ $mus->id }}"
                                                        data-href="{{ asset('assets/images/album/' . $mus->demo) }}" data-name={{$mus->demo}}><i
                                                            class="fa-solid fa-download download"></i></button>
                                                    <button onclick="location.href='{{ route('login') }}'"><i
                                                            class="fa-solid fa-star"></i></button>

                                                    <button data-href="{{ asset('assets/images/album/' . $mus->demo) }}">
                                                        <i class="fa-solid fa-share share"></i></button>
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
                                                        width: 150,
                                                        responsive: true,

                                                    });

                                                this["music" + mux].load("{{ asset('assets/images/album/' . $mus->demo) }}");

                                                var dur = this["music" + mux].getCurrentTime();

                                                //  $('#time'+mux).text(parseFloat(this["music"+mux].getDuration(),2));
                                            </script>

                                    </div>
                                @endforeach





                            </div>


                        </div>






                    </div>

                </div>
            </div>
            <!-- Modal -->
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/2.0.4/wavesurfer.min.js"></script> --}}

    <script>
        $(".loader").fadeOut(5000);
        var type, sort, instrument, duration, music_type_id, auth_user, asset_music_url, asset_album_url,asset_songs_url;
        var musicarray = [];
        var mux = 0;
        var totalmux = 0;
        var page = 1;
        var lastpage = 0;
        var pagedata = 1;
        var loaddata = 10;
        //  asset_album_url = "{{ asset('assets/images/album/') }}";
        asset_album_url = "https://aswwat.com/public/assets/images/album";
        asset_songs_url = "https://aswwat.com/public/assets/images/songs";

        function fetchsongs(page) {
            type = $('#type').val();
            sort = $('#sort').val();
            instrument = $('#instrument').val();
            duration = $('#duration').val();
            music_type_id = $('#music_type_id').val();
            auth_user = $('#auth_user').val();
            var album_id = $('#album_id').val();
            var subscription = 0;
            $.ajax({
                url: "{{ url('/getAlbum') }}?page=" + page,
                datatype: 'json',
                data: {
                    type: type,
                    sort: sort,
                    instrument: instrument,
                    duration,
                    music_type_id: music_type_id,
                    page: page,
                    album_id:album_id,
                },
                cache: false,
                success: function(data) {
                    musicarray = [];

                        var row = ""
                        var color = ''
                        pagedata = 0
                        if (data.music.data.length == 0) {
                            pagedata = 0;
                        } else {
                            pagedata = 1;
                        }
                        last_page = data.music.last_page;
                        // console.log(data.music);
                        var favourite = data.favourite;
                        $.each(data.music.data, function(index, value) {
                            mux++
                            if (favourite.indexOf(value.id) !== -1) {
                                color = 'yellow';
                            } else {
                                color = '';
                            }
                            row += "<div class='music-items'>" +
                                "<div class='items-left'>" +
                                "<div style='display: none;'>";
                            if (auth_user == 1) {
                                row += "<a id='music_url" + mux +
                                    "' href='" + asset_album_url + "/" + value.demo +
                                    "'></a>";
                            } else {
                                row += "<a id='music_url" + mux +
                                    "' href='" + asset_album_url + "/" + value.demo +
                                    "'></a>";
                            }
                            row += "</div><input type='hidden' id='music_item" + mux + "' value='0'>";

                            if (value.image)
                                row += "<img src='" + asset_album_url + "/" + value.image +
                                "' alt='Upload Icon' data-holder-rendered='true' max-height='10px;' max-width='50px;' style='height:50px;width:50px;'>";
                            else {
                                row += "<img src='" + asset_album_url + "/" + value.image +
                                    "' alt='Upload Icon' data-holder-rendered='true' max-height='10px;' max-width='50px;' style='height:50px;width:50px;'>";
                            }
                            row += "<i class='fa-solid fa-play' id='icon-play" + mux +
                                "'  onclick='pausemusic(" + mux + ")'></i>" +
                                "<span class='artist-name'>" +
                                "<p id='music_name" + mux + "'>" + value.name + "</p>" +
                                "<p id='artist_name" + mux + "'>" + value.artist_name  + "</p>" +
                                "</span>" +
                                "<p class='category' id='category" + mux + "'>" + value.cat_name +
                                "</p>" +
                                "<p class='time'><span id='currenttime" + mux + "'></span> / " +
                                "<span id='duration" + mux + "'></span>" +
                                "</p>" +
                                "<div class='demo' id='demo" + mux + "'>" +
                                "<div id='music" + mux + "' class='waveform'></div></div>" +
                                "<span class='music-price'> $ " + parseFloat(value.price) +
                                " </span>" +
                                "</div>" +
                                "<div class='items-right'>" +
                                "<span class='music-action' id='music_action" + mux + "'>";

                            if (auth_user == 1) {
                                if (subscription == 1) {

                                    row += "<button data-id='" + value.id +
                                        "' data-duration='duration" + mux +
                                        "' data-type='1'><i class='fa-solid fa-cart-shopping add-to-cart'></i></button>" +
                                        "<button data-id='" + value.id + "'  data-href='" +
                                        asset_album_url + "/" + value.demo + " ' data-name='" + value
                                        .demo + "'>" +
                                        "<i class='fa-solid fa-download download'></i></button>" +
                                        "<button data-id='" + value.id + "' data-duration='duration" +
                                        mux + "' data-type='1'><i class='fa-solid " + color +
                                        "  fa-star add-favourite'></i></button>" +
                                        "<button data-id='" + value.id + "' data-href='" +
                                        asset_album_url + "/" + value.demo +
                                        "' ><i class='fa-solid  fa-share share'></i></button>";
                                } else {
                                    row += "<button data-id='" + value.id +
                                        "' data-duration='duration" + mux +
                                        "' data-type='1'><i class='fa-solid fa-cart-shopping add-to-cart'></i></button>" +
                                        "<button data-id='" + value.id + "'  data-href='" +
                                        asset_album_url + "/" + value.demo + "' data-name='" + value
                                        .demo + "'>" +
                                        "<i class='fa-solid fa-download download'></i></button>" +
                                        "<button data-id='" + value.id + "' data-duration='duration" +
                                        mux + "' data-type='1'><i class='fa-solid " + color +
                                        " fa-star add-favourite'></i></button>" +
                                        "<button data-id='" + value.id + "' data-href='" +
                                        asset_album_url + "" + value.demo +
                                        "' ><i class='fa-solid fa-share share'></i></button>";
                                }
                            } else {
                                row +=
                                    "<button ><i class='fa-solid fa-cart-shopping add-to-cart'></i>" +
                                    "</button>" +
                                    "<button data-id='" + value.id + "' data-href='" + asset_album_url +
                                    "/" + value.demo + "' data-name='" + value.demo +
                                    "'><i class='fa-solid fa-download download'></i></button>" +
                                    "<button ><i class='fa-solid fa-star add-favourite'></i></button>"

                                    +
                                    "<button data-id='" + value.id + "' data-href='" + asset_album_url +
                                    "/" + value.demo +
                                    "' ><i class='fa-solid fa-share share'></i></button>";
                            }
                            row += "</span></div></div>";

                            musicarray.push(asset_album_url + "/" + value.demo);



                        })


                    totalmux = mux;
                    //    console.log(musicarray);
                    $('#playlist').append(row);
                }
            });
        }
        fetchsongs(page);

        function loadsongsdata(){
            if (last_page > page) {
                    page++;
            setTimeout(() => {
                fetchsongs(page);
                    setTimeout(() => {
                     loadsongs(page);

                    }, 2000);
                    setTimeout(() => {
                        displayTime()
                    }, 6000);
                    }, 2000);
                }
        }
        setInterval(() => {
                        loadsongsdata();

                    }, 5000);
                    function loadsongs(p) {
            var pg = parseInt(p) * loaddata;
            var mux = parseInt(pg) - 10;
            console.log(mux);
            for (let index = 0; index < musicarray.length; index++) {
                mux++;

                this["music" + mux] =
                    WaveSurfer.create({
                        container: "#music" + mux,
                        loopSelection: true,
                        waveColor: "gray",
                        progressColor: "white",
                        height: 48,
                        maxCanvasWidth: 150,
                        width: 150,
                        responsive: true,


                    });
                this["music" + mux].load(musicarray[index]);

            }
        }
        var wavesurfer, current_music_id;
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
                // pausemusic(current_music_id);
                $('#icon-play' + current_music_id).removeClass('fa-pause');
                $('#icon-play' + current_music_id).addClass('fa-play');
                // console.log('pause');
            });
        });
        setTimeout(() => {

$('#playlist').css('visibility', 'visible');
displayTime()

// $("#playlist").load(location.href+" #playlist>*","");
}, 6000);
setTimeout(() => {


loadsongs(page);

// $("#playlist").load(location.href+" #playlist>*","");
}, 2000);

        function displayTime() {
            for (let index = 1; index <= totalmux; index++) {
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
            });
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
@endpush
