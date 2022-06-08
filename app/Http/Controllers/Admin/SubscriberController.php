<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    //
    //list of subscribers
    public function index()
    {
        $data['subscribers'] = User::where('is_admin',0)->get();
        return view('admin.subscriber.list', $data);
    }

    //add page of subscribers

    public function add()
    {
        return view('admin.subscriber.add');
    }

    //edit page of subscribers

    public function edit($id)
    {
        $data['subscriber'] = User::find($id);
        return view('admin.subscriber.edit', $data);
    }

    //add new subscriber

    public function store(Request $request)
    {
        $subscriber = new User;
        // dd($request);
        $subscriber->name = $request->name;
        $subscriber->downloads = $request->downloads;
        $subscriber->price = $request->price;

        $subscriber->save();
        return redirect('/admin/subscriber')->with('success', 'Subscriber is successfully saved');
    }

    //update subscriber
    public function update($id, Request $request)
    {
        $subscriber =  User::find($id);;
        // dd($request);
        $subscriber->name = $request->name;
        $subscriber->downloads = $request->downloads;
        $subscriber->price = $request->price;
        $subscriber->save();
        return redirect('/admin/subscriber')->with('success', 'Subscriber is successfully Updated');
    }

    //delete subscriber
    public function destroy($id)
    {
        $subscriber = User::where('id', $id);

        $subscriber->delete();
        return back();
    }
}
