<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    //
    public function index()
    {
        $data['instruments']=Instrument::get();
        return view('admin.instrument.list',$data);
    }
    public function add()
    {
        return view('admin.instrument.add');
    }
    public function edit($id)
    {
        $data['instrument']=Instrument::find($id);
        return view('admin.instrument.edit',$data);
    }
    public function store(Request $request)
    {
        $instrument = new Instrument;
        // dd($request);
        $instrument->name = $request->name;

        $instrument->save();
        return redirect('/admin/instrument')->with('success', 'Instrument is successfully saved');
    }
    public function update($id, Request $request)
    {
        $instrument =  Instrument::find($id);;
        // dd($request);
        $instrument->name = $request->name;

        $instrument->save();
        return redirect('/admin/instrument')->with('success', 'Instrument is successfully Updated');
    }

    public function destroy($id)
    {
        $instrument = Instrument::where('id',$id);

        $instrument->delete();
        return back();
    }
}
