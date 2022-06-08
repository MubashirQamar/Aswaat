<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MusicType;
use Illuminate\Http\Request;

class MusicTypeController extends Controller
{
    //

    public function index()
    {
        $data['musics']= MusicType::get();
        return view('admin.music_type.list',$data);
    }
    public function add()
    {
        return view('admin.music_type.add');
    }
    public function edit($id)
    {
        $data['music']= MusicType::find($id);
        return view('admin.music_type.edit',$data);
    }
    public function store(Request $request)
    {
        $music = new MusicType;
        // dd($request);
        $music->name = $request->name;

        $music->save();
        return redirect('/admin/music-type')->with('success', 'Music Type is successfully saved');
    }
    public function update($id, Request $request)
    {
        $music =  MusicType::find($id);;
        // dd($request);
        $music->name = $request->name;

        $music->save();
        return redirect('/admin/music-type')->with('success', 'Music Type is successfully Updated');
    }

    public function destroy($id)
    {
        $music = MusicType::where('id',$id);

        $music->delete();
        return back();
    }


}
