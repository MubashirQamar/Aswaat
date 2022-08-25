<?php

namespace App\Http\Controllers;

use App\Album;
use App\Category;
use App\Download;
use App\Favourite;
use App\Package;
use App\Song;
use App\SubCategory;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class UserController extends Controller
{
    public function updatePackage(Request $request)
    {
        if ($request->package == 1) {
            $user = Auth::user();
            $user->subscription_id = $request->package;
            $user->save();

            return redirect('/home');
        } elseif ($request->package == 4) {
            return redirect('/contact');
        } else {
            $id = $request->package;
            $package = Package::where('id', $request->package)->first();
            session()->forget('package', []);
            $cart = session()->get('package', []);

            if (isset($cart[$id])) {
                // $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'id' => $package->id,
                    'name' => $package->name,
                    'price' => $package->price,
                ];
            }
            session()->put('package', $cart);

            return redirect('/payment');
            // return redirect('/freesubscribtion');
            //
        //     $sub = new Subscription;
        //     $sub->user_id = Auth::user()->id;
        //     $sub->package_id = $request->package;
        //     $sub->total_download = $package->downloads;
        //     $sub->sound_effects = $package->sound_effects;
        //     $sub->sound_tracks = $package->sound_tracks;
        //     $sub->use_download = 0;
        //     $sub->status = 'Active';
        //     $sub->start_date = date('Y-m-d');
        //     $sub->end_date = date("Y-m-d", strtotime("+1 month"));
        //     $sub->save();
        //     $user = Auth::user();
        //     $user->subscription_id = $sub->id;
        //     $user->save();
        //     return redirect('/home');
        }
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {
        $date = date('Y-m-d');
        $q = Subscription::where('user_id', Auth::user()->id)->where('end_date', '>=', $date)->where('status', 'Active')->get();

        $totals = $q->sum('total_download') - $q->sum('use_download');
        $effects = $q->sum('sound_effects') - $q->sum('use_effects');
        $tracks = $q->sum('sound_tracks') - $q->sum('use_tracks');

        $id = $request->id;
        $type = $request->type;
        $category = 0;
        $duration = $request->duration;
        $use_track=$tracks ;
        $use_effect= $effects;
        $session_use_track =  session()->get('use_tracks');
        $session_use_effect =  session()->get('use_effects');
        $total_track = 0;
        $total_effect = 0;
        if ($type == 1) {
            $song = Album::findOrFail($id);
            $album = SubCategory::with('category')->where('id',$song->subcat_id)->first();
           if(isset($album)){
            $category = $album->category->id;
            if( $category == 1){
                $session_use_track++;
                $total_track = $tracks - $session_use_track;

                session()->put('use_tracks', $session_use_track);

                if ($total_track <= 0) {
                    return Response::json(['data' => 'error', 'total' => $total_track]);
                }
            }
            if( $category == 2){
                $session_use_effect++;
                // return $session_use_effect;
                $total_effect = $effects - $session_use_effect;
                session()->put('use_effects', $session_use_effect);
                if ($total_effect <= 0) {
                    return Response::json(['data' => 'error', 'total' => $total_effect]);
                }
            }
         }
        } else {
            $song = Song::findOrFail($id);
        }
        $cart = session()->get('cart', []);

        if (isset($cart[$type][$id])) {
        } else {

            $grant_total = $totals - count($cart);
            if ($grant_total > 0) {

                $cart[$type][$id] = [
                    'name' => $song->name,
                    'type' => $type,
                    'price' => $song->price,
                    'duration' => $duration,
                    'image' => $song->image,
                    'cat_id' => $category,
                ];
            } elseif (Auth::user()->subscription_id == 1) {
                $cart[$type][$id] = [
                    'name' => $song->name,
                    'price' => $song->price,
                    'type' => $type,
                    'duration' => $duration,
                    'image' => $song->image,
                    'cat_id' => $category,
                ];
            } else {
                return Response::json(['data' => 'error', 'total' => $totals]);
                // return redirect()->back()->with('error', 'You can not add more');
            }
        }

        session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Song Name has been added to cart successfully!');
        return Response::json(['data' => 'Success', 'total' => $totals]);
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $session_use_track =  session()->get('use_tracks');
            $session_use_effect =  session()->get('use_effects');
            $cart = session()->get('cart');
            if (isset($cart[0][$request->id])) {
                unset($cart[0][$request->id]);

                session()->put('cart', $cart);
                if (count($cart[0]) == 0) {
                    unset($cart[0]);
                    session()->put('cart', $cart);
                }
            } elseif (isset($cart[1][$request->id])) {
                if(isset($cart[1][$request->id]['cat_id'])){
                    $cat=$cart[1][$request->id]['cat_id'];
                    if($cat == 1){
                        $session_use_track --;
                        session()->put('use_tracks', $session_use_track);
                    }
                    if($cat == 2 ){
                        $session_use_effect --;
                        session()->put('use_effects', $session_use_effect);
                    }
                }
                unset($cart[1][$request->id]);
                session()->put('cart', $cart);
                if (count($cart[1]) == 0) {
                    unset($cart[1]);
                    session()->put('cart', $cart);
                }
            }
            // session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        $session_use_track =  session()->get('use_tracks');
        $session_use_effect =  session()->get('use_effects');
        if (count($cart) == 0) {
            return redirect('/home');
        }
        $zip = new ZipArchive();
        $fileName = 'Aswwat'.time().'.zip';
        $date = date('Y-m-d');
        $filearray = [];

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === true) {
            foreach ($cart as $id => $detail) {
                foreach ($detail as $key => $details) {
                    $downloads = new Download();
                    $downloads->song_id = $key;
                    $downloads->user_id = Auth::user()->id;
                    $downloads->type = $details['type'];
                    $downloads->save();

                    $sub = Subscription::where('user_id', Auth::user()->id)->where('end_date', '>=', $date)->where('status', 'Active')->orderBy('id', 'ASC')->first();
                    $use = $sub->use_download + 1;
                    $use_tracks=$sub->use_tracks;
                    $use_effects= $sub->use_effects;
                    $cat = $details['cat_id'];
                    if($cat == 1){
                        $session_use_track --;
                       ++$sub->use_tracks ;
                       $sub->save();
                        session()->put('use_tracks', $session_use_track);
                    }
                    if($cat == 2 ){
                        $session_use_effect --;
                       ++ $sub->use_effects;
                       $sub->save();
                        session()->put('use_effects', $session_use_effect);
                    }
                    if ($sub->total_download > $use) {
                        ++$sub->use_download;

                        $sub->save();
                    } elseif ($sub->total_download == $use) {
                        ++$sub->use_download;
                        $sub->status = 'Inactive';

                        $sub->save();
                    }
                    if ($id != 1) {
                        $song = Song::find($key);
                        if (isset($song->audio)) {
                            $zip->addFile(public_path('assets/images/songs/'.$song->audio), $song->audio);
                            array_push($filearray, asset('assets/images/songs/'.$song->audio));
                            // array_push($filearray,asset('assets/images/songs/' . $song->audio));
                        }
                        if (isset($song->image)) {
                            $zip->addFile(public_path('assets/images/songs/'.$song->image), $song->image);
                        }
                        if (isset($song->copyright)) {
                            $zip->addFile(public_path('assets/images/songs/'.$song->copyright), $song->copyright);
                        }
                        if (isset($song->file)) {
                            $zip->addFile(public_path('assets/images/songs/'.$song->file), $song->file);
                        }
                    } else {
                        $song = Album::find($key);
                        if (isset($song->audio)) {
                            $zip->addFile(public_path('assets/images/album/'.$song->audio), $song->audio);
                            array_push($filearray, asset('assets/images/album/'.$song->audio));
                        }
                        if (isset($song->image)) {
                            $zip->addFile(public_path('assets/images/album/'.$song->image), $song->image);
                        }
                        if (isset($song->copyright)) {
                            $zip->addFile(public_path('assets/images/album/'.$song->copyright), $song->copyright);
                        }
                        if (isset($song->file)) {
                            $zip->addFile(public_path('assets/images/album/'.$song->file), $song->file);
                        }
                    }

                    unset($cart[$id][$key]);
                    session()->put('cart', $cart);
                }
                unset($cart[$id]);
                session()->put('cart', $cart);
            }

            $zip->close();
        }
        session()->put('use_tracks', 0);
        session()->put('use_effects', 0);
        // return redirect('/home?tab=downloads');
        // dd($filearray);
        return redirect('/home?tab=downloads')->with(['downloads_file' => $filearray]);
    }

    public function createDownloadZipFiles($id)
    {
        $zip = new ZipArchive();
        $fileName = 'myNewFile'.time().'.zip';
        $song = Song::find($id);
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === true) {
            if (isset($song->audio)) {
                $zip->addFile(public_path('assets/images/songs/'.$song->audio), $song->audio);
            }
            if (isset($song->image)) {
                $zip->addFile(public_path('assets/images/songs/'.$song->image), $song->image);
            }
            if (isset($song->copyright)) {
                $zip->addFile(public_path('assets/images/songs/'.$song->copyright), $song->copyright);
            }
            if (isset($song->file)) {
                $zip->addFile(public_path('assets/images/songs/'.$song->file), $song->file);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName));
    }

    public function addToFavourite(Request $request)
    {
        $id = $request->id;
        try {
            $fav = Favourite::where('user_id', Auth::user()->id)->where('song_id', $id)->first();
            if ($fav) {
                $fav->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Songs Remove Successfully.',
                    'status' => 'remove',
                ], 200);
            } else {
                $favourite = new Favourite();
                $favourite->user_id = Auth::user()->id;
                $favourite->type = $request->type;
                $favourite->song_id = $id;
                if ($favourite->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Success',
                        'status' => 'add',
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => 'something goes wrong'], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        if ($request->password != '*****' && isset($request->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back();
    }

    //  account setting
    public function setting()
    {
        return view('admin.setting');
    }

    public function updatesetting(Request $request)
    {
        if ($request->password != '*******' && isset($request->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Password is successfully saved');
    }
}
