@extends('backend.layouts.master') 
@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap4-toggle.min.css') }}" rel="stylesheet">
@stop

@section('container')  

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
{{-- Data Stat Dashboard --}}
<div class="row">

        <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrEtudiant) }}</strong> Etudiants</div>
            </li>          
          </ul>
    </div>
  </div>

          <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrCode) }}</strong> Codes disponible</div>
            </li>          
          </ul>
    </div>
  </div>

          <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrCodeActif) }}</strong> Codes Activés</div>
            </li>          
          </ul>
    </div>
  </div>
 
           <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrCodeNoActif) }}</strong> Codes Non Activés</div>
            </li>          
          </ul>
    </div>
  </div>

          <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrCodeUtilise) }}</strong> Codes Utilisé</div>
            </li>          
          </ul>
    </div>
  </div>


</div>
{{-- Table  --}}
<div class="row">
  <div class="card col-12">
    <div class="card-body">
      <h5 class="card-title">{{ strtoupper($auditoire->lib) }}</h5>
      <div class="table-responsive">
          <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
            <div class="row">
              <form action="{{ request()->server()['PATH_INFO'] }}" method="POST" id="formFiltres" class="form-inline col-12">
                 @csrf
                <div class="col-sm-12 col-md-6">
                  <div class="float-left" id="">
                    Afficher 
                      <select name="showEntries" aria-controls=""  onchange="document.getElementById('nameFiltre').value='?';document.getElementById('formFiltres').submit();" class="form-control">
                        @foreach([10,25,50,100] as $value)
                        {!! $value == $etudiants->perPage() 
                           ? "<option value='$value' selected >$value</option>"
                           : "<option value='$value'>$value</option>" !!}
                        @endforeach
                      </select> 
                      lignes
                   
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div id="zero_config_filter" class="float-right">
                   {{--  <form action="{{ request()->server()['PATH_INFO'] }}" method="POST" class="form-inline">
                        @csrf --}}
                    <div class="form-group">
                      <input type="search" name="name" id="nameFiltre" class="form-control" placeholder="Nom ou  Matricule" required>
                      <button type= 'submit' name="searchStudent" value="searchStudent" class="btn"><i class="fa fa-search"></i></button>
                    </div>          
                  </div>
                </div>
              </form>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table id="zero_config" class=" table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info" style="font-size: 1rem;">
                  <thead>
                      <tr role="row">
                        <th class="" style="width: 143px;font-size: 1rem;">
                          Matricules
                        </th>
                        <th class=""  style="width: 143px;font-size: 1rem;">
                          Noms
                        </th>
                        <th class="" tabindex="0" rowspan="1" colspan="1"  style="width: 234px;font-size: 1rem;">
                          Postoms et Prénoms
                        </th>
                        <th class=""  style="width: 108px;font-size: 1rem;">
                          Code d'accès
                        </th>
                        <th class="" style="width: 90px;font-size: 1rem;">
                          Activation
                        </th>
                        <th class="" style="width: 44px;font-size: 1rem;">
                          Etat 
                        </th>
                      </tr>
                  </thead>
                  <tbody>  
                    @if ($etudiants->isNotEmpty())
                    @foreach ($etudiants as $etudiant) 
                    <tr role="row" class="odd" id="etudiant" data-student >
                      <th  data-matricule = "{{ $etudiant['matricule'] }}" scope="row" data-toggle="modal" data-target="#Modal2" style="font-size: 1rem;">
                        {{ $etudiant['matricule'] }}
                      </th>
                      <td data-toggle="modal" data-target="#Modal2">
                        {{ $etudiant['nom'] }}
                      </td>
                      <td data-toggle="modal" data-target="#Modal2">
                        {{ $etudiant['postnom'] }}  {{ $etudiant['prenom'] }}
                      </td>
                      <td data-toggle="modal" data-target="#Modal2" >
                        {{ $etudiant['code'] }}
                      </td>
                      <td  >
                        <a href="{{ route('section.code_activated', getNbr($etudiant['idcodes'] ),'-') }}" >
                        @if ($etudiant['code.active'] == "1")
                        <input  type="checkbox" checked data-toggle="toggle" data-on="Activer" data-off="Désactiver" data-onstyle="primary" data-offstyle="danger" onchange="location = '{{ route('section.code_activated', getNbr($etudiant['idcodes'] ),'-') }}'">
                        @else
                        <input type="checkbox"  data-toggle="toggle" data-on="Activer" data-off="Désactiver" data-onstyle="primary" data-offstyle="danger" onchange="location ='{{ route('section.code_activated', getNbr($etudiant['idcodes'] ),'-') }}'">
                        @endif
                     <span style="display: none">{{ $etudiant['code.active'] }}</span> 



                    </a></td>
                      <td data-toggle="modal" data-target="#Modal2" id = "codeStatut" data-codeStatut ="{{ $etudiant['codeStatut'] }}">{{ $etudiant['code.statut'] }}</td>
                      <td style="display: none;">{{ route('section.code_activated', getNbr($etudiant['idcodes']),'-') }}</td>
                   </tr>
                    @endforeach     
                    @else
                      <td colspan='6' style="text-align: center;"><strong >Aucun Etudiant trouvé</strong></td>
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th rowspan="1" colspan="1">
                        Matricules
                      </th>
                      <th rowspan="1" colspan="1">
                        Noms
                      </th>
                      <th rowspan="1" colspan="1">
                        Postnoms et Prénoms
                      </th>
                      <th rowspan="1" colspan="1">
                        Codes
                      </th>
                      <th rowspan="1" colspan="1">
                        Activation
                      </th>
                      <th rowspan="1" colspan="1">
                        Etat 
                      </th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-5">
                @if (!isset(request()->searchStudent))
                <div class="dataTables_info" id="zero_config_info" role="status" aria-live="polite">
                    {!! sprintf('De %d à %d afficher sur %d ',$etudiants->firstItem(),$etudiants->lastItem(),$etudiants->total()) !!}
                </div>
                @endif
              </div>
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="zero_config_paginate">
                {{ $etudiants->links()}} 
                </div>
              </div>
            </div>
            <div class="row">
              @if (isset(request()->searchStudent))
                <a href="" class="btn btn-secondary ">Afficher tout les étudiants</a>
              @endif
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- BEGIN MODAL -->
<!-- Modal -->
<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="modal-title-code" aria-hidden="true" style="display: none;">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-code"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 1.1rem">
                <div class="row">
                  <ul class="list-unstyled ml-3 font-bold text-monospace">
                    <li>Matricule : <span id="modal-matricule">{{-- 2019XX --}}</span></li>
                    <li>Nom : <span id="modal-nom">{{-- Dialu --}}</span></li>
                    <li>Postnom et Prénom : <span id="modal-postnom">{{-- Bil WiFi --}}</span></li>
                    <li>Auditoire : <span id="modal-auditoire">{{ $auditoire->abbr }}</span></li>
                    <li>Code </li>
                  </ul>
                </div>
                <div class="justify-content-center" style="width: 60%; margin-left: 20%; margin-right: 20%; ">
                  <div class="btn btn-lg btn-block btn-outline-info" id="modal-code" style="font-size: 2.3rem">
                    {{-- Code --}}
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <a href="" type="button" class="btn btn-primary btn-lg" id="isActive"  >{{-- Activer --}}</a>
            </div>
        </div>
    </div>
</div>

<!-- END MODAL -->



<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->



@stop
@section('script')
{{-- <script src={{ asset('backend/assets/libs/datatables.net-bs4/js/datatables.min.js') }}></script>  --}}
<script src={{ asset('js/bootstrap4-toggle.min.js') }}></script>
<script type="text/javascript">
  jQuery(function(){
    $('#etudiant[data-student]').on('click', function(){
    
      // var link = $(this);
      // // var childre = link.children;
      // var fields = $.trim(link.text()).split('\n');
      // console.log(fields);

      var link = $(this);
      // var childre = link.children;

      // Filtrage du tableau pour avoir un tab propre
      // en supprimant le case vide
      var fields = $.trim(link.text()).split('\n');

      var field_filtre = jQuery.grep(fields, function(val){
        val = $.trim(val);
        if( val == '' || val == NaN || val == undefined || val == null ){
            return false;
        }
        return true;
      });

      field_filtre.forEach(function(value,key){
        field_filtre[key] = $.trim(value);
      });
      console.log(field_filtre);

      var matricule = $.trim(field_filtre[0]);
      var nom = $.trim(field_filtre[1]);
      var postnom = $.trim(field_filtre[2]);
      var code = $.trim(field_filtre[3]);

      var url = $.trim(field_filtre[7]);

      if($.trim(field_filtre[5]) == '0' || $.trim(field_filtre[5]) == '1'){
        var codeIsActive = $.trim(field_filtre[5]) == '0' ? 'Activer' : 'Désactiver';
        var title = $.trim(field_filtre[5]) == '0' ? 'Activation' : 'Désactivation';
        $('#isActive').css('display','true');

      }else{
        
        $('#isActive').css('display','none');
      }

      if($.trim(field_filtre[5]) != '0'){
       $("#isActive").removeClass('btn-primary');
       $("#isActive").addClass('btn-danger');
      }else{
       $("#isActive").removeClass('btn-danger');
       $("#isActive").addClass('btn-primary');

      }
      $("#modal-title-code").html(title);
      $("#modal-matricule").html(matricule);
      $("#modal-nom").html(nom);
      $("#modal-postnom").html(postnom);
      $("#modal-code").html(code);
      $("#isActive").html(codeIsActive);
      $("#isActive").attr('href',url);

    });

  });
</script>

@stop