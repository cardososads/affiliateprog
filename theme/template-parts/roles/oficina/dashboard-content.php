<?php
// Inclui o arquivo wp-load.php do WordPress
$path = dirname(__FILE__);
preg_match('/^(.+)wp-content\/.*/', $path, $matches);
include($matches[1] . 'wp-load.php');

global $wpdb;
$metas = new WP_Meta_Oficinas_Query_Helper();

$user_helper = new WP_User_Query_Helper();
$promotor = $user_helper->get_promotor_of_user_oficina();

$current_user_id = get_current_user_id();
$user_data = get_userdata($current_user_id);
$user_cnpj = get_user_meta($current_user_id, 'cnpj', true);
$nome_fantasia = get_user_meta($current_user_id, 'nome_fantasia', true);

$user_dados = get_userdata($current_user_id);

// Obtém os metadados do usuário
$user_meta = get_user_meta($current_user_id);
//var_dump($user_meta);
// Combina os dados do usuário com os metadados
$user_all_data = array_merge((array) $user_dados->data, $user_meta);

// Exibe os dados do usuário
$specific_data_keys = array(
	'razao_social',
	'nome_fantasia',
	'cnpj',
	'inscricao_estadual',
	'endereco',
	'bairro',
	'cidade',
	'uf',
	'cep',
	'telefone',
	'celular',
	'email',
	'email_financeiro',
	'email_danfe_xml'
);
$all_metas = [];
$all_metas = $metas->get_meta_oficina_by_cnpj($user_cnpj);
$table_name = $wpdb->prefix . 'historico_metas';
if (!empty($all_metas) && is_array($all_metas)) {
	extract($all_metas);
}
if (!empty($user_all_data) && is_array($user_all_data)) {
	extract($user_all_data);
}

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


<div class="bg-white rounded-lg shadow-md p-6 flex justify-between">
	<!-- 5.2 - Primeira seção da oficina -->
	<div class="">
		<!-- 5.2.1 - Nome Fantasia Espaço para um nome que virá do bd -->
		<div class="mb-4 flex gap-4">
			<h3 class="text-lg font-semibold">Nome Fantasia:</h3>
			<span class="text-gray-700"><?= !empty($nome_fantasia[0]) ? $nome_fantasia[0] : 'Nenhum nome fantasia disponível' ?></span>
		</div>

		<!-- 5.2.2 - Email (mostrará o email do user) -->
		<div class="mb-4 flex gap-4">
			<h3 class="text-lg font-semibold">Email:</h3>
			<span class="text-gray-700"><?= !empty($user_email) ? $user_email : 'Nenhum email disponível' ?></span>
		</div>

		<!-- 5.2.3 - Promotor (mostrará o nome do promotor) -->
		<div class="mb-4 flex gap-4">
			<h3 class="text-lg font-semibold">Promotor:</h3>
			<span class="text-gray-700"><?= !empty($promotor->nome_fantasia) ? $promotor->nome_fantasia : 'Nenhum promotor disponível' ?></span>
		</div>
	</div>
	<!-- 5.2.4 - Botão para Download / Visualização Contratro - Manual (do lado direito na mesma div) -->
	<div class="flex flex-col gap-4 justify-center">
		<a href="<?php echo esc_url(get_template_directory_uri() . '/docs/MOD_Anexo_1_Manual_do_Credenciado.pdf'); ?>" download>
			<span class="bg-verde hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">Manual do Credenciado</span>
		</a>

		<!-- 5.2.5 - Botão para visualizar dados de cadastro (botão direito na mesma div) -->


		<!-- Modal toggle -->
		<button data-modal-target="default-modal" data-modal-toggle="default-modal" class="bg-verde hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
			Meus Dados
		</button>

		<!-- Main modal -->
		<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full">
			<div class="p-4 w-full max-w-2xl h-fit mt-10">
				<!-- Modal content -->
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					<!-- Modal header -->
					<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
						<h2 class="text-2xl font-bold mb-4">Detalhes do Usuário</h2>
						<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
							<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
							</svg>
							<span class="sr-only">Close modal</span>
						</button>
					</div>
					<!-- Modal body -->
					<div class="max-w-2xl mx-auto mt-10 px-4">
						<div class="overflow-hidden">
							<table class="min-w-full divide-y divide-gray-200">
								<tbody class="bg-white divide-y divide-gray-200">
								<?php foreach ($specific_data_keys as $key) : ?>
									<tr>
										<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
											<?php echo str_replace('_', ' ', ucwords($key)); ?>
										</td>
										<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
											<?php
											if (isset($user_meta[$key])) {
												echo is_array($user_meta[$key]) ? implode(', ', $user_meta[$key]) : $user_meta[$key];
											} else {
												echo 'Dados não preenchidos';
											}
											?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

					<!-- Modal footer -->
					<a href="https://suporte-bosch.zendesk.com/hc/pt-br" target="_blank">
						<button class="p-3 bg-verde text-white rounded-xl text-center m-4 shadow">
							Solicitar Alteração de Dados
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="w-full flex gap-[40px] py-5">
	<!--01-->
	<div class="w-1/2 flex gap-5 justify-between px-4 py-5 whitespace-nowrap bg-white rounded-xl">
		<div class="flex flex-col">
			<h3 class="text-base font-medium leading-4 text-slate-400">Meta Mensal de Compras de Peças Bosch</h3>
			<div class="flex gap-4 mt-4">
				<p class="text-lg font-medium leading-6 text-gray-700"><?php echo isset($meta_mensal) ? $meta_mensal : 'Nenhuma meta disponível'; ?></p>
			</div>
		</div>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
	</div>
	<!--02-->
	<div class="w-1/2 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
		<div class="flex flex-col">
			<h3 class="text-base font-medium leading-4 text-slate-400">Bônus Atingido</h3>
			<div class="flex gap-4 mt-4 whitespace-nowrap">
				<p class="text-lg font-medium leading-6 text-gray-700"><?php echo isset($percentual_bonus) ? $percentual_bonus.'%' : 'Nenhum bônus atingido'; ?></p>
			</div>
		</div>
		<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9195ce572162ae219b6738263e6a665bbb03627060a5c7f956a2bb5ea766d490?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Approved indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
	</div>
</div>

<div class="mb-8">
	<!-- 5.3 - Demonstração dos benefícios -->
	<div class="bg-white rounded-lg shadow-md p-6">
		<!-- 5.3.1 - Lista de benefícios (lista como em uma landing page com uma imagem na parte esquerda e a lista na direita) -->
		<div class="flex mb-6">
			<div class="w-1/2 pr-4">
				<img src="<?php echo get_template_directory_uri() . '/img/reparadores-sorrindo-na-garagem.jpg' ?>" alt="Imagem do benefício" class="w-full h-full object-cover rounded-lg shadow-md">
			</div>
			<div class="w-1/2 bg-verde rounded-lg p-4 shadow-md">
				<h3 class="text-2xl text-white font-semibold mb-2">Acesse seus Benefícios</h3>
				<!-- 5.3.2 - Links de Benefícios (como cards) -->
				<div class="mb-6">
					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2	 gap-4">
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Acesso ao MecânicoPro</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://www.mecanicopro.com.br/" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Plataforma de cursos Bosch SuperProfissionais</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://www.mecanicopro.com.br/" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Enviar Dados para Atingimento de Bônus</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://am.bcs-portal.boschaftermarket.com/br/pt/" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Catálogo de Peças Online</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://baixecatalogo.com.br/catalogo/robert-bosch" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Desconto em Sistema de Gestão para Oficinas</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://ultracar.com.br" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Suporte Equipamentos Bosch</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://suporte-bosch.zendesk.com/hc/pt-br" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Suporte Dúvidas Gerais do Conceito</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="https://suporte-bosch.zendesk.com/hc/pt-br" target="_blank">Clique aqui</a>
						</div>
						<div class="bg-white flex flex-col justify-center items-center rounded-lg p-4 shadow-md">
							<span class="block text-gray-700 text-center focus:outline-none border-none bg-transparent">Manual do Credenciado com todos os benefícios</span>
							<a class="p-2 bg-verde rounded-xl text-white shadow" href="<?php echo esc_url(get_template_directory_uri() . '/docs/MOD_Anexo_1_Manual_do_Credenciado.pdf'); ?>" target="_blank">Clique aqui</a>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- 5.3.3 - Logos dos parceiros (como cards também só que menores) -->
		<h3 class="text-2xl font-semibold mb-2 text-center py-4">Nossos Parceiros</h3>
		<div class=" w-full flex justify-between mb-6">
			<div class="flex items-center space-x-4">
				<img src="<?php echo get_template_directory_uri() . '/img/Captura de tela de 2024-04-16 23-57-20.png'; ?>" alt="Logo Parceiro 1" class="h-20">
				<!-- Adicione mais logos conforme necessário -->
			</div>
			<div class="flex items-center space-x-4">
				<img src="<?php echo get_template_directory_uri() . '/img/Captura de tela de 2024-04-16 23-57-20.png'; ?>" alt="Logo Parceiro 1" class="h-20">
				<!-- Adicione mais logos conforme necessário -->
			</div>
			<div class="flex items-center space-x-4">
				<img src="<?php echo get_template_directory_uri() . '/img/Captura de tela de 2024-04-16 23-57-20.png'; ?>" alt="Logo Parceiro 1" class="h-20">
				<!-- Adicione mais logos conforme necessário -->
			</div>
			<div class="flex items-center space-x-4">
				<img src="<?php echo get_template_directory_uri() . '/img/Captura de tela de 2024-04-16 23-57-20.png'; ?>" alt="Logo Parceiro 1" class="h-20">
				<!-- Adicione mais logos conforme necessário -->
			</div>
			<div class="flex items-center space-x-4">
				<img src="<?php echo get_template_directory_uri() . '/img/Captura de tela de 2024-04-16 23-57-20.png'; ?>" alt="Logo Parceiro 1" class="h-20">
				<!-- Adicione mais logos conforme necessário -->
			</div>
		</div>
	</div>
</div>

<script>
	// Saída dos dados mensais em JSON para o JavaScript
	var dadosMensais = <?php echo $dados_mensais_json; ?>;
	console.log(dadosMensais);
</script>



