<?php
/**
 * AffiliateProg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AffiliateProg
 */

if ( ! defined( 'AFFILIATEPROG_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'AFFILIATEPROG_VERSION', '0.1.0' );
}

if ( ! defined( 'AFFILIATEPROG_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `affiliateprog_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'AFFILIATEPROG_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'affiliateprog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function affiliateprog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on AffiliateProg, use a find and replace
		 * to change 'affiliateprog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'affiliateprog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'affiliateprog' ),
				'menu-2' => __( 'Footer Menu', 'affiliateprog' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'affiliateprog_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function affiliateprog_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'affiliateprog' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'affiliateprog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'affiliateprog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function affiliateprog_scripts() {
	wp_enqueue_style( 'affiliateprog-style', get_stylesheet_uri(), array(), AFFILIATEPROG_VERSION );
	wp_enqueue_style('flowbite-style', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css', array(), AFFILIATEPROG_VERSION);
	wp_enqueue_style( 'affiliateprog-style-nocomp', get_template_directory_uri() . '/style-nocomp.css', array(), AFFILIATEPROG_VERSION );
	wp_enqueue_script('flowbite-script', 'https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js', array(), AFFILIATEPROG_VERSION, false);
	wp_enqueue_script( 'affiliateprog-script', get_template_directory_uri() . '/js/script.min.js', array(), AFFILIATEPROG_VERSION, true );
	wp_enqueue_script( 'affiliateprog-custom-script', get_template_directory_uri() . '/js/scripts.js', array(), AFFILIATEPROG_VERSION, true );
//	wp_enqueue_script( 'affiliateprog-htmx-script', get_template_directory_uri() . '/js/htmx.min.js', array(), AFFILIATEPROG_VERSION, false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'affiliateprog_scripts' );

function enqueue_jquery_from_google_cdn() {
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_from_google_cdn');


/**
 * Enqueue the block editor script.
 */
function affiliateprog_enqueue_block_editor_script() {
	wp_enqueue_script(
		'affiliateprog-editor',
		get_template_directory_uri() . '/js/block-editor.min.js',
		array(
			'wp-blocks',
			'wp-edit-post',
		),
		AFFILIATEPROG_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'affiliateprog_enqueue_block_editor_script' );

/**
 * Enqueue the script necessary to support Tailwind Typography in the block
 * editor, using an inline script to create a JavaScript array containing the
 * Tailwind Typography classes from AFFILIATEPROG_TYPOGRAPHY_CLASSES.
 */
function affiliateprog_enqueue_typography_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'affiliateprog-typography',
			get_template_directory_uri() . '/js/tailwind-typography-classes.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			AFFILIATEPROG_VERSION,
			true
		);
		wp_add_inline_script( 'affiliateprog-typography', "tailwindTypographyClasses = '" . esc_attr( AFFILIATEPROG_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'affiliateprog_enqueue_typography_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function affiliateprog_tinymce_add_class( $settings ) {
	$settings['body_class'] = AFFILIATEPROG_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'affiliateprog_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions with dashboard menus roles
 */

require get_template_directory() . '/inc/users/user-menu-contents.php';
require get_template_directory() . '/inc/users/user-roles.php';

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );

function enqueue_chart_js() {
	// Registre a biblioteca Chart.js do CDN
	wp_register_script('chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js', array(), null, true);

	// Adicione a biblioteca ao frontend
	wp_enqueue_script('chart-js');
}
add_action('wp_enqueue_scripts', 'enqueue_chart_js');


// Função para criar a tabela no ativação do plugin ou do tema
function criar_tabela_meta_filtros() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'meta_filtros';
	$wpdb_collate = $wpdb->collate;

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cnpj varchar(255) NOT NULL,
        meta_filtros decimal(10,2) NOT NULL,
        atingido_filtros decimal(10,2) NOT NULL,
        meta_filtro_de_oleo decimal(10,2) NOT NULL,
        atingido_filtro_de_oleo decimal(10,2) NOT NULL,
        meta_filtro_de_cabine decimal(10,2) NOT NULL,
        atingido_filtro_de_cabine decimal(10,2) NOT NULL,
        meta_filtro_de_combustivel decimal(10,2) NOT NULL,
        atingido_filtro_de_combustivel decimal(10,2) NOT NULL,
        meta_filtro_de_ar decimal(10,2) NOT NULL,
        atingido_filtro_de_ar decimal(10,2) NOT NULL,
        data_registro datetime NOT NULL,
        PRIMARY KEY  (id)
    );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
add_action( 'init', 'criar_tabela_meta_filtros' );

function criar_tabela_meta_eletrica() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'meta_eletrica';
	$wpdb_collate = $wpdb->collate;

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cnpj varchar(255) NOT NULL,
        meta_alternador decimal(10,2) NOT NULL,
        atingido_alternador decimal(10,2) NOT NULL,
        meta_motor_de_partida decimal(10,2) NOT NULL,
        atingido_motor_de_partida decimal(10,2) NOT NULL,
        meta_componentes_eletricos decimal(10,2) NOT NULL,
        atingido_componentes_eletricos decimal(10,2) NOT NULL,
        data_registro datetime NOT NULL,
        PRIMARY KEY  (id)
    );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
add_action( 'init', 'criar_tabela_meta_eletrica' );

function criar_tabela_meta_freios() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'meta_freios';
	$wpdb_collate = $wpdb->collate;

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cnpj varchar(255) NOT NULL,
        meta_pastilha_de_friccao decimal(10,2) NOT NULL,
        atingido_pastilha_de_friccao decimal(10,2) NOT NULL,
		meta_de_fluido decimal(10,2) NOT NULL,
        atingido_fluido decimal(10,2) NOT NULL,
		meta_de_hidraulica decimal(10,2) NOT NULL,
        atingido_hidraulica decimal(10,2) NOT NULL,
		meta_de_cc_braking_systems decimal(10,2) NOT NULL,
        atingido_cc_braking_systems decimal(10,2) NOT NULL,
        data_registro datetime NOT NULL,
        PRIMARY KEY  (id)
    );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
add_action( 'init', 'criar_tabela_meta_freios' );



add_action('admin_post_send_invite_email', 'send_invite_email');
add_action('admin_post_nopriv_send_invite_email', 'send_invite_email');

function send_invite_email() {
	if (!isset($_POST['send_invite_email_nonce']) || !wp_verify_nonce($_POST['send_invite_email_nonce'], 'send_invite_email_nonce')) {
		wp_die('Nonce inválido');
	}

	if (isset($_POST['user_email']) && isset($_POST['cnpj'])) {
		$user_email = sanitize_email($_POST['user_email']);
		$cnpj = sanitize_text_field($_POST['cnpj']);

		if (is_user_logged_in()) {
			$user_id = get_current_user_id();

			$codigo_invite = get_user_meta($user_id, 'codigo_invite', true);

			$cadastro_link = esc_url(add_query_arg('codigo_invite', $codigo_invite, site_url('/cadastro-oficina')));

			$to = $user_email;

			$subject = 'Convite para Oficina';


			$message = 'Olá,<br><br>';
			$message .= 'Você está sendo convidado(a) para participar do Programa de Interação, onde sua oficina poderá se beneficiar de diversas oportunidades e recursos exclusivos.<br><br>';
			$message .= 'Detalhes do convite:<br>';
			$message .= '- Link de Cadastro: <a href="' . $cadastro_link . '">' . $cadastro_link . '</a><br><br>';
			$message .= 'Esperamos contar com sua participação!<br><br>';
			$message .= 'Atenciosamente,<br>';
			$message .= 'Equipe do Programa de Interação';

			$headers = array('Content-Type: text/html; charset=UTF-8');

			$sent = wp_mail($to, $subject, $message, $headers);

			if ($sent) {
				$redirect_url = add_query_arg('invite_email_success', 'true', $_SERVER['HTTP_REFERER']);
			} else {
				$redirect_url = add_query_arg('invite_email_error', 'true', $_SERVER['HTTP_REFERER']);
			}

			wp_safe_redirect($redirect_url);
			exit;
		} else {
			wp_die('Não foi possível enviar o convite. Por favor, faça login.');
		}
	} else {
		wp_die('Por favor, forneça um e-mail e um CNPJ.');
	}
}

function importar_csv_e_processar_upload($arquivo_tmp) {
	global $dados_csv_processados;

	$dados_csv_processados = array();

	if (!is_uploaded_file($arquivo_tmp)) {
		return false;
	}

	if (($handle = fopen($arquivo_tmp, "r")) !== false) {
		$cabecalhos = fgetcsv($handle, 1000, ",");

		$cabecalhos = array_map(function($cabecalho) {
			$cabecalho = trim(preg_replace('/[^\w\s]/u', '', $cabecalho));
			$cabecalho = str_replace(' ', '_', $cabecalho);
			$cabecalho = remove_acentos($cabecalho);
			$cabecalho = strtolower($cabecalho);
			$cabecalho = preg_replace('/_+/', '_', $cabecalho);
			return $cabecalho;
		}, $cabecalhos);

		while (($linha = fgetcsv($handle, 1000, ",")) !== false) {
			$linha = array_map(function($valor) {
				return preg_replace('/[^0-9]/', '', $valor);
			}, $linha);

			$linha_associativa = array_combine($cabecalhos, $linha);

			$linha_processada = array_map('sanitize_text_field', $linha_associativa);

			$dados_csv_processados[] = $linha_processada;
		}
		fclose($handle);
		return true;
	} else {
		return false;
	}
}

function remove_acentos($string) {
	return iconv('UTF-8', 'ASCII//TRANSLIT', $string);
}

function verificar_compatibilidade_campos($dados, $nome_tabela) {
	global $wpdb;

	// Adiciona o prefixo da tabela, se necessário
	$nome_tabela_com_prefixo = $wpdb->prefix . $nome_tabela;

	// Verifica se a tabela existe no banco de dados
	if (!tabela_existe($nome_tabela_com_prefixo)) {
		echo "A tabela '$nome_tabela_com_prefixo' não existe no banco de dados. Não é possível continuar.";
		return;
	}

	// Obtém a descrição dos campos na tabela
	$desc_tabela = $wpdb->get_results("DESCRIBE $nome_tabela_com_prefixo");

	// Verifica se ocorreu algum erro ao obter a descrição da tabela
	if ($wpdb->last_error) {
		echo "Erro ao obter a descrição da tabela: " . $wpdb->last_error;
		return;
	}

	// Array para armazenar os nomes das colunas na tabela
	$colunas_tabela = array();

	// Extrai os nomes das colunas da descrição da tabela, ignorando 'id' e 'data_registro'
	foreach ($desc_tabela as $coluna) {
		if ($coluna->Field != 'id' && $coluna->Field != 'data_registro') {
			$colunas_tabela[] = $coluna->Field;
		}
	}

	// Variável para contar o número total de inserções bem-sucedidas
	$total_insercoes = 0;

	// Verifica se as colunas nos dados correspondem às colunas na tabela
	foreach ($dados as $linha) {
		// Array para armazenar os dados a serem inseridos
		$dados_insercao = array();

		// Itera sobre os valores da linha
		foreach ($linha as $chave => $valor) {
			// Ignora os campos 'cnpj' e 'data_registro', pois eles não precisam ser verificados
			if ($chave == 'data_registro') {
				continue;
			}

			// Verifica se o nome da coluna existe na tabela
			if (in_array($chave, $colunas_tabela)) {
				// Adiciona os dados à array de inserção
				$dados_insercao[$chave] = $valor;
			} else {
				return;
			}
		}

		// Adiciona a data de registro à array de inserção
		$dados_insercao['data_registro'] = current_time('mysql');

		// Insere os dados na tabela
		$resultado = $wpdb->insert($nome_tabela_com_prefixo, $dados_insercao);

		// Verifica se a inserção foi bem-sucedida
		if ($resultado !== false) {
			// Incrementa o total de inserções bem-sucedidas
			$total_insercoes++;
		}
	}

	// Exibe o total de inserções bem-sucedidas
	echo "Total de linhas inseridas: $total_insercoes";
}


// Função para verificar se a tabela existe no banco de dados
function tabela_existe($nome_tabela) {
	global $wpdb; // Obtém a instância global do objeto do WordPress Database

	// Verifica se a tabela existe no banco de dados
	$resultado = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $nome_tabela));

	// Retorna true se a tabela existe, false caso contrário
	return $resultado !== null;
}



// Função para acessar os dados da tabela com filtros opcionais
function meu_acesso_tabela($tabela, $filtros = array()) {
	global $wpdb; // Obtém a instância global do objeto do WordPress Database

	// Adiciona o prefixo da tabela do WordPress, se necessário
	$nome_tabela = $wpdb->prefix . $tabela;

	// Construindo a consulta SQL com base nos filtros
	$sql = "SELECT * FROM $nome_tabela WHERE 1=1";
	// Adiciona filtros à consulta, se fornecidos
	if (!empty($filtros)) {
		foreach ($filtros as $campo => $valor) {
			$sql .= " AND $campo = '$valor'";
		}
	}

	// Obtém os dados da tabela com base nos filtros aplicados
	$resultados = $wpdb->get_results($sql);

	// Verifica a compatibilidade dos campos antes de inserir os dados
	verificar_compatibilidade_campos($resultados, $tabela);

	// Retorna os resultados
	return $resultados;
}

// Função para retornar a quantidade de usuários cadastrados por mês
function usuarios_cadastrados_por_mes() {
	global $wpdb;

	$results = $wpdb->get_results("
        SELECT
            YEAR(user_registered) AS year,
            MONTH(user_registered) AS month,
            COUNT(*) AS total_users
        FROM
            {$wpdb->prefix}users
        GROUP BY
            YEAR(user_registered),
            MONTH(user_registered)
    ");

	$output = '<table>';

	foreach ($results as $result) {
		$output .= '<tr>';
		$output .= '<td class="text-lg font-medium leading-6 text-gray-700">' . $result->total_users . '</td>';
		$output .= '</tr>';
	}

	$output .= '</table>';

	return $output;
}
add_shortcode('exibir_usuarios_cadastrados', 'usuarios_cadastrados_por_mes');

// Função para retornar a quantidade de usuários ativos cadastrados por mês
function usuarios_ativos_por_mes() {
	global $wpdb;

	$results = $wpdb->get_results("
        SELECT
            YEAR(u.user_registered) AS year,
            MONTH(u.user_registered) AS month,
            COUNT(*) AS total_users_ativos
        FROM
            {$wpdb->prefix}users u
        JOIN
            {$wpdb->prefix}usermeta um ON u.ID = um.user_id
        WHERE
            um.meta_key = 'user_status' AND um.meta_value = 'ativo'
        GROUP BY
            YEAR(u.user_registered),
            MONTH(u.user_registered)
    ");

	$output = [];

	foreach ($results as $result) {
		$month_name = date("F", mktime(0, 0, 0, $result->month, 1));
		$output[$result->year][$month_name] = $result->total_users_ativos;
	}

	return $output;
}

add_shortcode('exibir_usuarios_ativos_por_mes', 'usuarios_ativos_por_mes');

// Função para retornar a quantidade de usuários cadastrados por mês no ano corrente
function quantidade_usuarios_cadastrados_por_mes() {
	global $wpdb;

	$year = date("Y"); // Obtém o ano corrente

	$results = $wpdb->get_results("
        SELECT
            MONTH(u.user_registered) AS month,
            COUNT(u.ID) AS total_users_cadastrados
        FROM {$wpdb->prefix}users u
        WHERE YEAR(u.user_registered) = $year
        GROUP BY MONTH(u.user_registered)
    ");

	$output = [];
	// Preenche o array de saída com os resultados
	foreach ($results as $result) {
		$month_name = date("F", mktime(0, 0, 0, $result->month, 1));
		$output[$year][$month_name] = $result->total_users_cadastrados;
	}

	return $output;
}

// Função para retornar a quantidade de usuários ativos cadastrados por mês no ano corrente
function quantidade_usuarios_ativos_por_mes() {
	global $wpdb;

	$year = date("Y"); // Obtém o ano corrente

	$results = $wpdb->get_results("
        SELECT
            MONTH(um.user_registered) AS month,
            COUNT(um.user_id) AS total_users_ativos
        FROM {$wpdb->prefix}usermeta um
        INNER JOIN {$wpdb->prefix}users u ON um.user_id = u.ID
        WHERE YEAR(u.user_registered) = $year AND um.meta_key = 'user_status' AND um.meta_value = 'ativo'
        GROUP BY MONTH(u.user_registered)
    ");

	$output = [];
	// Preenche o array de saída com os resultados
	foreach ($results as $result) {
		$month_name = date("F", mktime(0, 0, 0, $result->month, 1));
		$output[$year][$month_name] = $result->total_users_ativos;
	}

	return $output;
}


// Suponha que o ID do usuário logado seja $user_id_logged_in

// Função para obter o código de convite de um usuário
function get_codigo_invite($user_id)
{
	return get_user_meta($user_id, 'codigo_invite', true);
}

// Função para obter a quantidade de usuários indicados por um determinado código de convite
function quantidade_usuarios_indicados($codigo_invite)
{
	// Inicialize a quantidade de usuários indicados como zero
	$quantidade_usuarios_indicados = 0;

	// Obtenha todos os usuários
	$users = get_users(array('meta_key' => 'codigo_invite', 'meta_value' => $codigo_invite));

	// Percorra todos os usuários para contar quantos têm o código de convite correspondente
	foreach ($users as $user) {
		// Exclua o próprio usuário logado da contagem
		global $user_id_logged_in;
		if ($user->ID != $user_id_logged_in) {
			$quantidade_usuarios_indicados++;
		}
	}

	return $quantidade_usuarios_indicados;
}

function quantidade_usuarios_ativos($codigo_invite)
{
	// Inicialize a quantidade de usuários ativos com código de convite como zero
	$quantidade_usuarios_ativos = 0;

	// Obtenha todos os usuários com o código de convite correspondente
	$users = get_users(array(
		'meta_key'     => 'codigo_invite',
		'meta_value'   => $codigo_invite,
		'meta_compare' => 'EXISTS', // Garante que o meta_key 'codigo_invite' exista para o usuário
	));

	// Percorra todos os usuários para contar quantos estão ativos
	foreach ($users as $user) {
		// Verifique se o usuário está ativo
		if ('ativo' === get_user_meta($user->ID, 'user_status', true)) {
			$quantidade_usuarios_ativos++;
		}
	}

	return $quantidade_usuarios_ativos;
}




