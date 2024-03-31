<form id="upload-form" action="<?php echo esc_url(get_template_directory_uri() . '/template-parts/roles/administrator/csv-functions.php'); ?>" method="post" enctype="multipart/form-data" class="mb-4">
	<input type="hidden" name="action" value="process_csv_upload">
	<input type="file" name="csv_file" accept=".csv" class="border rounded-md p-2 mr-2">
	<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar CSV</button>
</form>

<!--esc_url( admin_url('admin-post.php') );-->
<?php
global $wpdb;
$table_name = $wpdb->prefix . 'historico_metas';

// Consulta SQL para recuperar os dados da tabela
$resultados = $wpdb->get_results("SELECT * FROM $table_name");

// Verifica se existem resultados
if ($resultados) {
	?>
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
				<td class="px-4 py-3"><?php echo $resultado->meta_filtro; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->atingido_filtro; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->meta_oleo; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->atingido_oleo; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->meta_cabine; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->atingido_cabine; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->meta_combustivel; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->atingido_combustivel; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->meta_ar; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->atingido_ar; ?></td>
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
?>
