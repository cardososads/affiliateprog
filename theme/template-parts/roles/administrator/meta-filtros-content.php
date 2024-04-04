<?php
if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
	global $dados_csv_processados;
	$arquivo_tmp = $_FILES['csv_file']['tmp_name'];
	if (importar_csv_e_processar_upload($arquivo_tmp)) {
		// Processamento bem-sucedido, os dados estão disponíveis na variável global $dados_csv_processados
//		echo '<pre>';
//		print_r($dados_csv_processados);
//		echo '</pre>';
	} else {
		// Erro ao importar e processar o CSV
		echo "Erro ao importar e processar o CSV.";
	}
} else {
	// Nenhum arquivo enviado ou ocorreu um erro no upload
	echo "Nenhum arquivo enviado ou ocorreu um erro no upload.";
}
verificar_compatibilidade_campos($dados_csv_processados, 'meta_filtros');
?>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="csv_file">Selecione o arquivo CSV:</label>
		<input type="file" name="csv_file" id="csv_file">
		<button type="submit">Enviar</button>
	</form>
<?php
$filtros = array();
$cnpj = isset($_POST['cnpj']) ? sanitize_text_field($_POST['cnpj']) : '';
if (!empty($cnpj)) {
	$filtros['cnpj'] = $cnpj;
}

$resultados = meu_acesso_tabela('meta_filtros', $filtros);
// Verifica se existem resultados
if ($resultados) { ?>
	<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
		<tbody>
		<?php
		// Loop pelos resultados e exibe cada linha da tabela
		foreach ($resultados as $resultado) {
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
<?php
} else {
	echo 'Nenhum dado encontrado.';
}
