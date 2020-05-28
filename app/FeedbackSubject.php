<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackSubject extends Model
{
    // set fillable props
    protected $fillable = ['subject', 'description'];
}
