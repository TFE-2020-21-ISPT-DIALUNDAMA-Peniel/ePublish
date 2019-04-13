<?php

namespace App\DataTables\Section;

use App\Models\Auditoire;
use Yajra\DataTables\Services\DataTable;

class ListAuditoiresBySectionDataTable extends DataTable
{

    protected $actions = ['print', 'excel'];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        // dd(datatables($query));
        return datatables($query)
                                ->addColumn('action',function($query){
                                   return '<a href='.route("section.show_auditoire",[$this->idsessions,$query->idauditoires]).'>Afficher</a>';
                                });



    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Auditoire $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Auditoire $model)
    {
        return $model::GetAuditoireBySection($this->idsections)->get();
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
            // 'idauditoires',
            [
                'name' => 'lib',
                'data' => 'lib',
                'title' => 'Auditoires',
                'searchable' => false,
                'orderable' => false,
                'footer' => 'lib',
                'exportable' => true,
                'printable' => true,
            ]
          
        ];
    }

    protected function getBuilderParameters(){
        return [
            'paging' => false,
            'searching' => false,
            'info' => false,
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Auditoires_' . date('YmdHis');
    }
}

