<?php

namespace App\Http\Controllers;

use App\Album;
use App\Download;
use App\Favourite;
use App\Package;
use App\Song;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use ZipArchive;

class UserController extends Controller
{
    //
    public function updatePackage(Request $request)
    {
        if ($request->package == -1) {
            $user = Auth::user();
            $user->subscription_id = $request->package;
            $user->save();
            return redirect('/home');
        } else {
            $id = $request->package;
            $package = Package::where('id', $request->package)->first();
            session()->forget('package', []);
            $cart = session()->get('package', []);

            if (isset($cart[$id])) {
                // $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $package->id,
                    "name" => $package->name,
                    "price" => $package->price,
                ];
            }
            session()->put('package', $cart);
            return redirect('/payment');
            //
            // $sub = new Subscription;
            // $sub->user_id = Auth::user()->id;
            // $sub->package_id = $request->package;
            // $sub->total_download = $package->downloads;
            // $sub->use_download = 0;
            // $sub->status = 'Active';
            // $sub->start_date = date('Y-m-d');
            // $sub->end_date = date("Y-m-d", strtotime("+1 month"));
            // $sub->save();
            // $user = Auth::user();
            // $user->subscription_id = $sub->id;
            // $user->save();
            // return redirect('/home');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request)
    {
        $date = date('Y-m-d');
        $q = Subscription::where('user_id',Auth::user()->id)->where('end_date',  '>=', $date)->where('status','Active')->get();

        $totals = $q->sum('total_download') - $q->sum('use_download');

        $id = $request->id;
        $type = $request->type;
        $duration = $request->duration;
        if($type==1){
            $song = Album::findOrFail($id);
        }else{
        $song = Song::findOrFail($id);
        }
        $cart = session()->get('cart', []);

        if (isset($cart[$type][$id])) {

        } else {
            $grant_total = $totals - count($cart)  ;
            if ($grant_total > 0) {
                $cart[$type][$id]= [
                    "name" => $song->name,
                    "type" => $type,
                    "price" => $song->price,
                    "duration" => $duration,
                    "image" => $song->image
                ];
            } else if (Auth::user()->subscription_id == -1) {
                $cart[$type][$id] = [
                    "name" => $song->name,
                    "price" => $song->price,
                    "type" => $type,
                    "duration" => $duration,
                    "image" => $song->image
                ];
            } else {
                return Response::json(['data' => 'error','total' => $totals]);
                // return redirect()->back()->with('error', 'You can not add more');
            }
        }

        session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Song Name has been added to cart successfully!');
        return Response::json(['data' => 'Success','total' => $totals]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[0][$request->id])) {
                unset($cart[0][$request->id]);

                session()->put('cart', $cart);
                if(count($cart[0])== 0){
                    unset($cart[0]);
                    session()->put('cart', $cart);
                }
            }
            else if (isset($cart[1][$request->id])) {
                unset($cart[1][$request->id]);
                session()->put('cart', $cart);
                if(count($cart[1])== 0){
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


        if (count($cart) == 0) {
            return redirect('/home');
        }
        $zip = new ZipArchive;
        $fileName = 'Aswwat' . time() . '.zip';
        $date = date('Y-m-d');
        $filearray=array();


        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

            foreach ($cart as  $id => $detail) {
                foreach ($detail as  $key => $details) {
                $downloads = new Download;
                $downloads->song_id = $key;
                $downloads->user_id = Auth::user()->id;
                $downloads->type =$details['type'];
                $downloads->save();

                $sub = Subscription::where('user_id', Auth::user()->id)->where('end_date',  '>=', $date)->where('status','Active')->orderBy('id', 'ASC')->first();
                $use = $sub->use_download + 1;
                if($sub->total_download > $use){
                $sub->use_download +=  1;

                $sub->save();

                }else if($sub->total_download == $use)
                {
                $sub->use_download += 1;
                $sub->status = 'Inactive';

                $sub->save();

                }
                if($id != 1){
                    $song = Song::find($key);
                    if (isset($song->audio)) {
                        $zip->addFile(public_path('assets/images/songs/' . $song->audio), $song->audio);
                        array_push($filearray,asset('assets/images/songs/' . $song->audio));
                        // array_push($filearray,asset('assets/images/songs/' . $song->audio));
                    }
                    if (isset($song->image)) {
                        $zip->addFile(public_path('assets/images/songs/' . $song->image), $song->image);
                    }
                    if (isset($song->copyright)) {
                        $zip->addFile(public_path('assets/images/songs/' . $song->copyright), $song->copyright);
                    }
                    if (isset($song->file)) {
                        $zip->addFile(public_path('assets/images/songs/' . $song->file), $song->file);
                    }

                    }else{
                        $song = Album::find($key);
                        if (isset($song->audio)) {
                            $zip->addFile(public_path('assets/images/album/' . $song->audio), $song->audio);
                            array_push($filearray,asset('assets/images/album/' . $song->audio));
                        }
                        if (isset($song->image)) {
                            $zip->addFile(public_path('assets/images/album/' . $song->image), $song->image);
                        }
                        if (isset($song->copyright)) {
                            $zip->addFile(public_path('assets/images/album/' . $song->copyright), $song->copyright);
                        }
                        if (isset($song->file)) {
                            $zip->addFile(public_path('assets/images/album/' . $song->file), $song->file);
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

        // return redirect('/home?tab=downloads');
        // dd($filearray);
        return redirect('/home?tab=downloads')->with(['downloads_file' => $filearray]);
    }


    public function createDownloadZipFiles($id)
    {
        $zip = new ZipArchive;
        $fileName = 'myNewFile' . time() . '.zip';
        $song = Song::find($id);
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            if (isset($song->audio)) {
                $zip->addFile(public_path('assets/images/songs/' . $song->audio), $song->audio);
            }
            if (isset($song->image)) {
                $zip->addFile(public_path('assets/images/songs/' . $song->image), $song->image);
            }
            if (isset($song->copyright)) {
                $zip->addFile(public_path('assets/images/songs/' . $song->copyright), $song->copyright);
            }
            if (isset($song->file)) {
                $zip->addFile(public_path('assets/images/songs/' . $song->file), $song->file);
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
                    'status' => 'remove'
                ], 200);
            } else {
                $favourite = new Favourite;
                $favourite->user_id = Auth::user()->id;
                $favourite->type = $request->type;
                $favourite->song_id = $id;
                if ($favourite->save()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Success',
                        'status' => 'add'

                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => 'something goes wrong'], 400);
        }
    }

    public function updateProfile(Request $request)
    {

        if($request->password != '*****' && isset($request->password)){
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

}
