@extends('layouts.default')
@section('header')
    Numbers {{isset($customer)?"of Customer $customer->name":""}}
    <small>List of numbers registered.</small>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{route("create-number",['customer_id' => isset($customer) ? $customer->id : null ])}}" class="btn btn-block btn-info btn-lg">Create Number</a>
                </div>

                <div class="box">

                    <div class="box-body">
                        <table id="tableCategories" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Actions</th>
                                    <th>Customer</th>
                                    <th>Number</th>
                                    <th>Status</th>
                                    <th>Numbers Preferences</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($numbers as $number)
                                <tr>
                                    <td style="width: 70px">
                                        {{$number->id}}
                                    </td>
                                    <td align="center" style="width: 100px">
                                        <a href="{{route("edit-number", ['id' => $number->id])}}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                        <a  onclick="deleteItem({{$number->id}})" class="btn btn-default"><i class="fa fa-trash-o"></i></a>
                                    </td>

                                    <td>
                                        {{$number->customer()->name}}
                                    </td>
                                    <td>
                                        {{$number->number}}
                                    </td>
                                    <td>
                                        {{$number->getStatus()}}
                                    </td>
                                    <td align="center" style="width: 100px">
                                        <a href="{{route("number-preferences", ['number_id' => $number->id])}}" class="btn btn-default"><i class="fa fa-list"></i></a>
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
                                <th>Status</th>
                                <th>Numbers Preferences</th>
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
                window.location = "/delete-number/" + id;
            }
        }
    </script>
@endsection
