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
							<?php
								require 'edit-user-content.php';
							?>
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
