<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_GUARD = 'guard';

    public $timestamps = false;

    public static function getBaseArray(): array
    {
        $result = [];
        $result[] = Role::ROLE_ADMIN;
        $result[] = ROle::ROLE_GUARD;

        return $result;
    }

    protected $fillable = [
        'id_role',
        'name_role'
    ];

    public static function make
    (
        $name_role
    )
    {
        return Role::query()->make([
            'name_role' => $name_role
        ]);
    }

    public function getNameRole()
    {
        return $this->attributes['name_role'];
    }

    public function getId()
    {
        return $this->attributes['id_role'];
    }

    public function setNameRoleIfNotEmpty($name_role)
    {
        if($name_role != '')
        {
            $this->attributes['name_role'] = $name_role;
        }
    }

    public static function getById($id_role): Role
    {
        return Role::query()->where('id_role', $id_role)->firstOrFail();
    }
}
