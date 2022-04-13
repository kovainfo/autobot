<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\UserRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Address;
use App\Models\Essence;
use App\Models\Role;
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
        ->join('essences', 'essences.id_essence', '=', 'users.id_essence')->orderBy('users.id_user', 'desc')->paginate($paginateNumber);
        
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
        $essence = new Essence();
        if(Essence::getEssenceByEmail($request->getEmail()) == null)
        {
            $essence = Essence::make(
                $request->getEmail(),
                $request->getPasswordAttribute()
            );
            $essence->save();
        }
        elseif(User::query()->where('id_essence', Essence::getEssenceByEmail($request->getEmail()))->first() == null)
        {
            $essence = Essence::getEssenceByEmail($request->getEmail());
        }
        else
        {
            return response()->json(['messsage' => 'The email has already been taken."'], 500);
        }

        $address = Address::query()->where('address', $request->getAddressAttribute())->first() != null ? Address::getAddressByAddressAttribute($request->getAddressAttribute()) : Address::make($request->getAddressAttribute());
        $address->save();

        $user = User::make(
            $request->getName(),
            $request->getSurname(),
            $request->getPatronymic(),
            $request->getPhoneNumber(),
            $request->getTelegramId(),
            $request->getApproved(),
            $request->getRole(),
            $essence,
            $address
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

        $address = $user->getAddress();
        $essence = $user->getEssence();

        if(Essence::getEssenceByEmail($request->getEmail()) != null && Essence::getEssenceByEmail($request->getEmail())->getId() != $essence->getId())
        {
            return response()->json(['messsage' => 'The email has already been taken."'], 500);
        }
        if(User::query()->where('id_essence', $essence->getId())->count() > 1)
        {
            $essence = Essence::make(
                $request->getEmail(),
                $request->getPasswordAttribute()
            );
            $essence->save();
        }

        $essence->setEmailIfNotEmpty($request->getEmail());
        $essence->setPasswordIfNotEmpty($request->getPasswordAttribute());

        if(Address::getAddressByAddressAttribute($request->getAddressAttribute()) != null)
        {
            $user->setAddress(Address::getAddressByAddressAttribute($request->getAddressAttribute()));
        }
        elseif($request->getAddressAttribute() != '')
        {
            $address =  Address::make($request->getAddressAttribute());
            $address->save();
            $user->setAddress($address);
        }

        $user->setNameIfNotEmpty($request->getName());
        $user->setSurnameIfNotEmpty($request->getSurname());
        $user->setPatronymicIfNotEmpty($request->getPatronymic());
        $user->setPhoneNumberIfNotEmpty($request->getPhoneNumber());
        $user->setTelegramIdIfNotEmpty($request->getTelegramId());
        $user->setRole($request->getRole());


        $response = $user;
        if($user->getApproved() != $request->getApproved())
        {
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
        }

        $user->setApprovedIfNotEmpty($request->getApproved());
        $address->save();
        $essence->save();
        $user->setEssence($essence);
        $user->save();

        return response()->json(['message' => 'success', 'records' => $response ?? $user], 200);
    }


    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addFiveRandomUsers(Request $request)
    {
        User::factory()->count(5)->create();
        return response()->json(['message' => 'success'], 200);
    }


    public function getUsersCount()
    {
        $count = User::query()->count();
        return response()->json(['message' => 'success', 'count' => $count], 200);
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
