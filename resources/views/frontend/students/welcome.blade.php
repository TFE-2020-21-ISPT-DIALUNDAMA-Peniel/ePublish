@extends('frontend.layouts.master',['title'=>'Bienvenu(e)'])	
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/studentStyle.css') }}">
@stop

@section('container')
    <form class="form-signin" method= 'post' id='form' data-parsley-validate>
      <div class="text-center mb-4">
        @include('partials._logoIspt')
        <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
        <p>{{config('app.name') }} est une plateforme de publication de résultats, qui vous permet de consulter vos relevés des côtes en ligne.
        </p>
      </div>
      @if ($sessions->isNotEmpty())
        @include('frontend.partials._msgFlash')
        @csrf
        <div class="row">
          
           <div class="form-label-group col-6">
            <select class="custom-select form-control" name="session" id="sessionId" required="required" >
              @foreach ($sessions as $session)
                <option value="{{ $session->idsessions }}">{{ $session->abbr }}</option>
              @endforeach
           </select>
          </div>

          <div class="form-label-group col-6">
    		    <select class="custom-select" name="annee" id="annee" required="required" >
          		@foreach ($annees as $annee)
          			<option value="{{ $annee->idgestion_annees }}">{{ $annee->annee_format }}</option>
          		@endforeach
          	</select>
          </div>
        </div>
        <div class="form-label-group">
          <select class="custom-select form-control" name="auditoire" id="auditoireId" required="required" >
            @foreach ($auditoires as $auditoire)
              <option value="{{ $auditoire->idauditoires }}">{{ $auditoire->lib }}</option>
            @endforeach
         </select>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
      @else
        <div class="msg">
          <div class="alert alert-info">
            <strong>Aucune publication disponible pour l'instant !!!</strong>
          </div>
        </div>
      @endif
      @include('partials._@kindev')
    </form>
@stop
@section('script')
  <script type="text/javascript" src="{{  asset('js/appForm.js')  }}"></script>
@stop
