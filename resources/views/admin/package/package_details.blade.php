@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Package Description</h2>
                <a><button class="btn btn-info" type="button" data-toggle="modal" data-target="#AddPackageDesc"> Add New
                    </button></a>
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
                                <th>Content</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($pack_desc as $pack)
                            <tr data-id="{{ $pack->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td><span>{{ $pack->description }}</span></td>
                                <td><a><i data-toggle="modal" data-target="#EditPackageDesc"
                                            class="fa-solid fa-pen-to-square text-1x update"></i></a> &nbsp; <a
                                        onclick="$('#submit'+{{ $pack->id }}).click()"><i
                                            class="fa-solid fa-trash-can text-1x"></i></a>
                                    <form action="{{ url('admin/pack/delete/' . $pack->id) }}" method="post"
                                        class="delete-form">
                                        @csrf
                                        <button type="submit" id="submit{{ $pack->id }}"
                                            class="btn btn-danger btn-icon-text" style="display: none;">
                                            <i class="mdi mdi-delete-forever btn-icon-prepend"></i> Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="AddPackageDesc" tabindex="-1" role="dialog" aria-labelledby="AddPackageDesc"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form" autocomplete="off" method="POST" action="{{ url('admin/pack/store') }}" role="form"
                    autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddPackageDesc">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 form-control-label">Content</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="content" name="content"
                                    placeholder="Content" autocomplete="off" required>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal 2 --}}

    </div>
    <div id="EditPackageDesc" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <form role="form" autocomplete="off" method="POST" action="{{ url('admin/pack/update') }}" role="form"
                    autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditPackageDesc">Edit New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @csrf
                        <input type="hidden" id="edit_content_id" name="id">
                        <div class="form-group row">
                            <label for="content" class="col-sm-2 form-control-label">Content</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_content" name="content"
                                    placeholder="Content" autocomplete="off" required>
                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('include-js')
    <script>
        $('.update').click(function(e) {
            var tr = $(this).parent().parent().parent();
            var td = tr.children().find('span').text();
            var id = tr.attr('data-id');
            $('#edit_content').val(td);
            $('#edit_content_id').val(id);


        })
    </script>
@endpush
