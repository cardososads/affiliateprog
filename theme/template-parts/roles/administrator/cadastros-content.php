<section>
	<?php require 'add-user-content.php'; ?>
	<?php require 'edit-user-content.php'; ?>
	<section class="container mx-auto mt-8">
		<h2 class="text-2xl font-semibold mb-4">Registros Pendentes</h2>
		<?php
		// Query para buscar os registros pendentes de oficinas
		$registros_pendentes = new WP_User_Query(array(
			'role' => 'oficina',
			'meta_query' => array(
				array(
					'key' => 'estado_registro',
					'value' => 'pendente',
					'compare' => '='
				)
			)
		));

		if (!empty($registros_pendentes->results)) {
			foreach ($registros_pendentes->results as $oficina) {
				$username = $oficina->user_login;
				$email = $oficina->user_email;
				$cnpj = get_user_meta($oficina->ID, 'cnpj', true);
				?>
				<div class="bg-gray-100 p-4 mb-4">
					<p><strong>Nome de Usuário:</strong> <?php echo $username; ?></p>
					<p><strong>E-mail:</strong> <?php echo $email; ?></p>
					<p><strong>CNPJ:</strong> <?php echo $cnpj; ?></p>
					<button class="bg-green-500 text-white px-4 py-2 rounded-md mr-2" onclick="aceitarRegistro(<?php echo $oficina->ID; ?>)">Aceitar</button>
					<button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="rejeitarRegistro(<?php echo $oficina->ID; ?>)">Rejeitar</button>
				</div>
				<?php
			}
		} else {
			echo '<p>Não há registros pendentes de oficinas.</p>';
		}
		?>
	</section>

	<script>
		function aceitarRegistro(userID) {
			// Envie uma solicitação AJAX para aceitar o registro
			// Você precisa definir esta função para processar a aceitação no servidor
			console.log('Aceitar registro do usuário ID: ' + userID);
		}

		function rejeitarRegistro(userID) {
			// Envie uma solicitação AJAX para rejeitar o registro
			// Você precisa definir esta função para processar a rejeição no servidor
			console.log('Rejeitar registro do usuário ID: ' + userID);
		}
	</script>
</section>
