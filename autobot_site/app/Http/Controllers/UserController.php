<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\UserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginateNumber = $request->input('limit') ?? 5;

        $paginate = User::query()->paginate($paginateNumber);
        
        return response()->json(['message' => 'success', 'records' => $paginate->items(), 'total' => $paginate->total()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::make(
            $request->getName(),
            $request->getEmail(),
            $request->getPasswordInput(),
            $request->getRole()
        );

        $user->save();

        return response()->json(['messsage' => 'success', 'records' => $user], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['message' => 'success', 'records' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user = User::getById($request->getId());

        $user->setNameIfNotEmpty($request->getName());
        $user->setEmailIfNotEmpty($request->getEmail());
        $user->setPasswordfNotEmpty($request->getPasswordInput());
        $user->setRole($request->getRole());

        $user->save();

        return response()->json(['message' => 'success', 'records' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user = User::getById($request->input('id'));
        $result = $user->delete();
        return response()->json(['message' => $result ? 'success' : 'error'], $result ? 200 : 500);
    }
}
