<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Essence;
use App\Models\Address;
use Exception;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'phone_number',
        'telegram_id',
        'approved',
        'id_role',
        'id_essence',
        'id_address'
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_user';

    public static function make(
        $name,
        $surname,
        $patronymic,
        $phone_number,
        $telegram_id,
        $approved,
        Role $role,
        Essence $essence,
        Address $address
    )
    {
        return User::query()->make([
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'phone_number' => $phone_number,
            'telegram_id' => $telegram_id,
            'approved' => $approved,
            'id_role' => $role->getId(),
            'id_essence' => $essence->getId(),
            'id_address' => $address->getId()
        ]);
    }

    public static function getById($id): User
    {
        return User::query()->where('id_user', $id)->firstOrFail();
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getSurname()
    {
        return $this->attributes['surname'];
    }

    public function getPatronymic()
    {
        return $this->attributes['patronymic'];
    }

    public function getPhoneNumber()
    {
        return $this->attributes['phone_number'];
    }

    public function getTelegramId()
    {
        return $this->attributes['telegram_id'];
    }

    public function getApproved()
    {
        return $this->attributes['approved'];
    }

    public function getEssence()
    {
        return Essence::getEssenceById($this->attributes['id_essence']);
    }

    public function getAddress()
    {
        return Address::getAddressById($this->attributes['id_address']);
    }

    public function setSurnameIfNotEmpty($surname)
    {
        if($surname != '')
        {
            $this->attributes['surname'] = $surname;
        }
    }

    public function setPatronymicIfNotEmpty($patronymic)
    {
        if($patronymic != '')
        {
            $this->attributes['patronymic'] = $patronymic;
        }
    }

    public function setPhoneNumberIfNotEmpty($phone_number)
    {
        if($phone_number != '')
        {
            $this->attributes['phone_number'] = $phone_number;
        }
    }

    public function setTelegramIdIfNotEmpty($telegram_id)
    {
        if($telegram_id != '')
        {
            $this->attributes['telegram_id'] = $telegram_id;
        }
    }

    public function setApprovedIfNotEmpty($approved)
    {
        if($approved != '')
        {
            $this->attributes['approved'] = $approved;
        }
    }

    public function setNameIfNotEmpty($name)
    {
        if($name != '')
        {
            $this->attributes['name'] = $name;
        }
    }

    public function setRole(Role $role)
    {
        if($role == null || !$role->exists || $role == '') return;
        $this->attributes['id_role'] = $role->getId();
    }

    public function setEssence(Essence $essence)
    {
        if($essence == null || !$essence->exists || $essence == '') return;
        $this->attributes['id_essence'] = $essence->getId();
    }

    public function setAddress(Address $address)
    {
        if($address == null ||!$address->exists || $address == '') return;
        $this->attributes['id_address'] = $address->getId();
    }

    public function getIdRole()
    {
        return $this->attributes['id_role'];
    }

    public function getRole(): Role
    {
        return Role::getById($this->attributes['id_role']);
    }

    public function checkRole(array|string $roles): bool
    {
        $result = false;

        $current_user_role_name = $this->getRole()->getNameRole();

        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($role == $current_user_role_name)
                {
                    $result = true;
                }
            }
        }
        elseif(is_string($roles) && $roles == $current_user_role_name)
        {
            $result = true;
        }

        return $result;
    }

    public function SendMessage(string $message)
    {
        try
        {
            $apiToken = env('BOT_TOKEN');
            $data = [
                'chat_id' => $this->getTelegramId(), 
                'text' => $message
            ];
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?".http_build_query($data));
            return $response;
        }
        catch(Exception $e){}
    }
}
