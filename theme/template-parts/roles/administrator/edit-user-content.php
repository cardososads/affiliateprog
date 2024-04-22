<?php
$users = get_users(array('role__in' => array('varejista', 'oficina')));
?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
	<div class="flex items-center justify-between mb-4">
		<div class="flex flex-col">
			<label for="razaoSocialFilter">Filtrar por Razão Social:</label>
			<input id="razaoSocialFilter" type="text" class="border border-gray-300 rounded px-3 py-2">
		</div>

		<div class="flex flex-col">
			<label for="cnpjFilter">Filtrar por CNPJ:</label>
			<input id="cnpjFilter" type="text" class="border border-gray-300 rounded px-3 py-2">
		</div>

		<div class="flex flex-col">
			<label for="emailFilter">Filtrar por E-mail:</label>
			<input id="emailFilter" type="text" class="border border-gray-300 rounded px-3 py-2">
		</div>

		<div class="flex flex-col">
			<label for="tipoUsuarioFilter">Filtrar por Tipo de Usuário:</label>
			<select id="tipoUsuarioFilter" class="border border-gray-300 rounded px-3 py-2">
				<option value="">Todos</option>
				<option value="varejista">Varejista</option>
				<option value="oficina">Oficina</option>
			</select>
		</div>

		<div class="flex flex-col">
			<label for="statusFilter">Filtrar por Status:</label>
			<select id="statusFilter" class="border border-gray-300 rounded px-3 py-2">
				<option value="">Todos</option>
				<option value="pendente">Pendente</option>
				<option value="ativo">Ativo</option>
				<option value="reprovado">Reprovado</option>
				<option value="inativo">Inativo</option>
			</select>
		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('#razaoSocialFilter, #cnpjFilter, #emailFilter, #tipoUsuarioFilter, #statusFilter').on('input change', function() {
				var razaoSocialFilter = $('#razaoSocialFilter').val().toLowerCase();
				var cnpjFilter = $('#cnpjFilter').val().toLowerCase();
				var emailFilter = $('#emailFilter').val().toLowerCase();
				var tipoUsuarioFilter = $('#tipoUsuarioFilter').val().toLowerCase();
				var statusFilter = $('#statusFilter').val().toLowerCase();

				$('tbody tr').each(function() {
					var razaoSocial = $(this).find('td:eq(0)').text().trim().toLowerCase();
					var cnpj = $(this).find('td:eq(1)').text().trim().toLowerCase();
					var email = $(this).find('td:eq(2)').text().trim().toLowerCase();
					var tipoUsuario = $(this).find('td:eq(3)').text().trim().toLowerCase();
					var status = $(this).find('td:eq(4)').text().trim().toLowerCase();

					var showRow = true;

					if (razaoSocialFilter !== '' && !razaoSocial.includes(razaoSocialFilter)) {
						showRow = false;
					}
					if (cnpjFilter !== '' && !cnpj.includes(cnpjFilter)) {
						showRow = false;
					}
					if (emailFilter !== '' && !email.includes(emailFilter)) {
						showRow = false;
					}
					if (tipoUsuarioFilter !== '' && tipoUsuario !== tipoUsuarioFilter) {
						showRow = false;
					}
					if (statusFilter !== '' && status !== statusFilter) {
						showRow = false;
					}

					if (showRow) {
						$(this).show();
					} else {
						$(this).hide();
					}
				});
			});
		});
	</script>

	<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
		<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
		<tr>
			<th scope="col" class="px-6 py-3">
				Razão Social
			</th>
			<th scope="col" class="px-6 py-3">
				CNPJ
			</th>
			<th scope="col" class="px-6 py-3">
				E-mail
			</th>
			<th scope="col" class="px-6 py-3">
				Tipo de Usuário
			</th>
			<th scope="col" class="px-6 py-3">
				Status
			</th>
			<th scope="col" class="px-6 py-3">
				Ação
			</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user) :
			$user_roles = $user->roles;
			if (in_array('varejista', $user_roles) || in_array('oficina', $user_roles)) :
				?>
				<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
					<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
						<?php echo get_user_meta($user->ID, 'razao_social', true); ?>
					</td>
					<td class="px-6 py-4">
						<?php echo get_user_meta($user->ID, 'cnpj', true); ?>
					</td>
					<td class="px-6 py-4">
						<?php echo $user->user_email; ?>
					</td>
					<td class="px-6 py-4">
						<?php echo $user->roles[0]; ?>
					</td>
					<td class="px-6 py-4">
						<?php echo strtoupper(get_user_meta($user->ID, 'user_status', true)); ?>
					</td>
					<td class="px-6 py-4">
						<button data-modal-target="default-modal-<?php echo $user->ID; ?>" data-modal-toggle="default-modal-<?php echo $user->ID; ?>" class="block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
							Editar
						</button>
						<div id="default-modal-<?php echo $user->ID; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
							<div class="relative mt-14 p-4 w-full max-w-8xl max-h-full">
								<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
									<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
										<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
											Editar Usuário
										</h3>
									</div>
									<div class="p-4 md:p-5 space-y-4">
										<form id="editUserForm-<?php echo $user->ID; ?>" class="space-y-4 grid grid-cols-3 gap-4" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST">
											<?php $nonce = wp_create_nonce('salvar_dados_usuario_nonce'); ?>

											<input type="hidden" name="action" value="editar_usuario">
											<input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
											<input type="hidden" name="salvar_dados_usuario_nonce" value="<?= $nonce; ?>">

											<?php
											$campos_personalizados = get_campos_personalizados_usuario();
											foreach ($campos_personalizados as $campo => $label) :
												?>
												<div class="col-span-1">
													<label for="edit<?php echo ucfirst($campo); ?>" class="font-medium text-gray-700 dark:text-gray-300"><?php echo $label; ?>:</label>
													<input type="text" name="<?php echo $campo; ?>" id="edit<?php echo ucfirst($campo); ?>" class="w-full border border-gray-300 rounded px-3 py-2" value="<?= get_user_meta($user->ID, $campo, true); ?>">
												</div>
											<?php endforeach; ?>

											<div class="col-span-1">
												<label for="editUserStatus<?php echo $user->ID; ?>" class="font-medium text-gray-700 dark:text-gray-300">Status:</label>
												<select name="user_status" id="editUserStatus<?php echo $user->ID; ?>" class="w-full border border-gray-300 rounded px-3 py-2">
													<option value="pendente" <?php echo (get_user_meta($user->ID, 'user_status', true) == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
													<option value="ativo" <?php echo (get_user_meta($user->ID, 'user_status', true) == 'ativo') ? 'selected' : ''; ?>>Ativo</option>
													<option value="reprovado" <?php echo (get_user_meta($user->ID, 'user_status', true) == 'reprovado') ? 'selected' : ''; ?>>Reprovado</option>
													<option value="inativo" <?php echo (get_user_meta($user->ID, 'user_status', true) == 'inativo') ? 'selected' : ''; ?>>Inativo</option>
												</select>
											</div>

											<div class="col-span-3 flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
												<button data-modal-hide="default-modal-<?php echo $user->ID; ?>" type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
													Salvar
												</button>
											</div>
										</form>
										<script>
											jQuery(document).ready(function($) {
												$('#editUserForm-<?php echo $user->ID; ?>').on('submit', function(e) {
													e.preventDefault();

													var formData = new FormData(this);
													formData.append('action', 'editar_usuario');

													var userStatus = $('#editUserStatus<?php echo $user->ID; ?>').val();
													formData.append('user_status', userStatus);

													$.ajax({
														type: 'POST',
														url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
														data: formData,
														processData: false,
														contentType: false,
														success: function(response) {
															console.log(response);
															location.reload();
														},
														error: function(xhr, status, error) {
															console.error(xhr.responseText);
														}
													});
												});
											});
										</script>

									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			<?php endif;
		endforeach; ?>
		</tbody>
	</table>
</div>
