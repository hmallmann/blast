<?php


namespace App\Http\Controllers;


use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Http\Request;

class NumberPreferenceController extends Controller
{
    public function list( $number_id = null )
    {
        $number = null;

        if ($number_id)
            $number = Number::find($number_id);

        return view('layouts.number-preferences',
                        ['number_preferences' => $number_id?NumberPreference::where('number_id', $number_id)->get() : NumberPreference::all(),
                         'numbers' => Number::all(),
                         'number' => $number ? $number : null,
                         'customer' => $number ? $number->customer() : null,
                        ]);
    }

    public function create($number_id = null )
    {
        $number = null;

        if ($number_id)
            $number = Number::find($number_id);

        return view('layouts.editors.number-preference-editor', [ 'number' => $number ] );
    }

    public function edit( $id )
    {
        $numberPreference = NumberPreference::find( $id );

        if ( $numberPreference )
            return view('layouts.editors.number-preference-editor', [ 'number_preference' => $numberPreference ] );
        else
            return redirect()->back(404)->withErrors(['This number preference id does not exists.']);
    }

    public function delete( $id )
    {
        $numberPreference = NumberPreference::find( $id );

        if ( $numberPreference )
            $numberPreference->delete();

        return response()->redirectTo('/number-preferences/' . $numberPreference->number_id );
    }

    public function store( Request $request)
    {
        $data = $request->validate([
            'number_id' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);

        $inputs = $request->all();

        $id = isset($inputs['id']) ? $inputs['id'] : 0;

        $numberPreference = NumberPreference::firstOrNew( ['id' => $id] );
        $numberPreference->number_id = $inputs['number_id'];
        $numberPreference->name = $inputs['name'];
        $numberPreference->value = $inputs['value'];

        $numberPreference->save();

        return response()->redirectTo('/number-preferences/'. $numberPreference->number_id );
    }


}
