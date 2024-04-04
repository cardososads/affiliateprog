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
		'email_danfe_xml' => 'Email DANFE/XML',
		'codigo_invite' => 'Código de Convite',
		'user_status' => 'Status'
	);

	foreach ($campos_personalizados as $campo => $label) {
		$user_contactmethods[$campo] = $label;
	}

	return $user_contactmethods;
}
add_filter('user_contactmethods', 'adicionar_campos_personalizados_usuario');

// Função para gerar o código de convite para os varejistas
function gerar_codigo_convite_varejista($user_id) {
	$codigo_convite = 'vrj' . str_pad($user_id, 7, '0', STR_PAD_LEFT); // Formato: vrj0000001
	update_user_meta($user_id, 'codigo_invite', $codigo_convite);
}

// Função para validar e associar a oficina ao varejista através do código de convite
function associar_oficina_ao_varejista($user_id, $codigo_convite) {
	// Verificar se o código de convite é válido
	$varejista_id = get_user_by('meta_value', 'codigo_invite', $codigo_convite);
	if ($varejista_id) {
		// Associar a oficina ao varejista
		update_user_meta($user_id, 'varejista_associado', $varejista_id);
		return true;
	} else {
		return false; // Código de convite inválido
	}
}

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
		'email_danfe_xml',
		'codigo_invite',
		'user_status'
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

// Função para obter os campos personalizados do usuário
function get_campos_personalizados_usuario() {
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
		'email_danfe_xml' => 'Email DANFE/XML',
		'codigo_invite' => 'Código de Convite',
	);
	return $campos_personalizados;
}

add_action('wp_ajax_editar_usuario', 'editar_usuario_callback');

function editar_usuario_callback() {
    // Verifique o nonce, valide os dados e verifique as permissões se necessário

    $formData = $_POST; // Dados do formulário já estão no formato correto

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
        'email_danfe_xml',
        'codigo_invite',
        'user_status'
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

    // Verificar se houve sucesso na atualização
    if ($update_successful) {
        echo json_encode(array('success' => 'Dados atualizados com sucesso.'));
    } else {
        echo json_encode(array('error' => 'Nenhum dado a ser atualizado.'));
    }

    wp_die();
}


function add_user_script() {
	wp_localize_script('add-user-script', 'add_user_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'add_user_script');
//
//
//function add_new_user() {
//	$username = $_POST['username'];
//	$email = $_POST['email'];
//	$password = $_POST['password'];
//	$role = $_POST['role'];
//
//	$user_id = wp_create_user($username, $password, $email);
//
//	if (!is_wp_error($user_id)) {
//		$user = new WP_User($user_id);
//		$user->set_role($role);
//
//		// Se o usuário criado for um varejista, gere o código de convite
//		if ($role == 'varejista') {
//			gerar_codigo_convite_varejista($user_id);
//		}
//
//		echo 'Usuário adicionado com sucesso!';
//	} else {
//		echo 'Erro ao adicionar usuário: ' . $user_id->get_error_message();
//	}
//
//	die();
//}
//add_action('wp_ajax_add_new_user', 'add_new_user');
//add_action('wp_ajax_nopriv_add_new_user', 'add_new_user');

add_action('wp_ajax_add_new_user', 'add_new_user_callback');
add_action('wp_ajax_nopriv_add_new_user', 'add_new_user_callback');

function add_new_user_callback() {
	$username = sanitize_user($_POST['username']);
	$email = sanitize_email($_POST['email']);
	$password = $_POST['password'];
	$role = $_POST['role'];
	$cnpj = sanitize_text_field($_POST['cnpj']);
	$user_status = $_POST['user_status'];
	var_dump($cnpj);
	var_dump($cnpj);
	// Verifica se todos os campos necessários estão presentes
	if (!empty($username) && !empty($email) && !empty($password) && !empty($role) && !empty($cnpj) && !empty($user_status)) {
		// Cria o novo usuário
		$user_id = wp_create_user($username, $password, $email);

		// Verifica se o usuário foi criado com sucesso
		if (!is_wp_error($user_id)) {
			// Define o papel do usuário
			$user = new WP_User($user_id);
			$user->set_role($role);

			// Define o campo 'user_status' como 'pendente'
			update_user_meta($user_id, 'user_status', $user_status);

			// Salva o CNPJ do usuário
			update_user_meta($user_id, 'cnpj', $cnpj);

			// Redireciona para a página de sucesso
		} else {
			// Se houver um erro ao criar o usuário, retorna uma mensagem de erro
			echo 'Erro ao criar usuário: ' . $user_id->get_error_message();
		}
	} else {
		// Se algum campo estiver em branco, retorna uma mensagem de erro
		echo 'Todos os campos são obrigatórios.';
	}

	wp_die();
}

// Verificar e gerar códigos de convite para varejistas que não possuem
function verificar_e_gerar_codigos_convite() {
	// Obtém todos os usuários com o papel 'varejista'
	$usuarios_varejistas = get_users(array(
		'role' => 'varejista',
		'meta_query' => array(
			array(
				'key' => 'codigo_invite',
				'compare' => 'NOT EXISTS', // Verifica se o campo 'codigo_invite' não existe
			),
		),
	));

	// Se houver varejistas sem código de convite, gere para eles
	foreach ($usuarios_varejistas as $usuario) {
		$user_id = $usuario->ID;
		gerar_codigo_convite_varejista($user_id);
	}
}

// Adicionar a verificação na inicialização do tema
add_action('init', 'verificar_e_gerar_codigos_convite');

