@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Setting</h2>

            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                   @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible " role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <form role="form" autocomplete="off" method="POST" action="{{url('admin/update-setting')}}" role="form" autocomplete="off">
                   @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly id="name" name="name" placeholder="Username" value="{{ Auth::user()->name }}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" readonly id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password" placeholder="*******" autocomplete="off" >
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
