<?php
// Inclui o arquivo wp-load.php do WordPress
$path = dirname(__FILE__);
preg_match('/^(.+)wp-content\/.*/', $path, $matches);
include($matches[1] . 'wp-load.php');

global $wpdb;

// Nome das tabelas de histórico de metas
$table_filtros = $wpdb->prefix . 'meta_filtros';
$table_eletrica = $wpdb->prefix . 'meta_eletrica';
$table_freios = $wpdb->prefix . 'meta_freios';

// Obtém o CNPJ do usuário atual
$current_user_id = get_current_user_id();
$user_cnpj = get_user_meta($current_user_id, 'cnpj', true);
$user_nome_fantasia = get_user_meta($current_user_id, 'nome_fantasia', true);
$user_email = get_user_meta($current_user_id, 'email', true);

// Consulta SQL para recuperar os dados das três tabelas com base no CNPJ do usuário
$query_filtros = $wpdb->prepare("SELECT * FROM $table_filtros WHERE cnpj = %s", $user_cnpj);
$query_eletrica = $wpdb->prepare("SELECT * FROM $table_eletrica WHERE cnpj = %s", $user_cnpj);
$query_freios = $wpdb->prepare("SELECT * FROM $table_freios WHERE cnpj = %s", $user_cnpj);

// Executa as consultas SQL e recupera os resultados
$resultados_filtros = $wpdb->get_results($query_filtros);
$resultados_eletrica = $wpdb->get_results($query_eletrica);
$resultados_freios = $wpdb->get_results($query_freios);

// Converte os resultados em JSON para uso no gráfico
$dados_filtros = prepararDadosParaGrafico($resultados_filtros);
$dados_eletrica = prepararDadosParaGrafico($resultados_eletrica);
$dados_freios = prepararDadosParaGrafico($resultados_freios);

function prepararDadosParaGrafico($resultados) {
	$dados_mensais = array();

	foreach ($resultados as $resultado) {
		$data_registro = date('Y-m', strtotime($resultado->data_registro)); // Extrai o ano e mês da data de registro

		foreach ($resultado as $chave => $valor) {
			if (strpos($chave, 'atingido_') === 0) { // Verifica se a chave começa com "atingido_"
				$parametro = substr($chave, 9); // Remove o prefixo "atingido_" da chave

				// Cria um array para o mês de registro se ainda não existir
				if (!isset($dados_mensais[$data_registro])) {
					$dados_mensais[$data_registro] = array();
				}

				// Se não há dados para este parâmetro ou se o novo registro é mais recente
				if (!isset($dados_mensais[$data_registro][$parametro]) || strtotime($resultado->data_registro) > strtotime($dados_mensais[$data_registro][$parametro]['data_registro'])) {
					$dados_mensais[$data_registro][$parametro] = array(
						'valor' => $valor,
						'data_registro' => $resultado->data_registro
					);
				}
			}
		}
	}

	return $dados_mensais;
}
$user_id_logged_in = get_current_user();
// Obtenha o código de convite do usuário logado
$codigo_invite_usuario_logado = get_codigo_invite($user_id_logged_in);

// Obtenha a quantidade de usuários indicados pelo usuário logado
$quantidade_usuarios_indicados = quantidade_usuarios_indicados($codigo_invite_usuario_logado);
$quantidade_usuarios_ativos = quantidade_usuarios_ativos($codigo_invite_usuario_logado);
?>

<!-- Seção HTML -->
<section>
	<div class="flex w-full gap-[30px] mb-5">
		<div class="flex flex-col items-start w-full p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white">
			<div class="flex items-center">
				<div>
					<p class="text-[#2D3748] text-[18px] font-semibold"><?= $user_nome_fantasia ?></p>
					<span class="text-[#718096] text-[14px] font-normal leading-[21px]"><?= $user_email ?></span>
				</div>
			</div>
		</div>
	</div>

	<div class="w-full flex gap-[40px]">
		<!--01-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 whitespace-nowrap bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $quantidade_usuarios_indicados ?></p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--02-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações aprovadas</h3>
				<div class="flex gap-4 mt-4 whitespace-nowrap">
					<p class="text-lg font-medium leading-6 text-gray-700"><?php echo $quantidade_usuarios_ativos ?></p>
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

	<section class="grid grid-cols-6 gap-4 mt-4">
		<!-- Gráfico de Filtros -->
		<div class="col-span-6">
			<h2 class="text-2xl font-semibold mb-4">Porcentagem de metas alcançadas - Filtros</h2>
			<div class="bg-white rounded-xl p-4">
				<canvas id="chart_filtros" width="800" height="200"></canvas>
			</div>
		</div>

		<!-- Gráfico de Elétrica -->
		<div class="col-span-3">
			<h2 class="text-2xl font-semibold mb-4">Porcentagem de metas alcançadas - Elétrica</h2>
			<div class="bg-white rounded-xl p-4">
				<canvas id="chart_eletrica" width="800" height="200"></canvas>
			</div>
		</div>

		<!-- Gráfico de Freios -->
		<div class="col-span-3">
			<h2 class="text-2xl font-semibold mb-4">Porcentagem de metas alcançadas - Freios</h2>
			<div class="bg-white rounded-xl p-4">
				<canvas id="chart_freios" width="800" height="200"></canvas>
			</div>
		</div>
	</section>

</section>
<div class="grid gap-4 mt-4">
	<div class="w-full">
		<h2 class="text-2xl font-semibold mb-4">Tabela de Filtros</h2>
		<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			<!-- Cabeçalho da tabela -->
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th scope="col" class="px-4 py-3">ID</th>
				<th scope="col" class="px-4 py-3">CNPJ</th>
				<th scope="col" class="px-4 py-3">Meta Filtro</th>
				<th scope="col" class="px-4 py-3">Atingido Filtro</th>
				<th scope="col" class="px-4 py-3">Meta Óleo</th>
				<th scope="col" class="px-4 py-3">Atingido Óleo</th>
				<th scope="col" class="px-4 py-3">Meta Cabine</th>
				<th scope="col" class="px-4 py-3">Atingido Cabine</th>
				<th scope="col" class="px-4 py-3">Meta Combustível</th>
				<th scope="col" class="px-4 py-3">Atingido Combustível</th>
				<th scope="col" class="px-4 py-3">Meta Ar</th>
				<th scope="col" class="px-4 py-3">Atingido Ar</th>
				<th scope="col" class="px-4 py-3">Data Registro</th>
			</tr>
			</thead>
			<!-- Corpo da tabela -->
			<tbody>
			<?php
			// Loop pelos resultados e exibe cada linha da tabela
			foreach ($resultados_filtros as $resultado) {
				?>
				<tr>
					<td class="px-4 py-3"><?php echo $resultado->id; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->cnpj; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_filtros; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_filtros; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_filtro_de_oleo; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_filtro_de_oleo; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_filtro_de_cabine; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_filtro_de_cabine; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_filtro_de_combustivel; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_filtro_de_combustivel; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_filtro_de_ar; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_filtro_de_ar; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->data_registro; ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>

	<!-- Tabela de Pastilha de Fricção -->
	<div class="w-full">
		<h2 class="text-2xl font-semibold mb-4">Meta de Freios</h2>
		<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			<!-- Cabeçalho da tabela -->
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th scope="col" class="px-4 py-3">ID</th>
				<th scope="col" class="px-4 py-3">CNPJ</th>
				<th scope="col" class="px-4 py-3">Meta Pastilha de Fricção</th>
				<th scope="col" class="px-4 py-3">Atingido Pastilha de Fricção</th>
				<th scope="col" class="px-4 py-3">Meta de Fluído</th>
				<th scope="col" class="px-4 py-3">Atingido Fluído</th>
				<th scope="col" class="px-4 py-3">Meta de Hidráulica</th>
				<th scope="col" class="px-4 py-3">Atingido Hidráulica</th>
				<th scope="col" class="px-4 py-3">Meta de CC Braking Systems</th>
				<th scope="col" class="px-4 py-3">Atingido CC Braking Systems</th>
				<th scope="col" class="px-4 py-3">Data Registro</th>
			</tr>
			</thead>
			<!-- Corpo da tabela -->
			<tbody>
			<?php
			// Loop pelos resultados e exibe cada linha da tabela
			foreach ($resultados_freios as $resultado) {
				?>
				<tr>
					<td class="px-4 py-3"><?php echo $resultado->id; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->cnpj; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_pastilha_de_friccao; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_pastilha_de_friccao; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_de_fluido; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_fluido; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_de_hidraulica; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_hidraulica; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_de_cc_braking_systems; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_cc_braking_systems; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->data_registro; ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>

	<div class="w-full">
		<h2 class="text-2xl font-semibold mb-4">Tabela de Meta de Elétrica</h2>
		<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
			<!-- Cabeçalho da tabela -->
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
			<tr>
				<th scope="col" class="px-4 py-3">ID</th>
				<th scope="col" class="px-4 py-3">CNPJ</th>
				<th scope="col" class="px-4 py-3">Meta Alternador</th>
				<th scope="col" class="px-4 py-3">Atingido Alternador</th>
				<th scope="col" class="px-4 py-3">Meta Motor de Partida</th>
				<th scope="col" class="px-4 py-3">Atingido Motor de Partida</th>
				<th scope="col" class="px-4 py-3">Meta Componentes Eletrônicos</th>
				<th scope="col" class="px-4 py-3">Atingido Componentes Eletrônicos</th>
				<th scope="col" class="px-4 py-3">Data Registro</th>
			</tr>
			</thead>
			<!-- Corpo da tabela -->
			<tbody>
			<?php
			// Loop pelos resultados e exibe cada linha da tabela
			foreach ($resultados_eletrica as $resultado) {
				?>
				<tr>
					<td class="px-4 py-3"><?php echo $resultado->id; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->cnpj; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_alternador; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_alternador; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_motor_de_partida; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_motor_de_partida; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->meta_componentes_eletricos; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->atingido_componentes_eletricos; ?></td>
					<td class="px-4 py-3"><?php echo $resultado->data_registro; ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>

</div>

<script>
	// Função para criar um gráfico com os dados fornecidos em um canvas especificado
	function criarGrafico(data, canvasId) {
		var meses = Object.keys(data);
		var parametros = Object.keys(data[meses[0]]);
		var datasets = [];
		var colors = ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 205, 86, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)']; // Definir cores diferentes para as linhas

		parametros.forEach(function(parametro, index) {
			var valores = meses.map(function(mes) {
				// Converte o valor para uma porcentagem (assumindo que o valor original está em uma escala de 0 a 100)
				var valor = parseFloat(data[mes][parametro].valor);
				return valor;
			});

			datasets.push({
				label: parametro,
				data: valores,
				fill: false,
				borderColor: colors[index], // Usar uma cor diferente para cada conjunto de dados
				pointBorderColor: colors[index], // Cor dos marcadores
				pointBackgroundColor: colors[index], // Cor de fundo dos marcadores
				borderWidth: 1
			});
		});

		var ctx = document.getElementById(canvasId).getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: meses,
				datasets: datasets
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true,
							max: 100 // Define o valor máximo do eixo y como 100
						}
					}]
				}
			}
		});
	}

	// Criar gráficos para cada tipo de meta
	criarGrafico(<?php echo json_encode($dados_filtros); ?>, 'chart_filtros');
	criarGrafico(<?php echo json_encode($dados_eletrica); ?>, 'chart_eletrica');
	criarGrafico(<?php echo json_encode($dados_freios); ?>, 'chart_freios');
</script>

