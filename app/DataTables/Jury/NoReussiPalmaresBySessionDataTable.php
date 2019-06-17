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
                                   return '<a href='.route("jury.etudiant_succes",[$query->idetudiants,$this->idsessions]).' class="btn btn-success">A REUSSI</a>';
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
}
