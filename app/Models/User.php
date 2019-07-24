<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable 
{
	use Notifiable;
    protected $table = 'users';
    /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idusers';
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'username','name','first_name','email','password','idusers_roles','idsections'
    ];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Evénement éloquent lors de la creation d'un étudiant
     * l'année academique en cours est recuperée automatique
     */
    protected static function boot(){
        parent::boot();

        static::creating(function($user){
            $user->username = self::usernameUnique(str_slug($user->name, $separator = '-')); 
            $user->password = Hash::make('isptkin');

        });
    }



     public static function scopeJoinRole($query){

        return $query->leftJoin('users_roles','users.idusers_roles','=','users_roles.idusers_roles');

    }
    public static function scopeJoinSection($query){

        return $query->leftJoin('sections','users.idsections','=','sections.idsections');

    }



    // Génération de username unique
    private static function usernameUnique($username){
        if(self::where('username',$username)->first()){
            $complement  = random_int(1, 100);
            $username = $username.$complement;
            return self::usernameUnique($username);
        }
        return $username;
    }
    

}
