<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'lot_number',
        'telegram_id',
        'approved'
    ];

    public static function make(
        $name,
        $phone_number,
        $lot_number,
        $telegram_id,
        $approved
    )
    {
        return TelegramUser::query()->make([
            'name' => $name,
            'phone_number' => $phone_number,
            'lot_number' => $lot_number,
            'telegram_id' => $telegram_id,
            'approved' => $approved
        ]);
    }

    public static function getTelegramUserById($id): TelegramUser
    {
        return TelegramUser::query()->where('id', $id)->firstOrNew();
    }

    public function setNameIfNotEmpty($name)
    {
        if($name != '')
        {
            $this->attributes['name'] = $name;
        }
    }

    public function setPhoneNumberIfNotEmpty($phone_number)
    {
        if($phone_number != '')
        {
            $this->attributes['phone_number'] = $phone_number;
        }
    }

    public function setLotNumberIfNotEmpty($lot_number)
    {
        if($lot_number != '')
        {
            $this->attributes['lot_number'] = $lot_number;
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

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function getPhoneNumber()
    {
        return $this->attributes['phone_number'];
    }

    public function getLotNumber()
    {
        return $this->attributes['lot_number'];
    }

    public function getTelegramId()
    {
        return $this->attributes['telegram_id'];
    }

    public function getApproved()
    {
        return $this->attributes['approved'];
    }

    public function getId()
    {
        return $this->attributes['id'];
    }
}
