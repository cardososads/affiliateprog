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
</section>
