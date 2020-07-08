<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['pic', 'given_name', 'family_name', 'dob', 'user_id'];

    public function getRouteKeyName()
    {
        return 'user_id';
    }
}
