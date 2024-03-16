document.addEventListener("DOMContentLoaded", function() {
	// Capturar todos os botões de conteúdo
	var contentButtons = document.querySelectorAll('.content-button');

	// Iterar sobre cada botão
	contentButtons.forEach(function(button) {
		// Adicionar um ouvinte de evento de clique a cada botão
		button.addEventListener('click', function(event) {
			// Impedir o comportamento padrão de clicar em um link
			event.preventDefault();

			// Obter o conteúdo associado ao botão
			var content = button.getAttribute('data-content');

			// Enviar solicitação AJAX para carregar o conteúdo
			var xhr = new XMLHttpRequest();
			xhr.open('GET', "<?php echo esc_url(admin_url('admin-ajax.php')); ?>?action=load_content&content=" + content, true);
			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					// Atualizar o conteúdo na div #content
					document.getElementById('content').innerHTML = xhr.responseText;
				} else {
					console.error('Erro ao carregar conteúdo.');
				}
			};
			xhr.send();
		});
	});
});
