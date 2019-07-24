<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\CRUDUsersRequest;
use App\Http\Requests\ActivationUserRequest;
use Flashy;


class UsersController extends Controller
{
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CRUDUsersRequest $request)
    {
        User::updateOrCreate([
                                    'idusers' => $request->idusers
                                ],
                                [
                                    'name' => $request->name,
                                    'first_name' => $request->first_name,
                                    'email' => $request->email, 
                                    'idsections' => $request->idsections,
                                    'idusers_roles' =>$request->idusers_roles
                                ]); 
 
        Flashy::success('Opération effectuée avec succès');
        return redirect()->back();          
    }

    public function activation(ActivationUserRequest $request){
        $user = User::find($request->idusers);
        $user->statut = $user->statut == 1 ? 0 : 1;
        $user->save();
        $statut = $user->statut == 1 ? 'activer' : 'désactiver';

        Flashy::message('Le compte de '.$user->name.' '.$user->first_name .' à été '.$statut. ' avec succès');
        return redirect()->back();

    }
}
