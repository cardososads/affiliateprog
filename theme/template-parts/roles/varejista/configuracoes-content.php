<?php

$user = get_current_user();

?>

<section class="mt-5">
	<div class="flex w-full gap-[30px]">
		<div class="flex flex-col items-start w-[782px] p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white shadow">
			<div class="flex">
				<div>
					<p class="text-[#2D3748] text-[18px] font-semibold">Nome Completo</p>
					<span class="text-[#718096] text-[14px] font-normal leading-[21px]">email@email.com.br</span>
				</div>
			</div>
			<div class="flex flex-col">
				<div>
					<h4 class="text-[#2D3748] text-[18px] font-semibold leading-[25px] mb-[16px]">Informações do perfil</h4>
					<p class="text-[#A0AEC0] text-[16px] font-normal leading-[24px]">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<hr class="mt-[6px] mb-[30px]">
					<div class="flex">
						<ul class="w-[50%] flex flex-col gap-[18px]">
							<li class="text-[#718096] text-[12px]"><strong>Localização:</strong> Roraima - RR</li>
							<li class="text-[#718096] text-[12px]"><strong>Empresa:</strong> Automotores S.A</li>
						</ul>
						<div class="w-[50%] flex justify-end items-end">
							<button data-modal-target="edit-infos" data-modal-toggle="edit-infos" class="px-[20px] py-[10px] rounded-[5px] border-[1px] border-verde text-verde text-[10px]">
								Editar Informações
							</button>

							<div id="edit-infos" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
								<div class="relative p-4 w-full max-w-2xl max-h-full">
									<!-- Modal content -->
									<div class="p-4 md:p-5 space-y-4 bg-white">
										<!-- Formulário para edição de dados do usuário -->
										<form id="user-edit-form" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
											<div>
												<label for="username" class="block font-medium">Nome de Usuário:</label>
												<input type="text" id="username" name="username" value="<?php echo esc_attr($user->user_login); ?>" disabled class="w-full border rounded-md px-3 py-2">
												<!-- Outros campos personalizados -->
												<?php
												$campos_personalizados = get_campos_personalizados_usuario();
												var_dump($user->ID);
												foreach ($campos_personalizados as $campo => $label) :
													?>
													<label for="<?php echo $campo; ?>" class="block font-medium"><?php echo $label; ?>:</label>
													<?php if ($campo === 'profile_picture') : ?>
													<input type="file" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>" accept="image/*" class="w-full border rounded-md px-3 py-2">
												<?php else : ?>
													<input type="text" id="<?php echo $campo; ?>" name="<?php echo $campo; ?>" class="w-full border rounded-md px-3 py-2">
												<?php endif; ?>
												<?php endforeach; ?>
											</div>
											<button type="submit" class="col-span-2 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md">Salvar Alterações</button>
										</form>

									</div>
									<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
									<script>
										$(document).ready(function() {
											// Função para carregar os dados do usuário no formulário
											function carregarDadosUsuario() {
												$.ajax({
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													type: 'POST',
													data: {
														action: 'carregar_dados_usuario'
													},
													success: function(response) {
														var userData = JSON.parse(response);
														$('#username').val(userData.username);
														// Preencher os campos personalizados
														<?php foreach ($campos_personalizados as $campo => $label) : ?>
														$('#<?php echo $campo; ?>').val(userData.<?php echo $campo; ?>);
														<?php endforeach; ?>
													}
												});
											}

											// Carregar os dados do usuário quando a página for carregada
											carregarDadosUsuario();

											// Função para lidar com a submissão do formulário de edição de usuário
											$('#user-edit-form').submit(function(e) {
												e.preventDefault(); // Impedir o envio padrão do formulário

												// Serializar os dados do formulário
												var formData = $(this).serialize();

												// Enviar os dados via AJAX
												$.ajax({
													url: '<?php echo admin_url('admin-ajax.php'); ?>',
													type: 'POST',
													data: formData + '&action=salvar_dados_usuario',
													success: function(response) {
														// Lidar com a resposta após a submissão bem-sucedida
														if (response.success) {
															alert('Dados do usuário salvos com sucesso!');
															// Você pode adicionar mais ações aqui, como redirecionar o usuário para outra página, atualizar a interface do usuário, etc.
														} else {
															alert('Erro ao salvar os dados do usuário. Por favor, tente novamente.');
														}
													}
												});
											});
										});
									</script>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="flex flex-col items-start w-[782px] h p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] shadow" style="background-image: url('<?= get_template_directory_uri() . '/img/Background.svg' ?>')">
			<div class="flex flex-col h-[60%] justify-end">
				<h3 class="my-5 text-[18px] text-white font-semibold leading-loose">Precisa de ajuda?</h3>
				<p class="text-[16px] text-white font-normal leading-normal">
					Por favor, entre em contato conosco,
					<br>em breve um responsável pelo suporte retornará o seu chamado.
				</p>
			</div>
			<div class="flex w-full h-[40%] justify-end items-end">
				<button class="flex gap-[10px] px-[20px] py-[10px] rounded-[5px] border-[1px] bg-white text-verde text-[10px] mx-[30px]">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
						<path d="M7.5 0C3.35813 0 0 3.35813 0 7.5C0 8.90701 0.395213 10.2188 1.06934 11.344L0.0671387 15L3.80127 14.0198C4.89335 14.6407 6.15406 15 7.5 15C11.6419 15 15 11.6419 15 7.5C15 3.35813 11.6419 0 7.5 0ZM4.93286 4.00146C5.05474 4.00146 5.17996 4.00072 5.28809 4.00635C5.42184 4.00947 5.56741 4.01927 5.70679 4.32739C5.87241 4.69364 6.23305 5.61244 6.2793 5.70557C6.32555 5.79869 6.35832 5.9084 6.29394 6.03027C6.23269 6.15527 6.20084 6.23093 6.11084 6.34155C6.01771 6.44905 5.91567 6.58257 5.8313 6.66382C5.73817 6.75694 5.64201 6.85905 5.74951 7.04468C5.85701 7.2303 6.23035 7.83883 6.78223 8.33008C7.4916 8.96383 8.09012 9.15858 8.27637 9.25171C8.46262 9.34483 8.57048 9.33032 8.67798 9.20532C8.7886 9.08345 9.14258 8.66525 9.26758 8.479C9.38945 8.29275 9.51387 8.32498 9.68262 8.38623C9.85387 8.44748 10.7671 8.89735 10.9534 8.99048C11.1396 9.0836 11.2617 9.1297 11.3086 9.20532C11.3567 9.28345 11.3568 9.65536 11.2024 10.0891C11.048 10.5222 10.29 10.9411 9.94995 10.9705C9.60683 11.0023 9.2866 11.1247 7.71973 10.5078C5.82973 9.76344 4.6378 7.82764 4.54468 7.70264C4.45155 7.58076 3.78784 6.69619 3.78784 5.78369C3.78784 4.86807 4.26791 4.41965 4.43604 4.2334C4.60729 4.04715 4.80786 4.00146 4.93286 4.00146Z" fill="#41837F"/>
					</svg>
					Chat Via Whatsapp
				</button>
				<button class="px-[20px] py-[10px] rounded-[5px] border-[1px] border-white bg-[#4FD1C5;] text-white text-[10px]">Abrir Chamado</button>
			</div>
		</div>
	</div>
</section>
