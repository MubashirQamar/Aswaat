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
        $songs = Song::withCount('downloads')->orderBy('downloads_count','desc')->orderBy('id', 'DESC')->get();

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

    public static function songsSortfilterByMusicType($sort=null,$instrument=null,$bpm=null,$duration=null)
    {
       $songs = Song::withCount('downloads');
        if(is_numeric($instrument) == 1)
        {
            $songs  = $songs->where('sort_instrument',$instrument);
        }
        if(is_numeric($bpm) == 1)
        {
            $songs  = $songs->where('sort_bpm',$bpm);
        }
        if(is_numeric($duration) == 1)
        {
            $songs  = $songs->where('sort_duration',$duration);
        }
        if($sort == 'top'){
            $songs  = $songs->orderBy('downloads_count','desc');
        }else{
            $songs  = $songs->orderBy('id','desc');
        }
        $songs  = $songs->get();
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
    public static function songsSortSearchfilterByMusicType($sort=null,$instrument=null,$bpm=null,$duration=null,$search)
    {
       $songs = Song::withCount('downloads');
        if(is_numeric($instrument) == 1)
        {
            $songs  = $songs->where('sort_instrument',$instrument);
        }
        if(is_numeric($bpm) == 1)
        {
            $songs  = $songs->where('sort_bpm',$bpm);
        }
        if(is_numeric($duration) == 1)
        {
            $songs  = $songs->where('sort_duration',$duration);
        }
        if($sort == 'top'){
            $songs  = $songs->orderBy('downloads_count','desc');
        }else{
            $songs  = $songs->orderBy('id','desc');
        }
        $songs  = $songs->where('tags', 'LIKE', "%{$search}%")->get();
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
    public static function songsSearchfilterByMusicType($search)
    {
       $songs = Song::withCount('downloads')->where('tags', 'LIKE', "%{$search}%")->orderBy('downloads_count','desc')->get();

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

}
