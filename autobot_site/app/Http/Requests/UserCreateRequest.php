<?php

namespace App\Http\Requests;

use App\Http\Requests\MainRequests\UserRequest;
use App\Models\Essence;
use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends UserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}
