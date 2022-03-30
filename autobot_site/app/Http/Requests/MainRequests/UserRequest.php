<?php

namespace App\Http\Requests\MainRequests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function getEmail()
    {
        return $this->input('email');
    }
    public function getRole(): Role
    {
        return Role::getById($this->input('role_id'));
    }
    public function getPasswordInput()
    {
        return $this->input('password');
    }
    public function getId()
    {
        return $this->input('id');
    }
}
