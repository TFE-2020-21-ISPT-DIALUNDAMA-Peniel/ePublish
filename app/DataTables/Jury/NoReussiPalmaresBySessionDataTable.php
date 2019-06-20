<?php

namespace App\DataTables\Jury;

use App\Models\Etudiant;
use Yajra\DataTables\Services\DataTable;

class NoReussiPalmaresBySessionDataTable extends DataTable
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
            ->addColumn('action', function($query){
                                   return $this->getBtn($query);
                                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Etudiant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Etudiant $model)
    {
        return $model::EtudiantActif()
                       ->EtudiantParAuditoire($this->idauditoires)
                       ->EtudiantNonSuccesParSession($this->idsessions)
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
                    ->minifiedAjax(route('jury.showPalmaresByAuditoireAndSession',[$this->idsessions,$this->idauditoires]).'?param=NR')
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
            'idetudiants',
            'matricule',
            'nom',
            'postnom',
            'prenom'
        ];
    }

    protected function getBuilderParameters(){
        return [
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jury/NoReussiPalmaresBySession_' . date('YmdHis');
    }

    public function getBtn($query){
           // onclick="event.preventDefault();document.getElementById(\'form-action'.$query->idetudiants.'\' ).submit();"
        return 
        '<a class="btn btn-success action-add"  href="#" data-info="'.$query->idetudiants.','.$this->idsessions.'">
        A REUSSI
        </a>

        <form class="form-action" id="form-action'.$query->idetudiants.'" action="'. route("jury.etudiant_succes").'" method="POST" style="display: none;">
             '.csrf_field().'
           <input type="hidden" name="idetudiants" id="idetudiants" value ='.$query->idetudiants.' >
           <input type="hidden" name="idsessions" id="idsessions" value ='.$this->idsessions.' >

        </form>';
    }
}
