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
        'id',
        'name'
    ];

    public static function make
    (
        $name
    )
    {
        return Role::query()->make([
            'name' => $name
        ]);
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setNameIfNotEmpty($name)
    {
        if($name != '')
        {
            $this->attributes['name'] = $name;
        }
    }

    public static function getById($id): Role
    {
        return Role::query()->where('id', $id)->firstOrFail();
    }
}
