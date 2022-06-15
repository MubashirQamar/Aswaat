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
        $type = 0;
        $sort = 0;
        $scroll=0;
        $data['sort'] = 'top';
        $data['instrument'] = 3;
        $data['bpm'] = 0;
        $data['duration'] = 0;
        if (isset($request->sort)) {
            $scroll=1;
            $sort = 1;
            $data['sort'] = $request->sort;
            $data['instrument'] = $request->instrument;
            $data['bpm'] = $request->bpm;
            $data['duration'] = $request->duration;
        }
        $data['music_type_id'] = 0;
        if (isset($request->type)) {
            //  fetch sound track
            $scroll=1;
            if ($request->type == 'soundtrack' && $sort == 0) {
                $data['music'] = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->get();
                $type = 1;
                $data['type'] = $request->type;
                $data['albums'] = SubCategory::with('category')->get();
            }
            //  fetch sound track by sorting
            else if (isset($request->sort) && $request->type == 'soundtrack') {
                $music = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name');
                if (is_numeric($request->instrument) == 1) {
                    $music  = $music->where('sort_instrument', $request->instrument);
                } else {
                    $music  = $music->where('sort_instrument', 3);
                }
                if (is_numeric($request->bpm) == 1) {
                    $music  = $music->where('sort_bpm', $request->bpm);
                }
                if (is_numeric($request->duration) == 1) {
                    $music  = $music->where('sort_duration', $request->duration);
                }
                if ($request->sort == 'top') {
                    $music  = $music->orderBy('id', 'desc');
                } else {
                    $music  = $music->orderBy('id', 'desc');
                }
                $music = $music->get();

                $data['music'] = $music;
                $data['type'] = 'soundtrack';
                $data['albums'] = SubCategory::with('category')->get();
            }
            //  fetch albums
            else if ($request->type == 0 && $request->type != 'music' &&  $sort == 0) {
                $data['music'] = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->whereRaw("find_in_set('" . $request->id . "',albums.subcat_id)")
                    ->get();
                $data['type'] = 0;
                $data['music_type_id'] = $request->id;
                $data['albums'] = SubCategory::with('category')->get();
            }
            //  fetch album  by sorting
            else if ($request->type == 0 && $request->type != 'music' &&  $sort == 1 && isset($request->music_type_id)) {
                $music = DB::table('albums')
                    ->join('artists', 'artists.id', '=', 'albums.artist_id')
                    ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                    ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                    ->whereRaw("find_in_set('" . $request->music_type_id . "',albums.subcat_id)");

                if (is_numeric($request->instrument) == 1) {
                    $music  = $music->where('albums.sort_instrument', $request->instrument);
                }
                if (is_numeric($request->bpm) == 1) {
                    $music  = $music->where('albums.sort_bpm', $request->bpm);
                }
                if (is_numeric($request->duration) == 1) {
                    $music  = $music->where('albums.sort_duration', $request->duration);
                }
                if ($request->sort == 'top') {
                    $music  = $music->orderBy('albums.id', 'desc');
                } else {
                    $music  = $music->orderBy('albums.id', 'desc');
                }
                $music = $music->get();

                $data['music'] = $music;
                $data['music_type_id'] = $request->music_type_id;
                $data['type'] = 0;
                $data['albums'] = SubCategory::with('category')->get();
                // return 'ff';
            }
            //  fetch music by sorting
            else if (isset($request->sort) && $request->type == 'music') {
                $data['music'] = Song::songsSortfilterByMusicType($request->sort, $request->instrument, $request->bpm, $request->duration);
                $data['type'] = $request->type;
                $data['albums'] = SubCategory::with('category')->get();
            }
            //  fetch music by music type id
            else {

                $data['music'] = Song::songsfilterByMusicType($request->type);
                $data['type'] = $request->type;
                $data['albums'] = SubCategory::with('category')->get();
            }
        }
        //  fetch music
        else {
            $data['music'] = Song::songs();
            $data['type'] = 'music';

            $data['albums'] = SubCategory::with('category')->get();
        }
        if (Auth::user()) {
            $data['favourite'] = Favourite::where('user_id', Auth::user()->id)->where('type', $type)->get()->pluck('song_id')->toArray();
        } else {
            $data['favourite'] = array();
        }
        $data['scroll'] = $scroll;
        $data['music_type'] = MusicType::get();
        // return $data;
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
    public function album(Request $request, $id)
    {
        $sort = 0;

        $data['sort'] = 'top';

        $data['instrument'] = 3;
        $data['bpm'] = 0;
        $data['duration'] = 0;
        if (isset($request->sort)) {
            $sort = 1;
            $data['sort'] = $request->sort;
            $data['instrument'] = $request->instrument;
            $data['bpm'] = $request->bpm;
            $data['duration'] = $request->duration;
        }

        $data['album'] = SubCategory::find($id);
        if ($sort == 1) {
            $music = DB::table('albums')
                ->join('artists', 'artists.id', '=', 'albums.artist_id')
                ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                ->whereRaw("find_in_set('" . $id . "',albums.subcat_id)");

            if (is_numeric($request->instrument) == 1) {
                $music  = $music->where('albums.sort_instrument', $request->instrument);
            }
            if (is_numeric($request->bpm) == 1) {
                $music  = $music->where('albums.sort_bpm', $request->bpm);
            }
            if (is_numeric($request->duration) == 1) {
                $music  = $music->where('albums.sort_duration', $request->duration);
            }
            if ($request->sort == 'top') {
                $music  = $music->orderBy('albums.id', 'desc');
            } else {
                $music  = $music->orderBy('albums.id', 'desc');
            }
            $music = $music->get();

            $data['music'] = $music;
        } else {
            $data['music'] = DB::table('albums')
                ->join('artists', 'artists.id', '=', 'albums.artist_id')
                ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
                ->whereRaw("find_in_set('" . $id . "',albums.subcat_id)")
                ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
                ->get();
        }

        return view('album', $data);
    }
    public function profile(Request $req)
    {
        $date = date('Y-m-d');
        $q = Subscription::where('end_date',  '>=', $date)->where('status', 'Active')->get();
         $data['tab']="profile";
            if(isset($req->tab)){
                $data['tab']=$req->tab;
            }

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
          $data['packages'] = Package::with('package_detail')->get();
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
    public function contactus()
    {
        return view('contact');
    }
    public function search(Request $request)
    {
        $sort = 0;
        $data['sort'] = 'top';
        $data['instrument'] = 3;
        $data['bpm'] = 0;
        $data['duration'] = 0;
        $count=0;
        $search = $data['search'] = $request->searchmusic;
        if (isset($request->sort)) {
            $sort = 1;
            $data['sort'] = $request->sort;
            $data['instrument'] = $request->instrument;
            $data['bpm'] = $request->bpm;
            $data['duration'] = $request->duration;
            $albums = DB::table('albums')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
            ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
            ->where('tags', 'LIKE', "%{$search}%");

        if (is_numeric($request->instrument) == 1) {
            $albums  = $albums->where('albums.sort_instrument', $request->instrument);
        }
        if (is_numeric($request->bpm) == 1) {
            $albums  = $albums->where('albums.sort_bpm', $request->bpm);
        }
        if (is_numeric($request->duration) == 1) {
            $albums  = $albums->where('albums.sort_duration', $request->duration);
        }
        if ($request->sort == 'top') {
            $albums  = $albums->orderBy('albums.id', 'desc');
        } else {
            $albums  = $albums->orderBy('albums.id', 'desc');
        }
        $albums = $albums->get();
        $data['albums'] = $albums;
         $music = $data['music'] = Song::songsSortSearchfilterByMusicType($request->sort, $request->instrument, $request->bpm, $request->duration,$search);
        $count+=count($albums);
        $count+=count($music);
        }else{
            $albums =  $data['albums'] = DB::table('albums')
            ->join('artists', 'artists.id', '=', 'albums.artist_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'albums.subcat_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.cat_id')
            ->select('albums.*', 'artists.name AS artist_name', 'categories.name AS cat_name')
            ->where('tags', 'LIKE', "%{$search}%")
            ->get();
            $music =   $data['music'] = Song::songsSearchfilterByMusicType($search);
            $count+=count($albums);
            $count+=count($music);
        }

        if (Auth::user()) {
            $data['favourite'] = Favourite::where('user_id', Auth::user()->id)->where('type', 0)->get()->pluck('song_id')->toArray();
        } else {
            $data['favourite'] = array();
        }
         $data['count']=$count;


        return view('search', $data);
    }
    public function terms()
    {
        return view('terms');
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function about()
    {
        return view('about_us');
    }
}
