@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Edit Package</h2>
                <a href="{{ url('admin/package') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" autocomplete="off" method="POST" action="{{ url('admin/package/update/'.$package->id) }}" role="form"
                    autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Package Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $package->name }}" placeholder="Package Name" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="downloads" class="col-sm-2 form-control-label">Downloads</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="downloads" name="downloads" value="{{ $package->downloads }}" placeholder="Downloads" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 form-control-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="{{ $package->price }}" placeholder="Price" autocomplete="off" required>
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
