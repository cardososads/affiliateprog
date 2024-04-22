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
			<th scope="col" class="px-4 py-3">Meta Linhas Gerais</th>
			<th scope="col" class="px-4 py-3">Atingido</th>
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
				<td class="px-4 py-3"><?php echo $resultado->meta_linhas_gerais; ?></td>
				<td class="px-4 py-3"><?php echo $resultado->linhas_gerais_atingido; ?></td>
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
