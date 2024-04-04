<button data-modal-target="edit-infos" data-modal-toggle="edit-infos" class="px-5 py-3 bg-verde rounded-lg text-white font-semibold">
	Cadastre-se aqui!
</button>

<div id="edit-infos" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
	<div class="relative p-4 w-full max-w-2xl max-h-full">
		<!-- Modal content -->
		<div class="relative mt-[70px] bg-white p-[40px] rounded-lg shadow dark:bg-gray-700 max-h-[690px] overflow-y-scroll">
			<!-- Modal header -->
			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="container mx-auto">
						<div class="md:flex md:justify-center">
							<div class="md:w-full">
								<h2 class="text-2xl font-bold mb-4">Cadastrar novo varejista</h2>
								<form id="add-user-form" class="space-y-4">
									<div>
										<label for="username" class="block font-semibold">Nome de usuário:</label>
										<input type="text" id="username" name="username" class="w-full border rounded px-3 py-2" required>
									</div>
									<div>
										<label for="email" class="block font-semibold">E-mail:</label>
										<input type="email" id="email" name="email" class="w-full border rounded px-3 py-2" required>
									</div>
									<div>
										<label for="cnpj" class="block font-semibold">CNPJ:</label>
										<input type="text" id="cnpj" name="cnpj" class="w-full border rounded px-3 py-2" required>
									</div>
									<div>
										<label for="password" class="block font-semibold">Senha:</label>
										<input type="password" id="password" name="password" class="w-full border rounded px-3 py-2" required>
									</div>
									<input type="hidden" name="role" value="varejista">
									<input type="hidden" name="user_status" value="pendente">
									<button type="submit" class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded hover:bg-blue-600">Cadastrar</button>
								</form>
								<div id="success-message" class="hidden text-green-600 mt-4">Seu cadastro foi realizado com sucesso! Faça login para preencher os seus dados.</div>
								<script>
									var add_user_ajax = {
										ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>'
									};

									jQuery(document).ready(function($) {
										$('#add-user-form').on('submit', function(e) {
											e.preventDefault();

											var formData = $(this).serialize();

											$.ajax({
												type: 'POST',
												url: add_user_ajax.ajax_url,
												data: formData + '&action=add_new_user',
												success: function(response) {
													$('#success-message').removeClass('hidden'); // Mostra a mensagem de sucesso
													$('#message').html(response);
													// Recarregar a página após 1 segundo
													setTimeout(function() {
														location.reload();
													}, 3000);
												},
												error: function(xhr, status, error) {
													console.error(xhr.responseText);
												}
											});

										});
									});
								</script>
								<div id="message" class="mt-4"></div>
							</div>
						</div>
					</div>
				</main>
			</div>
		</div>
	</div>
</div>
