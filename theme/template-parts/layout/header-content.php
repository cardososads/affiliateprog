<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AffiliateProg
 */
$current_user_id = get_current_user_id();
$user_data = get_userdata($current_user_id);
$user_nome_fantasia = get_user_meta($current_user_id, 'nome_fantasia', true);
$user_email = get_user_meta($current_user_id, 'email', true);
?>

<nav class="fixed z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
	<div class="px-3 py-3 lg:px-5 lg:pl-3">
		<div class="flex items-center justify-between">
			<div class="flex items-center justify-start">
				<button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
					<span class="sr-only">Abrir Lateral</span>
					<svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="#41837F" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
					<svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="#41837F" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
				</button>
				<a href="" class="flex ml-2 md:mr-24 text-2xl font-bold">
					<img src="<?php echo get_template_directory_uri() . '/img/logo_interacao.svg'; ?>" class="h-8 mr-3" alt="FlowBite Logo" />
					<img src="<?php echo get_template_directory_uri() . '/img/logovarejomais.jpg'; ?>" class="h-8 mr-3" alt="FlowBite Logo" />
					<?php
					// Verifica o tipo de usuário
					if (current_user_can('administrator')) {
						// Se for administrador
						echo 'Área do Administrador';
					} elseif (current_user_can('varejista')) {
						// Se for varejista
						echo 'Área do Varejista';
					} elseif (current_user_can('oficina')) {
						// Se for oficina
						echo 'Área da Oficina';
					} else {
						// Se não for nenhum dos tipos acima
						echo '';
					}
					?>
				</a>

			</div>
			<div class="flex items-center">
				<!-- Profile -->
				<div class="flex items-center ml-3">
					<div>
						<button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
							<span class="sr-only">Open user menu</span>
							<img class="w-8 h-8 rounded-full" src="<?= get_template_directory_uri() . '/img/52eabf633ca6414e60a7677b0b917d92-criador-de-avatar-masculino.webp' ?>" alt="user photo">
						</button>
					</div>
					<!-- Dropdown menu -->
					<div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-2">
						<div class="px-4 py-3" role="none">
							<p class="text-sm text-gray-900 dark:text-white" role="none">
								<?= $user_nome_fantasia ?>
							</p>
							<p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
								<?= $user_email ?>
							</p>
						</div>
						<ul class="py-1" role="none">
							<!-- Adicione o link de logout -->
							<li>
								<a href="<?php echo wp_logout_url(); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sair</a>
							</li>
						</ul>
					</div>

				</div>
			</div>
		</div>
	</div>
</nav>
