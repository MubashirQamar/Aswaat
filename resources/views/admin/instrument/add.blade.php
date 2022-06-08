@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Add Instrument</h2>
                <a href="{{ url('admin/instrument') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" autocomplete="off" method="POST" action="{{url('admin/instrument/store')}}" role="form" autocomplete="off">
                   @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Instrument Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Instrument Name" autocomplete="off" required>
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
