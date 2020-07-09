<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['pic', 'given_name', 'family_name', 'dob', 'user_id', 'remove_pic'];

    public function getRouteKeyName()
    {
        return 'user_id';
    }
}
