
@extends('backend.layouts.master',['title'=>'Auditoires'])
@push('stylesheets')
@endpush

@section('container')
<div class="create">
	<button type="button" class="addModal btn btn-info" data-toggle="modal" data-target="#editModal">
  		 <span class="fa fa-plus"> </span> Ajouter un étudiant
	</button>
</div>
<br><br><br>
<div class="row">
	<div class="col-3">

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
	</div>
	<div class="col-9">
		{{-- {!!$dataTable->table() !!}	 --}}
	</div>
</div>
{{-- Modal Formulaire ajout Etudiant --}}
@include('backend.partials.includes.formulaires.ajoutEtudiantForm')



@stop

@push("scripts")
{{-- {!!$dataTable->scripts() !!} --}}
@endpush