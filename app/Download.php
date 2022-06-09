<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Download extends Model
{
    //
    public function songs()
    {
        return $this->belongsTo('App\Song','song_id','id');
    }

    public static function downloads()
    {
       $downloads = Download::with('songs')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
     foreach($downloads as $download)
     {
         $artist_id=explode(',',$download->songs->artist_id);
         $music_id=explode(',',$download->songs->music_type_id);
         $genre_id=explode(',',$download->songs->genre_id);
         $instrument_id=explode(',',$download->songs->instrument_id);

         $download->songs->artist_name=Artist::whereIn('id',$artist_id)->get();
         $download->songs->music_type=MusicType::whereIn('id',$music_id)->get();
         $download->songs->genre=Genre::whereIn('id',$genre_id)->get();
         $download->songs->instrument=Instrument::whereIn('id',$instrument_id)->get();
     }
     return $downloads;
    }
}
