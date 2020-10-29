$('.cep').keyup(function() {
	if($(this).data('cep')){
		var data = $(this).data('cep');
		var cep = $(this).val().replace('-', '');
		if(cep.length == 8){
			$('.salvar-cep').attr('disabled', true);
			$('[data-cep="'+data+'"].cep-numero').val('');
			$('[data-cep="'+data+'"].cep-complemento').val('');
			$('[data-cep="'+data+'"].cep-rua').val('Carregando...');
			$('[data-cep="'+data+'"].cep-bairro').val('Carregando...');
			$('[data-cep="'+data+'"].cep-cidade').val('Carregando...');
			$('[data-cep="'+data+'"].cep-estado').val('Carregando...');

			$.getJSON('./API/CEP/'+cep, function(json) {
				if(json.localidade){
					if(json.logradouro != ''){
						$('[data-cep="'+data+'"].cep-rua').val(json.logradouro);
						$('[data-cep="'+data+'"].cep-rua').attr('readonly', true);

						$('[data-cep="'+data+'"].cep-bairro').val(json.bairro);
						$('[data-cep="'+data+'"].cep-bairro').attr('readonly', true);
					} else {
						$('[data-cep="'+data+'"].cep-rua').val('');
						$('[data-cep="'+data+'"].cep-rua').attr('readonly', false);
						
						$('[data-cep="'+data+'"].cep-bairro').val('');
						$('[data-cep="'+data+'"].cep-bairro').attr('readonly', false);
					}
					$('[data-cep="'+data+'"].cep-cidade').val(json.localidade);
					$('[data-cep="'+data+'"].cep-estado').val(json.uf);

					if(json.logradouro != ''){
						$('[data-cep="'+data+'"].cep-rua').val(json.logradouro);
					}
					$('[data-cep="'+data+'"].cep-bairro').val(json.bairro);
					$('[data-cep="'+data+'"].cep-cidade').val(json.localidade);
					$('[data-cep="'+data+'"].cep-estado').val(json.uf);
				} else {
					toast('warning', json.error);
					$('[data-cep="'+data+'"].cep-rua').val('');
					$('[data-cep="'+data+'"].cep-bairro').val('');
					$('[data-cep="'+data+'"].cep-cidade').val('');
					$('[data-cep="'+data+'"].cep-estado').val('');
				}
				$('.salvar-cep').attr('disabled', false);
			});
		} else {
			$('[data-cep="'+data+'"].cep-rua').val('');
			$('[data-cep="'+data+'"].cep-bairro').val('');
			$('[data-cep="'+data+'"].cep-cidade').val('');
			$('[data-cep="'+data+'"].cep-estado').val('');

			$('[data-cep="'+data+'"].cep-rua').attr('readonly', true);
			$('[data-cep="'+data+'"].cep-bairro').attr('readonly', true);
			$('[data-cep="'+data+'"].cep-cidade').attr('readonly', true);
			$('[data-cep="'+data+'"].cep-estado').attr('readonly', true);
		}
	}
});