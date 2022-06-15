<?php

namespace App\Http\Controllers\Admin;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Package;
use App\Song;
use App\Subscription;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index() {
        $data['artist']=Artist::count();
        $data['package']=Package::count();
        $data['subscriber']=Subscription::withcount('user')->groupBy('user_id')->get();
        $data['song']=Song::count();

        return view('admin.index',$data);
      }


}
