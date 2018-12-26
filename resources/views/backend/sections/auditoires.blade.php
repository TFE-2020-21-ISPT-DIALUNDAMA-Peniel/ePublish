@extends('backend.layouts.master') 
@section('stylesheet')
<link rel="stylesheet" type="text/css" href=" {{ asset('backend/dist/css/matrix-style.css') }} ">
@stop
@section('container')  
@php
    // dd($dataStat);
@endphp

    {{--     @foreach ($data["auditoires"] as $element)
                @php
                    
             dump($element->lib);
                @endphp
        @endforeach --}}
 
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                   {{--  @php
                        $i = 0;
                        foreach ($data as $key => $value) {
                            dump("$key=>$value");
                        }
                            die();
                    @endphp --}}
                    @foreach ($dataStat as $key => $d)
                        <!-- Column -->         
                        <div class="widget-box widget-plain">
                          <div class="center">
                                <ul class="stat-boxes2">
                                  <li>
                                    <div class="left peity_bar_neutral">ico</div>
                                    <div class="right"> <strong>{{ $d }}</strong> {{ ucfirst($key) }} </div>
                                  </li>          
                                </ul>
                          </div>
                        </div>
                    @endforeach
                </div>
                


         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Static Table</h5>
                    </div>
                    <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Auditoires</th>
                              <th scope="col">Nombre Etudiants</th>
                              <th scope="col">Codes</th>
                              <th scope="col">Codes Actif</th>
                              <th scope="col">Codes Non Actifs</th>
                              <th scope="col">Codes Utilisé</th>
                            </tr>
                          </thead>
                          <tbody>
                         @foreach ($dataAuditoires as $auditoire)
                            <tr>
                              <th scope="row">{{ $auditoire['id'] }}</th>
                              <td>{{ $auditoire['lib'] }}</td>
                              <td>{{ $auditoire['nbrEtudiants'] }}</td>
                              <td>{{ $auditoire['nbrCodes'] }}</td>
                              <td>{{ $auditoire['nbrCodesActifs'] }}</td>
                              <td>{{ $auditoire['nbrCodesNoActifs'] }}</td>
                              <td>{{ $auditoire['nbrCodesUtilises'] }}</td>
                            </tr>
                          @endforeach
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