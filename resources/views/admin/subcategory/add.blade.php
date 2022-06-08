@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Add Sub Category</h2>
                <a href="{{ url('admin/sub-category') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" autocomplete="off" enctype="multipart/form-data" method="POST"
                    action="{{ url('admin/sub-category/store') }}" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="instrument" class="col-sm-2 form-control-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control select2-multiple" name="cat_id" required>

                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label"> Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Sub Category Name"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-sm-2 form-control-label" for="copyright">
                            Image
                        </label>


                        <div class="col-sm-10">
                            <div id="profile-container">
                                <img class="" id="profileImage"
                                    src="{{ asset('assets/images/upload.png') }}" alt="Upload Icon"
                                    data-holder-rendered="true" max-height="10px;" max-width="50px;"
                                    style="height:50px;width:50px;">

                            </div>
                            <input type="file" id="imageUpload" name="image" class="file-upload-default form-control"
                                placeholder="Password" autocomplete="off" required>
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
