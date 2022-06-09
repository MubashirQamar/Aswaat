<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    //
    public function downloads()
    {
        return $this->hasMany('App\Download','song_id','id');
    }

    public static function songs()
    {
        $songs = Song::withCount('downloads')->orderBy('downloads_count','desc')->get();

     foreach($songs as $song)
     {
         $artist_id=explode(',',$song->artist_id);
         $music_id=explode(',',$song->music_type_id);
         $genre_id=explode(',',$song->genre_id);
         $instrument_id=explode(',',$song->instrument_id);

         $song->artist_name=Artist::whereIn('id',$artist_id)->get();
         $song->music_type=MusicType::whereIn('id',$music_id)->get();
         $song->genre=Genre::whereIn('id',$genre_id)->get();
         $song->instrument=Instrument::whereIn('id',$instrument_id)->get();
     }
     return $songs;
    }
    public static function songsfilterByMusicType($music_type_id)
    {
       $songs = Song::withCount('downloads')->orderBy('downloads_count','desc')->get();

     foreach($songs as $song)
     {
         $artist_id=explode(',',$song->artist_id);
         $music_id=explode(',',$song->music_type_id);
         $genre_id=explode(',',$song->genre_id);
         $instrument_id=explode(',',$song->instrument_id);

         $song->artist_name=Artist::whereIn('id',$artist_id)->get();
         $song->music_type=MusicType::where('id',$music_type_id)->get();
         $song->genre=Genre::whereIn('id',$genre_id)->get();
         $song->instrument=Instrument::whereIn('id',$instrument_id)->get();
     }
     return $songs;
    }
}
