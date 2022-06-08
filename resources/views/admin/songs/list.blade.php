@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Songs</h2>
                <a href="{{ url('admin/songs/add') }}"><button class="btn btn-info"> Add New </button></a>
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
                <div class="table-responsive">
                    <table class="datatables table table-striped b-t b-b">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Song Name</th>
                                <th>Artists</th>
                                <th>Genres</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($songs as $song)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $song->name }}</td>
                                    <td> @foreach($song->artist_name AS $art){{ $art->name.','  }}@endforeach</td>
                                    <td>@foreach($song->genre AS $gen){{ $gen->name.','  }}@endforeach</td>

                                    <td>
                                        <a href="{{ url('admin/songs/edit/' . $song->id) }}"><i
                                        class="fa-solid fa-pen-to-square text-1x"></i></a>
                                        &nbsp; <a
                                    onclick="$('#submit'+{{ $song->id }}).click()"><i
                                        class="fa-solid fa-trash-can text-1x"></i></a>
                                <form action="{{ url('admin/songs/delete/' . $song->id) }}" method="post"
                                    class="delete-form">
                                    @csrf
                                    <button type="submit" id="submit{{ $song->id }}"
                                        class="btn btn-danger btn-icon-text" style="display: none;">
                                        <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                                </form>
                            </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
