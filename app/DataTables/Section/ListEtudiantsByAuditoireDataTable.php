<?php

namespace App\DataTables\Section;

use App\Models\Etudiant;
use Yajra\DataTables\Services\DataTable;

class ListEtudiantsByAuditoireDataTable extends DataTable
{

    protected $printPreview = '';

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
                if ($query->active == 1) {
                    $btn = "btn btn-danger";
                    $txt  = "Désactiver";                       
                }else{
                    $btn = "btn btn-success";
                    $txt  = "Activer";
                }                     
                return '<button class="activate-code '.$btn.' btn-block" data-info="'.$query->idcodes.',">'.$txt.'</button>';

                 // return '<input class="activate-code" type="checkbox"'.$check.' data-toggle="toggle" data-on="Activer" data-off="Désactiver" data-onstyle="primary" data-offstyle="danger" data-info="'.$query->idcodes.',">';


                // return '<input  type="checkbox"'.$check.' data-toggle="toggle" data-on="Activer" data-off="Désactiver" data-onstyle="primary" data-offstyle="danger" onchange="document.getElementById(\'form-action'.$query->idcodes.'\' ).submit();" data-info="'.$query->idcodes.'">'
                //     .' '.
                //     '<form class="form-action" id="form-action'.$query->idcodes.'" action="'. route("section.code_activated").'" method="POST" style="display: none;">
                //          '.csrf_field().'
                //        <input type="hidden" name="idcodes" id="idcodes" value ='.$query->idcodes.' >

                //     </form>';


               
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
        return $model::EtudiantActif()
                       ->EtudiantParAuditoire($this->idauditoires)
                       ->EtudiantParSession($this->idsessions)
                       ->EtudiantCodeParSession($this->idsessions)
                       ->get();
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
                    ->addAction(['width' => '120px'])
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
            'prenom',
            'code',
            // 'active',
            // 'statut',
           
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Etudiants_NomAuditoire' . date('YmdHis');
    }

    protected function getBuilderParameters(){
        return [
            'dom' => 'flrtipB',
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
