<?php
$user_id = get_current_user_id();
// Verifica se $user foi definido em algum lugar antes do código ser executado
if (isset($user)) :
	?>
	<!-- Modal toggle -->
	<button data-modal-target="default-modal-<?php echo $user_id; ?>" data-modal-toggle="default-modal-<?php echo $user_id ?>" class="block text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
		Editar
	</button>

	<!-- Main modal -->
	<div id="default-modal-<?php echo $user_id ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative mt-14 p-4 w-full max-w-8xl max-h-full">
			<!-- Modal content -->
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
						Editar Usuário
					</h3>
				</div>
				<!-- Modal body -->
				<div class="p-4 md:p-5 space-y-4">
					<!-- Formulário de edição de usuário -->
					<form id="editUserForm-<?php echo $user_id ?>" class="space-y-4 grid grid-cols-3 gap-4" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="POST">
						<!-- Campos do formulário -->
						<?php $nonce = wp_create_nonce('salvar_dados_usuario_nonce'); ?>

						<input type="hidden" name="action" value="editar_usuario">
						<input type="hidden" name="user_id" value="<?php echo $user_id ?>">
						<input type="hidden" name="salvar_dados_usuario_nonce" value="<?= $nonce; ?>">

						<?php
						// Obtém os campos personalizados do usuário
						$campos_personalizados = get_campos_personalizados_usuario();
						foreach ($campos_personalizados as $campo => $label) :
							// Verificar se o usuário atual é um administrador e se o campo é 'codigo_invite' ou 'user_status'
							if (current_user_can('administrator') || ($campo !== 'codigo_invite' && $campo !== 'user_status')) :
								?>
								<div class="col-span-1">
									<label for="edit<?php echo ucfirst($campo); ?>" class="font-medium text-gray-700 dark:text-gray-300"><?php echo $label; ?>:</label>
									<!-- Mostra o valor atual do campo -->
									<input type="text" name="<?php echo $campo; ?>" id="edit<?php echo ucfirst($campo); ?>" class="w-full border border-gray-300 rounded px-3 py-2" value="<?= get_user_meta($user_id, $campo, true); ?>">
								</div>
							<?php
							endif;
						endforeach;
						?>
						<!-- Campo de seleção de status -->
						<?php if (current_user_can('administrator')) : ?>
							<div class="col-span-1">
								<label for="editUserStatus<?php echo $user_id ?>" class="font-medium text-gray-700 dark:text-gray-300">Status:</label>
								<select name="user_status" id="editUserStatus<?php echo $user_id ?>" class="w-full border border-gray-300 rounded px-3 py-2">
									<?php
									// Array de opções para o campo de seleção de status
									$opcoes_status = array(
										'pendente' => 'Pendente',
										'ativo' => 'Ativo',
										'reprovado' => 'Reprovado',
										'inativo' => 'Inativo'
									);
									foreach ($opcoes_status as $valor => $descricao) :
										?>
										<option value="<?php echo $valor; ?>" <?php echo (get_user_meta($user->ID, 'user_status', true) == $valor) ? 'selected' : ''; ?>><?php echo $descricao; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endif; ?>
						<!-- Modal footer -->
						<div class="col-span-3 flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
							<button data-modal-hide="default-modal-<?php echo $user_id ?>" type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
								Salvar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<script>
	jQuery(document).ready(function($) {
		// Manipulação do formulário para enviar dados via AJAX
		$('[id^=editUserForm]').on('submit', function(e) {
			e.preventDefault();

			var formData = new FormData(this);
			var userStatus = $('[id^=editUserStatus]').val(); // Obtém o valor selecionado do campo de status

			formData.append('action', 'editar_usuario');
			formData.append('user_status', userStatus);

			$.ajax({
				type: 'POST',
				url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					console.log(response);
					location.reload(); // Recarrega a página após o salvamento dos dados
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		});
	});
</script>
