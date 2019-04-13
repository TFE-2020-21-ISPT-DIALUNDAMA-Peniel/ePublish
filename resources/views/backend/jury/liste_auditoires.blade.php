
@extends('backend.layouts.master',['title'=>'Auditoires'])
@push('stylesheets')
@endpush

@section('container')
{{-- @php
dd($auditoires)
@endphp --}}

{{-- Affichage de la liste des auditoires --}}
@foreach ($auditoires as $section)
<div class="accordion" id="accordionExample">
	<div class="card m-b-0">
	    <div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        <a data-toggle="collapse" data-target="#{{ $section[0]->section_lib }}" aria-expanded="false" aria-controls="{{ $section[0]->section_lib }}" class="collapsed">
	            {{-- <i class="m-r-5 fa fa-magnet" aria-hidden="true"></i> --}}
	            <span>SECTION : {{ $section[0]->section_lib }}</span>
	        </a>
	      </h5>
	    </div>
	    <div id="{{ $section[0]->section_lib }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
	      <div class="card-body">
	        <ul>
	        	@foreach ($section as $auditoire)
	        	<a href="{{ route('jury.showEtudiants',$auditoire->idauditoires) }}" class="">
	        		<li>{{ $auditoire->lib }}</li>
	        	</a>
	        	@endforeach
	        </ul>
	      </div>
	    </div>
</div>
</div>
@endforeach


@stop

@push("scripts")

@endpush