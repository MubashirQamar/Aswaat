<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favourite extends Model
{
    //
    public function songs()
    {
        return $this->belongsTo('App\Song','song_id','id');
    }
    public static function favourites()
    {
       $favourites = Favourite::with('songs')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
     foreach($favourites as $favourite)
     {
         $artist_id=explode(',',$favourite->songs->artist_id);
         $music_id=explode(',',$favourite->songs->music_type_id);
         $genre_id=explode(',',$favourite->songs->genre_id);
         $instrument_id=explode(',',$favourite->songs->instrument_id);

         $favourite->songs->artist_name=Artist::whereIn('id',$artist_id)->get();
         $favourite->songs->music_type=MusicType::whereIn('id',$music_id)->get();
         $favourite->songs->genre=Genre::whereIn('id',$genre_id)->get();
         $favourite->songs->instrument=Instrument::whereIn('id',$instrument_id)->get();
     }
     return $favourites;
    }
}
