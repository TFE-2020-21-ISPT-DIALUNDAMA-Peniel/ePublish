<?php

namespace App\DataTables\Jury;

use App\Models\Publication;
use Yajra\DataTables\Services\DataTable;

class ListePublicationsBySessionDataTable extends DataTable
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
                if ($query->statut == 0){
                    $badge = '<span class="badge badge-pill badge-danger">Suspendu</span></h5>';
                    $btn = '<button type="button" class="btn btn-primary">Publier</button>';
                    $statut = 'suspendu';
                }else if ($query->statut == 1){
                    $badge = '<span class="badge badge-pill badge-success">Publié</span></h5>';
                    $btn = '<button type="button" class="btn btn-primary">Suspendre</button>';
                    $statut = 'publier';

                }else if ($query->statut == 2){
                    $badge = '<span class="badge badge-pill badge-warning">Planifié</span></h5>';
                    $btn = '<button type="button" class="btn btn-primary">Publier</button>';
                    $statut = 'planifier';

                }


                return $badge . '  <i class=" fas fa-edit" ></i><button type="button" class="edit-modal btn btn-info" data-toggle="modal" data-target="#editModal"  data-info="'.$query->idpublications.','.$query->idauditoires.','.$query->statut.','.$query->date_publication.','.$statut.'">
                  <span class="fa fa-edit"></span> Edit
                </button>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Publication $model)
    {
        return $model->PublicationParSession($this->idsessions)->PublicationJoinAuditoire()->get();
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
                    ->addAction(['width' => '180px'])
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
            'date_publication'
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
        return 'Jury/ListePublicationsBySession_' . date('YmdHis');
    }
}
