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

    public function getAddInfo()
    {
        return $this->input('add_info');
    }

    public function getDateTime()
    {
        return $this->input('date_time');
    }

    public function getFullName()
    {
        return $this->input('full_name');
    }

    public function getPhoneNumber()
    {
        return $this->input('phone_number');
    }

    public function getComment()
    {
        return $this->input('comment');
    }

    public function getStatus()
    {
        return $this->input('status');
    }

    public function getTelegramUserId()
    {
        return $this->input('telegram_user_id');
    }

    public function getAddress()
    {
        return $this->input('address');
    }

    public function getApproved()
    {
        return $this->input('approved');
    }

    public function getId()
    {
        return $this->input('id');
    }
}
