    <form class="form-signin" method="POST" id='form' action="{{ route('students.authentification') }}" data-parsley-validate>
{{-- <div id="loader"></div> --}}
      
      <div class="text-center mb-4">
        @include('partials._logoIspt')
        <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name') }}</h1>
        <p>{{config('app.name') }} est une plateforme de publication de résultats, qui vous permet de consulter vos bulletins de notes en ligne.
        </p>
      </div>
      @if ($publications->get()->isNotEmpty())
        @include('frontend.partials._msgFlash')
        @csrf
        <div class="row">
          
           <div class="form-label-group col-6">
            <select class="custom-select form-control" name="idsessions" id="idsessions" required="required" >
              @foreach ($sessions->get() as $session)
                <option value="{{ $session->idsessions }}">{!! $session->abbr !!}</option>
              @endforeach
           </select>
          </div>

          <div class="form-label-group col-6">
    		    <select class="custom-select" name="idgestion_annees" id="idgestion_annees" required="required" >
          		@foreach ($annees->get() as $annee)
          			<option value="{{ $annee->idgestion_annees }}">{{ $annee->annee_format }}</option>
          		@endforeach
          	</select>
          </div>
        </div>
        <div class="form-label-group">
         <select class="form-control" id="fidauditoires" name="idauditoires" required="">
              @foreach($auditoires::getAuditoireGroupBySection() as $sections)
                  <optgroup label="{{ $sections[0]->section_lib  }}">
                      @foreach ($sections as $auditoire)
                          @if(!empty($idauditoireSelected) && $idauditoireSelected == $auditoire->idauditoires)
                          <option value="{{ $auditoire->idauditoires }}" selected>{{ $auditoire->abbr }}</option>
                          @else
                          <option value="{{ $auditoire->idauditoires }}"  >{{ $auditoire->abbr }}</option>
                          @endif
                      @endforeach
                  </optgroup>
              @endforeach
        </select>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
      @else
        <div class="msg">
          <div class="alert alert-info" style="text-align: center;">
            <strong >Aucune publication disponible pour l'instant !</strong>
          </div>
        </div>
      @endif
      @include('partials._@kindev')
    </form>