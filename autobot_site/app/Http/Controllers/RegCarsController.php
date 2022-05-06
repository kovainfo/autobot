<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequests\RegCarsRequest;
use App\Http\Requests\RegCarsRequestCreate;
use App\Http\Requests\RegCarsRequestUpdate;
use App\Models\RegCars;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $paginateNumber = $request->input('limit') ?? 5;

        $paginate = DB::table('reg_cars')
        ->join('users', 'users.id_user', '=', 'reg_cars.id_user')->orderBy($request->input('sortBy') ?? 'reg_cars.id_reg_car', $request->input('direction') ?? 'desc');

        // $paginate = DB::table('reg_cars')
        // ->join('addresses', 'addresses.id_address', '=', 'users.id_address')
        // ->join('roles', 'roles.id_role', '=', 'users.id_role')
        // ->join('essences', 'essences.id_essence', '=', 'users.id_essence')->orderBy($request->input('sortBy') ?? 'users.id_user', $request->input('direction') ?? 'desc')->paginate($paginateNumber);
        
        if(!empty($request->input("num_car"))) {
            $paginate = $paginate->where("num_car", "like", '%' . $request->input("num_car") . '%');
        }

        if(!empty($request->input("dateTime_order"))) {
            $paginate = $paginate->where("dateTime_order", "like", '%' . $request->input("dateTime_order") . '%');
        }
        
        $paginate = $paginate->paginate($paginateNumber);

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
            $request->getModel(),
            $request->getOwner(),
            $request->getAddInfo(),
            $request->getDateTimeOrder(),
            $request->getComment(),
            $request->getApproved(),
            
        );
        $RegCars->save();
        
        return response()->json(['message' => 'success', 'records' => $RegCars], 200);
    }

    public function getCarsCount()
    {
        $count = RegCars::query()->count();
        return response()->json(['message' => 'success', 'count' => $count], 200);
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
        $RegCars = RegCars::getRegCarById($request->getIdRegCar());

        $RegCars->setNumCarIfNotEmpty($request->getNumCar());
        $RegCars->setModelIfNotEmpty($request->getModel());
        $RegCars->setOwnerIfNotEmpty($request->getOwner());
        $RegCars->setAddInfoIfNotEmpty($request->getAddInfo());
        $RegCars->setDateTimeOrderIfNotEmpty($request->getDateTimeOrder());
        $RegCars->setCommentIfNotEmpty($request->getComment());
        $RegCars->setApprovedIfNotEmpty($request->getApproved());
        


        $RegCars->save();

        $user = User::getById($RegCars->getIdUser());
        
        $message = "";
        if($request->getApproved() == 1)
        {
            $message = sprintf("Здравствуйте, %s. Ваша заявка на пропуск одобрена!", $user->getName());   
        }
        if($request->getApproved() == 2)
        {
            $message = sprintf("Здравствуйте, %s. Ваша заявка на пропуск отклонена!", $user->getName());   
        }

        $response = $user->SendMessage($message);

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
