<?php

namespace App\Http\Requests\MainRequests;

use App\Models\Address;
use App\Models\Essence;
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

    public function getSurname()
    {
        return $this->input('surname');
    }

    public function getPatronymic()
    {
        return $this->input('patronymic');
    }

    public function getPhoneNumber()
    {
        return $this->input('phone_number');
    }

    public function getTelegramId()
    {
        return $this->input('telegram_id');
    }

    public function getApproved()
    {
        return $this->input('approved');
    }

    public function getRole(): Role
    {
        return Role::getById($this->input('id_role'));
    }

    public function getEssence(): Essence
    {
        return Essence::getEssenceById($this->input('id_essence'));
    }

    public function getAddress(): Address
    {
        return Address::getAddressById($this->input('id_address'));
    }

    public function getIdUser()
    {
        return $this->input('id_user');
    }
}
