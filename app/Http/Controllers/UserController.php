<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;


class UserController extends Controller
{
    //
    public function create(Request $request)
    {
        $user = new User;

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $user->username . '@3Techies.com';
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->dob= $request->input('dob');
        $user->gender = $request->input('gender');

        $user->save();

        return Redirect::to('dashboard');
    }

    
}
