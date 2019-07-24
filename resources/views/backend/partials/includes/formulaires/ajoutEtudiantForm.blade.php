@inject('auditoires', 'App\Models\Auditoire')
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modifier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- msg d'erreur --}}
        @include('frontend.partials._msgFlash')
        {{-- Formualire d'import --}}
        <form method="post" action="{{ route(session('user')['role'].'.importEtudiantByAuditoire') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="idauditoires" value="{{!empty($idauditoireSelected) ? $idauditoireSelected : '' }}" hidden="">
            <div class="form-group col-12">
                <label class=" control-label"><i class=" fas fa-file-excel"> </i> Importer une liste en format excel</label>
                <div class="row">
                    <div class="custom-file col-9">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="file" required="Veillez choisir un fichier">
                        <label class="custom-file-label" for="validatedCustomFile">choisir un fichier...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <div class="col-3">
                        <button type="submit" id="importFileExcel" class="save btn btn-primary">Importer
                        </button>
                </div>
                </div>
            </div>
                

        </form>
        <hr>
        {{-- Formulaire --}}
        <form id="etudiantForm" action="{{ route(session('user')['role'].'.etudiant.store') }}" method="POST" name="etudiantForm" class="form-horizontal">
            @csrf
           <input type="hidden" name="idetudiants" id="fidetudiants" >
            <div class="form-group">
                <label for="matricule"  class="col-sm-2 control-label">Matricule</label>
                <div class="col-sm-12">
                    <input type="text" id="fmatricule" class="form-control" id="matricule" name="matricule" placeholder="Entrer matricule étudiant"  maxlength="50" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="nom"  class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-12">
                    <input type="text" id="fnom" class="form-control" id="nom" name="nom" placeholder="Entrer nom étudiant"  maxlength="50" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="postnom" class="col-sm-2 control-label">Postnom</label>
                <div class="col-sm-12">
                    <input type="text" id="fpostnom" class="form-control" id="postnom" name="postnom" placeholder="Entrer postnom étudiant"  maxlength="50" >
                </div>
            </div><div class="form-group">
                <label for="prenom"  class="col-sm-2 control-label">Prenom</label>
                <div class="col-sm-12">
                    <input type="text" id="fprenom" class="form-control" id="prenom" name="prenom" placeholder="Entrer prenom étudiant"  maxlength="50" >
                </div>
            </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Auditoire</label>
                    <div class="col-sm-12">
                        
                    	<select class="form-control" id="fidauditoires" name="idauditoires" required="">
                            @foreach($auditoires::getAuditoireGroupBySection() as $sections)
                                <optgroup label="{{ $sections[0]->section_lib  }}">
                                    @foreach ($sections as $auditoire)
                                        @if(!empty($idauditoireSelected) && $idauditoireSelected == $auditoire->idauditoires)
                                        <option value="{{ $auditoire->idauditoires }}" selected>{{ $auditoire->lib }}</option>
                                        @else
                                        <option value="{{ $auditoire->idauditoires }}"  >{{ $auditoire->lib }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                    	</select>
                    </div>
                </div>
        {{--     <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
             </button>
            </div> --}}
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
	        <button type="submit" class="save btn btn-primary">Enregistrer</button>
	      </div>
        </form>
      </div>
    </div>
  </div>
</div>