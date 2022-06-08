<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use Illuminate\Http\Request;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    //
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }

    public function index()
    {
        $data['artists'] = Artist::get();
        return view('admin.artist.list',$data);
    }
    public function add()
    {
        return view('admin.artist.add');
    }
    public function store(Request $request)
    {
        $artist = new Artist;
        // dd($request);
        $artist->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('artist');
            $image->move($path, $name);
            $artist->img = $name;
        }
        $artist->save();
        return redirect('/admin/artist')->with('success', 'Artist is successfully saved');
    }


    public function edit($id)
    {
        $data['artist'] = Artist::find($id);
        return view('admin.artist.edit',$data);
    }

    public function update($id, Request $request)
    {
        $artist =  Artist::find($id);;
        // dd($request);
        $artist->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $this->media->unlinkProfilePic($artist->img,'artist');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('artist');
            $image->move($path, $name);
            $artist->img = $name;
        }
        $artist->save();
        return redirect('/admin/artist')->with('success', 'Artist is successfully Updated');
    }

    public function destroy($id)
    {
        $artist = Artist::where('id',$id);
        if(isset($artist->img)){
            $this->media->unlinkProfilePic($artist->img,'artist');
        }
        $artist->delete();
        return back();
    }
}
