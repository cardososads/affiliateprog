<section>
	<div class="flex gap-[30px]">
		<div class="flex flex-col w-1/2 rounded-lg bg-white p-6 my-8">
			<h2 class="text-2xl font-semibold mb-5">Link de Afiliado</h2>
			<div class="flex flex-col gap-4">
				<div class="p-6 bg-gray-100 flex flex-col gap-2 w-5/6 shadow rounded-lg">
					<h3 class="text-2xl font-semibold mb-4">Convite via e-mail</h3>
					<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
						<input type="hidden" name="action" value="send_invite_email">
						<?php wp_nonce_field('send_invite_email_nonce', 'send_invite_email_nonce'); ?>

						<!-- Adicione os campos do formulário -->
						<div class="flex flex-col mb-4">
							<label for="email" class="mb-2">Seu e-mail</label>
							<input type="email" id="email" name="user_email" required
								   class="py-2 px-3 border rounded-md focus:outline-none focus:border-blue-400">
						</div>

						<div class="flex flex-col mb-4">
							<label for="cnpj" class="mb-2">CNPJ</label>
							<input type="text" id="cnpj" name="cnpj" required
								   class="py-2 px-3 border rounded-md focus:outline-none focus:border-blue-400">
						</div>

						<button type="submit"
								class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
							Convidar
						</button>
					</form>
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
</section>
