<section>
	<?php require 'add-user-content.php'; ?>
	<?php require 'edit-user-content.php'; ?>
	<section class="container mx-auto mt-8">
		<h2 class="text-2xl font-semibold mb-4">Registros Pendentes</h2>
		<?php
		// Recupera os usuários com status 'pending'
		$pending_users = get_users(array(
			'meta_key'     => 'user_status',
			'meta_value'   => 'pendente',
			'meta_compare' => '='
		));

		// Verifica se há usuários pendentes
		if (!empty($pending_users)) {
			?>
			<ul>
				<?php foreach ($pending_users as $user) { ?>
					<li>
						<?php echo esc_html($user->user_login); ?> - <?php echo esc_html($user->user_email); ?>
						<a href="<?php echo esc_url(admin_url('admin-post.php?action=approve_user&user_id=' . $user->ID)); ?>">Aprovar</a>
					</li>
				<?php } ?>
			</ul>
		<?php } else { ?>
			<p>Nenhum registro pendente encontrado.</p>
		<?php } ?>
	</section>


</section>
