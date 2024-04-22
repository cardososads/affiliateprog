<?php
// Verifica se o arquivo CSV foi enviado com sucesso e não há erros
if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
	$arquivo_tmp = $_FILES['csv_file']['tmp_name'];

	if (importar_csv_e_processar_upload($arquivo_tmp)) {
		echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="success">Dados enviados com sucesso.</div>';

		global $dados_csv_processados;

	} else {
		echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">Erro ao importar e processar o CSV.</div>';
	}
} else {
	echo '<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 mb-4 rounded relative" role="alert">Adicione um arquivo CSV para fazer upload dos dados.</div>';
}

if (isset($dados_csv_processados)) {
	verificar_compatibilidade_campos($dados_csv_processados, 'metas');
}
?>

	<form action="" method="post" enctype="multipart/form-data" class="mt-4 flex items-center">
		<input type="file" name="csv_file" id="csv_file" class="mr-2 border rounded-md px-2 py-1">
		<button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Enviar</button>
	</form>

<?php

$filtros = array();
$cnpj = isset($_POST['cnpj']) ? sanitize_text_field($_POST['cnpj']) : '';
if (!empty($cnpj)) {
	$filtros['cnpj'] = $cnpj;
}

$resultados = meu_acesso_tabela('metas', $filtros);
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
			<th scope="col" class="px-4 py-3">Meta Commodities</th>
			<th scope="col" class="px-4 py-3">Atingido</th>
			<th scope="col" class="px-4 py-3">Total Geral</th>
			<th scope="col" class="px-4 py-3">Bônus Geral</th>
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
				<td class="px-4 py-3"><?php echo 'R$' . number_format($resultado->meta_commodities, 2, ',', '.'); ?></td>
				<td class="px-4 py-3"><?php echo $resultado->commodities_atingido; ?></td>
				<td class="px-4 py-3"><?php echo 'R$' . number_format($resultado->total_geral, 2, ',', '.'); ?></td>
				<td class="px-4 py-3"><?php echo 'R$' . number_format($resultado->bonus_geral, 2, ',', '.'); ?></td>
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
