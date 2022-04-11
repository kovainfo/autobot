<?php

namespace App\Http\Requests\MainRequests;

use Illuminate\Foundation\Http\FormRequest;

class TelegramUserRequest extends FormRequest
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

    public function getName()
    {
        return $this->input('name');
    }

    public function getPhoneNumber()
    {
        return $this->input('phone_number');
    }

    public function getLotNumber()
    {
        return $this->input('lot_number');
    }

    public function getTelegramId()
    {
        return $this->input('telegram_id');
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
