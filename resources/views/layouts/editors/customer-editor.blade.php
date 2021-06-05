@php
    if ( !isset($customer) )
    {
        $customer = null;
    }

    if( !isset($users) )
    {
        $users = \App\Models\User::getUsersList();
    }
@endphp
@extends('layouts.default')
@section('header')
    Customer Editor
    <small></small>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('store-customer') }}" enctype="multipart/form-data">
                        @csrf

                        <input name="id" hidden="hidden" type="text" value="{{$customer?$customer->id:''}}">

                        <div class="form-group row">
                            @include('layouts.components.select', [ 'id' => 'user_id',
                                                                  'title' => 'User',
                                                                  'class' => "form-control @error('user_id') is-invalid @enderror",
                                                                  'name' => 'user_id',
                                                                  'values' => $users,
                                                                  'required' => true,
                                                                  'selectedId' => $customer?$customer->user_id:old('user_id')
                                                                ])
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $customer?$customer->name:old('name') }}" required
                                       autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="document" class="col-md-2 col-form-label text-md-right">Document</label>

                            <div class="col-md-6">
                                <input id="document" type="text"
                                       class="form-control @error('document') is-invalid @enderror"
                                       name="document" value="{{ $customer?$customer->document:old('document') }}" required
                                       autocomplete="document">

                                @error('document')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            @include('layouts.components.select', [ 'id' => 'status',
                                                                  'title' => 'Status',
                                                                  'class' => "form-control @error('status') is-invalid @enderror",
                                                                  'name' => 'status',
                                                                  'values' => \App\Models\Customer::getStatusList(),
                                                                  'required' => true,
                                                                  'selectedId' => $customer?$customer->status:old('status')
                                                                ])
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
