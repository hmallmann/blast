<?php


namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function list()
    {
        return view('layouts.customers',
                        ['customers' => Customer::all(),
                         'users' => User::all()
                        ]);
    }

    public function create()
    {
        return view('layouts.editors.customer-editor' );
    }

    public function edit( $id )
    {
        $customer = Customer::find( $id );

        if ( $customer )
            return view('layouts.editors.customer-editor', [ 'customer' => $customer ] );
        else
            return redirect()->back(404)->withErrors(['This customer id does not exists.']);
    }

    public function delete( $id )
    {
        $customer = Customer::find( $id );

        if ( $customer )
            $customer->delete();

        return response()->redirectTo('/admin/products' );
    }


    public function store( Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'document' => 'required|min:6|max:12',
            'status' => 'required',
        ]);

        $inputs = $request->all();

        $id = isset($inputs['id']) ? $inputs['id'] : 0;

        $customer = Customer::firstOrNew( ['id' => $id] );
        $customer->user_id = $inputs['user_id'];
        $customer->name = $inputs['name'];
        $customer->document = $inputs['document'];
        $customer->status = $inputs['status'];

        $customer->save();

        return response()->redirectTo('/customers' );
    }


}
