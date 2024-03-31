<?php
// Inclui o arquivo wp-load.php do WordPress
$path = dirname(__FILE__);
preg_match('/^(.+)wp-content\/.*/', $path, $matches);
include($matches[1] . 'wp-load.php');

global $wpdb;

// Nome da tabela de histórico de metas
$table_name = $wpdb->prefix . 'historico_metas';

// Obtém o CNPJ do usuário atual
$current_user_id = get_current_user_id();
$user_cnpj = get_user_meta($current_user_id, 'cnpj', true);

// Consulta SQL para recuperar os dados da tabela com base no CNPJ do usuário
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE cnpj = %s", $user_cnpj);
$resultados = $wpdb->get_results($query);

$dados_mensais = array();

// Processa os resultados para encontrar os valores mais recentes para cada parâmetro
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

// Converte os dados em JSON para saída
$dados_mensais_json = json_encode($dados_mensais);

// Saída formatada para depuração
//echo '<pre>';
//print_r($dados_mensais_json);
//echo '</pre>';
?>
<canvas id="myChart" width="800" height="300"></canvas>

<script>
	var data = <?php echo $dados_mensais_json; ?>;

	var meses = Object.keys(data);
	var parametros = Object.keys(data[meses[0]]);

	var datasets = [];
	parametros.forEach(function(parametro) {
		var valores = meses.map(function(mes) {
			// Converte o valor para uma porcentagem (assumindo que o valor original está em uma escala de 0 a 100)
			var valor = parseFloat(data[mes][parametro].valor);
			return valor;
		});

		datasets.push({
			label: parametro,
			data: valores,
			fill: false,
			borderColor: 'rgba(75, 192, 192, 1)',
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
