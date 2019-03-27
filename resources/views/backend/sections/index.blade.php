@extends('backend.layouts.master',['title'=>'Section']) 
@section('container')   
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    @foreach ($sessions as $session)
                        <!-- Column -->
                    
                        <a href="{{ route('section.show',$session->idsessions) }}" class="col-md-6 col-lg-3">
                            <div class="card card-hover">
                                @if ($session->idsessions % 2 != 0)
                                <div class="box bg-cyan text-center">
                                @else
                                <div class="box bg-danger text-center">
                                @endif
                                    <h1 class="font-light text-white">{{ $session->idsessions  }}</h1>
                                    <h6 class="text-white">{{ $session->lib  }}</h6>
                                </div>
                            </div>
                        </a> 
                    @endforeach
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