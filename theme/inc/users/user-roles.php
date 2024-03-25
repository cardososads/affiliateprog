<?php

// Adicionar campos personalizados aos perfis de usuário
function adicionar_campos_personalizados_usuario($user_contactmethods) {
	$campos_personalizados = array(
		'profile_picture' => 'Foto de Perfil',
		'razao_social' => 'Razão Social',
		'nome_fantasia' => 'Nome Fantasia',
		'cnpj' => 'CNPJ',
		'inscricao_estadual' => 'Inscrição Estadual',
		'endereco' => 'Endereço',
		'bairro' => 'Bairro',
		'cidade' => 'Cidade',
		'uf' => 'UF',
		'cep' => 'CEP',
		'telefone' => 'Telefone',
		'celular' => 'Celular',
		'email' => 'Email',
		'email_financeiro' => 'Email Financeiro',
		'email_danfe_xml' => 'Email DANFE/XML'
	);

	foreach ($campos_personalizados as $campo => $label) {
		$user_contactmethods[$campo] = $label;
	}

	return $user_contactmethods;
}
add_filter('user_contactmethods', 'adicionar_campos_personalizados_usuario');

// Carregar e salvar campos personalizados do usuário
function carregar_e_salvar_campos_personalizados_usuario() {
	$campos_personalizados = array(
		'profile_picture',
		'razao_social',
		'nome_fantasia',
		'cnpj',
		'inscricao_estadual',
		'endereco',
		'bairro',
		'cidade',
		'uf',
		'cep',
		'telefone',
		'celular',
		'email',
		'email_financeiro',
		'email_danfe_xml'
	);

	if (isset($_POST['action']) && $_POST['action'] === 'salvar_dados_usuario') {
		// Salvar os valores dos campos personalizados
		$user_id = get_current_user_id();
		foreach ($campos_personalizados as $campo) {
			if (isset($_POST[$campo])) {
				update_user_meta($user_id, $campo, sanitize_text_field($_POST[$campo]));
			}
		}
		wp_send_json_success('Dados do usuário salvos com sucesso.');
	} elseif (isset($_POST['action']) && $_POST['action'] === 'carregar_dados_usuario') {
		// Carregar os valores dos campos personalizados
		$user_data = array();
		$user_id = get_current_user_id();
		foreach ($campos_personalizados as $campo) {
			$user_data[$campo] = get_user_meta($user_id, $campo, true);
		}
		wp_send_json_success($user_data);
	}
}
add_action('wp_ajax_salvar_dados_usuario', 'carregar_e_salvar_campos_personalizados_usuario');
add_action('wp_ajax_nopriv_salvar_dados_usuario', 'carregar_e_salvar_campos_personalizados_usuario');
add_action('wp_ajax_carregar_dados_usuario', 'carregar_e_salvar_campos_personalizados_usuario');
add_action('wp_ajax_nopriv_carregar_dados_usuario', 'carregar_e_salvar_campos_personalizados_usuario');

function get_campos_personalizados_usuario() {
	return array(
		'profile_picture' => 'Foto de Perfil',
		'razao_social' => 'Razão Social',
		'nome_fantasia' => 'Nome Fantasia',
		'cnpj' => 'CNPJ',
		'inscricao_estadual' => 'Inscrição Estadual',
		'endereco' => 'Endereço',
		'bairro' => 'Bairro',
		'cidade' => 'Cidade',
		'uf' => 'UF',
		'cep' => 'CEP',
		'telefone' => 'Telefone',
		'celular' => 'Celular',
		'email' => 'Email',
		'email_financeiro' => 'Email Financeiro',
		'email_danfe_xml' => 'Email DANFE/XML'
	);
}

add_action('wp_ajax_editar_usuario', 'editar_usuario_callback');

function editar_usuario_callback() {
	// Verifique o nonce, valide os dados e verifique as permissões se necessário

	parse_str($_POST['formData'], $formData);

	// Processar os dados do formulário e atualizar as informações do usuário
	// Substitua esta parte do código com a lógica específica de atualização do usuário

	$user_id = $formData['user_id'];
	$razao_social = $formData['razao_social'];
	$cnpj = $formData['cnpj'];

	// Atualizar as metainformações do usuário
	update_user_meta($user_id, 'razao_social', $razao_social);
	update_user_meta($user_id, 'cnpj', $cnpj);

	// Retornar uma resposta (por exemplo, em formato JSON)
	echo json_encode(array('success' => true));
	wp_die();
}
