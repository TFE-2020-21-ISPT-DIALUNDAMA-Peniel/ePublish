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
        return datatables($query);
            // ->addColumn('action', 'jury/listetudiantsbyauditoire.action');
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
                    ->addAction([
                        'defaultContent' => $this->editorBtn(),
                        'data'           => 'action',
                        'name'           => 'action',
                        'title'          => 'Edition',
                        'orderable'      => false,
                        'searchable'     => false,
                        'exportable'     => false,
                        'printable'      => true,
                        'footer'         => '',
                    ])
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


    private function editorBtn(){
        return '<button class="edit-modal btn btn-info">
                    <span class="fa fa-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger">
                 <span class="fa fa-trash"></span> Delete
                </button>';
    }
}
