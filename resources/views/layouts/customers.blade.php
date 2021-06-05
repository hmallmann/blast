@extends('layouts.default')
@section('header')
    Customers
    <small>List of customers registered.</small>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a href="{{route("create-customer")}}" class="btn btn-block btn-info btn-lg">Create Customer</a>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customers List</h3>
                    </div>
                    <div class="box-body">
                        <table id="tableCategories" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Actions</th>
                                    <th>User</th>
                                    <th>Name</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                    <th>Numbers</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($customers as $customer)
                                <tr>
                                    <td style="width: 70px">
                                        {{$customer->id}}
                                    </td>
                                    <td align="center" style="width: 100px">
                                        <a href="{{route("edit-customer", ['id' => $customer->id])}}" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                        <a  onclick="deleteItem({{$customer->id}})" class="btn btn-default"><i class="fa fa-trash-o"></i></a>
                                    </td>

                                    <td>
                                        {{$customer->user()->name}}
                                    </td>
                                    <td>
                                        {{$customer->name}}
                                    </td>
                                    <td>
                                        {{$customer->document}}
                                    </td>
                                    <td>
                                        {{$customer->getStatus()}}
                                    </td>
                                    <td align="center" style="width: 100px">
                                        <a href="{{route("numbers", ['customer_id' => $customer->id])}}" class="btn btn-default"><i class="fa fa-list"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>User</th>
                                <th>Name</th>
                                <th>Document</th>
                                <th>Status</th>
                                <th>Numbers</th>
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
                window.location = "{{route('delete-customer', ['id'=>' '])}}/" + id;
            }
        }
    </script>
@endsection
