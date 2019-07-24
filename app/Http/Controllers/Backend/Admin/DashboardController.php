<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use App\Models\Auditoire;
use App\Models\Users_role;
use App\DataTables\Jury\ListEtudiantsByAuditoireDataTable; //INTERFACE JURY
use App\DataTables\Admin\GetUsersDataTable;

class DashboardController extends Controller
{
    /****
    * Affiche la liste des auditoires
    * Pour la liste des etudiants
    * Répartis par section 
    *
    ****/

    public function showAuditoiresEtudiant()
    {
        $route = route('admin.showAuditoires');
        // dd($route);
        
		return view('backend.jury.etudiantListe_auditoires',compact('route'));
        // return $dataTables->render('backend.jury.liste_auditoires');
    }

    public function showEtudiantsByAuditoires(Auditoire $auditoire, ListEtudiantsByAuditoireDataTable $dataTables)
    {
        // $auditoires = Auditoire::getAuditoireGroupBySection();
        return $dataTables->with(['idauditoires' => $auditoire->idauditoires])
                            ->render('backend.jury.liste_etudiants',['auditoire'=>$auditoire]);

        // return view('backend.jury.liste_auditoires',compact('auditoires'));
    }


    public function getUser(Users_role $users_roles,GetUsersDataTable $dataTables){
        return $dataTables->with(['idusers_roles' => $users_roles->idusers_roles])
                            ->render('backend.admin.liste_utilisateurs',compact('users_roles'));
    }
}
