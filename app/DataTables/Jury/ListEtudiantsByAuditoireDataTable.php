<?php

namespace App\DataTables\Jury;

use Yajra\DataTables\Services\DataTable;
use App\Models\Etudiant;    

class ListEtudiantsByAuditoireDataTable extends DataTable
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
                return $this->editorBtn($query);  
            }
            );
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Etudiant $model)
    {
        return $model::EtudiantParAuditoire($this->idauditoires)->get();
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
            'idauditoires',
            'statut'
        ];
    }


    
    protected function getBuilderParameters(){
        return [
            'dom' => 'flrtipB',
            'buttons' => ['print', 'excel','pdf'],
            'order' => [[1,'Asc']]
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jury/ListEtudiantsByAuditoire_' . date('YmdHis');
    }


    private function editorBtn(Etudiant $query){
        return '
        <div class = "inline">
                <button type="button" class="edit-modal btn btn-info" data-toggle="modal" data-target="#editModal"  data-info="'.$query->idetudiants.','.$query->matricule.','.$query->nom.','.$query->postnom.','.$query->prenom.','.$query->idauditoires.'">
                  <span class="fa fa-edit"></span> Edit
                </button>'
                .
                '<button class="delete-modal btn btn-danger" data-info="'.$query->idetudiants.','.$query->matricule.','.$query->nom.','.$query->postnom.','.$query->prenom.','.$query->idauditoires.'">
                 <span class="fa fa-trash"></span> Delete
                </button>
        </div>' ;
    }
}
