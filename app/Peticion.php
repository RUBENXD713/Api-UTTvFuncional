<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Peticion extends Model
{
    use Notifiable, HasApiTokens;
    protected $table = "peticiones";
    public function users()
    {
        return $this->hasOne('App\User');
        //un producto tiene una persona
    }
}
