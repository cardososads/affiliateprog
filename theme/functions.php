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
//add_filter( 'show_admin_bar', '__return_false' );

function enqueue_chart_js() {
	// Registre a biblioteca Chart.js do CDN
	wp_register_script('chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js', array(), null, true);

	// Adicione a biblioteca ao frontend
	wp_enqueue_script('chart-js');
}
add_action('wp_enqueue_scripts', 'enqueue_chart_js');


// Função para criar a tabela no ativação do plugin ou do tema
function criar_tabela_historico_metas() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'historico_metas';
	$wpdb_collate = $wpdb->collate;

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cnpj varchar(255) NOT NULL,
        meta_filtro decimal(10,2) NOT NULL,
        atingido_filtro decimal(10,2) NOT NULL,
        meta_oleo decimal(10,2) NOT NULL,
        atingido_oleo decimal(10,2) NOT NULL,
        meta_cabine decimal(10,2) NOT NULL,
        atingido_cabine decimal(10,2) NOT NULL,
        meta_combustivel decimal(10,2) NOT NULL,
        atingido_combustivel decimal(10,2) NOT NULL,
        meta_ar decimal(10,2) NOT NULL,
        atingido_ar decimal(10,2) NOT NULL,
        data_registro datetime NOT NULL,
        PRIMARY KEY  (id)
    );";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

// Registra a função para ser executada na ativação do plugin ou do tema
add_action( 'init', 'criar_tabela_historico_metas' );


add_action('wpcf7_before_send_mail', 'custom_validation', 10, 1);

function custom_validation($contact_form) {
	// Verifica se a validação já foi executada
	if (session_id() === '') {
		session_start();
	}
	if ($_SESSION['cnpj_validation_executed']) {
		return;
	}

	$submission = WPCF7_Submission::get_instance();
	if (!$submission) {
		return;
	}

	$posted_data = $submission->get_posted_data();
	$cnpj = $posted_data['cnpj'];

	// Obtém todos os usuários
	$users = get_users();

	// Verifica se algum usuário possui o CNPJ fornecido
	foreach ($users as $user) {
		$user_cnpj = get_user_meta($user->ID, 'cnpj', true);
		if ($user_cnpj == $cnpj) {
			$contact_form->add_error('cnpj', 'CNPJ já está em uso. Por favor, escolha outro.');
			$_SESSION['cnpj_validation_executed'] = true; // Marca a validação como executada

			// Adiciona uma classe ao botão de envio para desativá-lo
			echo "<script>document.addEventListener('DOMContentLoaded', function() { document.querySelector('.wpcf7-submit').setAttribute('disabled', 'disabled'); });</script>";
			return;
		}
	}
}

add_action('admin_post_send_invite_email', 'send_invite_email');
add_action('admin_post_nopriv_send_invite_email', 'send_invite_email');

function send_invite_email() {
	// Verifica se o nonce é válido
	if (!isset($_POST['send_invite_email_nonce']) || !wp_verify_nonce($_POST['send_invite_email_nonce'], 'send_invite_email_nonce')) {
		wp_die('Nonce inválido');
	}

	// Verifica se o email do usuário e o CNPJ foram fornecidos
	if (isset($_POST['user_email']) && isset($_POST['cnpj'])) {
		// Obtém os dados do formulário
		$user_email = sanitize_email($_POST['user_email']);
		$cnpj = sanitize_text_field($_POST['cnpj']);

		// Verifica se há um usuário logado
		if (is_user_logged_in()) {
			// Obtém o ID do usuário atualmente logado
			$user_id = get_current_user_id();

			// Obtém o código de convite associado ao usuário atual
			$codigo_invite = get_user_meta($user_id, 'codigo_invite', true);

			// Link de cadastro com o código de convite
			$cadastro_link = esc_url(add_query_arg('codigo_invite', $codigo_invite, site_url('/cadastro-oficina')));

			// Endereço de e-mail do administrador do site
			$to = $user_email;

			// Assunto do e-mail
			$subject = 'Convite para Oficina';

			// Corpo do e-mail
			$message = 'CNPJ do Usuário: ' . $cnpj . '<br>';
			$message .= 'E-mail do Usuário: ' . $user_email . '<br>';
			$message .= 'Link de Cadastro: <a href="' . $cadastro_link . '">' . $cadastro_link . '</a>';

			// Cabeçalhos adicionais
			$headers = array('Content-Type: text/html; charset=UTF-8');

			// Envie o e-mail
			$sent = wp_mail($to, $subject, $message, $headers);

			// Verifique se o e-mail foi enviado com sucesso
			if ($sent) {
				echo 'E-mail enviado com sucesso para o administrador do site.';
			} else {
				echo 'Falha ao enviar o e-mail.';
			}
		} else {
			echo 'Não foi possível enviar o convite. Por favor, faça login.';
		}
	} else {
		echo 'Por favor, forneça um e-mail e um CNPJ.';
	}

	// Redireciona de volta para a página de onde o formulário foi enviado
	wp_redirect($_SERVER['HTTP_REFERER']);
	exit;
}
