<?php
/**
 * Created by PhpStorm.
 * User: Henrique
 * Date: 02/04/2020
 * Time: 00:26
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function profile()
    {
        return view('layouts.profile');
    }
}
