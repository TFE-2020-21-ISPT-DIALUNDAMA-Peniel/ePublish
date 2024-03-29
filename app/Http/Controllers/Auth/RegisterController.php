<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:45|unique:users',
            'name' => 'required|string|max:65',
            'first_name' => 'required|string|max:65',
            'email' => 'required|string|email|max:65|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'idusers_roles' => 'required|int',
            // 'idsessions' => 'required|digits',

        ]);
    }

     public function showRegistrationForm()
    {
        return view('backend.auth.login');  
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'idusers_roles' => $data['idusers_roles'],

        ]);
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
