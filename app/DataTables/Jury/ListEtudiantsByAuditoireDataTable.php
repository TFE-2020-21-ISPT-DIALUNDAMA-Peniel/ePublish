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
        return $model::EtudiantParAuditoire($this->idauditoires)->EtudiantJoinAuditoire()->get();
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
                    ->addAction(['width' => '100px'])
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
            'abbr'=>[
                'name' => 'abbr',
                'data' => 'abbr',
                'title' => 'Auditoire',
                'searchable' => true,
                'orderable' => false,
                'exportable' => true,
                'printable' => true,
            ],
            'statut'=>[
                        'defaultContent' => '<input type="checkbox"/>s',
                        'title'          => '',
                        'data'           => 'statut',
                        'name'           => 'statut',
                        'type'           => 'checkbox',
                        'orderable'      => false,
                        'searchable'     => false,
                        'exportable'     => false,
                        'printable'      => true,
                        'width'          => '10px',
                    ]

        ];
    }


    
    protected function getBuilderParameters(){
        return [
            'dom' => 'flrtipB',
            'buttons' => ['print', 'excel','pdf'],
            // 'order' => [[1,'Asc']],
            'language'=> 
                // ['url' => asset('dataTables/fr.json')],
            [   
            'processing' =>    'Traitement en cours...',
            'zeroRecords'=>   'Aucun élément à afficher',
        ]

    //     search:         "Rechercher&nbsp;:",<font></font>
    //     lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",<font></font>
    //     info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",<font></font>
    //     infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",<font></font>
    //     infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",<font></font>
    //     infoPostFix:    "",<font></font>
    //     loadingRecords: "Chargement en cours...",<font></font>
    //     emptyTable:     "Aucune donnée disponible dans le tableau",<font></font>
    //     paginate: {<font></font>
    //         first:      "Premier",<font></font>
    //         previous:   "Pr&eacute;c&eacute;dent",<font></font>
    //         next:       "Suivant",<font></font>
    //         last:       "Dernier"<font></font>
    //     },<font></font>
    //     aria: {<font></font>
    //         sortAscending:  ": activer pour trier la colonne par ordre croissant",<font></font>
    //         sortDescending: ": activer pour trier la colonne par ordre décroissant"<font></font>
    //     }<font></font>
    // }<font></font>

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
                  <span class="fa fa-edit"></span> 
                </button>'
                .'  '.
                '<button class="delete-modal btn btn-danger" data-info="'.$query->idetudiants.','.$query->matricule.','.$query->nom.','.$query->postnom.','.$query->prenom.','.$query->idauditoires.'">
                 <span class="fa fa-trash"></span> 
                </button>
        </div>' ;
    }
}
