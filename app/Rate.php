<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    // set fillable props
    protected $fillable = ['rate', 'description'];

    // prevent eloquent from setting the updated_at timestamp on create
    public $timestamps = false;
}
