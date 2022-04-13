<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\RegCarsRequest;
use App\Http\Requests\RegCarsRequestCreate;
use App\Http\Requests\RegCarsRequestUpdate;
use App\Models\RegCars;
use Illuminate\Http\Request;

class RegCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request  $request)
    {
        $paginate = RegCars::query()->paginate($request->input('limit'));

        return response()->json(['message' => 'success', 'records' => $paginate->items(), 'total' => $paginate->total()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegCarsRequestCreate $request)
    {
        $RegCars = RegCars::make(
            $request->getNumCar(),
            $request->getAddInfo(),
            $request->getDateTime(),
            $request->getAddress(),
            $request->getFullName(),
            $request->getPhoneNumber(),
            $request->getComment(),
            $request->getStatus(),
            $request->getApproved(),
            $request->getTelegramUserId(),
        );
        $RegCars->save();
        
        return response()->json(['message' => 'success', 'records' => $RegCars], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegCars  $RegCars
     * @return \Illuminate\Http\Response
     */
    public function show(RegCars $RegCars)
    {
        return response()->json(['message' => 'success', 'records' => $RegCars], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RegCarsRequestUpdate  $request
     * @param  \App\Models\RegCars  $RegCars
     * @return \Illuminate\Http\Response
     */
    public function update(RegCarsRequestUpdate $request, RegCars $RegCars)
    {
        $RegCars = RegCars::getRegCarsById($request->getId());

        $RegCars->setNumCarIfNotEmpty($request->getNumCar());
        $RegCars->setAddInfoIfNotEmpty($request->getAddInfo());
        $RegCars->setDateTimeIfNotEmpty($request->getDateTime());
        $RegCars->setAddressIfNotEmpty($request->getAddress());
        $RegCars->setFullNameIfNotEmpty($request->getFullName());
        $RegCars->setPhoneNumberIfNotEmpty($request->getPhoneNumber());
        $RegCars->setCommentIfNotEmpty($request->getComment());
        $RegCars->setStatusIfNotEmpty($request->getStatus());
        $RegCars->setApprovedIfNotEmpty($request->getApproved());
        $RegCars->setTelegramUserIdIfNotEmpty($request->getTelegramUserId());

        $RegCars->save();
        
        return response()->json(['message' => 'success', 'records' => $RegCars], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegCars  $RegCars
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegCars $RegCars)
    {
        $result = $RegCars->delete();
        return response()->json(['message' => $result ? 'success' : 'error'], $result ? 200 : 500);
    }


    
}
