@extends('admin.layouts.app')
@section('content')

    <div class="row padding">
        <div class="col-sm-12 ">
			<div class="row">
				<div class="col-xs-3">
			        <div class="box p-a">
			          <div class="pull-left m-r">
			          	<i class="fa-solid fa-a text-2x text-danger m-y-sm"></i>
			          </div>
			          <div class="clear">
			          	<div class="text-muted">Artist</div>
			            <h4 class="m-a-0 text-md _600"><a href="">{{ $artist }}</a></h4>
			          </div>
			        </div>
			    </div>
			    <div class="col-xs-3">
			        <div class="box p-a">
			          <div class="pull-left m-r">
			          	<i class="fa-solid fa-cubes text-2x text-info m-y-sm"></i>
			          </div>
			          <div class="clear">
			          	<div class="text-muted">Package</div>
			            <h4 class="m-a-0 text-md _600"><a href="">{{ $package }}</a></h4>
			          </div>
			        </div>
			    </div>
			    <div class="col-xs-3">
			        <div class="box p-a">
			          <div class="pull-left m-r">
			          	<i class="fa-solid fa-users text-2x text-accent m-y-sm"></i>
			          </div>
			          <div class="clear">
			          	<div class="text-muted">Subscriber</div>
			            <h4 class="m-a-0 text-md _600"><a href="">{{ count($subscriber) }}</a></h4>
			          </div>
			        </div>
			    </div>
			    <div class="col-xs-3">
			        <div class="box p-a">
			          <div class="pull-left m-r">
			          	<i class="fa-solid fa-music text-2x text-success m-y-sm"></i>
			          </div>
			          <div class="clear">
			          	<div class="text-muted">Songs</div>
			            <h4 class="m-a-0 text-md _600"><a href="">{{ $song }}</a></h4>
			          </div>
			        </div>
			    </div>

		    </div>
	    </div>
    </div>
@endsection
