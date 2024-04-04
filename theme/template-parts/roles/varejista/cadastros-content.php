<?php
	$user_id = get_current_user_id();
	$codigo_invite = get_user_meta($user_id, 'codigo_invite', true);
?>
<section class="h-screen">
	<div class="flex gap-[30px]">

		<div class="flex flex-col w-1/2 rounded-lg bg-white p-6 my-8">
			<script>
				function copyTextToClipboard(text) {
					var input = document.createElement('input');
					input.setAttribute('value', text);
					document.body.appendChild(input);

					input.select();
					input.setSelectionRange(0, 99999);

					document.execCommand('copy');

					document.body.removeChild(input);
				}

				function copyLink() {
					var link = document.getElementById("affiliateLink").value;
					copyTextToClipboard(link);
					alert("Link copied to clipboard!");
				}
			</script>

			<div class="flex items-center mb-5 gap-4">
				<h2 class="text-2xl font-semibold">Link de Afiliado</h2>
				<?php $affiliateLink = site_url('/cadastro-oficina') . '/?' . $codigo_invite; ?>
				<input type="hidden" value="<?= $affiliateLink ?>" id="affiliateLink" readonly>
				<button class="px-[10px] py-[5px] bg-verde rounded-xl text-white font-semibold" onclick="copyLink()">Copiar link</button>			</div>
			<div class="flex flex-col gap-4">
				<div class="p-6 bg-gray-100 flex flex-col gap-2 w-5/6 shadow rounded-lg">
					<h3 class="text-2xl font-semibold mb-4">Convite via e-mail</h3>
					<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
						<input type="hidden" name="action" value="send_invite_email">
						<?php wp_nonce_field('send_invite_email_nonce', 'send_invite_email_nonce'); ?>

						<!-- Adicione os campos do formulário -->
						<div class="flex flex-col mb-4">
							<label for="email" class="mb-2">Seu e-mail</label>
							<input type="email" id="email" name="user_email" required
								   class="py-2 px-3 border rounded-md focus:outline-none focus:border-blue-400">
						</div>

						<div class="flex flex-col mb-4">
							<label for="cnpj" class="mb-2">CNPJ</label>
							<input type="text" id="cnpj" name="cnpj" required
								   class="py-2 px-3 border rounded-md focus:outline-none focus:border-blue-400">
						</div>

						<button type="submit"
								class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
							Convidar
						</button>
					</form>
					<?php if (isset($_GET['invite_email_success']) && $_GET['invite_email_success'] === 'true') : ?>
						<div class="success-message">E-mail enviado com sucesso para o administrador do site.</div>
					<?php elseif (isset($_GET['invite_email_error']) && $_GET['invite_email_error'] === 'true') : ?>
						<div class="error-message">Falha ao enviar o e-mail.</div>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<div class="w-1/2 h-full">
			<div class="w-full rounded-[10px] bg-white p-[40px] my-[30px]">
				<h2 class="text-xl font-semibold">Meta Mensal</h2>
				<div >
					<div class="w-full" ">
						<canvas id="bar-chart"></canvas>
					</div>

					<script>
						// Dados do gráfico (supondo que você tenha esses dados)
						const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'];
						const monthlyGoals = [100, 150, 200, 180, 220]; // Metas mensais

						// Criar gráfico de barras
						var ctx = document.getElementById('bar-chart').getContext('2d');
						var myChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: months,
								datasets: [{
									label: 'Meta Mensal',
									data: monthlyGoals,
									backgroundColor: 'rgb(65,131,127)', // Cor de fundo das barras
									//borderColor: 'rgba(54, 162, 235, 1)', // Cor da borda das barras
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									y: {
										beginAtZero: true,
										title: {
											display: true,
											text: 'Meta'
										}
									},
									x: {
										title: {
											display: true,
											text: 'Mês'
										}
									}
								}
							}
						});
					</script>

				</div>
			</div>
		</div>
	</div>

	<div class="w-full rounded-[10px] bg-white p-[40px] my-[30px]">
		<h2 class="text-gray-700 text-[25px] font-semibold leading-[35px] pb-[20px]">Parcerias</h2>
		aqui eu quero a lista de users "oficina" que tem o código do varejista igual ao do user logado
	</div>

</section>

<?php
$user_id = get_current_user_id();
$codigo_invite = get_user_meta($user_id, 'codigo_invite', true);

// Consulta para obter os usuários do tipo "oficina" com o mesmo código de convite do varejista logado
$oficinas_com_codigo_varejista = get_users(array(
	'meta_key'     => 'codigo_invite',
	'meta_value'   => $codigo_invite,
	'meta_compare' => '=',
	'role'         => 'oficina',
));

?>

<section class="h-screen">
	<div class="flex gap-[30px]">
		<!-- Seu código existente para a seção de link de afiliado e convite por e-mail -->

		<div class="w-full rounded-[10px] bg-white p-[40px] my-[30px]">
			<h2 class="text-gray-700 text-[25px] font-semibold leading-[35px] pb-[20px]">Parcerias</h2>
			<div>
				<?php if ($oficinas_com_codigo_varejista) : ?>
					<ul>
						<?php foreach ($oficinas_com_codigo_varejista as $oficina) : ?>
							<li><?php echo esc_html($oficina->display_name); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php else : ?>
					<p>Nenhuma oficina encontrada para este varejista.</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

