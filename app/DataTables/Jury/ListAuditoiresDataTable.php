<?php

namespace App\DataTables\Jury;

use App\Models\Auditoire;
use Yajra\DataTables\Services\DataTable;

class ListAuditoiresDataTable extends DataTable
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
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Auditoire $model)
    {
       return $model->newQuery()->select('idauditoires', 'lib');
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
                    ->addAction(['width' => '80px']);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'lib'
          
        ];
    }

    protected function getBuilderParameters(){
        return [
            'dom' => 'Bfrtip',
            'buttons' => ['print', 'excel','copy'],
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
        return 'Jury/ListAuditoires_' . date('YmdHis');
    }
}
