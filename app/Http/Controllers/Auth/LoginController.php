<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\RateLimiter;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    public function login(Request $request){
        // $this->clearLoginAttempts($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $input = $request->all();

        $this->validate($request, [
           'username' => 'required',
           'password' => 'required'
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password']))){
            $this->clearLoginAttempts($request);
            // RateLimiter::clear('login.'.$request->ip());
            // dd(auth()->user()->is_admin);
            if(auth()->user()->is_admin == 1){
                return redirect('admin');
            }else{
                Auth::logout();
                return redirect('login')->with('message', 'orguay');
            }
        }
        $this->incrementLoginAttempts($request);
        return redirect()->route('login');
    }

    public function showLoginform(Request $request){
        // $key = 'login.'.$request->ip();
        // return view('auth.login', [
        //     'key' => $key,
        //     'retries' => RateLimiter::retriesLeft($key, 3),
        //     'seconds' => RateLimiter::availableIn($key),
        // ]);
        return view('vendor.adminlte.auth.login');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
