<?php
	$user_id = get_current_user_id();
	$codigo_invite = get_user_meta($user_id, 'codigo_invite', true);
?>
<section class="h-screen">
	<div class="flex gap-[30px]">

		<div class="flex flex-col w-1/2 rounded-lg bg-white p-6 my-8">
			<script>
				function copyLink() {
					var link = document.getElementById("affiliateLink");
					link.select();
					document.execCommand("copy");
					alert("Link copied to  clipboard!");
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
								class="bg-verde hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
		<div class="flex gap-[40px]">
			<div class="w-[50%] px-[50px] py-[20px] bg-[#f1f1f1] rounded-[10px] shadow">
				<div class="flex justify-between">
					<div class="flex">
						<div class="relative mr-[22px] ">
							<img class="w-[80px] h-[80px] rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0OMHEKM45qri2RzU_TfNJgVKzlEYLB_iwP18p4lN83w&s" alt="Large avatar">
							<a href="#">
					<span class="bg-verde shadow w-[28px] p-[5px] flex justify-center items-center font-medium text-white text-[7px] text-center leading-none border-[1px] border-white rounded-[21px] absolute translate-y-1/2 translate-x-1/2 left-auto bottom-0 right-0 shadow">
						Ativo
					</span>
							</a>
						</div>
						<div>
							<ul class="flex flex-col gap-[3px]">
								<li class="text-[#718096] text-[12px]"><strong>Wesley Cardoso</strong></li>
								<li class="text-[#718096] text-[12px]"><strong>Empresa:</strong> Automotores S.A</li>
								<li class="text-[#718096] text-[12px]"><strong>E-mail:</strong> wesley@mail.com.br</li>
								<li class="text-[#718096] text-[12px]"><strong>Localização:</strong> Roraima - RR</li>
							</ul>
						</div>
					</div>
					<div class="flex items-center justify-center">
						<ul class="flex items-center justify-center gap-[14px]">
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
										<g clip-path="url(#clip0_6_152)">
										<path d="M11 6C11 3.24 8.76 1 6 1C3.24 1 1 3.24 1 6C1 8.42 2.72 10.435 5 10.9V7.5H4V6H5V4.75C5 3.785 5.785 3 6.75 3H8V4.5H7C6.725 4.5 6.5 4.725 6.5 5V6H8V7.5H6.5V10.975C9.025 10.725 11 8.595 11 6Z" fill="#41837F"/>
										</g>
										<defs>
										<clipPath id="clip0_6_152">
										<rect width="12" height="12" fill="white"/>
										</clipPath>
										</defs>
										</svg>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
										<g clip-path="url(#clip0_6_153)">
										<path d="M11.625 2.56659C11.203 2.74996 10.7565 2.87076 10.2996 2.92519C10.7798 2.64403 11.1409 2.19735 11.3152 1.66894C10.8612 1.93439 10.3654 2.12064 9.8489 2.21972C9.63142 1.9918 9.36987 1.81048 9.08014 1.68678C8.7904 1.56309 8.47854 1.4996 8.16351 1.50019C6.88804 1.50019 5.85586 2.51737 5.85586 3.77128C5.85495 3.94569 5.87494 4.11959 5.91539 4.28925C5.00078 4.24637 4.1052 4.01306 3.28593 3.60423C2.46666 3.1954 1.74175 2.62007 1.15758 1.91503C0.952634 2.26053 0.844249 2.65473 0.84375 3.05644C0.84375 3.84394 1.25461 4.54003 1.875 4.94784C1.50744 4.93912 1.1474 4.84183 0.825469 4.66425V4.69237C0.825469 5.79393 1.62234 6.71034 2.67703 6.91893C2.4787 6.9718 2.27432 6.99859 2.06906 6.99862C1.92342 6.99887 1.7781 6.98474 1.63523 6.95643C1.92844 7.85878 2.7818 8.51503 3.79265 8.53378C2.97126 9.1668 1.9628 9.50895 0.925781 9.50643C0.741707 9.50616 0.557804 9.4952 0.375 9.47362C1.42996 10.1473 2.65628 10.5036 3.90797 10.5002C8.15859 10.5002 10.4808 7.03846 10.4808 4.03612C10.4808 3.93769 10.4782 3.83925 10.4735 3.74315C10.9242 3.42254 11.3142 3.02412 11.625 2.56659Z" fill="#41837F"/>
										</g>
										<defs>
										<clipPath id="clip0_6_153">
										<rect width="12" height="12" fill="white"/>
										</clipPath>
										</defs>
										</svg>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
										  <g clip-path="url(#clip0_6_154)">
											<path d="M6.82309 1.35404C7.30615 1.35548 7.76901 1.54802 8.11059 1.88959C8.45216 2.23117 8.6447 2.69403 8.64614 3.17709V6.82279C8.6447 7.30585 8.45216 7.76871 8.11059 8.11028C7.76901 8.45186 7.30615 8.64439 6.82309 8.64583H3.17739C2.69433 8.64439 2.23147 8.45186 1.8899 8.11028C1.54832 7.76871 1.35579 7.30585 1.35435 6.82279V3.17709C1.35579 2.69403 1.54832 2.23117 1.8899 1.88959C2.23147 1.54802 2.69433 1.35548 3.17739 1.35404H6.82309ZM6.82309 0.624939H3.17739C1.77368 0.624939 0.625244 1.77338 0.625244 3.17709V6.82279C0.625244 8.2265 1.77368 9.37494 3.17739 9.37494H6.82309C8.2268 9.37494 9.37524 8.2265 9.37524 6.82279V3.17709C9.37524 1.77338 8.2268 0.624939 6.82309 0.624939Z" fill="#41837F"/>
											<path d="M7.36987 3.177C7.26171 3.177 7.15598 3.14493 7.06605 3.08484C6.97611 3.02475 6.90602 2.93934 6.86463 2.83941C6.82323 2.73948 6.81241 2.62952 6.83351 2.52344C6.85461 2.41735 6.90669 2.31991 6.98317 2.24343C7.05966 2.16695 7.1571 2.11486 7.26318 2.09376C7.36927 2.07266 7.47922 2.08349 7.57915 2.12488C7.67908 2.16627 7.76449 2.23637 7.82458 2.3263C7.88467 2.41623 7.91675 2.52197 7.91675 2.63013C7.9169 2.70199 7.90286 2.77317 7.87543 2.83959C7.84801 2.90601 7.80773 2.96636 7.75692 3.01717C7.7061 3.06798 7.64576 3.10826 7.57934 3.13569C7.51292 3.16312 7.44173 3.17716 7.36987 3.177Z" fill="#41837F"/>
											<path d="M5.00024 3.5413C5.28869 3.5413 5.57065 3.62683 5.81049 3.78708C6.05032 3.94733 6.23725 4.1751 6.34763 4.44159C6.45801 4.70808 6.48689 5.00131 6.43062 5.28421C6.37435 5.56711 6.23545 5.82698 6.03149 6.03094C5.82753 6.2349 5.56767 6.3738 5.28476 6.43007C5.00186 6.48634 4.70863 6.45746 4.44214 6.34708C4.17565 6.2367 3.94788 6.04977 3.78763 5.80994C3.62738 5.5701 3.54185 5.28814 3.54185 4.99969C3.54226 4.61303 3.69604 4.24232 3.96946 3.96891C4.24287 3.69549 4.61358 3.54171 5.00024 3.5413ZM5.00024 2.81219C4.5676 2.81219 4.14467 2.94049 3.78493 3.18085C3.4252 3.42122 3.14483 3.76286 2.97926 4.16257C2.81369 4.56229 2.77037 5.00212 2.85478 5.42645C2.93918 5.85079 3.14752 6.24056 3.45345 6.54649C3.75938 6.85242 4.14915 7.06076 4.57348 7.14516C4.99782 7.22957 5.43765 7.18625 5.83736 7.02068C6.23708 6.85511 6.57872 6.57474 6.81908 6.215C7.05945 5.85527 7.18774 5.43234 7.18774 4.99969C7.18774 4.41953 6.95728 3.86313 6.54704 3.4529C6.1368 3.04266 5.58041 2.81219 5.00024 2.81219Z" fill="#41837F"/>
										  </g>
										  <defs>
											<clipPath id="clip0_6_154">
											  <rect width="10" height="10" fill="white" transform="translate(0.000244141)"/>
											</clipPath>
										  </defs>
										</svg>
									</span>
								</a>
							</li>
						</ul>
					</div>
					<div>
						<p class="text-[#718096] text-[12px] mb-[5px] font-semibold">Comissão</p>
						<p class="text-[#64B713] text-[18px] mb-[5px] font-semibold">R$ 78,90</p>
						<button class="px-[10px] py-[5px] bg-verde text-white text-[10px] rounded-[2px]">
							Solicitar retirada
						</button>

					</div>
				</div>
			</div>
			<div class="w-[50%] px-[50px] py-[20px] bg-[#f1f1f1] rounded-[10px] shadow">
				<div class="flex justify-between">
					<div class="flex">
						<div class="relative mr-[22px] ">
							<img class="w-[80px] h-[80px] rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0OMHEKM45qri2RzU_TfNJgVKzlEYLB_iwP18p4lN83w&s" alt="Large avatar">
							<a href="#">
								<span class="bg-red-500 shadow w-[28px] p-[5px] flex justify-center items-center font-medium text-white text-[7px] text-center leading-none border-[1px] border-white rounded-[21px] absolute translate-y-1/2 translate-x-1/2 left-auto bottom-0 right-0 shadow">
									Inativo
								</span>
							</a>
						</div>
						<div>
							<ul class="flex flex-col gap-[3px]">
								<li class="text-[#718096] text-[12px]"><strong>Wesley Cardoso</strong></li>
								<li class="text-[#718096] text-[12px]"><strong>Empresa:</strong> Automotores S.A</li>
								<li class="text-[#718096] text-[12px]"><strong>E-mail:</strong> wesley@mail.com.br</li>
								<li class="text-[#718096] text-[12px]"><strong>Localização:</strong> Roraima - RR</li>
							</ul>
						</div>
					</div>
					<div class="flex items-center justify-center">
						<ul class="flex items-center justify-center gap-[14px]">
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
										<g clip-path="url(#clip0_6_152)">
										<path d="M11 6C11 3.24 8.76 1 6 1C3.24 1 1 3.24 1 6C1 8.42 2.72 10.435 5 10.9V7.5H4V6H5V4.75C5 3.785 5.785 3 6.75 3H8V4.5H7C6.725 4.5 6.5 4.725 6.5 5V6H8V7.5H6.5V10.975C9.025 10.725 11 8.595 11 6Z" fill="#41837F"/>
										</g>
										<defs>
										<clipPath id="clip0_6_152">
										<rect width="12" height="12" fill="white"/>
										</clipPath>
										</defs>
										</svg>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
										<g clip-path="url(#clip0_6_153)">
										<path d="M11.625 2.56659C11.203 2.74996 10.7565 2.87076 10.2996 2.92519C10.7798 2.64403 11.1409 2.19735 11.3152 1.66894C10.8612 1.93439 10.3654 2.12064 9.8489 2.21972C9.63142 1.9918 9.36987 1.81048 9.08014 1.68678C8.7904 1.56309 8.47854 1.4996 8.16351 1.50019C6.88804 1.50019 5.85586 2.51737 5.85586 3.77128C5.85495 3.94569 5.87494 4.11959 5.91539 4.28925C5.00078 4.24637 4.1052 4.01306 3.28593 3.60423C2.46666 3.1954 1.74175 2.62007 1.15758 1.91503C0.952634 2.26053 0.844249 2.65473 0.84375 3.05644C0.84375 3.84394 1.25461 4.54003 1.875 4.94784C1.50744 4.93912 1.1474 4.84183 0.825469 4.66425V4.69237C0.825469 5.79393 1.62234 6.71034 2.67703 6.91893C2.4787 6.9718 2.27432 6.99859 2.06906 6.99862C1.92342 6.99887 1.7781 6.98474 1.63523 6.95643C1.92844 7.85878 2.7818 8.51503 3.79265 8.53378C2.97126 9.1668 1.9628 9.50895 0.925781 9.50643C0.741707 9.50616 0.557804 9.4952 0.375 9.47362C1.42996 10.1473 2.65628 10.5036 3.90797 10.5002C8.15859 10.5002 10.4808 7.03846 10.4808 4.03612C10.4808 3.93769 10.4782 3.83925 10.4735 3.74315C10.9242 3.42254 11.3142 3.02412 11.625 2.56659Z" fill="#41837F"/>
										</g>
										<defs>
										<clipPath id="clip0_6_153">
										<rect width="12" height="12" fill="white"/>
										</clipPath>
										</defs>
										</svg>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
										  <g clip-path="url(#clip0_6_154)">
											<path d="M6.82309 1.35404C7.30615 1.35548 7.76901 1.54802 8.11059 1.88959C8.45216 2.23117 8.6447 2.69403 8.64614 3.17709V6.82279C8.6447 7.30585 8.45216 7.76871 8.11059 8.11028C7.76901 8.45186 7.30615 8.64439 6.82309 8.64583H3.17739C2.69433 8.64439 2.23147 8.45186 1.8899 8.11028C1.54832 7.76871 1.35579 7.30585 1.35435 6.82279V3.17709C1.35579 2.69403 1.54832 2.23117 1.8899 1.88959C2.23147 1.54802 2.69433 1.35548 3.17739 1.35404H6.82309ZM6.82309 0.624939H3.17739C1.77368 0.624939 0.625244 1.77338 0.625244 3.17709V6.82279C0.625244 8.2265 1.77368 9.37494 3.17739 9.37494H6.82309C8.2268 9.37494 9.37524 8.2265 9.37524 6.82279V3.17709C9.37524 1.77338 8.2268 0.624939 6.82309 0.624939Z" fill="#41837F"/>
											<path d="M7.36987 3.177C7.26171 3.177 7.15598 3.14493 7.06605 3.08484C6.97611 3.02475 6.90602 2.93934 6.86463 2.83941C6.82323 2.73948 6.81241 2.62952 6.83351 2.52344C6.85461 2.41735 6.90669 2.31991 6.98317 2.24343C7.05966 2.16695 7.1571 2.11486 7.26318 2.09376C7.36927 2.07266 7.47922 2.08349 7.57915 2.12488C7.67908 2.16627 7.76449 2.23637 7.82458 2.3263C7.88467 2.41623 7.91675 2.52197 7.91675 2.63013C7.9169 2.70199 7.90286 2.77317 7.87543 2.83959C7.84801 2.90601 7.80773 2.96636 7.75692 3.01717C7.7061 3.06798 7.64576 3.10826 7.57934 3.13569C7.51292 3.16312 7.44173 3.17716 7.36987 3.177Z" fill="#41837F"/>
											<path d="M5.00024 3.5413C5.28869 3.5413 5.57065 3.62683 5.81049 3.78708C6.05032 3.94733 6.23725 4.1751 6.34763 4.44159C6.45801 4.70808 6.48689 5.00131 6.43062 5.28421C6.37435 5.56711 6.23545 5.82698 6.03149 6.03094C5.82753 6.2349 5.56767 6.3738 5.28476 6.43007C5.00186 6.48634 4.70863 6.45746 4.44214 6.34708C4.17565 6.2367 3.94788 6.04977 3.78763 5.80994C3.62738 5.5701 3.54185 5.28814 3.54185 4.99969C3.54226 4.61303 3.69604 4.24232 3.96946 3.96891C4.24287 3.69549 4.61358 3.54171 5.00024 3.5413ZM5.00024 2.81219C4.5676 2.81219 4.14467 2.94049 3.78493 3.18085C3.4252 3.42122 3.14483 3.76286 2.97926 4.16257C2.81369 4.56229 2.77037 5.00212 2.85478 5.42645C2.93918 5.85079 3.14752 6.24056 3.45345 6.54649C3.75938 6.85242 4.14915 7.06076 4.57348 7.14516C4.99782 7.22957 5.43765 7.18625 5.83736 7.02068C6.23708 6.85511 6.57872 6.57474 6.81908 6.215C7.05945 5.85527 7.18774 5.43234 7.18774 4.99969C7.18774 4.41953 6.95728 3.86313 6.54704 3.4529C6.1368 3.04266 5.58041 2.81219 5.00024 2.81219Z" fill="#41837F"/>
										  </g>
										  <defs>
											<clipPath id="clip0_6_154">
											  <rect width="10" height="10" fill="white" transform="translate(0.000244141)"/>
											</clipPath>
										  </defs>
										</svg>
									</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="flex flex-col justify-center items-center gap-[22px]">
						<div class="flex gap-[21px] items-center justify-center">
							<button class="flex items-center gap-[2px] text-red-500 text-[10px]">
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
									<g clip-path="url(#clip0_4_471)">
										<path d="M3.75049 12.625C3.75049 13.3125 4.31299 13.875 5.00049 13.875H10.0005C10.688 13.875 11.2505 13.3125 11.2505 12.625V6.375C11.2505 5.6875 10.688 5.125 10.0005 5.125H5.00049C4.31299 5.125 3.75049 5.6875 3.75049 6.375V12.625ZM11.2505 3.25H9.68799L9.24424 2.80625C9.13174 2.69375 8.96924 2.625 8.80674 2.625H6.19424C6.03174 2.625 5.86924 2.69375 5.75674 2.80625L5.31299 3.25H3.75049C3.40674 3.25 3.12549 3.53125 3.12549 3.875C3.12549 4.21875 3.40674 4.5 3.75049 4.5H11.2505C11.5942 4.5 11.8755 4.21875 11.8755 3.875C11.8755 3.53125 11.5942 3.25 11.2505 3.25Z" fill="#E53E3E"/>
									</g>
									<defs>
										<clipPath id="clip0_4_471">
											<rect width="15" height="15" fill="white" transform="translate(0.000488281 0.75)"/>
										</clipPath>
									</defs>
								</svg>
								Deletar
							</button>
							<button class="flex items-center gap-[2px] text-gray-700 text-[10px]">
								<svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
									<g clip-path="url(#clip0_4_474)">
										<path d="M1.50037 8.97917V10.4992C1.50037 10.6392 1.61037 10.7492 1.75037 10.7492H3.27037C3.33537 10.7492 3.40037 10.7242 3.44537 10.6742L8.90536 5.21917L7.03037 3.34417L1.57537 8.79917C1.52537 8.84917 1.50037 8.90917 1.50037 8.97917ZM10.3554 3.76917C10.5504 3.57417 10.5504 3.25917 10.3554 3.06417L9.18537 1.89417C8.99037 1.69917 8.67536 1.69917 8.48036 1.89417L7.56537 2.80917L9.44036 4.68417L10.3554 3.76917Z" fill="#2D3748"/>
									</g>
									<defs>
										<clipPath id="clip0_4_474">
											<rect width="12" height="12" fill="white" transform="translate(0.000366211 0.249207)"/>
										</clipPath>
									</defs>
								</svg>
								Editar
							</button>
						</div>
						<button class="px-[10px] py-[5px] mx-[11px] bg-verde text-white text-[10px] rounded-[2px]">
							Solicitar retirada
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
