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
                                   return '<a href='.route("jury.etudiant_no_succes",[$query->idetudiants_succes]).' class="btn btn-success">N\'A PAS REUSSI</a>';
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
}
