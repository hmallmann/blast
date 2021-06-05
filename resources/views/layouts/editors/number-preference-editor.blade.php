@php
    if ( !isset($number_preference) )
    {
        $number_preference = null;
    }

    if( !isset($numbers) )
    {
        $numbers = \App\Models\Number::getNumbersList();
    }

    $selectedNumber = null;

    if( $number_preference )
        $selectedNumber = $number_preference->number_id;
    elseif ( isset($number) )
        $selectedNumber = $number->id;
    else
        $selectedNumber = old('customer_id');

@endphp
@extends('layouts.default')
@section('header')
    Number Preference Editor
    <small></small>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('store-number-preference') }}" enctype="multipart/form-data">
                        @csrf

                        <input name="id" hidden="hidden" type="text" value="{{$number_preference?$number_preference->id:''}}">

                        <div class="form-group row">
                            @include('layouts.components.select', [ 'id' => 'number_id',
                                                                  'title' => 'Number',
                                                                  'class' => "form-control @error('number_id') is-invalid @enderror",
                                                                  'name' => 'number_id',
                                                                  'values' => $numbers,
                                                                  'required' => true,
                                                                  'selectedId' => $selectedNumber
                                                                ])
                            @error('number_id')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $number_preference?$number_preference->name:old('name') }}" required
                                       autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="value" class="col-md-2 col-form-label text-md-right">Value</label>

                            <div class="col-md-6">
                                <input id="value" type="text"
                                       class="form-control @error('value') is-invalid @enderror"
                                       name="value" value="{{ $number_preference?$number_preference->value:old('value') }}" required
                                       autocomplete="value" autofocus>

                                @error('value')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
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
