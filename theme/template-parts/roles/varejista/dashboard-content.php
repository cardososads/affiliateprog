<?php
// Inclui o arquivo wp-load.php do WordPress
$path = dirname(__FILE__);
preg_match('/^(.+)wp-content\/.*/', $path, $matches);
include($matches[1] . 'wp-load.php');

global $wpdb;

$user_helper = new WP_User_Query_Helper();
$user_data = $user_helper->get_current_user_data();

$metas_helper = new WP_Metas_Query_Helper();

extract($user_data);
$metas = $metas_helper->get_metas_by_cnpj($cnpj);
$metas_anual = $metas_helper->get_metas_by_cnpj_all_months($cnpj);
echo '<pre>';
//print_r($metas[0]->meta_commodities);
echo '</pre>';

$usuarios_indicados_mes = $user_helper->get_users_indicated_by_current_user_this_month($codigo_invite[0]);
$usuarios_aprovados_mes = $user_helper->get_users_indicated_by_current_user_with_status_this_month($codigo_invite[0]);

?>

<!-- Seção HTML -->

<section class="grid grid-cols-5 gap-4">
	<div class="col-span-6 md:col-span-3 lg:col-span-5">
		<div class="flex w-full gap-[30px] mb-5">
			<div class="flex flex-col items-start w-full p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white">
				<div class="flex items-center">
					<div>
						<p class="text-[#2D3748] text-[16px] font-semibold"><?= $nome_fantasia[0] ?></p>
						<span class="text-[#718096] text-[12px] font-normal leading-[21px]"><?= $user_email ?></span>
					</div>
				</div>
			</div>
		</div>

		<div class="w-full flex gap-[20px]">
			<!--01-->
			<div class="w-1/4 flex gap-5 justify-between px-2 py-3 whitespace-nowrap bg-white rounded-xl">
				<div class="flex flex-col">
					<h3 class="text-[12px] font-medium leading-4 text-slate-400">Indicações Mês</h3>
					<div class="flex gap-4 mt-4">
						<p class="text-[14px] font-medium leading-6 text-gray-700"><?php echo count($usuarios_indicados_mes) ?></p>
					</div>
				</div>
				<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
			</div>
			<!--02-->
			<div class="w-1/4 flex gap-5 justify-between px-2 py-3 bg-white rounded-xl">
				<div class="flex flex-col">
					<h3 class="text-[12px] font-medium leading-4 text-slate-400">Indicações aprovadas</h3>
					<div class="flex gap-4 mt-4 whitespace-nowrap">
						<p class="text-[14px] font-medium leading-6 text-gray-700"><?php echo count($usuarios_aprovados_mes) ?></p>
					</div>
				</div>
				<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9195ce572162ae219b6738263e6a665bbb03627060a5c7f956a2bb5ea766d490?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Approved indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
			</div>
			<!--03-->
			<div class="w-1/4 flex gap-5 justify-between px-2 py-3 bg-white rounded-xl">
				<div class="flex flex-col">
					<h3 class="text-[12px] font-medium leading-4 text-slate-400">Meta Total de Linhas de Produtos Foco</h3>
					<div class="flex flex-col gap-1 mt-4">
						<p class="text-[14px] font-medium leading-6 text-gray-700"><?php echo 'R$' . number_format($metas[0]->meta_commodities, 2, ',', '.'); ?></p>
						<p class="my-auto text-[12px] leading-4 text-slate-500">Atingido: <?php echo $metas[0]->commodities_atingido; ?>%</p>
					</div>
				</div>
				<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/24759ece4c96580886bf9d4a6f8b9bd67989dfc83e39556d7455122bc242cf2d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Commission icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
			</div>
			<!--04-->
			<div class="w-1/4 flex gap-5 justify-between px-2 py-3 bg-white rounded-xl">
				<div class="flex flex-col">
					<h3 class="text-[12px] font-medium leading-4 text-slate-400">Meta Total de Linhas Gerais</h3>
					<div class="flex flex-col gap-1 mt-4">
						<p class="text-[14px] font-medium leading-6 text-gray-700"><?php echo 'R$' . number_format($metas[0]->meta_linhas_gerais, 2, ',', '.'); ?></p>
						<p class="my-auto text-[12px] leading-4 text-rose-700">Atingido <?php echo $metas[0]->linhas_gerais_atingido?>%</p>
					</div>
				</div>
				<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39136fa6d29d426060d4c90ed4bef2d6b826e957be44c1fafdca66274a36540e?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Monthly sales icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
			</div>
			<!--05-->
			<div class="w-1/4 flex gap-5 justify-between px-2 py-3 bg-white rounded-xl">
				<div class="flex flex-col">
					<h3 class="text-[12px] font-medium leading-4 text-slate-400">Bônus Geral</h3>
					<div class="flex flex-col gap-1 mt-4">
						<p class="text-[14px] font-medium leading-6 text-gray-700"><?php echo 'R$' . number_format($metas[0]->bonus_geral, 2, ',', '.'); ?></p>
					</div>
				</div>
				<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39136fa6d29d426060d4c90ed4bef2d6b826e957be44c1fafdca66274a36540e?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Monthly sales icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
			</div>
		</div>
	</div>

	<!-- Gráfico -->
	<div class="col-span-6 md:col-span-3 lg:col-span-1">
		<div class="bg-white rounded-xl p-4">
			<canvas id="chart_metas" width="800" height="400"></canvas>
		</div>
	</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
	// Função para criar um gráfico com os dados fornecidos em um canvas especificado
	function criarGrafico(data, canvasId) {
		var meses = Object.keys(data);
		var datasets = [{
			label: 'Meta Commodities Atingido',
			data: meses.map(mes => data[mes]['commodities_atingido']),
			borderColor: 'rgba(75, 192, 192, 1)', // Cor da linha
			borderWidth: 2,
			fill: false
		}, {
			label: 'Meta Linhas Gerais Atingido',
			data: meses.map(mes => data[mes]['linhas_gerais_atingido']),
			borderColor: 'rgba(255, 99, 132, 1)', // Cor da linha
			borderWidth: 2,
			fill: false
		}];

		var ctx = document.getElementById(canvasId).getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: meses,
				datasets: datasets
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	}

	// Dados para o gráfico
	var metas_anual = <?php echo json_encode($metas_anual); ?>;

	// Criar o gráfico
	criarGrafico(metas_anual, 'chart_metas');
</script>

<table class="rounded-xl max-w-[1400px] divide-y divide-gray-200 gap-4 mt-4">
	<thead class="bg-gray-50">
	<tr>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta Total de Linhas de Produtos Foco</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produtos Foco Atingido</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta Total de Linhas Gerais</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Linhas Gerais Atingido</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Geral</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bonus Geral</th>
		<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Registro</th>
	</tr>
	</thead>
	<tbody class="bg-white divide-y divide-gray-200">
	<?php foreach ($metas_anual as $nome_mes => $dados_mes): ?>
		<?php if (!empty($dados_mes)): ?>
			<tr>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo 'R$' . number_format($dados_mes['meta_commodities'], 2, ',', '.'); ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo $dados_mes['commodities_atingido']; ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo 'R$' . number_format($dados_mes['meta_linhas_gerais'], 2, ',', '.'); ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo $dados_mes['linhas_gerais_atingido']; ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo 'R$' . number_format($dados_mes['total_geral'], 2, ',', '.'); ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo 'R$' . number_format($dados_mes['bonus_geral'], 2, ',', '.'); ?></td>
				<td class="px-6 py-4 whitespace-nowrap"><?php echo $dados_mes['data_registro']; ?></td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
	</tbody>
</table>

