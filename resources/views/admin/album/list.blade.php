@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Album</h2>
                <a href="{{ url('admin/album/add') }}"><button class="btn btn-info"> Add New </button></a>
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
                                <th>Sound Name</th>
                                {{-- <th>Artists</th> --}}
                                {{-- <th>Genres</th> --}}

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($albums as $album)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $album->name }}</td>
                                    {{-- <td> @foreach($album->artist_name AS $art){{ $art->name.','  }}@endforeach</td> --}}
                                    {{-- <td>@foreach($album->genre AS $gen){{ $gen->name.','  }}@endforeach</td> --}}

                                    <td>
                                        <a href="{{ url('admin/album/edit/' . $album->id) }}"><i
                                        class="fa-solid fa-pen-to-square text-1x"></i></a>
                                        &nbsp; <a
                                    onclick="$('#submit'+{{ $album->id }}).click()"><i
                                        class="fa-solid fa-trash-can text-1x"></i></a>
                                <form action="{{ url('admin/album/delete/' . $album->id) }}" method="post"
                                    class="delete-form">
                                    @csrf
                                    <button type="submit" id="submit{{ $album->id }}"
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
