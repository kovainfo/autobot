<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
    ];

    public static function make($address)
    {
        return Address::query()->make(['address' => $address]);
    }

    public function setAddressIfNotEmpty($address)
    {
        if($address != '')
        {
            $this->attributes['address'] = $address;
        }
    }

    public function getAddressAttribute()
    {
        return $this->attributes['address'];
    }

    public function getId()
    {
        return $this->attributes['id_address'];
    }

    public static function getAddressById($id)
    {
        return Address::query()->where('id_address', $id)->firstOrFail();
    }
}
