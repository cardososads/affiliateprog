<?php
/*
 * Template Name: Login
 */
get_header();
?>

<section>
	<div class="grid grid-cols-2 w-full h-screen">
		<div class="p-5 rounded-xl bg-white flex flex-col items-center justify-center">
			<a href="#"><img class="p-5 w-[300px] opacity-80" src="<?= get_template_directory_uri() . '/img/logo_interacao.svg' ?>" alt=""></a>
			<div class="flex flex-col items-center">
				<?php
				$args = array(
					'echo'           => true,
					'redirect'       => site_url($_SERVER['REQUEST_URI']), // Redirecionar de volta para a página atual após o login
					'form_id'        => 'loginform',    // ID do formulário
					'label_username' => __('Username'), // Rótulo do campo de usuário
					'label_password' => __('Password'), // Rótulo do campo de senha
					'label_remember' => __('Remember Me'), // Rótulo para "Lembrar-me"
					'label_log_in'   => __('Log In'), // Rótulo para o botão de login
					'id_username'    => 'user_login',  // ID do campo de usuário
					'id_password'    => 'user_pass',   // ID do campo de senha
					'id_remember'    => 'rememberme',  // ID do campo "Lembrar-me"
					'id_submit'      => 'wp-submit',   // ID do botão de login
					'remember'       => true,          // Mostrar a opção de "Lembrar-me"
					'value_username' => '',            // Valor padrão para o campo de usuário (vazio para nada)
					'value_remember' => false          // Valor padrão para a caixa de seleção "Lembrar-me"
				);

				// Exibe o formulário de login
				wp_login_form($args);
				?>
				<a class="block mt-2 text-sm text-gray-600 hover:underline" href="<?php echo wp_lostpassword_url(); ?>">Esqueceu sua senha?</a>
			</div>
			<span class="mt-5">Ainda não é um afiliado?</span>
			<button class="px-5 py-3 bg-verde rounded-lg"><a class="text-white font-semibold" href="">Cadastre-se aqui</a></button>
		</div>

		<div>
			<img src="<?= get_template_directory_uri() . '/img/login-bg-image.svg' ?>" alt="">
		</div>
	</div>
</section>

<?php
get_footer();
?>
