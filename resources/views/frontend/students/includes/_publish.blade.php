<div class="card container bg-light">
  <div class="card-header">

      Matricule:  {{ $etudiant->matricule }} <br>
      Nom et Postnom :  {{ $etudiant->nom.' '. $etudiant->postnom }} <br>
    	Promotion:  {{ $etudiant->abbr }} <br>
    	

  </div>
  <div class="fluid">
    <img src="{{ $bulletin_path_img }}" class="img-fluid" alt="Bulletin de {{ $etudiant->nom }}">
  </div>
  <div class="card-footer">
    <form action="{{ route('students.dowloadBulletin')}}" method="POST">
      @csrf
      <input type="text" name="path_file" value="{{ $bulletin_path_pdf }}" hidden>
      <input type="submit" class="btn btn-primary btn-lg btn-block" value="Télécharger">
    </form>
    <hr>
    <a href="{{ route('students.index') }} " class="btn btn-danger btn-block"> Fermer </a>
  </div>
  @include('partials._@kindev')
</div>