<?php

namespace App\DataTables\Jury;

use App\Models\Auditoire;
use Yajra\DataTables\Services\DataTable;

class ListeAuditoireDataPublicationDataTable extends DataTable
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
            ->addColumn('action', 'jury/listeauditoiredatapublication.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Auditoire $model)
    {
        foreach ($model::get() as $auditoire) {
           $data[] = $model::getStatPublication($this->idsessions,$auditoire->idauditoires);
        }
        return $data;
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
            'lib',
            'nbrEtudiant',
            'nbrBulletin',
           
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
        return 'Jury/ListeAuditoireDataPublication_' . date('YmdHis');
    }
}
