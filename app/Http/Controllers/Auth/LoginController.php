<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Subscription;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo()
    {
        $role = Auth::user()->is_admin;
        switch ($role) {
          case '1':
            return '/admin';
            break;
          case '0':
            return '/home';
            break;

          default:
            return '/';
          break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (auth()->attempt([$fieldType => $input['email'], 'password' => $input['password']])) {
            $role = Auth::user()->is_admin;
            $checkpack = Subscription::where('user_id', Auth::user()->id)->where('status', 'Active')->get();
            switch ($role) {
              case '1':
                return redirect()->route('admin');
                break;
              case '0':
                session()->put('use_tracks', 0);
                session()->put('use_effects', 0);
                if (count($checkpack) != 0) {
                    return redirect('/home');
                } elseif (Auth::user()->subscription_id == 1) {
                    return redirect('/home');
                } else {
                    return redirect('/packages');
                }
                break;

              default:
                return '/';
              break;
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}
