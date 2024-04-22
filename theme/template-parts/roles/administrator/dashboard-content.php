<?php

$users = new WP_User_Query_Helper();
$metas = new WP_Metas_Query_Helper();

$total_users = $users->get_non_admin_users_count();
$this_month_users = $users->get_users_registered_this_month_count();
$aprov_users = count($users->get_users_with_meta('user_status', 'ativo'));
$pend_users = count($users->get_users_with_meta('user_status', 'pendente'));

$meta_commodities = $metas->sum_column_values('meta_commodities');
$porcentagem_commodities =$metas->calculate_percentage('meta_commodities', 'commodities_atingido');
$meta_linhas_gerais = $metas->sum_column_values('meta_linhas_gerais');
$anual_linhas = $metas->get_monthly_column_totals_with_percentage('meta_linhas_gerais', 'linhas_gerais_atingido');
$porcentagem_linhas_gerais =$metas->calculate_percentage('meta_linhas_gerais', 'linhas_gerais_atingido');
$anual_commodities = $metas->get_monthly_column_totals_with_percentage('meta_commodities', 'commodities_atingido');
$bonus_geral = $metas->sum_column_values('bonus_geral');

$actve_and_registered_users = $users->get_users_registered_and_active_per_month();

$months = array_keys($actve_and_registered_users);
$registered_counts = array_column($actve_and_registered_users, 'registered_count');
$active_counts = array_column($actve_and_registered_users, 'active_count');

?>

<section class="mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
	<!-- Indicações -->
	<div class="bg-white rounded-xl p-5">
		<h3 class="text-base font-medium leading-4 text-slate-400">Indicações</h3>
		<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $total_users ?></p>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-10 h-10">
	</div>

	<!-- Indicações Aprovadas -->
	<div class="bg-white rounded-xl p-5">
		<h3 class="text-base font-medium leading-4 text-slate-400">Indicações aprovadas</h3>
		<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $aprov_users ?></p>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9195ce572162ae219b6738263e6a665bbb03627060a5c7f956a2bb5ea766d490?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Approved indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-10 h-10">
	</div>

	<!-- Meta Commodities -->
	<div class="bg-white rounded-xl p-5">
		<h3 class="text-base font-medium leading-4 text-slate-400">Meta Commodities</h3>
		<p class="text-lg font-medium leading-6 text-gray-700"><?php echo 'R$' . number_format($meta_commodities, 2, ',', '.'); ?></p>
		<p class="my-auto text-sm leading-4 text-slate-500">Atingido <?= number_format($porcentagem_commodities, 2) ?>%</p>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/24759ece4c96580886bf9d4a6f8b9bd67989dfc83e39556d7455122bc242cf2d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Commission icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-10 h-10">
	</div>

	<!-- Meta Linhas Gerais -->
	<div class="bg-white rounded-xl p-5">
		<h3 class="text-base font-medium leading-4 text-slate-400">Meta Linhas Gerais</h3>
		<p class="text-lg font-medium leading-6 text-gray-700"><?php echo 'R$' . number_format($meta_linhas_gerais, 2, ',', '.'); ?></p>
		<p class="my-auto text-sm leading-4 text-rose-700">Atingido <?= number_format($porcentagem_linhas_gerais, 2) ?>%</p>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39136fa6d29d426060d4c90ed4bef2d6b826e957be44c1fafdca66274a36540e?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Monthly sales icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-10 h-10">
	</div>
</section>

<section class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">
	<!-- Gráficos -->
	<div class="bg-white rounded-xl p-[40px]">
		<canvas id="metaMensalChart"></canvas>
		<script>
			var ctx = document.getElementById('metaMensalChart').getContext('2d');
			var metaMensalChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode($months); ?>,
					datasets: [{
						label: 'Indicações',
						backgroundColor: '#6BADA4',
						data: <?php echo json_encode($registered_counts); ?>
					}, {
						label: 'Indicações Aprovadas',
						backgroundColor: '#41837F',
						data: <?php echo json_encode($active_counts); ?>
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

	<div class="bg-white rounded-xl p-[40px]">
		<canvas id="usuariosAtivosChart"></canvas>
		<script>
			var ctx2 = document.getElementById('usuariosAtivosChart').getContext('2d');
			var usuariosAtivosChart = new Chart(ctx2, {
				type: 'line',
				data: {
					labels: <?php echo json_encode($months); ?>,
					datasets: [{
						label: 'Usuários Ativos',
						borderColor: '#41837F',
						backgroundColor: 'transparent',
						data: <?php echo json_encode($active_counts); ?>
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

	<div class="bg-white rounded-xl p-[40px] col-span-full">
		<canvas id="metaCommoditiesChart" class="max-h-[400px]"></canvas>
		<script>
			var ctx3 = document.getElementById('metaCommoditiesChart').getContext('2d');
			var metaCommoditiesChart = new Chart(ctx3, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode(array_keys($anual_commodities)); ?>,
					datasets: [{
						label: 'Meta Commodities',
						backgroundColor: '#EABDA8',
						data: <?php echo json_encode(array_column($anual_commodities, 'total_column1')); ?>
					}, {
						label: 'Porcentagem Commodities',
						backgroundColor: '#F28F3B',
						data: <?php echo json_encode(array_column($anual_commodities, 'total_column2')); ?>
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

	<div class="bg-white rounded-xl p-[40px] col-span-full">
		<canvas id="metaLinhasGeraisChart"></canvas>
		<script>
			var ctx4 = document.getElementById('metaLinhasGeraisChart').getContext('2d');
			var metaLinhasGeraisChart = new Chart(ctx4, {
				type: 'bar',
				data: {
					labels: <?php echo json_encode(array_keys($anual_linhas)); ?>,
					datasets: [{
						label: 'Meta Linhas Gerais',
						backgroundColor: '#7CB0DC',
						data: <?php echo json_encode(array_column($anual_linhas, 'total_column1')); ?>
					}, {
						label: 'Porcentagem Linhas Gerais',
						backgroundColor: '#2E75B6',
						data: <?php echo json_encode(array_column($anual_linhas, 'total_column2')); ?>
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
</section>
