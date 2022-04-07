<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\UserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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
        
        $paginate = DB::table('users')
        ->join('addresses', 'addresses.id_address', '=', 'users.id_address')
        ->join('roles', 'roles.id_role', '=', 'users.id_role')
        ->join('essences', 'essences.id_essence', '=', 'users.id_essence')->orderBy('users.id_user')->paginate($paginateNumber);
        
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
            $request->getSurname(),
            $request->getPatronymic(),
            $request->getPhoneNumber(),
            $request->getTelegramId(),
            $request->getApproved(),
            $request->getRole(),
            $request->getEssence(),
            $request->getAddress()
        );

        $user->save();

        return response()->json(['messsage' => 'success', 'records' => $user], 200);

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
        $user = User::getById($request->getIdUser());

        $user->setNameIfNotEmpty($request->getName());
        $user->setSurnameIfNotEmpty($request->getSurname());
        $user->setPatronymicIfNotEmpty($request->getPatronymic());
        $user->setPhoneNumberIfNotEmpty($request->getPhoneNumber());
        $user->setTelegramIdIfNotEmpty($request->getTelegramId());
        $user->setApprovedIfNotEmpty($request->getApproved());
        $user->setRole($request->getRole());
        $user->setEssence($request->getEssence());
        $user->setAddress($request->getAddress());

        $user->save();

        
        $message = "";
        if($request->getApproved() == 1)
        {
            $message = sprintf("Здравствуйте, %s. Ваша регистрация восстановлена! Теперь вы можете оформлять пропуска для въезда автомобилей на территорию посёлка. Для заказа пропуска введите номер и марку машины", $user->getName());   
        }
        if($request->getApproved() == 2)
        {
            $message = sprintf("Здравствуйте, %s. Вы забанены!", $user->getName());   
        }

        $response = $user->SendMessage($message);
        return response()->json(['message' => 'success', 'records' => $response ?? $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user = User::getById($request->input('id_user'));
        $result = $user->delete();
        return response()->json(['message' => $result ? 'success' : 'error'], $result ? 200 : 500);
    }
}
