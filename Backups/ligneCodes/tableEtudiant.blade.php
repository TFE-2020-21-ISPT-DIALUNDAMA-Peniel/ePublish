<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
          <h5 class="card-title m-b-0">Static Table</h5>
             <div class="row" >
            {{--   <div class="col-6">
                <form id="filtre"  method="post" class="form-inline">
                    @csrf
                  <div class="">
                    <select class="form-control" name="input" required>
                        <option value="actif" >Codes actifs</option>
                        <option value="noActif">Codes non actifs</option>
                        <option value="utilise">Codes utilisés</option>
                    </select>
                  </div>
                  <div class="">
                    <input type="submit" name="filtrer" value="Filtrer" class="btn btn-primary">
                  </div>
                </form>
              </div> --}}
              <div class="col-md-6">
                <form id="searchStudentForm" action="{{ request()->server()['PATH_INFO'] }}" method="POST" class="form-inline">
                    @csrf
                  <div class="">
                    <input type="search" name="name" class="form-control" placeholder="Chercher étudiants par nom ou  matricule" required>
                  </div>
                  <div class="">
                    <input type="submit" name="searchStudent"  class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>
      </div>
        <table class="table">
              <thead>
             
                <tr>
                  {{-- <th scope="col">N°</th> --}}
                  <th scope="col"><strong>Matricule</strong></th>
                  <th scope="col"><strong>Noms</strong></th>
                  <th scope="col"><strong>Postnoms et Prénoms</strong></th>
                  <th scope="col"><strong>Codes d'accès</strong></th>
                  <th scope="col"><strong>Statut code</strong></th>
                  <th scope="col"><strong>Etat</strong></th>
                </tr>
              </thead>
              <tbody>
                @if ($dataEtudiants->isNotEmpty())
                   @foreach ($dataEtudiants as $etudiant)
                      <tr>
                        {{-- <th scope="row">{{ $etudiant['id'] }}</th> --}}
                        <th scope="row" >{{ $etudiant['matricule'] }}</th>
                        <td>{{ $etudiant['nom'] }}</td>
                        <td>{{ $etudiant['postnom'] }}  {{ $etudiant['prenom'] }}</td>
                        <td>{{ $etudiant['code'] }}</td>            

                        <td>
                               <a  href="{{ route('section.code_activated') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('idcode').value = {{ $etudiant['idcode'] }} ;
                                               document.getElementById('codeIsActive').submit();">
                                    {{ $etudiant['codeIsActive'] }}
                              </a>

                            
                        </td>
                      {{--   <td><a href="{{ route('section.code_activated',$etudiant['idcode']) }}">{{ $etudiant['codeIsActive'] }}</a></td> --}}
                        <td>{{ $etudiant['codeStatut'] }}</td>
                      </tr>
                    @endforeach     
                @else
                  <td colspan='6' style="text-align: center;"><strong >Aucun Etudiant trouvé</strong></td>
                @endif

              </tbody>
                
        </table>
        <div> {{ $paginate }} </div>
        @if (isset(request()->searchStudent))
          <a href="" class="btn btn-primary ">Afficher tout les étudiants</a>
        @endif
        <form id="codeIsActive" action="{{ route('section.code_activated') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="idcode" value="" id="idcode">
        </form>
    </div>
  </div>
</div>