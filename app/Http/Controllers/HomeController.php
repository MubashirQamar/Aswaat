<?php

namespace App\Http\Controllers;

use App\Album;
use App\Download;
use App\Favourite;
use App\MusicType;
use App\Package;
use App\Song;
use App\SubCategory;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->type)) {
            if ($request->type == 'soundtrack') {
                $data['music'] = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->get();
                $data['type'] = $request->type;
                $data['albums'] = SubCategory::with('category')->get();
            } else if ($request->type == 0) {
                $data['music'] = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->whereRaw("find_in_set('" . $request->id . "',albums.subcat_id)")
                    ->get();
                $data['type'] = 'soundtrack';
                $data['albums'] = SubCategory::with('category')->get();
            } else {
                $data['music'] = Song::songsfilterByMusicType($request->type);
                $data['type'] = $request->type;
                $data['albums'] = SubCategory::with('category')->get();
            }
        } else {
            $data['music'] = Song::songs();
            $data['type'] = 'music';

            $data['albums'] = SubCategory::with('category')->get();
        }

        $data['music_type'] = MusicType::get();
        return view('index', $data);
    }
    public function sound_effect()
    {
        $data['sound'] = DB::table('sub_categories')
            ->where('cat_id', '2')
            ->get();
        return view('sound_effect', $data);
    }
    public function sound_track()
    {

        $data['sound'] = DB::table('sub_categories')
            ->where('cat_id', '1')
            ->get();
        return view('sound_track', $data);
    }
    public function album($id)
    {
        $data['album'] = SubCategory::find($id);
        $data['music'] = DB::table('albums')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
            ->whereRaw("find_in_set('" . $id . "',albums.subcat_id)")
            ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
            ->get();
        return view('album', $data);
    }
    public function profile()
    {
        $date = date('Y-m-d');
        $q = Subscription::where('end_date',  '>=', $date)->where('status', 'Active')->get();

        $data['credit'] =  $totals = $q->sum('total_download') - $q->sum('use_download');

        $data['subscriber'] = Subscription::with('package')->where('user_id', Auth::user()->id)->where('status', 'Active')->orderBy('id', 'DESC')->first();
        $data['downloads'] = Download::downloads();
        $data['favourites'] = Favourite::favourites();
        $data['packages'] = Package::get();
        return view('home', $data);
    }
    public function package()
    {
        if (Auth::user()) {
            $check = Subscription::with('package')->where('user_id', Auth::user()->id)->where('status', 'Active')->orderBy('id', 'DESC')->count();
        } else {
            $check = 0;
        }
        if ($check != 0) {
            $data['modal'] = 1;
        } else {
            $data['modal'] = 0;
        }
        $data['packages'] = Package::get();
        return view('package', $data);
    }
    public function cart()
    {
        $date = date('Y-m-d');
        $q = Subscription::where('end_date',  '>=', $date)->where('status', 'Active')->get();
        $data['total_download'] = $q->sum('total_download');
        $data['use_download'] = $q->sum('use_download');
        $data['totals'] = $q->sum('total_download') - $q->sum('use_download');
        // return $data;
        return view('cart', $data);
    }

    public function payment()
    {
        return view('payment');
    }

    public function paymentMsg()
    {
        return view('paymentmsg');
    }


    function changeLang($langcode)
    {

        App::setLocale($langcode);
        session()->put("lang_code", $langcode);
        return redirect()->back();
    }
    public function contactus(){
        return view('contact');
    }
}
