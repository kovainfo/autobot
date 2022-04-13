<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::query()->where('email',$request->input('email'))->where('password', $request->input('password'))->first();
        if($user != null){
            Auth::login($user);
            return redirect(route('index'));
        }
        else
        {
            return redirect(route('auth'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route("auth"));
    }

}
