@extends('backend.layouts.master') 
@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
@stop

@section('container')  
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

{{-- <div class="row">
        <!-- Column -->         
  <div class="widget-box widget-plain">
    <div class="center">
          <ul class="stat-boxes2">
            <li>
              <div class="left peity_bar_neutral">ico</div>
              <div class="right"> <strong>{{ getNbr($section->nbrAuditoire) }}</strong> Auditoires</div>
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
</div> --}}

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
          <h5 class="card-title m-b-0">Section : {{ session('user')['section'] }}</h5>
      </div>
      <table class="table " >
        <thead>
          <tr class="font-bold head-tab">
            <th scope="col">N°</th>
            <th scope="col">Auditoires</th>
            <th scope="col">Nombre Etudiants</th>
            <th scope="col">Codes</th>
            <th scope="col">Codes Actif</th>
            <th scope="col">Codes Non Actifs</th>
            <th scope="col">Codes Utilisé</th>
          </tr>
        </thead>
        <tbody>
         @if ($auditoires->isNotEmpty())
          @php $i=1 @endphp
          
          @foreach ($auditoires as $auditoire)
          <tr onclick='location = "{{ route('section.show_auditoire',[$idsession,$auditoire['idauditoires']]) }}"'>
            <th scope="row">{{ $i++ }}</th>
            <td><a href="{{ route('section.show_auditoire',[$idsession,$auditoire['idauditoires']]) }} ">{{ $auditoire['lib'] }}</a></td>
            <td>{{ getNbr($auditoire['nbrEtudiant']) }}</td>
            <td>{{ getNbr($auditoire['nbrCode']) }}</td>
            <td>{{ getNbr($auditoire['nbrCodeActif']) }}</td>
            <td>{{ getNbr($auditoire['nbrCodeNoActif']) }}</td>
            <td>{{ getNbr($auditoire['nbrCodeUtilise'])  }}</td>
          </tr>
          @endforeach
         @else
            <td colspan="7" style="text-align: center;"><strong>Aucun auditoire disponible</strong></td>
         @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- BEGIN MODAL -->

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