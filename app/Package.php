<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    public function package_detail()
    {
        return $this->hasMany('App\PackageDetail', 'package_id', 'id');
    }
    function package_Content()
    {
        return $this->hasMany(PackageDetail::class, 'package_id', 'id');
    }
}
