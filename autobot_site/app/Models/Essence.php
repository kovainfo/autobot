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

    public $timestamps = false;

    protected $primaryKey = 'id_essence';

    public static function make(
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
        return $this->id_essence;
    }

    public static function getEssenceById($id)
    {
        return Essence::query()->where('id_essence', $id)->firstOrFail();
    }

    public static function getEssenceByEmail($email)
    {
        return Essence::query()->where('email', $email)->first();
    }

}
