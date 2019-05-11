<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CRUDEtudiantRequest;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Flashy;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // -------------------------------------------------
        return '-----------------------------';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CRUDEtudiantRequest $request)
    {
        Etudiant::updateOrCreate([
                                    'idetudiants' => $request->idetudiants,'matricule' => $request->matricule
                                ],
                                [
                                    'nom' => $request->nom,'postnom' => $request->postnom,'prenom' => $request->prenom, 'idauditoires' => $request->idauditoires
                                ]); 
        // if (request()->ajax()) {
        //     return response()->json(['success'=>'Etudiant ajouter avec succès']);
        // }   
          //---------------------------------------------------------------
         //
        // AJOUT DE FLASHY
       //------------------------------------------------------------------- 
        Flashy::success('Etudiant ajouter avec succès');
        return redirect()->back();          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idetudiants)
    {
        dd('d');
        Etudiant::destroy($idetudiants);
        return response()->json(['success'=>'Etudiant supprimer avec succès.']);
    }
}
