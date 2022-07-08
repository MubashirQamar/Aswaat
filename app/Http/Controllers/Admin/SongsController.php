<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\Container\CommonContainer;
use App\Download;
use App\Favourite;
use App\Genre;
use App\Http\Controllers\Controller;
use App\Instrument;
use App\MusicType;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
{
    //
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }

    public function index()
    {


        $data['songs'] = Song::songs();

        return view('admin.songs.list', $data);
    }

    //add page of songss

    public function add()
    {
        $data['artists'] = Artist::get();
        $data['instruments'] = Instrument::get();
        $data['genres'] = Genre::get();
        $data['music_type'] = MusicType::get();
        return view('admin.songs.add', $data);
    }

    //edit page of songss

    public function edit($id)
    {
        $data['song'] = Song::find($id);
        $data['artists'] = Artist::get();
        $data['instruments'] = Instrument::get();
        $data['genres'] = Genre::get();
        $data['music_type'] = MusicType::get();
        return view('admin.songs.edit', $data);
    }

    //add new songs

    public function store(Request $request)
    {
        $songs = new Song;

        $songs->name = $request->name;
        $songs->artist_id = trim(implode(",", $request->artist));
        $songs->music_type_id = trim(implode(",", $request->music_type));
        $songs->genre_id = trim(implode(",", $request->genre));
        $songs->instrument_id = trim(implode(",", $request->instrument));
        $songs->price = $request->price;
        $songs->sort_instrument = $request->instrument2;
        $songs->sort_bpm = $request->bpm;
        $songs->sort_duration = $request->duration;
        $songs->tags = $request->tag;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('songs');
            $image->move($path, $image_name);
            $songs->image = $image_name;
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audio_name  = $this->media->getFileName($audio);
            $path  = $this->media->getProfilePicPath('songs');
            $audio->move($path, $audio_name);
            $songs->audio = $audio_name;
        }

        if ($request->hasFile('demo')) {
            $demo = $request->file('demo');
            $demo_name  = $this->media->getFileName($demo);
            $path  = $this->media->getProfilePicPath('songs');
            $demo->move($path, $demo_name);
            $songs->demo_audio = $demo_name;
        }

        if ($request->hasFile('pdf_file')) {
            $pdf_file = $request->file('pdf_file');
            $pdf_file_name  = $this->media->getFileName($pdf_file);
            $path  = $this->media->getProfilePicPath('songs');
            $pdf_file->move($path, $pdf_file_name);
            $songs->file = $pdf_file_name;
        }

        if ($request->hasFile('copyright')) {
            $copyright = $request->file('copyright');
            $copyright_name  = $this->media->getFileName($copyright);
            $path  = $this->media->getProfilePicPath('songs');
            $copyright->move($path, $copyright_name);
            $songs->copyright = $copyright_name;
        }

        $songs->save();
        return redirect('/admin/songs')->with('success', 'Songs is successfully saved');
    }

    //update songs
    public function update($id, Request $request)
    {
        $songs =  Song::find($id);;
        // dd($request);
        $songs->name = $request->name;
        $songs->artist_id = implode(", ", $request->artist);
        $songs->music_type_id = implode(", ", $request->music_type);
        $songs->genre_id = implode(", ", $request->genre);
        $songs->instrument_id = implode(", ", $request->instrument);
        $songs->price = $request->price;
        $songs->sort_instrument = $request->instrument2;
        $songs->sort_bpm = $request->bpm;
        $songs->sort_duration = $request->duration;
        $songs->tags = $request->tag;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('songs');
            $image->move($path, $image_name);
            $songs->image = $image_name;
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audio_name  = $this->media->getFileName($audio);
            $path  = $this->media->getProfilePicPath('songs');
            $audio->move($path, $audio_name);
            $songs->audio = $audio_name;
        }
        if ($request->hasFile('demo')) {
            $demo = $request->file('demo');
            $demo_name  = $this->media->getFileName($demo);
            $path  = $this->media->getProfilePicPath('songs');
            $demo->move($path, $demo_name);
            $songs->demo_audio = $demo_name;
        }
        if ($request->hasFile('pdf_file')) {
            $pdf_file = $request->file('pdf_file');
            $pdf_file_name  = $this->media->getFileName($pdf_file);
            $path  = $this->media->getProfilePicPath('songs');
            $pdf_file->move($path, $pdf_file_name);
            $songs->file = $pdf_file_name;
        }

        if ($request->hasFile('copyright')) {
            $copyright = $request->file('copyright');
            $copyright_name  = $this->media->getFileName($copyright);
            $path  = $this->media->getProfilePicPath('songs');
            $copyright->move($path, $copyright_name);
            $songs->copyright = $copyright_name;
        }
        $songs->save();
        return redirect('/admin/songs')->with('success', 'Songs is successfully Updated');
    }

    //delete songs
    public function destroy($id)
    {
        $songs = Song::where('id', $id);
        if (isset($songs->image)) {
            $this->media->unlinkProfilePic($songs->image, 'songs');
        }
        if (isset($songs->audio)) {
            $this->media->unlinkProfilePic($songs->audio, 'songs');
        }
        if (isset($songs->file)) {
            $this->media->unlinkProfilePic($songs->file, 'songs');
        }
        if (isset($songs->copyright)) {
            $this->media->unlinkProfilePic($songs->copyright, 'songs');
        }
        Download::where('type','0')->where('song_id',$id)->delete();
        Favourite::where('type','0')->where('song_id',$id)->delete();
        $songs->delete();
        return back();
    }

    public function downloadzip()
    {
    }
}
