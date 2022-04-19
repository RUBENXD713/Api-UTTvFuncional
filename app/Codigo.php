<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Codigo extends Model
{
    use Notifiable, HasApiTokens;

    protected $table = "codigos";
}
