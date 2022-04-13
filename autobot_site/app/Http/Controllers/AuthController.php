<?php

namespace App\Http\Controllers;

use App\Models\Essence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $essence = Essence::query()->where('email',$request->input('email'))->where('password', $request->input('password'))->first();
        $user = null;
        if($essence != null)
        {
            $user = User::query()->where('id_essence', $essence->getId())->firstOrFail();
        }
        if($user != null){
            Auth::login($user, true);
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
