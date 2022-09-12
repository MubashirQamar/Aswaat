@extends('admin.layouts.app')
@section('content')
    <div class="padding">
        <div class="box">
            <div class="box-header d-flex">
                <h2>Add Package</h2>
                <a href="{{ url('admin/package') }}"><button class="btn btn-info"> Back </button></a>
            </div>
            <div class="box-divider m-a-0"></div>
            <div class="box-body">
                <form role="form" autocomplete="off" method="POST" action="{{ url('admin/package/store') }}" role="form"
                    autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 form-control-label">Package Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Package Name" autocomplete="off" required>
                        </div>
                    </div>
                       <div class="form-group row">
                        <label for="downloads" class="col-sm-2 form-control-label">Sound Track Downloads</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sound_track" name="sound_track"
                                placeholder="Sound Track Downloads" autocomplete="off" required>
                        </div>
                    </div>
                       <div class="form-group row">
                        <label for="downloads" class="col-sm-2 form-control-label">Sound Effect Downloads</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sound_effect" name="sound_effect"
                                placeholder="Sound Effect Downloads" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="downloads" class="col-sm-2 form-control-label">Total Downloads</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="downloads" name="downloads"
                                placeholder="Downloads" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 form-control-label">Content</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="content" name="content"
                                placeholder="Content" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 form-control-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Price"
                                autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <div class="box">
                                <div class="box-header d-flex">
                                    <h3>Package Details</h3>
                                    {{-- <button id="addBtn" type="button" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add More </button> --}}
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="package_table">
                                        @foreach ($pack_desc as $pack)
                                            <tr >
                                                <td><input type="hidden" name="package_detail_id[]" value="{{ $pack->id }}">{{ $loop->iteration }}</td>
                                                <td><span>{{ $pack->description }}</span></td>
                                                <td><select name="status[]" class="form-control select2-multiple">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
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
@push('include-js')
    <script>
        $(document).ready(function() {

            // Denotes total number of rows
            var rowIdx = 0;

            // jQuery button click event to add a row
            $('#addBtn').on('click', function() {

                // Adding a row inside the tbody.
                $('#package_table').append(`<tr id="R${++rowIdx}">

                <td>
                    <div class="form-group row">

                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description[]"placeholder="Description"
                                autocomplete="off" required>
                        </div>
                    </div>

                </td>
             </td>
              <td class="text-center">
                <button  type="button"  class="btn btn-danger remove"><i class="fa-solid fa-xmark"></i></button>
                </td>
              </tr>`);
            });

            // jQuery button click event to remove a row.
            $('#package_table').on('click', '.remove', function() {

                // Getting all the rows next to the row
                // containing the clicked button
                var child = $(this).closest('tr').nextAll();

                // Iterating across all the rows
                // obtained to change the index
                child.each(function() {

                    // Getting <tr> id.
                    var id = $(this).attr('id');

                    // Getting the <p> inside the .row-index class.
                    var idx = $(this).children('.row-index').children('p');

                    // Gets the row number from <tr> id.
                    var dig = parseInt(id.substring(1));

                    // Modifying row index.
                    idx.html(`Row ${dig - 1}`);

                    // Modifying row id.
                    $(this).attr('id', `R${dig - 1}`);
                });

                // Removing the current row.
                $(this).closest('tr').remove();

                // Decreasing total number of rows by 1.
                rowIdx--;
            });
        });
    </script>
@endpush
