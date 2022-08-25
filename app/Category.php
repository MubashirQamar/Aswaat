<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //1 Sound Tracks
    //2 Sound Effects
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'cat_id', 'id');
    }

    public function getcat($id)
    {
      return  DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->where('sub_categories.id', $id)
                    ->first();
    }
}
