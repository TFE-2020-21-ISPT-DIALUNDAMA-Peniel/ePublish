<?php

namespace App\DataTables\Jury;

use App\Models\Etudiant;
use App\Models\Bulletin;
use App\Http\Controllers\Gestions\BulletinsController;
use Yajra\DataTables\Services\DataTable;

class ListeBulletinByAuditoireAndSessionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action',function($query){
                if ($bulletin = Bulletin::where('idetudiants',$query->idetudiants)->where('idsessions',$this->idsessions)->first()){
                    $action = '<button type="button" class="showBulletin addModal btn btn-info btn-block" data-toggle="modal" data-target="#showBulletin" data-info="'.$bulletin->idbulletins.'">
         <i class=" fas fa-eye"> Afficher</i>
    </button>';
                }else{
                    $action = '<a href="#UploadBulletin" type="button" class="btn btn-success btn-block uploadBulletin" > <i class=" fas fa-upload"> Télécharger </i>';
                }

                // $btn = !empty($bulletin->idbulletins) ? '' : 'disabled';
                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Etudiant $model)
    {
        return $model::EtudiantParAuditoire($this->idauditoires)
                       ->EtudiantParSession($this->idsessions)
                       // ->EtudiantGetBulletin($this->idsessions)
                       // ->where('bulletins.idsessions',$this->idsessions)
                       // ->orWhere('bulletins.idsessions',null)
                       ->get([
                            'etudiants.idetudiants',
                            'etudiants.matricule',
                            'etudiants.nom',
                            'etudiants.postnom',
                            'etudiants.prenom',
                        ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'matricule',
            'nom',
            'postnom',
            'prenom'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jury/ListeBulletinByAuditoireAndSession_' . date('YmdHis');
    }

        protected function getBuilderParameters(){
        return [
            
            'buttons' => [
                            $this->paramBtn('print','Imprimer'),
                            $this->paramBtn('pdf','PDF'),
                            $this->paramBtn('excel','Excel')

                ],
            'order' => [[1,'Asc']]
        ];
    }


    /**
     * parametres des attribut de btn.
     *
     * @return array
     */

    private function paramBtn($type,$name='Imprimer'){
        return [
                                'extend' => $type,
                                'filename' => 'Liste - '.$this->auditoires_lib,
                                'title' => "CODES D'ACCES",
                                'message' => $this->auditoires_lib,
                                'text' => $name,
                                'exportOptions' => [
                                                    'columns' => ':visible'
                                                    ],

                            ];
    }
}
