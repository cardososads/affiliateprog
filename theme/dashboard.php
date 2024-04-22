<?php
/*
 * Template Name: Dashboard
 */
get_header();

$current_user = wp_get_current_user();
$cargo = isset($current_user->roles[0]) ? $current_user->roles[0] : '';
$contents = get_user_contents($cargo);
$view = isset($_GET['content']) && isset($contents[$_GET['content']]) ? $_GET['content'] : '';

?>


<?php get_footer(); ?>

<div class="flex w-full h-screen">
	<?php if ($cargo !== 'oficina') : ?>
	<!-- SIDEBAR -->
	<aside id="sidebar"
		   class="absolute md:relative top-0 left-0 z-40 sm:z-0 flex flex-col flex-shrink-0 sm:visible w-56 h-screen pt-14 font-normal duration-75 lg:flex transition-transform -translate-x-full sm:translate-x-0"
		   aria-label="Sidebar">
		<div
			class="relative flex flex-col flex-1 min-h-0 pt-0 bg-verde-10% border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
			<div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
				<div class="flex-1 px-3 space-y-1 divide-y divide-gray-200 dark:divide-gray-700">
					<ul class="pb-2 space-y-2">
						<li>
							<form action="#" method="GET" class="lg:hidden">
								<label for="mobile-search" class="sr-only">Search</label>
								<div class="relative">
									<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
										<svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
											 xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
												  clip-rule="evenodd"></path>
										</svg>
									</div>
									<input type="text" name="email" id="mobile-search"
										   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
										   placeholder="Search">
								</div>
							</form>
						</li>
						<?php foreach ($contents as $key => $content) : ?>
							<li>
								<?php if ($key === $view) : ?>
									<a href="<?php echo esc_url(add_query_arg('content', $key, get_permalink())); ?>"
									   class="flex text-[14px] items-center rounded-3xl bg-slate-200 p-4 gap-2">
										<?php echo $content['icon']; ?>
										<?php echo $content['title']; ?>
									</a>
								<?php else: ?>
									<a href="<?php echo esc_url(add_query_arg('content', $key, get_permalink())); ?>"
									   class="flex text-[14px] items-center p-4 gap-2">
										<?php echo $content['icon']; ?>
										<?php echo $content['title']; ?>
									</a>
								<?php endif; ?>

							</li>
						<?php endforeach; ?>
					</ul>

					<div class="pt-2 space-y-2"></div>
				</div>
			</div>
		</div>
		<div
			class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex  dark:bg-gray-800 z-20 border-r border-gray-200 dark:border-gray-700">
			<a href="https://api.whatsapp.com/send?phone=5519971719172" data-tooltip-target="tooltip-whats" target="_blank"
			   class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer bg-white hover:bg-gray-200 shadow-xl">
				<svg height="auto" width="25" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
					 fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<path style="fill:#EDEDED;"
							  d="M0,512l35.31-128C12.359,344.276,0,300.138,0,254.234C0,114.759,114.759,0,255.117,0 S512,114.759,512,254.234S395.476,512,255.117,512c-44.138,0-86.51-14.124-124.469-35.31L0,512z"></path>
						<path style="fill:#55CD6C;"
							  d="M137.71,430.786l7.945,4.414c32.662,20.303,70.621,32.662,110.345,32.662 c115.641,0,211.862-96.221,211.862-213.628S371.641,44.138,255.117,44.138S44.138,137.71,44.138,254.234 c0,40.607,11.476,80.331,32.662,113.876l5.297,7.945l-20.303,74.152L137.71,430.786z"></path>
						<path style="fill:#FEFEFE;"
							  d="M187.145,135.945l-16.772-0.883c-5.297,0-10.593,1.766-14.124,5.297 c-7.945,7.062-21.186,20.303-24.717,37.959c-6.179,26.483,3.531,58.262,26.483,90.041s67.09,82.979,144.772,105.048 c24.717,7.062,44.138,2.648,60.028-7.062c12.359-7.945,20.303-20.303,22.952-33.545l2.648-12.359 c0.883-3.531-0.883-7.945-4.414-9.71l-55.614-25.6c-3.531-1.766-7.945-0.883-10.593,2.648l-22.069,28.248 c-1.766,1.766-4.414,2.648-7.062,1.766c-15.007-5.297-65.324-26.483-92.69-79.448c-0.883-2.648-0.883-5.297,0.883-7.062 l21.186-23.834c1.766-2.648,2.648-6.179,1.766-8.828l-25.6-57.379C193.324,138.593,190.676,135.945,187.145,135.945"></path>
					</g></svg>
			</a>
			<div id="tooltip-whats" role="tooltip"
				 class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
				Whatsapp
				<div class="tooltip-arrow" data-popper-arrow></div>
			</div>
			<a href="https://suporte-bosch.zendesk.com/hc/pt-br" data-tooltip-target="tooltip-settings" target="_blank"
			   class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer bg-white hover:bg-gray-200 shadow-xl">
				<svg height="auto" width="25" xmlns="http://www.w3.org/2000/svg"
					 xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" xml:space="preserve" fill="#000000"><g
						id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<style type="text/css"> .st0 {
								fill: #4F5D73;
							}

							.st1 {
								opacity: 0.2;
							}

							.st2 {
								fill: #231F20;
							}

							.st3 {
								fill: #FFFFFF;
							}

							.st4 {
								fill: #E0995E;
							} </style>
						<g id="Layer_1">
							<g>
								<circle class="st0" cx="32" cy="32" r="32"></circle>
							</g>
							<g class="st1">
								<g>
									<path class="st2"
										  d="M10,34c0,12.2,9.8,22,22,22s22-9.8,22-22s-9.8-22-22-22S10,21.8,10,34z M44,34c0,6.6-5.4,12-12,12 c-6.6,0-12-5.4-12-12s5.4-12,12-12C38.6,22,44,27.4,44,34z"></path>
								</g>
							</g>
							<g>
								<g>
									<path class="st3"
										  d="M10,32c0,12.2,9.8,22,22,22s22-9.8,22-22s-9.8-22-22-22S10,19.8,10,32z M44,32c0,6.6-5.4,12-12,12 c-6.6,0-12-5.4-12-12s5.4-12,12-12C38.6,20,44,25.4,44,32z"></path>
								</g>
							</g>
							<g class="st1">
								<path class="st2"
									  d="M27.9,22.9c0.9,0.9,0.9,2.3,0.1,3.1l-4,4c-0.8,0.8-2.2,0.8-3.1-0.1l-7.4-7.4c-0.9-0.9-0.9-2.3-0.1-3.1l4-4 c0.8-0.8,2.2-0.8,3.1,0.1L27.9,22.9z"></path>
							</g>
							<g class="st1">
								<path class="st2"
									  d="M50.6,45.5c0.9,0.9,0.9,2.3,0.1,3.1l-4,4c-0.8,0.8-2.2,0.8-3.1-0.1l-7.4-7.4c-0.9-0.9-0.9-2.3-0.1-3.1l4-4 c0.8-0.8,2.2-0.8,3.1,0.1L50.6,45.5z"></path>
							</g>
							<g class="st1">
								<path class="st2"
									  d="M43.1,29.9c-0.9,0.9-2.3,0.9-3.1,0.1l-4-4c-0.8-0.8-0.8-2.2,0.1-3.1l7.4-7.4c0.9-0.9,2.3-0.9,3.1-0.1l4,4 c0.8,0.8,0.8,2.2-0.1,3.1L43.1,29.9z"></path>
							</g>
							<g class="st1">
								<path class="st2"
									  d="M20.5,52.6c-0.9,0.9-2.3,0.9-3.1,0.1l-4-4c-0.8-0.8-0.8-2.2,0.1-3.1l7.4-7.4c0.9-0.9,2.3-0.9,3.1-0.1l4,4 c0.8,0.8,0.8,2.2-0.1,3.1L20.5,52.6z"></path>
							</g>
							<g>
								<path class="st4"
									  d="M27.9,20.9c0.9,0.9,0.9,2.3,0.1,3.1l-4,4c-0.8,0.8-2.2,0.8-3.1-0.1l-7.4-7.4c-0.9-0.9-0.9-2.3-0.1-3.1l4-4 c0.8-0.8,2.2-0.8,3.1,0.1L27.9,20.9z"></path>
							</g>
							<g>
								<path class="st4"
									  d="M50.6,43.5c0.9,0.9,0.9,2.3,0.1,3.1l-4,4c-0.8,0.8-2.2,0.8-3.1-0.1l-7.4-7.4c-0.9-0.9-0.9-2.3-0.1-3.1l4-4 c0.8-0.8,2.2-0.8,3.1,0.1L50.6,43.5z"></path>
							</g>
							<g>
								<path class="st4"
									  d="M43.1,27.9c-0.9,0.9-2.3,0.9-3.1,0.1l-4-4c-0.8-0.8-0.8-2.2,0.1-3.1l7.4-7.4c0.9-0.9,2.3-0.9,3.1-0.1l4,4 c0.8,0.8,0.8,2.2-0.1,3.1L43.1,27.9z"></path>
							</g>
							<g>
								<path class="st4"
									  d="M20.5,50.6c-0.9,0.9-2.3,0.9-3.1,0.1l-4-4c-0.8-0.8-0.8-2.2,0.1-3.1l7.4-7.4c0.9-0.9,2.3-0.9,3.1-0.1l4,4 c0.8,0.8,0.8,2.2-0.1,3.1L20.5,50.6z"></path>
							</g>
						</g>
						<g id="Layer_2"></g>
					</g></svg>
			</a>
			<div id="tooltip-settings" role="tooltip"
				 class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
				Suporte
				<div class="tooltip-arrow" data-popper-arrow></div>
			</div>
		</div>
	</aside>
	<?php endif; ?>
	<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

	<!-- END SIDEBAR -->
	<main class="w-full flex flex-col pb-4 bg-cinza-10%">
		<!-- INICIO-HEADER -->
		<header class="entry-header h-[71px]">

			<?php
			if (is_sticky() && is_home() && !is_paged()) {
				printf('<span">%s</span>', esc_html_x('Featured', 'post', 'affiliateprog'));
			}
			if (is_singular()) :
				the_title('<h1 class="entry-title">', '</h1>');
			else :
				the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
			endif;
			?>

		</header><!-- .entry-header -->
		<!-- FIM-HEADER -->
		<div class="content col-span-5 rounded-box  mt-5 mb-5 mr-5 ml-5 max-h-[690px] overflow-y-scroll" id="content">
			<div class="w-full h-full">
				<?php
				// Verificar se o template correspondente ao parâmetro 'content' existe
				if (!empty($view) && file_exists(get_template_directory() . "/template-parts/roles/{$cargo}/{$view}-content.php")) {
					get_template_part("template-parts/roles/$cargo/$view", 'content');
				} else {
					// Se o template não for encontrado, exibir uma mensagem de erro ou redirecionar para uma página padrão
					get_template_part("template-parts/roles/$cargo/dashboard", 'content');
				}

				?>

			</div>
		</div>
		<?php get_template_part('template-parts/layout/footer', 'content'); ?>
	</main>
</div>


