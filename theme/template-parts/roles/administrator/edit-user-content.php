<?php
$users = get_users(array('role__in' => array('varejista', 'oficina')));
?>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
						<!-- Modal toggle -->
						<button data-modal-target="default-modal-<?php echo $user->ID; ?>"
								data-modal-toggle="default-modal-<?php echo $user->ID; ?>"
								class="block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
								type="button">
							Editar
						</button>
						<!-- Main modal -->
						<div id="default-modal-<?php echo $user->ID; ?>" tabindex="-1" aria-hidden="true"
							 class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
							<div class="relative mt-14 p-4 w-full max-w-8xl max-h-full">
								<!-- Modal content -->
								<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
									<!-- Modal header -->
									<div
										class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
										<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
											Editar Usuário
										</h3>
									</div>
									<!-- Modal body -->
									<div class="p-4 md:p-5 space-y-4">
										<!-- Formulário de edição de usuário -->
										<form id="editUserForm-<?php echo $user->ID; ?>"
											  class="space-y-4 grid grid-cols-3 gap-4"
											  action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST">
											<!-- Campos do formulário -->
											<?php $nonce = wp_create_nonce('salvar_dados_usuario_nonce'); ?>

											<input type="hidden" name="action" value="editar_usuario">
											<input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
											<input type="hidden" name="salvar_dados_usuario_nonce" value="<?= $nonce; ?>">

											<?php
											$campos_personalizados = get_campos_personalizados_usuario();
											foreach ($campos_personalizados as $campo => $label) :
												?>
												<div class="col-span-1">
													<label for="edit<?php echo ucfirst($campo); ?>"
														   class="font-medium text-gray-700 dark:text-gray-300"><?php echo $label; ?>:</label>
													<input type="text" name="<?php echo $campo; ?>"
														   id="edit<?php echo ucfirst($campo); ?>"
														   class="w-full border border-gray-300 rounded px-3 py-2"
														   value="<?= get_user_meta($user->ID, $campo, true); ?>">
												</div>
											<?php endforeach; ?>
											<!-- Modal footer -->
											<div class="col-span-3 flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
												<button data-modal-hide="default-modal-<?php echo $user->ID; ?>"
														type="submit"
														class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
													Salvar
												</button>
											</div>
										</form>
										<script>
											jQuery(document).ready(function ($) {
												$('#editUserForm-<?php echo $user->ID; ?>').on('submit', function (e) {
													e.preventDefault();

													// Obter os dados do formulário manualmente
													var formData = new FormData(this);

													// Adicionar a ação ao objeto FormData
													formData.append('action', 'editar_usuario');

													// Iterar sobre os pares chave/valor do objeto FormData
													for (const pair of formData.entries()) {
														console.log(pair[0] + ': ' + pair[1]);
													}

													// Fazer a requisição AJAX
													$.ajax({
														type: 'POST',
														url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
														data: formData,
														processData: false, // Evitar que o jQuery processe os dados
														contentType: false, // Evitar que o jQuery defina o Content-Type
														success: function (response) {
															// Manipular a resposta do servidor
															console.log(response);
														},
														error: function (xhr, status, error) {
															// Manipular erros, se houver
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

