<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public function package_detail()
    {
        return $this->hasMany('App\PackageDetail','package_id','id');
    }
}
