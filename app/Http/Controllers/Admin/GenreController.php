<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    //it is a category of music

    public function index()
    {
        $data['genres']=Genre::get();
        return view('admin.genre.list',$data);
    }
    public function add()
    {
        return view('admin.genre.add');
    }
    public function edit($id)
    {
        $data['genre']=Genre::find($id);
        return view('admin.genre.edit',$data);
    }
    public function store(Request $request)
    {
        $genre = new Genre;
        // dd($request);
        $genre->name = $request->name;

        $genre->save();
        return redirect('/admin/genre')->with('success', 'Genre is successfully saved');
    }
    public function update($id, Request $request)
    {
        $genre =  Genre::find($id);;
        // dd($request);
        $genre->name = $request->name;

        $genre->save();
        return redirect('/admin/genre')->with('success', 'Genre is successfully Updated');
    }

    public function destroy($id)
    {
        $genre = Genre::where('id',$id);

        $genre->delete();
        return back();
    }
}
