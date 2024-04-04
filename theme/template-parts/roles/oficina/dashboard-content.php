<?php
// Inclui o arquivo wp-load.php do WordPress
$path = dirname(__FILE__);
preg_match('/^(.+)wp-content\/.*/', $path, $matches);
include($matches[1] . 'wp-load.php');

global $wpdb;

$table_name = $wpdb->prefix . 'historico_metas';

$current_user_id = get_current_user_id();
$user_data = get_userdata($current_user_id);
$user_cnpj = get_user_meta($current_user_id, 'cnpj', true);
$user_nome_fantasia = get_user_meta($current_user_id, 'nome_fantasia', true);
$user_email = get_user_meta($current_user_id, 'email', true);
// Consulta SQL para recuperar os dados da tabela com base no CNPJ do usuário
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE cnpj = %s", $user_cnpj);
$resultados = $wpdb->get_results($query);

$dados_mensais = array();

foreach ($resultados as $resultado) {
	$data_registro = date('Y-m', strtotime($resultado->data_registro));

	foreach ($resultado as $chave => $valor) {
		if (strpos($chave, 'atingido_') === 0) { // Verifica se a chave começa com "atingido_"
			$parametro = substr($chave, 9); // Remove o prefixo "atingido_" da chave

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

// Converte os dados em JSON para saída
$dados_mensais_json = json_encode($dados_mensais);

// Saída formatada para depuração
//echo '<pre>';
//print_r($dados_mensais_json);
//echo '</pre>';
?>
<section>
	<div class="flex w-full gap-[30px] mb-5">
		<div class="flex flex-col items-start w-full p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white">
			<div class="flex items-center">
				<div>
					<p class="text-[#2D3748] text-[18px] font-semibold"><?= $user_nome_fantasia ?></p>
					<span class="text-[#718096] text-[14px] font-normal leading-[21px]"><a href="mailto:<?= $user_data->user_email ?>" ><?=$user_data->user_email ?></a></span>
				</div>
			</div>
		</div>
	</div>
	<h2 class="text-2xl font-semibold mb-4">Porcentagem de metas alcançadas</h2>
	<div class=" bg-white rounded-xl p-4">
		<canvas id="myChart" width="800" height="200"></canvas>
	</div>
	<!-- Tabela -->
	<h2 class="text-2xl font-semibold my-4">Resumo das metas</h2>
	<div class="overflow-x-auto mt-5 rounded-xl bg-white shadow-xl">
		<table class="table-auto w-full border-collapse border border-gray-200">
			<thead class="bg-gray-100">
			<tr>
				<th class="px-4 py-2">ID</th>
				<th class="px-4 py-2">CNPJ</th>
				<th class="px-4 py-2">Meta Filtro</th>
				<th class="px-4 py-2">Atingido Filtro</th>
				<th class="px-4 py-2">Meta Óleo</th>
				<th class="px-4 py-2">Atingido Óleo</th>
				<th class="px-4 py-2">Meta Cabine</th>
				<th class="px-4 py-2">Atingido Cabine</th>
				<th class="px-4 py-2">Meta Combustível</th>
				<th class="px-4 py-2">Atingido Combustível</th>
				<th class="px-4 py-2">Meta Ar</th>
				<th class="px-4 py-2">Atingido Ar</th>
				<th class="px-4 py-2">Data Registro</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($resultados as $resultado): ?>
				<tr class="hover:bg-gray-100">
					<td class="px-4 py-2"><?php echo $resultado->id; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->cnpj; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->meta_filtro; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->atingido_filtro; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->meta_oleo; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->atingido_oleo; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->meta_cabine; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->atingido_cabine; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->meta_combustivel; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->atingido_combustivel; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->meta_ar; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->atingido_ar; ?></td>
					<td class="px-4 py-2"><?php echo $resultado->data_registro; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<script>
	var data = <?php echo $dados_mensais_json; ?>;

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

	var ctx = document.getElementById('myChart').getContext('2d');
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
</script>



