<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegCars extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'num_car',
        'add_info',
        'date_time',
        'address',
        'full_name',
        'phone_number',
        'comment',
        'status',
        'approved',
        'telegram_user_id'
    ];

    public static function make(
        $num_car,
        $add_info,
        $date_time,
        $address,
        $full_name,
        $phone_number,
        $comment,
        $status,
        $approved,
        $telegram_user_id
    )
    {
        return RegCars::query()->make([
            'num_car' => $num_car,
            'add_info' => $add_info,
            'date_time' => $date_time,
            'address' => $address,
            'full_name' => $full_name,
            'phone_number' => $phone_number,
            'comment' => $comment,
            'status' => $status,
            'approved' => $approved,
            'telegram_user_id' => $telegram_user_id
        ]);
    }

    public static function getRegCarsById($id): RegCars
    {
        return RegCars::query()->where('id', $id)->firstOrNew();
    }

    public function setNumCarIfNotEmpty($num_car)
    {
        if($num_car != '')
        {
            $this->attributes['num_car'] = $num_car;
        }
    }

    public function setAddInfoIfNotEmpty($add_info)
    {
        if($add_info != '')
        {
            $this->attributes['add_info'] = $add_info;
        }
    }

    public function setDateTimeIfNotEmpty($date_time)
    {
        if($date_time != '')
        {
            $this->attributes['date_time'] = $date_time;
        }
    }

    public function setAddressIfNotEmpty($address)
    {
        if($address != '')
        {
            $this->attributes['address'] = $address;
        }
    }

    public function setFullNameIfNotEmpty($full_name)
    {
        if($full_name != '')
        {
            $this->attributes['full_name'] = $full_name;
        }
    }

    public function setPhoneNumberIfNotEmpty($phone_number)
    {
        if($phone_number != '')
        {
            $this->attributes['phone_number'] = $phone_number;
        }
    }

    public function setCommentIfNotEmpty($comment)
    {
        if($comment != '')
        {
            $this->attributes['comment'] = $comment;
        }
    }

    public function setStatusIfNotEmpty($status)
    {
        if($status != '')
        {
            $this->attributes['status'] = $status;
        }
    }

    public function setApprovedIfNotEmpty($approved)
    {
        if($approved != '')
        {
            $this->attributes['approved'] = $approved;
        }
    }

    public function setTelegramUserIdIfNotEmpty($telegram_user_id)
    {
        if($telegram_user_id != '')
        {
            $this->attributes['telegram_user_id'] = $telegram_user_id;
        }
    }



    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getNumCar()
    {
        return $this->attributes['num_car'];
    }

    public function getAddInfo()
    {
        return $this->attributes['add_info'];
    }

    public function getDateTime()
    {
        return $this->attributes['date_time'];
    }

    public function getAddress()
    {
        return $this->attributes['address'];
    }

    public function getFullName()
    {
        return $this->attributes['full_name'];
    }

    public function getPhoneNumber()
    {
        return $this->attributes['phone_number'];
    }

    public function getComment()
    {
        return $this->attributes['comment'];
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function getApproved()
    {
        return $this->attributes['approved'];
    }

    public function getTelegramUserId()
    {
        return $this->attributes['telegram_user_id'];
    }
}
