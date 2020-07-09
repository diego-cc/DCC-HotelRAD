<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $primaryKey = 'type';
    public function getKeyName()
    {
        return 'type';
    }

    protected $fillable = ['description'];

    // All available room types
    public const SINGLE = 1;
    public const DOUBLE = 2;
    public const TRIPLE = 3;
}
