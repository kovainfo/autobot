<?php

namespace App\Http\Requests\MainRequests;

use Illuminate\Foundation\Http\FormRequest;

class RegCarsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getNumCar()
    {
        return $this->input('num_car');
    }

    public function getModel()
    {
        return $this->input('model');
    }

    public function getAddInfo()
    {
        return $this->input('add_info');
    }

    public function getOwner()
    {
        return $this->input('owner');
    }

    public function getDateTimeOrder()
    {
        return $this->input('dateTime_order');
    }


    public function getComment()
    {
        return $this->input('comment');
    }


    public function getApproved()
    {
        return $this->input('approved');
    }

    public function getIdRegCar()
    {
        return $this->input('id_reg_car');
    }
}
