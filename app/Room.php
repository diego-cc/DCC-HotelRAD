<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['status_id', 'rate_id', 'room_number', 'floor', 'accessible', 'type'];
}
