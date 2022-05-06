<?php

namespace App\Http\Controllers;

use App\Models\Essence;
use App\Models\Role;
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
            $currentRole = $user->getRole()->getNameRole();
            if($currentRole == Role::ROLE_ADMIN)
            {
                return redirect(route('index'));
            }
            elseif($currentRole == Role::ROLE_GUARD)
            {
                //add security route
                return redirect(route('security'));
            }
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
