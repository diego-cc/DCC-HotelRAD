<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    // set fillable props
    protected $fillable = ['name', 'description'];
}
