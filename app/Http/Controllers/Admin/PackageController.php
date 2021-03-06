<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\PackageContent;
use App\PackageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data['pack_desc'] = PackageContent::get();
        return view('admin.package.add',$data);
    }

    //edit page of packages

    public function edit($id)
    {
        // $data['pack_desc'] = PackageContent::get();
        $data['pack_desc']=DB::select('SELECT * FROM package_contents  WHERE package_contents.id NOT IN (SELECT package_details.package_content_id FROM package_details WHERE package_details.package_id='.$id.' )');
        $data['package'] = Package::find($id);
        $data['package_detail'] = PackageDetail::with('package_content')->where('package_id',$id)->get();
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

        if(count($request->package_detail_id) != 0 ){
            for ($i=0; $i < count($request->package_detail_id) ; $i++) {
                # code...
                $package_detail=new PackageDetail;
                $package_detail->package_id=$package->id;
                $package_detail->package_content_id=$request->package_detail_id[$i];
                $package_detail->status=$request->status[$i];
                $package_detail->save();
            }

        }

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

        if(count($request->package_detail_id) != 0 ){
            DB::table('package_details')->where('package_id', $id)->delete();

            for ($i=0; $i < count($request->package_detail_id) ; $i++) {
                # code...
                $package_detail=new PackageDetail;
                $package_detail->package_id=$package->id;
                $package_detail->package_content_id=$request->package_detail_id[$i];
                $package_detail->status=$request->status[$i];
                $package_detail->save();
            }

        }

        return redirect('/admin/package')->with('success', 'Package is successfully Updated');
    }

    //delete package
    public function destroy($id)
    {
        $package = Package::where('id', $id);

        $package->delete();
        return back();
    }


    //  Package Description
    public function packageDesc(){
        $data['pack_desc'] = PackageContent::get();
        return view('admin.package.package_details',$data);
    }

    public function packageDescStore(Request $request){
        $pack = new PackageContent;
        $pack->description = $request->content;
        $pack->save();
        return redirect('admin/pack/description')->with('success', 'Package Description is successfully saved');
    }
    public function packageDescUpdate(Request $request){
        $pack = PackageContent::find($request->id);
        $pack->description = $request->content;
        $pack->save();
        return redirect('admin/pack/description')->with('success', 'Package Description is successfully Updated');

    }
    public function packageDescdestroy($id){
        $package = PackageContent::where('id', $id);

        $package->delete();
        return back();
    }
}
