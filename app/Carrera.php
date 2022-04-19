<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Carrera extends Model
{
    use Notifiable, HasApiTokens;

    protected $table = "carreras";
}
