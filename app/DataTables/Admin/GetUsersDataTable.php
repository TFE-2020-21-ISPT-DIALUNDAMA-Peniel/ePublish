<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Yajra\DataTables\Services\DataTable;

class GetUsersDataTable extends DataTable
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
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->JoinRole()
                     ->JoinSection()
                     ->where('users.idusers_roles',$this->idusers_roles)
                     ->get([
                        'users.idusers',
                        'users.name',
                        'users.first_name',
                        'users.username',
                        'users.email',
                        'users.statut',
                        'users_roles.idusers_roles',
                        'users_roles.lib as role',
                        'sections.lib as section',
                        'sections.idsections',
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
                    ->addAction(['width' => '160px'])
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
           // 'idusers',
            'name',
            'first_name',
            'username',
            'email',
            //'role',
            'section',
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
        return 'Admin/GetUsers_' . date('YmdHis');
    }

    private function editorBtn($query){
        if ($query->statut == 0) {
            $btn = 'dark';
            $ico = 'fas fa-user-times';
        }else{
            $btn = 'success';
            $ico = 'fas fa-check';

        }
        return '
        <div class = "inline">
                <a  class=" btn btn-'
                .$btn.'" data-info="'.$query->idusers.'" onclick="event.preventDefault();document.getElementById(\'form-action'.$query->idusers.'\' ).submit();">
                 <span class="'.$ico.' text-light"></span> 
                </a>
                <form class="form-action" id="form-action'.$query->idusers.'" action="'. route("admin.users_activation").'" method="POST" style="display: none;">
                     '.csrf_field().'
                   <input type="hidden" name="idusers" id="idusers" value ='.$query->idusers.' >

                </form>'
                .' '.
                '<button type="button" class="edit-modal btn btn-info" data-toggle="modal" data-target="#editModal"  data-info="'.$query->idusers.','.$query->name.','.$query->first_name.','.$query->email.','.$query->idsections.','.$query->idroles.'">
                  <span class="fa fa-edit"></span> 
                </button>'
                .'  '.
                '<button class="delete-modal btn btn-danger" data-info="'.$query->idusers.'">
                 <span class="fa fa-trash"></span> 
                </button>
        </div>' ;
    }


}
