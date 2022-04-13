<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_message',
        'message'
    ];

    public static function make($id_message, $message)
    {
        return Message::query()->make(['id_message'=> $id_message, 'message'=>$message]);
    }

    public function getMessageAttribute()
    {
        return $this->attributes['message'];
    }

    public function setMessageAttributeIfNotEmpty($message)
    {
        if($message != '')
        {
            $this->attributes['message'] = $message;
        }
    }

    public function getId()
    {
        return $this->attributes['id_message'];
    }

    public function getMessageById($id_message)
    {
        return Message::query()->where('id_message', $id_message)->firstOrFail();
    }
}
