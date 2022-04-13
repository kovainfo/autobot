<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegCars extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'num_car',
        'model',
        'owner',
        'add_info',
        'dateTime_order',
        'comment',
        'approved',
        'id_user'
    ];

    public static function make(
        $num_car,
        $model,
        $owner,
        $add_info,
        $dateTime_order,
        $comment,
        $approved,
        $id_user
    )
    {
        return RegCars::query()->make([
            'num_car' => $num_car,
            'model' => $model,
            'owner' => $owner,
            'add_info' => $add_info,
            'dateTime_order' => $dateTime_order,
            'comment' => $comment,
            'approved' => $approved,
            'id_user' => $id_user->getId()
        ]);
    }
    
    public static function getRegCarById($id_reg_car): RegCars
    {
        return RegCars::query()->where('id_reg_car', $id_reg_car)->firstOrNew();
    }

    public function setNumCarIfNotEmpty($num_car)
    {
        if($num_car != '')
        {
            $this->attributes['num_car'] = $num_car;
        }
    }

    public function setModelIfNotEmpty($model)
    {
        if($model != '')
        {
            $this->attributes['model'] = $model;
        }
    }

    public function setAddInfoIfNotEmpty($add_info)
    {
        if($add_info != '')
        {
            $this->attributes['add_info'] = $add_info;
        }
    }

   public function getIdUser()
   {
       return $this->attributes['id_user'];
   }

    public function setOwnerIfNotEmpty($owner)
    {
        if($owner != '')
        {
            $this->attributes['owner'] = $owner;
        }
    }


    public function setDateTimeOrderIfNotEmpty($dateTime_order)
    {
        if($dateTime_order != '')
        {
            $this->attributes['dateTime_order'] = $dateTime_order;
        }
    }

    public function setCommentIfNotEmpty($comment)
    {
        if($comment != '')
        {
            $this->attributes['comment'] = $comment;
        }
    }


    public function setApprovedIfNotEmpty($approved)
    {
        if($approved != '')
        {
            $this->attributes['approved'] = $approved;
        }
    }

    
    public function setIdUser(id_user $id_user)
    {
        if($id_user == null ||!$id_user->exists || $id_user == '') return;
        $this->attributes['id_user'] = $id_user->getId();
    }

    


   

    public function getNumCar()
    {
        return $this->attributes['num_car'];
    }

    public function getModel()
    {
        return $this->attributes['model'];
    }

    public function getDateTimeOrder()
    {
        return $this->attributes['dateTime_order'];
    }

    public function getComment()
    {
        return $this->attributes['comment'];
    }

    public function getAddInfo()
    {
        return $this->attributes['add_info'];
    }

    
    protected $primaryKey = 'id_reg_car';


    public function getApproved()
    {
        return $this->attributes['approved'];
    }

    
    
}
