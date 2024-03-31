<section>
	<div class="flex gap-[30px]">
		<div class="flex flex-col w-1/2 rounded-lg bg-white p-6 my-8">
			<h2 class="text-2xl font-semibold mb-5">Link de Afiliado</h2>

			<div class="flex flex-col gap-4">
				<div class="p-6 bg-gray-100 flex flex-col gap-2 w-[90%] shadow rounded-lg">
					<h3 class="text-2xl font-semibold mb-4">Convite via e-mail</h3>
					<?php echo do_shortcode('[contact-form-7 id="629ba84" title="User Invite"]'); ?>
				</div>
			</div>

		</div>
		<div class="w-1/2 h-full">
			<div class="w-full rounded-[10px] bg-white p-[40px] my-[30px]">
				<h2 class="text-xl font-semibold">Meta Mensal</h2>
				<div >
					<div class="w-full" ">
						<canvas id="bar-chart"></canvas>
					</div>

					<script>
						// Dados do gráfico (supondo que você tenha esses dados)
						const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'];
						const monthlyGoals = [100, 150, 200, 180, 220]; // Metas mensais

						// Criar gráfico de barras
						var ctx = document.getElementById('bar-chart').getContext('2d');
						var myChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: months,
								datasets: [{
									label: 'Meta Mensal',
									data: monthlyGoals,
									backgroundColor: 'rgb(65,131,127)', // Cor de fundo das barras
									//borderColor: 'rgba(54, 162, 235, 1)', // Cor da borda das barras
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									y: {
										beginAtZero: true,
										title: {
											display: true,
											text: 'Meta'
										}
									},
									x: {
										title: {
											display: true,
											text: 'Mês'
										}
									}
								}
							}
						});
					</script>

				</div>
			</div>
		</div>
	</div>
	<?php require 'edit-user-content.php'; ?>
	<?php require 'add-user-content.php'; ?>
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
