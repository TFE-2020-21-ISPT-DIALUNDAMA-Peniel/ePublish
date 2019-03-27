
$(function(){
		$('#register').click(function() {
			$('#myModal').modal();
			});
		$(document).on('submit', '#formRegister', function(e) {
			e.preventDefault();
			$('input+small').text('');
			$('input').parent().removeClass('has-error');
			$.ajax({
				method: $(this).attr('method'),
				url: $(this).attr('action'),
				data: $(this).serialize(),
				dataType: "json"
			})
			.done(function(data) {
				$('.alert-success').removeClass('hidden');
				$('#myModal').modal('hide');
			})
			.fail(function(data) {
				$.each(data.responseJSON, function (key, value) {
					var input = '#formRegister input[name=' + key + ']';
					$(input + '+small').text(value);
					$(input).parent().addClass('has-error');
				});
			});
		});

});
