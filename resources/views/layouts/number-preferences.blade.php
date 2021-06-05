@extends('layouts.default')
@section('header')
    Number Preferences {{isset($number)?"of Number $number->number":""}}
    <small>{{isset($customer)?"Customer $customer->name.":""}}</small>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{route("create-number-preference", [ 'number_id' => isset($number) ? $number->id : null ])}}" class="btn btn-block btn-info btn-lg">Create Number Preference</a>
                </div>
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Actions</th>
                                    <th>Customer</th>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($number_preferences as $number_preference)
                                <tr>
                                    <td style="width: 70px">
                                        {{$number_preference->id}}
                                    </td>
                                    <td align="center" style="width: 100px">
                                        <a href="{{route("edit-number-preference", ['id' => $number_preference->id])}}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                        <a  onclick="deleteItem({{$number_preference->id}})" class="btn btn-default"><i class="fa fa-trash-o"></i></a>
                                    </td>

                                    <td>
                                        {{$number_preference->number() != null && $number_preference->number()->customer() != null ? $number_preference->number()->customer()->name : ''}}
                                    </td>
                                    <td>
                                        {{isset($number_preference->number()->number) ? $number_preference->number()->number : ''}}
                                    </td>
                                    <td>
                                        {{$number_preference->name}}
                                    </td>
                                    <td>
                                        {{$number_preference->value}}
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Customer</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
            <!-- /.box -->
        </div>
    </div>

    <script>
        function deleteItem(id) {
            var result = confirm("Do you really want to delete this item?");
            if (result == true) {
                window.location = "/delete-number-preference/" + id;
            }
        }
    </script>
@endsection
