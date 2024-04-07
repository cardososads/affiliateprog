<?php

	$usuarios_cadastrados_por_mes = quantidade_usuarios_cadastrados_por_mes();
	$usuarios_ativos_por_mes = usuarios_ativos_por_mes();

	$quantidades_cadastrados = array();
	$quantidades_ativos = array();

	$meses_do_ano = array(
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	);

	foreach ($meses_do_ano as $mes) {
		$quantidades_cadastrados[] = isset($usuarios_cadastrados_por_mes[2024][$mes]) ? $usuarios_cadastrados_por_mes[2024][$mes] : 0;
		$quantidades_ativos[] = isset($usuarios_ativos_por_mes[2024][$mes]) ? $usuarios_ativos_por_mes[2024][$mes] : 0;
	}

?>

<section class="mt-5 flex flex-col gap-[40px]">
	<!--Porcentagens-->
	<div class="w-full flex gap-[40px]">
		<!--01-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 whitespace-nowrap bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $quantidades_cadastrados[3] ?></p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--02-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações aprovadas</h3>
				<div class="flex gap-4 mt-4 whitespace-nowrap">
					<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $quantidades_ativos[3] ?></p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9195ce572162ae219b6738263e6a665bbb03627060a5c7f956a2bb5ea766d490?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Approved indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--03-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Comissões</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700">R$ 3580,00</p>
					<p class="my-auto text-sm leading-4 text-slate-500">+5%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/24759ece4c96580886bf9d4a6f8b9bd67989dfc83e39556d7455122bc242cf2d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Commission icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--04-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Vendas do mês</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700">R$ 10820,00</p>
					<p class="my-auto text-sm leading-4 text-rose-700">-15%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39136fa6d29d426060d4c90ed4bef2d6b826e957be44c1fafdca66274a36540e?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Monthly sales icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
	</div>
	<!-- Charts/Banner -->
	<div class="flex w-full gap-[20px]">
		<div class="flex w-full gap-[20px]">
			<div class="w-1/2 bg-white rounded-xl p-[40px]">
				<canvas id="metaMensalChart"></canvas>
				<script>
					var ctx = document.getElementById('metaMensalChart').getContext('2d');
					var metaMensalChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							datasets: [{
								label: 'Indicações',
								backgroundColor: '#6BADA4',
								data: <?php echo json_encode($quantidades_cadastrados); ?>
							}, {
								label: 'Indicações Aprovadas',
								backgroundColor: '#41837F',
								data: <?php echo json_encode($quantidades_ativos); ?>
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				</script>
			</div>
			<div class="w-1/2 bg-white rounded-xl p-[40px]">
				<canvas id="usuariosAtivosChart"></canvas>
				<script>
					var ctx2 = document.getElementById('usuariosAtivosChart').getContext('2d');
					var usuariosAtivosChart = new Chart(ctx2, {
						type: 'line',
						data: {
							labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							datasets: [{
								label: 'Usuários Ativos',
								borderColor: '#41837F',
								backgroundColor: 'transparent',
								data: <?php echo json_encode($quantidades_ativos); ?>
							}]
						},
						options: {
							scales: {
								y: {
									beginAtZero: true
								}
							}
						}
					});
				</script>
			</div>
		</div>
	</div>
</section>
