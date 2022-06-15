@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Edit Home Page Song</h2>
                <a href="{{ url('admin/songs') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" enctype="multipart/form-data" autocomplete="off" method="POST"
                    action="{{ url('admin/songs/update/' . $song->id) }}" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Song Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="{{ $song->name }}" name="name"
                                placeholder="Song Name" autocomplete="off" required>
                        </div>
                    </div>
                    <?php
                    $art = explode(',', $song->artist_id);
                    $music_id = explode(',', $song->music_type_id);
                    $genre_id = explode(',', $song->genre_id);
                    $instrument_id = explode(',', $song->instrument_id);

                    ?>
                    <div class="form-group row">
                        <label for="artist" class="col-sm-2 form-control-label">Artist</label>
                        <div class="col-sm-10">


                            <select class="form-control select2-multiple" name="artist[]" required multiple="multiple">

                                @foreach ($artists as $artist)
                                    <option @if (in_array($artist->id, $art)) {{ 'selected' }} @endif
                                        value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="music_type" class="col-sm-2 form-control-label">Music Type</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="music_type[]" required multiple="multiple">

                                @foreach ($music_type as $music)
                                    <option @if (in_array($music->id, $music_id)) {{ 'selected' }} @endif
                                        value="{{ $music->id }}">{{ $music->name }}</option>
                                @endforeach


                            </select>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="genre" class="col-sm-2 form-control-label">Genre</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="genre[]" required multiple="multiple">

                                @foreach ($genres as $genre)
                                    <option @if (in_array($genre->id, $genre_id)) {{ 'selected' }} @endif
                                        value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instrument" class="col-sm-2 form-control-label">Instrument</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="instrument[]" required multiple="multiple">

                                @foreach ($instruments as $instrument)
                                    <option @if (in_array($instrument->id, $instrument_id)) {{ 'selected' }} @endif
                                        value="{{ $instrument->id }}">{{ $instrument->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 form-control-label">Song Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" value="{{ $song->price }}" name="price" placeholder="Song Price"
                                autocomplete="off" required>
                        </div>
                    </div>

                    <div class="row form-group">

                        <label class="col-sm-2 form-control-label" for="copyright">
                            Song Image
                        </label>
                        <div class="col-sm-10 controls ">
                            <div id="profile-container">
                                @if (isset($song->img))
                                    <img class="" id="profileImage"
                                        src="{{ asset('assets/images/songs/' . $song->img) }}" alt="Upload Icon"
                                        data-holder-rendered="true" max-height="10px;" max-width="100px;"
                                        style="height:100px;width:100px;">
                                @else
                                    <img class="" id="profileImage"
                                        src="{{ asset('assets/images/upload.png') }}" alt="Upload Icon"
                                        data-holder-rendered="true" max-height="10px;" max-width="100px;"
                                        style="height:100px;width:100px;">
                                @endif
                            </div>

                            <input class="col-sm-12 form-control" name="image" type="file">

                        </div>

                    </div>
                    <div class="row form-group">

                        <label class="col-sm-2 form-control-label" for="audio">
                            Song File
                        </label>
                        <div class="col-sm-10">
                            <audio id="audio" controls>
                                <source
                                    @if (isset($song->audio)) src="{{ asset('assets/images/songs/' . $song->audio) }}" @else src="" @endif
                                    id="src" />
                            </audio>
                            <input class="col-sm-12 form-control" id="audio-upload" name="audio" type="file">

                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="demo">
                            Demo File
                        </label>
                        <div class="col-sm-10">
                            <audio id="demo" controls>
                                <source @if (isset($song->demo_audio)) src="{{ asset('assets/images/songs/' . $song->demo_audio) }}" @else src="" @endif id="srcdemo" />
                            </audio>
                            <input class="col-sm-12 form-control" id="audio-upload1" name="demo" type="file">

                        </div>
                    </div>
                    <div class="row form-group">

                        <label class="col-sm-2 form-control-label" for="pdf_file">
                            PDF File
                        </label>
                        <div class="col-sm-10 d-flex ">

                            <input class="col-sm-12 form-control" name="pdf_file" type="file">
                            @if (isset($song->file))
                                <a href="{{ asset('assets/images/songs/' . $song->file) }}" download
                                    target="_blank"><button type="button" class="btn btn-default btn-download"><i
                                            class="fa-solid fa-download"></i> Download</button>
                                </a>
                            @endif

                        </div>
                    </div>
                    <div class="row form-group">

                        <label class="col-sm-2 form-control-label" for="copyright">
                            Copy Right File
                        </label>
                        <div class="col-sm-10 d-flex">
                            <input class="col-sm-12 form-control" name="copyright" type="file">
                            @if (isset($song->copyright))
                            <a href="{{ asset('assets/images/songs/' . $song->copyright) }}" download
                                target="_blank"><button type="button" class="btn btn-default btn-download"><i
                                        class="fa-solid fa-download"></i> Download</button>
                            </a>
                        @endif
                        </div>
                    </div>
                    <hr />
                    <h4><b>Sorting Filters</b></h4>
                    <hr />
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="instrument2">
                            Instrument
                        </label>

                        <div class="col-sm-10 controls ">

                            <select class="form-control select2-multiple" name="instrument2" >
                                <option @if($song->sort_instrument == 1) selected @endif value="1">Vocal & Instrumental </option>
                                <option @if($song->sort_instrument == 2) selected @endif value="2">Vocal Only </option>
                                <option @if($song->sort_instrument == 3) selected @endif value="3">Instruments</option>

                            </select>

                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="bpm">
                            BPM
                        </label>

                        <div class="col-sm-10 controls ">

                            <select class="form-control select2-multiple" name="bpm" >
                                <option @if($song->sort_bpm == 'slow') selected @endif value="slow">Slow </option>
                                <option @if($song->sort_bpm == 'medslow') selected @endif value="medslow">Med-Slow </option>
                                <option @if($song->sort_bpm == 'medium') selected @endif value="medium">Medium </option>
                                <option @if($song->sort_bpm == 'medfast') selected @endif value="medfast">Med-Fast </option>
                                <option @if($song->sort_bpm == 'fast') selected @endif value="fast">Fast </option>

                            </select>

                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="duration">
                            Durations
                        </label>

                        <div class="col-sm-10 controls ">

                            <select class="form-control select2-multiple" name="duration" required>
                                <option @if($song->sort_duration	 == 1) selected @endif value="1">10 - 30 sec </option>
                                <option @if($song->sort_duration	 == 2) selected @endif value="2">30 - 50 sec </option>
                                <option @if($song->sort_duration	 == 3) selected @endif value="3">50+ sec     </option>

                            </select>

                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="tag">
                            Tags
                        </label>

                        <div class="col-sm-10 controls ">

                            <input class="col-sm-12 form-control input-tags" value="{{ $song->tags }}" name="tag" data-role="tagsinput">

                        </div>
                    </div>
                    <div class="form-group row m-t-md">
                        <div class="col-sm-offset-2 col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
