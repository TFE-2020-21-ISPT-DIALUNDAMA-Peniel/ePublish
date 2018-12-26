<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    	'username','name','first_name','email','password','idusers_roles'
    ];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];





}
