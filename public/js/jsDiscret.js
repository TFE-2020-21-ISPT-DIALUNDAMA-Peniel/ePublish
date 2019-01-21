jQuery(function(){
	var jsD = {

		//Define the name of the hidden input field for methode submission
		methodeInputName : '_method',
		tokenInputName : '_token',
		metaNameToken : 'csrf-token',


		initialize : function(){

			$('a[data-method]').on('click', this.handleMethod);

		},

		handleMethod : function(e){
			e.preventDefault();

			var link = $(this),
				httpMethod = link.data('method').toUpperCase(),
				confirmMessage = link.data('confirm'),
				form;

			//Quiter si la méthode n'est pas dans le tableau

			if ($.inArray(httpMethod,['POST','PUT','PATCH','DELETE']) === -1) {
				return;
			}

			//On verifie si le data-confirm exist

			if (confirmMessage) {
				if (confirm(confirmMessage)) {

					form = jsD.createForm(link);
					form.submit();
				}
			}else {

				form = jsD.createForm(link);
				form.submit();
			}


		},

		createForm : function(link){

			var form = $('<form>',
				{
					'method' : 'POST',
					'action' : link.prop('href') 

				});

			var token = $('<input>',
				{
					'type' : 'hidden',
					'name' : jsD.tokenInputName,
					'value': $('meta[name='+ jsD.metaNameToken + ']').prop('content')
				});

			var method = $('<input>',
				{
					'type' : 'hidden',
					'name' : jsD.methodeInputName,
					'value': link.data('method')	
				});

	
			return form.append(token, method).appendTo('body');

		}

	};

	jsD.initialize();
});