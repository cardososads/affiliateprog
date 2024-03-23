<section class="mt-5">
	<div class="flex w-full gap-[30px]">
		<div class="flex flex-col items-start w-[782px] p-[40px] gap-[37px] rounded-[10px] border-[1px] border-[#F8F9FA] bg-white shadow">
			<div class="flex">
				<div class="relative mr-[22px] ">
					<img class="w-[80px] h-[80px] rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0OMHEKM45qri2RzU_TfNJgVKzlEYLB_iwP18p4lN83w&s" alt="Large avatar">
					<a href="#">
					<span class="bg-white shadow w-[26px] h-[26px] flex justify-center items-center font-medium text-blue-800 text-center leading-none rounded-[8px] absolute translate-y-1/2 translate-x-1/2 left-auto bottom-0 right-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
						<g clip-path="url(#clip0_4_24)">
						<path d="M1.49977 9.58254V11.1025C1.49977 11.2425 1.60977 11.3525 1.74977 11.3525H3.26977C3.33477 11.3525 3.39977 11.3275 3.44477 11.2775L8.90477 5.82254L7.02977 3.94754L1.57477 9.40254C1.52477 9.45254 1.49977 9.51254 1.49977 9.58254ZM10.3548 4.37254C10.5498 4.17754 10.5498 3.86254 10.3548 3.66754L9.18477 2.49754C8.98977 2.30254 8.67477 2.30254 8.47977 2.49754L7.56477 3.41254L9.43977 5.28754L10.3548 4.37254V4.37254Z" fill="#41837F"/>
						</g>
						<defs>
						<clipPath id="clip0_4_24">
						<rect width="12" height="12" fill="white" transform="translate(-0.000228882 0.852539)"/>
						</clipPath>
						</defs>
						</svg>
					</span>
					</a>
				</div>
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
							<li class="text-[#718096] text-[12px]"><strong>Nome completo:</strong> Wesley Cardoso</li>
							<li class="text-[#718096] text-[12px]"><strong>E-mail:</strong> wesley@mail.com.br</li>
							<li class="text-[#718096] text-[12px]"><strong>Localização:</strong> Roraima - RR</li>
							<li class="text-[#718096] text-[12px]"><strong>Empresa:</strong> Automotores S.A</li>
							<li class="text-[#718096] text-[12px]"><strong>Media Social:</strong><span>logos</span></li>
						</ul>
						<div class="w-[50%] flex justify-end items-end">
							<button data-modal-target="edit-infos" data-modal-toggle="edit-infos" class="px-[20px] py-[10px] rounded-[5px] border-[1px] border-verde text-verde text-[10px]">
								Editar Informações
							</button>

							<div id="edit-infos" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
								<div class="relative p-4 w-full max-w-2xl max-h-full">
									<!-- Modal content -->
									<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
										<!-- Modal header -->
										<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
											<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
												Altere os seus dados
											</h3>
											<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-infos">
												<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
													<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
												</svg>
												<span class="sr-only">Close modal</span>
											</button>
										</div>
										<!-- Modal body -->
										<div class="p-4 md:p-5 space-y-4">
											<p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
												With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
											</p>
											<p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
												The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
											</p>
										</div>
										<!-- Modal footer -->
										<div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
											<button data-modal-hide="edit-infos" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
											<button data-modal-hide="edit-infos" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
										</div>
									</div>
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
	<div class="w-full rounded-[10px] bg-white p-[40px] my-[30px]">
			<h2 class="text-gray-700 text-[25px] font-semibold leading-[35px] pb-[20px]">Lista de Aprovações</h2>
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
