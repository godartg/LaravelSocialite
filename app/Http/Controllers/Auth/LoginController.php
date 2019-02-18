<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver($provider)->scopes(["https://www.googleapis.com/auth/drive"])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        
        $user = User::updateOrCreate(   ['email'        =>  $userLogin->email], 
                                        ['refresh_token'=>  $userLogin->token],
                                        ['name'         =>  $userLogin->name]);
        
        // $user->token;
        Auth::Login($user, true);
        return redirect($this->redirectTo);
    }
    public function logout(request $request){
        session('g_token', '');
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect($redirectTo);
    }
}
