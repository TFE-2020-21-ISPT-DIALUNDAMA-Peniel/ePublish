@inject('sections', 'App\Models\Section')

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
        {{-- Formulaire --}}
        <form id="usersForm" action="{{ route('admin.users_store') }}" method="POST" name="usersForm" class="form-horizontal">
            @csrf
           <input type="hidden" name="idusers_roles" id="fidusers_roles" value="{{ $users_roles->idusers_roles }}">
           <input type="hidden" name="idusers" id="fidusers" >
            <div class="form-group">
                <label for="nom"  class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-12">
                    <input type="text" id="fnom" class="form-control" id="nom" name="name" placeholder="Entrer le nom de l'utilisateur "  maxlength="50" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="prenom"  class="col-sm-2 control-label">Prenom</label>
                <div class="col-sm-12">
                    <input type="text" id="fprenom" class="form-control" id="prenom" name="first_name" placeholder="Entrer le prenom de l'utilisateur"  maxlength="50" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="email"  class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-12">
                    <input type="email" id="femail" class="form-control" id="email" name="email" placeholder="Entrer l'email de l'utilisateur"  maxlength="50" >
                </div>
            </div>
            <?php $sect = $users_roles->lib != 'section' ? 'disabled hidden' : '' ?>
            <div class="form-group" {{ $sect }} >
                    <label class="col-sm-2 control-label">Section</label>
                    <div class="col-sm-12">
                        
                        <select class="form-control" id="fidsections" name="idsections" required="" {{ $sect }}>
                            @foreach($sections::get() as $section)
                                <option value="{{ $section->idsections }}">{{ $section->lib }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>           
        </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
	        <button type="submit" class="save btn btn-primary">Enregistrer</button>
	      </div>
        </form>
      </div>
    </div>
  </div>

@push('scripts')
<script type="text/javascript">
    
    {{-- Ajout users formulaire --}}
    $(document).on('click', '.addModal', function() {
        $('#msgErrors').html('');
        $('#msgErrors').attr('hidden','true');

        $('.modal-title').text('Ajouter');
        resetmodalData()
        $('.form-horizontal').trigger("reset");
        $('.form-horizontal').show();
        $('#myModal').modal('show');
        });

    {{-- edition du formulaire --}}
    $(document).on('click', '.edit-modal', function() {
            $('#msgErrors').html('');
            $('#msgErrors').attr('hidden','true');

            $('#footer_action_button').text(" Update");
            $('#footer_action_button').addClass('fas fa-check');
            $('#footer_action_button').removeClass('fas fa-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').removeClass('delete');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Modifier');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            var stuff = $(this).data('info').split(',');
            fillmodalData(stuff)
            $('#myModal').modal('show');
            });

    // remplissage formulaire par les donnée d'une ligne selectionée
    function fillmodalData(details){
            $('#fidusers').val(details[0]);
            $('#fnom').val(details[1]);
            $('#fprenom').val(details[2]);
            $('#femail').val(details[3]);
            $('#fidsections').val(details[4]);
            
            }

    function resetmodalData(){
            $('#fidusers').val('');
            $('#fnom').val('');
            $('#fnom').val('');
            $('#fprenom').val('');
            $('#femail').val('');
            $('#fidsections').val('');
        
            }



    $('#usersForm').on('submit', function(e) {
        e.preventDefault();
        $('#msgErrors').html('');
        $('#msgErrors').attr('hidden','true');

        $.ajax({
            type: 'post',
            url: '{{ route('admin.users_store') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'idusers': $("#fidusers").val(),
                'name': $('#fnom').val(),
                'first_name': $('#fprenom').val(),
                'email': $('#femail').val(),
                'idsections': $('#fidsections').val(),
                'idusers_roles': $('#fidusers_roles').val(),
               
                },

            success: function(data) {
                $('#dataTableBuilder').DataTable().draw(false);
                $('#editModal').modal('hide');
                
            },

            error:function(data) {
                var errors = data.responseJSON.errors;
                  $.each(errors, function (key, value) {
                    document.getElementById('msgErrors').innerHTML += "<li>"+value+"</li>"
                    $('#msgErrors').removeAttr('hidden');
                });
            }
        });
    });

    {{-- Suppression  --}}
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

</script>

@endpush