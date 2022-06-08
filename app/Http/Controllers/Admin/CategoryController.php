<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $data['category']=Category::get();
        return view('admin.category.list',$data);
    }
    public function add()
    {
        return view('admin.category.add');
    }
    public function edit($id)
    {
        $data['category']=Category::find($id);
        return view('admin.category.edit',$data);
    }
    public function store(Request $request)
    {
        $category = new Category;
        // dd($request);
        $category->name = $request->name;

        $category->save();
        return redirect('/admin/category')->with('success', 'Category is successfully saved');
    }
    public function update($id, Request $request)
    {
        $category =  Category::find($id);;
        // dd($request);
        $category->name = $request->name;

        $category->save();
        return redirect('/admin/category')->with('success', 'Category is successfully Updated');
    }

    public function destroy($id)
    {
        $category = Category::where('id',$id);

        $category->delete();
        return back();
    }
}
