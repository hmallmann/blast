<?php


namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\Number;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    public function list( $customer_id = null )
    {
        $customer = null;

        if ($customer_id)
            $customer = Customer::find($customer_id);

        return view('layouts.numbers',
                        ['numbers' => $customer_id ? Number::where( 'customer_id', $customer_id )->get() : Number::all(),
                         'customers' => Customer::all(),
                         'customer' => $customer
                        ]);
    }

    public function create($customer_id = null )
    {
        $customer = null;

        if ($customer_id)
            $customer = Customer::find($customer_id);

        return view('layouts.editors.number-editor', [ 'customer' => $customer ] );
    }

    public function edit( $id )
    {
        $number = Number::find( $id );

        if ( $number )
            return view('layouts.editors.number-editor', [ 'number' => $number ] );
        else
            return redirect()->back(404)->withErrors(['This number id does not exists.']);
    }

    public function delete( $id )
    {
        $number = Number::find( $id );

        if ( $number )
            $number->delete();

        return response()->redirectTo('/numbers' );
    }


    public function store( Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'number' => 'required|min:8|max:14',
            'status' => 'required',
        ]);

        $inputs = $request->all();

        $id = isset($inputs['id']) ? $inputs['id'] : 0;

        $number = Number::firstOrNew( ['id' => $id] );
        $number->customer_id = $inputs['customer_id'];
        $number->number = $inputs['number'];
        $number->status = $inputs['status'];

        if( $id )
            $number->save();
        else
            $number->create();

        return response()->redirectTo('/numbers' );
    }


}
