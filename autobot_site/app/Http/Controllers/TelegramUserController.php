<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\TelegramUserRequest;
use App\Http\Requests\TelegramUserRequestCreate;
use App\Http\Requests\TelegramUserRequestUpdate;
use App\Models\TelegramUser;
use Illuminate\Http\Request;

class TelegramUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $paginate = TelegramUser::query()->paginate($request->input('limit'));

        return response()->json(['message' => 'success', 'records' => $paginate->items(), 'total' => $paginate->total()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TelegramUserRequestCreate $request)
    {
        $telegramUser = TelegramUser::make(
            $request->getName(),
            $request->getPhoneNumber(),
            $request->getLotNumber(),
            $request->getTelegramId(),
            $request->getApproved()
        );
        $telegramUser->save();
        
        return response()->json(['message' => 'success', 'records' => $telegramUser], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TelegramUser  $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function show(TelegramUser $telegramUser)
    {
        return response()->json(['message' => 'success', 'records' => $telegramUser], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TelegramUserRequestUpdate  $request
     * @param  \App\Models\TelegramUser  $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function update(TelegramUserRequestUpdate $request, TelegramUser $telegramUser)
    {
        $telegramUser = TelegramUser::getTelegramUserById($request->getId());

        $telegramUser->setNameIfNotEmpty($request->getName());
        $telegramUser->setPhoneNumberIfNotEmpty($request->getPhoneNumber());
        $telegramUser->setLotNumberIfNotEmpty($request->getLotNumber());
        $telegramUser->setTelegramIdIfNotEmpty($request->getTelegramId());
        $telegramUser->setApprovedIfNotEmpty($request->getApproved());

        $telegramUser->save();
        
        return response()->json(['message' => 'success', 'records' => $telegramUser], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TelegramUser  $telegramUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TelegramUser $telegramUser)
    {
        $result = $telegramUser->delete();
        return response()->json(['message' => $result ? 'success' : 'error'], $result ? 200 : 500);
    }
}
