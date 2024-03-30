<?php

// Adicionar tipos de usuário personalizados
function adicionar_tipos_de_usuario() {
	add_role('varejista', __('Varejista'), array(
		'read' => true, // Permissões básicas para leitura
		// Adicione outras permissões necessárias para os varejistas
	));

	add_role('oficina', __('Oficina'), array(
		'read' => true, // Permissões básicas para leitura
		// Adicione outras permissões necessárias para as oficinas
	));
}
add_action('init', 'adicionar_tipos_de_usuario');


// Adicionar campos personalizados aos perfis de usuário
function adicionar_campos_personalizados_usuario($user_contactmethods) {
	$campos_personalizados = array(
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

	$formData = $_POST; // Dados do formulário já estão no formato correto

	// Mostrar os dados recebidos
	echo "<strong>Dados Recebidos:</strong><br>";
	foreach ($formData as $key => $value) {
		echo "$key: $value<br>";
	}
	echo "<br>";

	// Lista de campos a serem atualizados
	$campos = array(
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

	// Verificar se o ID do usuário está presente nos dados do formulário
	if (!isset($formData['user_id'])) {
		echo json_encode(array('error' => 'Dados de usuário não encontrados.'));
		wp_die();
	}

	$user_id = $formData['user_id'];
	$update_successful = false;

	// Processar os dados do formulário e atualizar as informações do usuário
	foreach ($campos as $campo) {
		if (isset($formData[$campo])) {
			$valor = $formData[$campo];
			update_user_meta($user_id, $campo, $valor);
			$update_successful = true; // Atualização bem-sucedida se ao menos um campo for atualizado
		}
	}

	// Mostrar os dados processados
	echo "<strong>Dados Processados:</strong><br>";
	foreach ($campos as $campo) {
		$valor_atualizado = get_user_meta($user_id, $campo, true);
		echo "$campo: $valor_atualizado<br>";
	}

	// Verificar se houve sucesso na atualização
	if ($update_successful) {
		echo json_encode(array('success' => 'Dados atualizados com sucesso.'));
	} else {
		echo json_encode(array('error' => 'Nenhum dado a ser atualizado.'));
	}

	wp_die();
}

function add_user_script() {
	wp_enqueue_script('add-user-script', get_template_directory_uri() . '/js/add-user-script.js', array('jquery'), '', true);
	wp_localize_script('add-user-script', 'add_user_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_user_script');


function add_new_user() {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	$user_id = wp_create_user($username, $password, $email);

	if (!is_wp_error($user_id)) {
		$user = new WP_User($user_id);
		$user->set_role($role);
		echo 'Usuário adicionado com sucesso!';
	} else {
		echo 'Erro ao adicionar usuário: ' . $user_id->get_error_message();
	}

	die();
}
add_action('wp_ajax_add_new_user', 'add_new_user');
add_action('wp_ajax_nopriv_add_new_user', 'add_new_user');


