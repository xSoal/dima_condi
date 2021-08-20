<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json($users, 200);
    }


    public function add(Request $request){

        $request->validate([
            "name" => "string|required|unique:users",
            "email" => "string|required|unique:users",
            "password" => "string|required",
            "password_confirm" => "required|same:password"
        ]);


        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json( 'ok', 200);



    }

}
