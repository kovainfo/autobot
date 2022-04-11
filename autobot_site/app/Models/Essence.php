<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Essence extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
    ];

    public function make(
        $email,
        $password
    )
    {
        return Essence::query()->make([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function setEmailIfNotEmpty($email)
    {
        if($email != '')
        {
            $this->attributes['email'] = $email;
        }
    }

    public function setPasswordIfNotEmpty($password)
    {
        if($password != '')
        {
            $this->attributes['password'] = $password;
        }
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }

    public function getId()
    {
        return $this->attributes['id_essence'];
    }

    public static function getEssenceById($id)
    {
        return Essence::query()->where('id_essence', $id)->firstOrFail();
    }
}
