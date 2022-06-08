@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Edit Artist</h2>
                <a href="{{ url('admin/artist') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form  role="form" action="{{url('admin/artist/update/'.$artist->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $artist->name }}" name="name" id="name" placeholder="Name" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center">
                        <label for="inputPassword3" class="col-sm-2 form-control-label">Profile Pic</label>
                        <div class="col-sm-10">
                            <div id="profile-container">
                                @if(isset($artist->img))
                                <img class="" id="profileImage" src="{{ asset('assets/images/artist/'.$artist->img)  }}" alt="Upload Icon" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                                @else
                                <img class="" id="profileImage" src="{{ asset('assets/images/upload.png')  }}" alt="Upload Icon" data-holder-rendered="true" max-height="10px;" max-width="100px;" style="height:100px;width:100px;">
                                @endif
                            </div>
                            <input type="file" id="imageUpload" name="image" class="file-upload-default form-control"   placeholder="Password" autocomplete="off">
                        </div>
                    </div>

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
