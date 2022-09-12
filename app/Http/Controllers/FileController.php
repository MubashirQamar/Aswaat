<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function file($folder,$file,Request $request)
    {
        return asset('assets/images'.$file);
    }
}
