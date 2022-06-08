<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'cat_id', 'id');
    }
}
