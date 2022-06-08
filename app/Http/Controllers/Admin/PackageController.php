<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //list of packages
    public function index()
    {
        $data['packages'] = Package::get();
        return view('admin.package.list', $data);
    }

    //add page of packages

    public function add()
    {
        return view('admin.package.add');
    }

    //edit page of packages

    public function edit($id)
    {
        $data['package'] = Package::find($id);
        return view('admin.package.edit', $data);
    }

    //add new package

    public function store(Request $request)
    {
        $package = new Package;
        // dd($request);
        $package->name = $request->name;
        $package->downloads = $request->downloads;
        $package->price = $request->price;

        $package->save();
        return redirect('/admin/package')->with('success', 'Package is successfully saved');
    }

    //update package
    public function update($id, Request $request)
    {
        $package =  Package::find($id);;
        // dd($request);
        $package->name = $request->name;
        $package->downloads = $request->downloads;
        $package->price = $request->price;
        $package->save();
        return redirect('/admin/package')->with('success', 'Package is successfully Updated');
    }

    //delete package
    public function destroy($id)
    {
        $package = Package::where('id', $id);

        $package->delete();
        return back();
    }
}
