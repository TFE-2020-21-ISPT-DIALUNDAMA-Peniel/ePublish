
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
    $('body').ajaxStart(function(){
      alert('a'); 
    });

  });
});