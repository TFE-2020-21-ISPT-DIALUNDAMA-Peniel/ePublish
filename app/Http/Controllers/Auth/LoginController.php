<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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
    protected $redirectTo = '/';

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
     * Renvoi la vue de la page de connexion
     *
     * @return view
    */

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    /**
     * Définie le mode d'authentifiaction par username au lieu de email 
     *
     * @return void
    */
    
    public function username()
    {
        return 'username';
    }

    /**
     * Définie la logique de rédirection par rapport au rôle de l'utilisateur 
     *
     * @return string
    */

    protected function redirectTo()
    {

        return redirectToDashboard();
    }











    
}
