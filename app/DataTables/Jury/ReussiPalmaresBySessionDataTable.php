<?php

namespace App\DataTables\Jury;

use App\Models\Etudiants_succes;
use Yajra\DataTables\Services\DataTable;

class ReussiPalmaresBySessionDataTable extends DataTable
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
     * @param \App\Etudiant_succes $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Etudiants_succes $model)
    {
        return $model->JoinEtudiant()
                    ->EtudiantSuccesParSession($this->idsessions)
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
                    ->minifiedAjax(route('jury.showPalmaresByAuditoireAndSession',[$this->idsessions,$this->idauditoires]).'?param=R')
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
            'prenom',
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
        return 'Jury/ReussiPalmaresBySession_' . date('YmdHis');
    }

    public function getBtn($query){
        // onclick="event.preventDefault();document.getElementById(\'form-action'.$query->idetudiants_succes.'\').submit();" 
        return 
        '<a class="btn btn-success action-del" href="#" data-info="'.$query->idetudiants_succes.',">
        N\'A PAS REUSSI
        </a>

        <form id="form-action'.$query->idetudiants_succes.'" action="'. route("jury.etudiant_no_succes").'" method="POST" style="display: none;">
            '.csrf_field().'
           <input type="hidden" name="idetudiants_succes" value ='.$query->idetudiants_succes.' >

        </form>';
    }
}
