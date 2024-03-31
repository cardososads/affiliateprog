<?php
preg_match('/^(.+)wp-content\/.*/', dirname(__FILE__), $path);
include($path[1] . 'wp-load.php');

global $wpdb;
$table_name = $wpdb->prefix . 'historico_metas';

// Obtém o CNPJ do usuário atual
$current_user_id = get_current_user_id();
$user_cnpj = get_user_meta($current_user_id, 'cnpj', true);

// Consulta SQL para recuperar os dados da tabela com base no CNPJ do usuário
$resultados = $wpdb->get_results($wpdb->prepare(
	"SELECT * FROM $table_name WHERE cnpj = %s",
	$user_cnpj
));

?>

<!-- Tabela -->
<div class="overflow-x-auto">
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
			<tr>
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

