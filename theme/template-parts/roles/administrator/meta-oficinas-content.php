<form action="" method="post" enctype="multipart/form-data" class="mt-4 flex items-center">
	<input type="file" name="csv_file" id="csv_file" class="mr-2 border rounded-md px-2 py-1">
	<button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Enviar</button>
</form>

<?php

$dados_tratados = array();
// Função para tratar os dados do arquivo CSV
function tratar_dados_csv($arquivo_tmp) {
	$dados_tratados = array();

	if (($handle = fopen($arquivo_tmp, "r")) !== false) {
		$cabecalho = fgetcsv($handle, 1000, ",");

		$cabecalho = array_map(function ($coluna) {
			$coluna = trim($coluna);
			$coluna = strtolower($coluna);
			$coluna = preg_replace('/\s+/', '_', $coluna);
			$coluna = mb_strtolower(preg_replace('/[^\x20-\x7E]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $coluna)), 'UTF-8');
			return $coluna;
		}, $cabecalho);

		while (($linha = fgetcsv($handle, 1000, ",")) !== false) {
			$linha = array_map('trim', $linha);
			$linha_tratada = array_combine($cabecalho, $linha);
			$dados_tratados[] = $linha_tratada;
		}

		fclose($handle);
	} else {
		echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">Erro ao importar e processar o CSV.</div>';
	}

	return $dados_tratados;
}

if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
	$arquivo_tmp = $_FILES['csv_file']['tmp_name'];

	// Chama a função para tratar os dados do arquivo CSV
	$dados_tratados = tratar_dados_csv($arquivo_tmp);

	// Exibe os dados tratados (apenas para fins de teste)
//	echo '<h2>Dados do arquivo CSV tratados:</h2>';
//	echo '<pre>';
////	print_r($dados_tratados);
//	echo '</pre>';
} else {
	echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 mb-4 rounded relative" role="alert">Adicione um arquivo CSV para fazer upload dos dados.</div>';
}

function verificar_compatibilidade_campos_e_inserir($dados, $nome_tabela)
{
	global $wpdb;

	// Adiciona o prefixo da tabela, se necessário
	$nome_tabela_com_prefixo = $wpdb->prefix . $nome_tabela;

	// Verifica se a tabela existe no banco de dados
	if (!tabela_existe($nome_tabela_com_prefixo)) {
		echo "A tabela '$nome_tabela_com_prefixo' não existe no banco de dados. Não é possível continuar.";
		return;
	}

	// Obtém a descrição dos campos na tabela
	$desc_tabela = $wpdb->get_results("DESCRIBE $nome_tabela_com_prefixo");

	// Verifica se ocorreu algum erro ao obter a descrição da tabela
	if ($wpdb->last_error) {
		echo "Erro ao obter a descrição da tabela: " . $wpdb->last_error;
		return;
	}

	// Array para armazenar os nomes das colunas na tabela
	$colunas_tabela = array();

	// Extrai os nomes das colunas da descrição da tabela, ignorando 'id' e 'data_registro'
	foreach ($desc_tabela as $coluna) {
		if ($coluna->Field != 'id' && $coluna->Field != 'data_registro') {
			$colunas_tabela[] = $coluna->Field;
		}
	}

	// Variável para contar o número total de inserções bem-sucedidas
	$total_insercoes = 0;

	// Verifica se as colunas nos dados correspondem às colunas na tabela
	foreach ($dados as $linha) {
		// Array para armazenar os dados a serem inseridos
		$dados_insercao = array();

		// Itera sobre os valores da linha
		foreach ($linha as $chave => $valor) {
			// Ignora os campos 'cnpj' e 'data_registro', pois eles não precisam ser verificados
			if ($chave == 'data_registro') {
				continue;
			}

			// Verifica se o nome da coluna existe na tabela
			if (in_array($chave, $colunas_tabela)) {
				// Adiciona os dados à array de inserção
				$dados_insercao[$chave] = $valor;
			}
		}

		// Adiciona a data de registro à array de inserção
		$dados_insercao['data_registro'] = current_time('mysql');

		// Insere os dados na tabela
		$resultado = $wpdb->insert($nome_tabela_com_prefixo, $dados_insercao);

		// Verifica se a inserção foi bem-sucedida
		if ($resultado !== false) {
			// Incrementa o total de inserções bem-sucedidas
			$total_insercoes++;
		}
	}

	// Exibe o total de inserções bem-sucedidas
	echo "Total de linhas inseridas: $total_insercoes";
}


verificar_compatibilidade_campos_e_inserir($dados_tratados, 'meta_oficinas');

$filtros = array();
$cnpj = isset($_POST['cnpj']) ? sanitize_text_field($_POST['cnpj']) : '';
if (!empty($cnpj)) {
	$filtros['cnpj'] = $cnpj;
}

$resultados = meu_acesso_tabela('meta_oficinas', $filtros);
// Verifica se existem resultados
if ($resultados) { ?>

	<form action="" method="post" class="my-4 flex gap-2 items-center">
		<label for="cnpj_filter" class="block mb-1">Filtrar por CNPJ:</label>
		<input type="text" name="cnpj" id="cnpj_filter" placeholder="Digite o CNPJ" class="border rounded-md px-2 py-1">
		<button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Filtrar</button>
	</form>

	<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
		<tr>
			<th scope="col" class="px-4 py-3">ID</th>
			<th scope="col" class="px-4 py-3">CNPJ</th>
			<th scope="col" class="px-4 py-3">Percentual Bônus</th>
			<th scope="col" class="px-4 py-3">Meta Mensal</th>
			<th scope="col" class="px-4 py-3">Mes</th>
			<th scope="col" class="px-4 py-3">Ano</th>
			<th scope="col" class="px-4 py-3">Data Registro</th>
		</tr>
		</thead>
		<tbody>
		<?php
		// Loop pelos resultados e exibe cada linha da tabela
		foreach ($resultados as $resultado) {
			?>
			<tr>
				<td class="px-4 py-3"><?php echo $resultado->id; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->cnpj; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->percentual_bonus; ?></td>
				<td class="px-4 py-3"><?php echo 'R$' . number_format($resultado->meta_mensal, 2, ',', '.'); ?></td>
				<td class="px-4 py-3"><?php echo $resultado->mes; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->ano; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->data_registro; ?></td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
	<?php
} else {
	echo 'Nenhum dado encontrado.';
}


