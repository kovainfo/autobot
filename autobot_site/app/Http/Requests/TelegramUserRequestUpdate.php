<?php

namespace App\Http\Requests;

use App\Http\Requests\MainRequests\TelegramUserRequest;
use Illuminate\Foundation\Http\FormRequest;

class TelegramUserRequestUpdate extends TelegramUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
