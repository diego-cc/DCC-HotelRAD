<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    // set fillable props
    protected $fillable = ['rate', 'description'];
}
