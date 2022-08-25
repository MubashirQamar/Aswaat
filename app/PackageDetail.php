<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageDetail extends Model
{
    use SoftDeletes;

    public function package_content()
    {
        return $this->belongsTo(PackageContent::class, 'package_content_id', 'id');
    }
}
