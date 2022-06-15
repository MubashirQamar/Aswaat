<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    public function package()
    {
        return $this->belongsTo('App\Package','package_id','id'); // links this->course_id to courses.id
    }
    public function user()
    {
        return $this->hasMany('App\User','id','user_id'); // links this->course_id to courses.id
    }
}
