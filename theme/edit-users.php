<?php
// Verifica se os dados do formulário foram enviados e se a ação é editar_usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'editar_usuario') {

	// Verifica se o nonce é válido
	if (isset($_POST['salvar_dados_usuario_nonce']) && wp_verify_nonce($_POST['salvar_dados_usuario_nonce'], 'salvar_dados_usuario_nonce')) {

		// Os dados do formulário são seguros para processamento
		// Faça o processamento dos dados aqui

		// Por exemplo, para atualizar os metadados do usuário
		$user_id = $_POST['user_id'];
		$campos_personalizados = get_campos_personalizados_usuario();
		foreach ($campos_personalizados as $campo => $label) {
			if (isset($_POST[$campo])) {
				$valor = sanitize_text_field($_POST[$campo]);
				update_user_meta($user_id, $campo, $valor);
			}
		}

		// Redireciona de volta para a página de onde veio
		wp_safe_redirect(wp_get_referer());
		exit;
	} else {
		// Nonce inválido, redireciona para uma página de erro ou exibe uma mensagem de erro
		echo "Nonce inválido!";
	}
} else {
	// Se não houver dados postados ou a ação não é editar_usuario, redireciona para a página inicial
	wp_safe_redirect(home_url());
	exit;
}
