<section class="mt-5 flex flex-col gap-[40px]">
	<!--Foto/Nome-->
	<div class="flex w-full gap-[30px]">
		<div class="flex flex-col items-start w-full p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white">
			<div class="flex items-center">
				<div class="relative mr-[22px] ">
					<img class="w-[80px] h-[80px] rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0OMHEKM45qri2RzU_TfNJgVKzlEYLB_iwP18p4lN83w&s" alt="Large avatar">
				</div>
				<div>
					<p class="text-[#2D3748] text-[18px] font-semibold">Nome Completo</p>
					<span class="text-[#718096] text-[14px] font-normal leading-[21px]">email@email.com.br</span>
				</div>
			</div>
		</div>
	</div>
	<!--Porcentagens-->
	<div class="w-full flex gap-[40px]">
		<!--01-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 whitespace-nowrap bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700">68</p>
					<p class="my-auto text-sm leading-4 text-rose-700">-17,5%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f5aea33a5800a28ddc8437469802aff7ffa48ce2f3776d22597f9c9ffab704d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--02-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Indicações aprovadas</h3>
				<div class="flex gap-4 mt-4 whitespace-nowrap">
					<p class="text-lg font-medium leading-6 text-gray-700">53</p>
					<p class="my-auto text-sm leading-4 text-slate-500">+5%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/9195ce572162ae219b6738263e6a665bbb03627060a5c7f956a2bb5ea766d490?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Approved indication icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--03-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Comissões</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700">R$ 3580,00</p>
					<p class="my-auto text-sm leading-4 text-slate-500">+5%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/24759ece4c96580886bf9d4a6f8b9bd67989dfc83e39556d7455122bc242cf2d?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Commission icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
		<!--04-->
		<div class="w-1/4 flex gap-5 justify-between px-4 py-5 bg-white rounded-xl">
			<div class="flex flex-col">
				<h3 class="text-base font-medium leading-4 text-slate-400">Vendas do mês</h3>
				<div class="flex gap-4 mt-4">
					<p class="text-lg font-medium leading-6 text-gray-700">R$ 10820,00</p>
					<p class="my-auto text-sm leading-4 text-rose-700">-15%</p>
				</div>
			</div>
			<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/39136fa6d29d426060d4c90ed4bef2d6b826e957be44c1fafdca66274a36540e?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Monthly sales icon" class="shrink-0 my-auto aspect-square fill-slate-500 w-[45px]">
		</div>
	</div>
	<!-- Charts/Banner -->
	<div class="flex w-full gap-[20px]">
		<div class="flex flex-col w-3/4 gap-[20px]">
			<div class="w-full bg-white rounded-xl p-[40px]">
				<canvas class="" id="metaMensalChart"></canvas>
				<script>
					var ctx = document.getElementById('metaMensalChart').getContext('2d');
					var metaMensalChart = new Chart(ctx, {
						type: 'line',
						data: {
							labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
							datasets: [{
								label: 'Meta Anterior',
								data: [60, 75, 80, 85, 90, 95, 100], // Dados da meta do mês anterior
								borderColor: '#A0A4AB',
								backgroundColor: '#A0A4AB',
								fill: false,
								yAxisID: 'y-axis-1'
							}, {
								label: 'Meta Atual',
								data: [75, 50, 82, 87, 92, 97, 102], // Dados da meta atual
								borderColor: '#41837F',
								backgroundColor: '#41837F',
								fill: false,
								yAxisID: 'y-axis-1'
							}]
						},
						options: {
							scales: {
								yAxes: [{
									type: 'linear',
									display: true,
									position: 'left',
									id: 'y-axis-1',
									ticks: {
										callback: function(value, index, values) {
											return value + '%'; // Adiciona o símbolo de porcentagem aos valores do eixo y
										}
									}
								}]
							}
						}
					});
				</script>
			</div>
			<div class="flex">
				<div class="w-1/2 bg-white rounded-xl p-[40px]">
					<canvas id="metaAlcancadaChart"></canvas>
					<script>
						var ctx = document.getElementById('metaAlcancadaChart').getContext('2d');
						var metaAlcancadaChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho'],
								datasets: [{
									label: 'Meta',
									data: [100, 110, 120, 130, 140, 150, 160], // Metas mensais
									backgroundColor: '#A0A4AB',
									borderColor: '#A0A4AB',
									borderWidth: 1
								}, {
									label: 'Meta Alcançada',
									data: [90, 105, 115, 125, 135, 145, 155], // Metas alcançadas
									backgroundColor: '#41837F',
									borderColor: '#41837F',
									borderWidth: 1
								}]
							},
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true,
											callback: function(value, index, values) {
												return value + '%'; // Adiciona o símbolo de porcentagem aos valores do eixo y
											}
										}
									}]
								}
							}
						});
					</script>
				</div>
			</div>
		</div>
		<div class="w-1/4 bg-verde p-[40px] rounded-xl">
			Banner
		</div>
	</div>
	<!-- Produtos -->
	<div>
		<h2 class="text-2xl font-semibold leading-9 text-gray-700 max-md:max-w-full">Produtos mais vendidos</h2>
		<div class="flex flex-wrap gap-5 justify-between content-center mt-10 max-md:max-w-full">
			<div class="justify-center max-md:pr-5 max-md:max-w-full">
				<div class="flex gap-5 max-md:flex-col max-md:gap-0">
					<figure class="flex flex-col w-3/12 max-md:ml-0 max-md:w-full">
						<img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/785d5a8b988fbbbce9c3993bc65e9bf58960a068e280eff249b70ef61006a9dd?apiKey=dbcd1f706eb34fbd832e207cfae2bdbc&" alt="Vela de motor product image" class="shrink-0 max-w-full aspect-square w-[100px] max-md:mt-10" />
					</figure>
					<div class="flex flex-col ml-5 w-[27%] max-md:ml-0 max-md:w-full">
						<h3 class="self-stretch my-auto text-base leading-6 text-gray-700 max-md:mt-10">
							Vela de motor
						</h3>
					</div>
					<div class="flex flex-col ml-5 w-[17%] max-md:ml-0 max-md:w-full">
						<p class="self-stretch my-auto text-sm font-extrabold leading-5 text-gray-700 max-md:mt-10">
							R$140,00
						</p>
					</div>
					<div class=" flex-col ml-5 w-[31%] max-md:ml-0 max-md:w-full">
						<div class="flex flex-col self-stretch py-1 my-auto text-sm font-bold leading-5 text-teal-300 whitespace-nowrap max-md:mt-10">
							<p>60%</p>
							<div class="shrink-0 mt-1.5 border-solid bg-slate-200 border-[3px] border-slate-200 h-[3px]"></div>
							<div class="z-10 shrink-0 bg-teal-300 border-teal-300 border-solid border-[3px] h-[3px]"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

