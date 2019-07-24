
// Traitement de formulaire avec ajax
$(function(){
    $(document).on('submit', '#form', function(e) {
      e.preventDefault();
      $('#msgErrors').attr('hidden','true');
      $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        global: true,
      
        success :function(data) {
        location = data;
        },
        error:function(data) {
        var errors = data.responseJSON.errors;
          $.each(errors, function (key, value) {
            $('#msgErrors .msgErrors').html(value);
            $('#msgErrors').removeAttr('hidden');
          });
        }

      });
    $('#formulaire').ajaxStart(function(){
      alert('a'); 
    });

  });
});

// Fonction d'ajout ou de suppression du "loader"
function ajaxBox_loader(pState)
{
// Ajout d'un élement <img> d'id #ajaxBox_loader
if (pState === true)
$('#loader').append('<img id="ajaxBox_loader" src="{" />');
// Suppression de l'élement d'id #ajaxBox_loader
else
$('#ajaxBox_loader').remove();
}