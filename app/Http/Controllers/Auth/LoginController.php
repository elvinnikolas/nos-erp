<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\lokasi;

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
    protected $redirectTo = '/home';

    protected function authenticated($request)
    {
        $user = auth()->user();
        $user->last_login = \Carbon\Carbon::now();
        $user->lokasi = $request->NamaLokasi;
        $user->save();
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

    public function username()
    {
        return 'name';
    }

    //override
    public function showLoginForm()
    {
        $lokasi = lokasi::where('Status', 'OPN')->get();
        return view('auth.login', compact('lokasi'));
    }
}
