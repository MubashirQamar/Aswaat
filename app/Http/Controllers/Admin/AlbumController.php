<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Artist;
use App\Category;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    //
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }
    public function index()
    {
        $data['albums'] =  DB::table('albums')
        ->join('artists', 'artists.id', '=', 'albums.artist_id')
        ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
        ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
        ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
        ->get();
        return view('admin.album.list', $data);
    }
    public function add()
    {

        $data['category'] = Category::with('subcategory')->get();

        $data['artists'] = Artist::get();
        return view('admin.album.add', $data);
    }
    public function edit($id)
    {
        $data['category'] = Category::with('subcategory')->get();

        $data['artists'] = Artist::get();
        $data['album'] = Album::find($id);
        return view('admin.album.edit', $data);
    }
    public function store(Request $request)
    {
        // dd($request);
        $album = new Album;

        $album->name = $request->name;
        $album->subcat_id =  implode(",", $request->subcat_id);
        $album->artist_id =  $request->artist;
        $album->price =  $request->price;

        $album->sort_instrument = $request->instrument2;
        $album->sort_bpm = $request->bpm;
        $album->sort_duration = $request->duration;
        $album->tags = $request->tag;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('album');
            $image->move($path, $image_name);
            $album->image = $image_name;
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audio_name  = $this->media->getFileName($audio);
            $path  = $this->media->getProfilePicPath('album');
            $audio->move($path, $audio_name);
            $album->audio = $audio_name;
        }

        if ($request->hasFile('demo')) {
            $demo = $request->file('demo');
            $demo_name  = $this->media->getFileName($demo);
            $path  = $this->media->getProfilePicPath('album');
            $demo->move($path, $demo_name);
            $album->demo = $demo_name;
        }

        if ($request->hasFile('pdf_file')) {
            $pdf_file = $request->file('pdf_file');
            $pdf_file_name  = $this->media->getFileName($pdf_file);
            $path  = $this->media->getProfilePicPath('album');
            $pdf_file->move($path, $pdf_file_name);
            $album->file = $pdf_file_name;
        }

        if ($request->hasFile('copyright')) {
            $copyright = $request->file('copyright');
            $copyright_name  = $this->media->getFileName($copyright);
            $path  = $this->media->getProfilePicPath('album');
            $copyright->move($path, $copyright_name);
            $album->copyright = $copyright_name;
        }

        $album->save();
        return redirect('/admin/album')->with('success', 'Album is successfully saved');
    }
    public function update($id, Request $request)
    {
        $album =  Album::find($id);;
        // dd($request);
        $album->name = $request->name;
        $album->subcat_id =  implode(",", $request->subcat_id);
        $album->artist_id =  $request->artist;
        $album->price =  $request->price;
        $album->sort_instrument = $request->instrument2;
        $album->sort_bpm = $request->bpm;
        $album->sort_duration = $request->duration;
        $album->tags = $request->tag;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('album');
            $image->move($path, $image_name);
            $album->image = $image_name;
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audio_name  = $this->media->getFileName($audio);
            $path  = $this->media->getProfilePicPath('album');
            $audio->move($path, $audio_name);
            $album->audio = $audio_name;
        }

        if ($request->hasFile('demo')) {
            $demo = $request->file('demo');
            $demo_name  = $this->media->getFileName($demo);
            $path  = $this->media->getProfilePicPath('album');
            $demo->move($path, $demo_name);
            $album->demo = $demo_name;
        }

        if ($request->hasFile('pdf_file')) {
            $pdf_file = $request->file('pdf_file');
            $pdf_file_name  = $this->media->getFileName($pdf_file);
            $path  = $this->media->getProfilePicPath('album');
            $pdf_file->move($path, $pdf_file_name);
            $album->file = $pdf_file_name;
        }

        if ($request->hasFile('copyright')) {
            $copyright = $request->file('copyright');
            $copyright_name  = $this->media->getFileName($copyright);
            $path  = $this->media->getProfilePicPath('album');
            $copyright->move($path, $copyright_name);
            $album->copyright = $copyright_name;
        }

        $album->save();
        return redirect('/admin/album')->with('success', 'Album is successfully Updated');
    }

    public function destroy($id)
    {
        $album = Album::where('id', $id);

        $album->delete();
        return back();
    }
}
