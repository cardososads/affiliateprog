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
	<!-- SIDEBAR -->
<aside id="sidebar" class="absolute md:relative top-0 left-0 z-40 sm:z-0 flex flex-col flex-shrink-0 sm:visible w-64 h-screen pt-14 font-normal duration-75 lg:flex transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
		<div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-verde-10% border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
			<div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
				<div class="flex-1 px-3 space-y-1 divide-y divide-gray-200 dark:divide-gray-700">
					<ul class="pb-2 space-y-2">
						<li>
							<form action="#" method="GET" class="lg:hidden">
								<label for="mobile-search" class="sr-only">Search</label>
								<div class="relative">
									<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
										<svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
									</div>
									<input type="text" name="email" id="mobile-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
								</div>
							</form>
						</li>
						<?php foreach ($contents as $key => $content) : ?>
							<li>
								<?php if ($key === $view) : ?>
									<a href="<?php echo esc_url(add_query_arg('content', $key, get_permalink())); ?>" class="flex items-center rounded-3xl bg-slate-200 p-4 gap-2">
										<?php echo $content['icon']; ?>
										<?php echo $content['title']; ?>
									</a>
								<?php else: ?>
									<a href="<?php echo esc_url(add_query_arg('content', $key, get_permalink())); ?>" class="flex items-center p-4 gap-2">
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

	</aside>

	<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

	<!-- END SIDEBAR -->
	<main class="w-full flex flex-col pb-4 bg-cinza-10%">
		<!-- INICIO-HEADER -->
		<header class="entry-header h-[71px]">

			<?php
			if ( is_sticky() && is_home() && ! is_paged() ) {
				printf( '<span">%s</span>', esc_html_x( 'Featured', 'post', 'affiliateprog' ) );
			}
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
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
		<?php get_template_part( 'template-parts/layout/footer', 'content' ); ?>
	</main>
</div>


