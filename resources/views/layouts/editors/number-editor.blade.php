@php
    if ( !isset($number) )
    {
        $number = null;
    }

    if( !isset($customers) )
    {
        $customers = \App\Models\Customer::getCustomersList();
    }

    $selectedCustomer = null;

    if( $number )
        $selectedCustomer = $number->customer_id;
    elseif ( isset($customer) )
        $selectedCustomer = $customer->id;
    else
        $selectedCustomer = old('customer_id');

@endphp
@extends('layouts.default')
@section('header')
    Number Editor
    <small></small>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('store-number') }}" enctype="multipart/form-data">
                        @csrf

                        <input name="id" hidden="hidden" type="text" value="{{$number?$number->id:''}}">

                        <div class="form-group row">
                            @include('layouts.components.select', [ 'id' => 'customer_id',
                                                                  'title' => 'Customer',
                                                                  'class' => "form-control @error('customer_id') is-invalid @enderror",
                                                                  'name' => 'customer_id',
                                                                  'values' => $customers,
                                                                  'required' => true,
                                                                  'selectedId' => $selectedCustomer
                                                                ])
                            @error('customer_id')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-md-2 col-form-label text-md-right">Number</label>

                            <div class="col-md-6">
                                <input id="number" type="text"
                                       class="form-control @error('number') is-invalid @enderror"
                                       name="number" value="{{ $number?$number->number:old('number') }}" required
                                       autocomplete="number" autofocus>

                                @error('number')
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
                                                                  'values' => \App\Models\Number::getStatusList(),
                                                                  'required' => true,
                                                                  'selectedId' => $number?$number->status:old('status')
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
