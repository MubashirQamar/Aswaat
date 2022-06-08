<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Container\CommonContainer;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    protected $media;

    public function __construct(CommonContainer $media)
    {
        return $this->media = $media;
    }
    public function index()
    {
        $data['subcategory']=SubCategory::get();
        return view('admin.subcategory.list',$data);
    }
    public function add()
    {
        $data['category']=Category::get();
        return view('admin.subcategory.add',$data);
    }
    public function edit($id)
    {
        $data['category']=Category::get();
        $data['subcategory']=SubCategory::find($id);
        return view('admin.subcategory.edit',$data);
    }
    public function store(Request $request)
    {
        $subcategory = new SubCategory;
        // dd($request);

        $subcategory->name = $request->name;
        $subcategory->cat_id = $request->cat_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('subcategory');
            $image->move($path, $image_name);
            $subcategory->image = $image_name;
        }

        $subcategory->save();
        return redirect('/admin/sub-category')->with('success', 'SubCategory is successfully saved');
    }
    public function update($id, Request $request)
    {
        $subcategory =  SubCategory::find($id);;
        $subcategory->cat_id = $request->cat_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name  = $this->media->getFileName($image);
            $this->media->unlinkProfilePic($subcategory->image, 'subcategory');
            $path  = $this->media->getProfilePicPath('subcategory');
            $image->move($path, $image_name);
            $subcategory->image = $image_name;
        }
        $subcategory->name = $request->name;
        $subcategory->save();
        return redirect('/admin/sub-category')->with('success', 'SubCategory is successfully Updated');
    }

    public function destroy($id)
    {
        $subcategory = SubCategory::where('id',$id);
        if (isset($subcategory->image)) {
            $this->media->unlinkProfilePic($subcategory->image, 'subcategory');
        }
        $subcategory->delete();
        return back();
    }
}
