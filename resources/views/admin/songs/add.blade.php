@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Add Song</h2>
                <a href="{{ url('admin/songs') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" enctype="multipart/form-data" autocomplete="off" method="POST"
                    action="{{ url('admin/songs/store') }}" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Song Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Song Name"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="artist" class="col-sm-2 form-control-label">Artist</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="artist[]" required multiple="multiple">
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="music_type" class="col-sm-2 form-control-label">Music Type</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="music_type[]" required multiple="multiple">

                                @foreach ($music_type as $music)
                                    <option value="{{ $music->id }}">{{ $music->name }}</option>
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
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="instrument" class="col-sm-2 form-control-label">Instrument</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="instrument[]" required multiple="multiple">

                                @foreach ($instruments as $instrument)
                                    <option value="{{ $instrument->id }}">{{ $instrument->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 form-control-label">Song Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Song Price"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="copyright">
                            Song Image
                        </label>


                        <div class="col-sm-10">
                            <div id="profile-container">
                                <img class="" id="profileImage"
                                    src="{{ asset('assets/images/upload.png') }}" alt="Upload Icon"
                                    data-holder-rendered="true" max-height="10px;" max-width="50px;"
                                    style="height:50px;width:50px;">

                            </div>
                            <input type="file" id="imageUpload" name="image" class="file-upload-default form-control"
                                placeholder="Password" autocomplete="off">
                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="audio">
                            Song File
                        </label>
                        <div class="col-sm-10">
                            <audio id="audio" controls>
                                <source src="" id="src" />
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
                                <source src="" id="srcdemo" />
                            </audio>
                            <input class="col-sm-12 form-control" id="audio-upload1" name="demo" type="file">

                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="pdf_file">
                            PDF File
                        </label>
                        <div class="col-sm-10 controls ">

                            <input class="col-sm-12 form-control" name="pdf_file" type="file">

                        </div>

                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="copyright">
                            Copy Right File
                        </label>
                        <div class="col-sm-10 controls ">

                            <input class="col-sm-12 form-control" name="copyright" type="file">

                        </div>
                    </div>

                    {{-- <hr /> --}}
                    <div class="form-group row m-t-md">
                        <div class="col-sm-offset-2 col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
