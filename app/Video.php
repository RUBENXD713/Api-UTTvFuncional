<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Video extends Model
{
    use Notifiable, HasApiTokens;

    protected $table = "videos";
}
