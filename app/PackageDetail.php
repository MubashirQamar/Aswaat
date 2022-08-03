<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    //
    function package_content()
    {
        return $this->belongsTo(PackageContent::class, 'package_content_id', 'id');
    }
}
