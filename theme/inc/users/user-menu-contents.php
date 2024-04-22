<?php

function get_user_contents($cargo) {
	$contents = array();

	switch ($cargo) {
		case 'administrator':
			$contents = array(
				'dashboard' => [
					'title' => 'Dashboard',
					'icon' => "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='19' viewBox='0 0 19 19' fill='none'><g clip-path='url(#clip0_2_266)'><path d='M9.59547 3.70846C9.54313 3.65839 9.47349 3.63045 9.40105 3.63045C9.32862 3.63045 9.25898 3.65839 9.20664 3.70846L2.73437 9.89139C2.70689 9.91769 2.68502 9.94928 2.67009 9.98427C2.65517 10.0193 2.6475 10.0569 2.64754 10.0949L2.64648 15.8978C2.64648 16.1962 2.76501 16.4824 2.97599 16.6933C3.18697 16.9043 3.47312 17.0228 3.77148 17.0228H7.15C7.29918 17.0228 7.44226 16.9636 7.54775 16.8581C7.65323 16.7526 7.7125 16.6095 7.7125 16.4603V11.6791C7.7125 11.6045 7.74213 11.533 7.79487 11.4802C7.84762 11.4275 7.91916 11.3978 7.99375 11.3978H10.8062C10.8808 11.3978 10.9524 11.4275 11.0051 11.4802C11.0579 11.533 11.0875 11.6045 11.0875 11.6791V16.4603C11.0875 16.6095 11.1468 16.7526 11.2522 16.8581C11.3577 16.9636 11.5008 17.0228 11.65 17.0228H15.0271C15.3255 17.0228 15.6116 16.9043 15.8226 16.6933C16.0336 16.4824 16.1521 16.1962 16.1521 15.8978V10.0949C16.1521 10.0569 16.1445 10.0193 16.1295 9.98427C16.1146 9.94928 16.0928 9.91769 16.0653 9.89139L9.59547 3.70846Z' fill='#41837F'/><path d='M17.659 8.7319L15.0293 6.21612V2.3985C15.0293 2.24932 14.97 2.10624 14.8645 2.00075C14.7591 1.89527 14.616 1.836 14.4668 1.836H12.7793C12.6301 1.836 12.487 1.89527 12.3815 2.00075C12.2761 2.10624 12.2168 2.24932 12.2168 2.3985V3.5235L10.1805 1.57655C9.99 1.38389 9.70664 1.2735 9.40043 1.2735C9.09528 1.2735 8.81262 1.38389 8.62207 1.5769L1.14434 8.7312C0.925669 8.94213 0.898247 9.28913 1.09723 9.51764C1.1472 9.57532 1.20838 9.62223 1.27705 9.65552C1.34573 9.6888 1.42046 9.70776 1.49669 9.71125C1.57293 9.71473 1.64907 9.70267 1.7205 9.67579C1.79192 9.64892 1.85713 9.60779 1.91215 9.55491L9.20707 2.58413C9.25941 2.53406 9.32905 2.50611 9.40149 2.50611C9.47392 2.50611 9.54356 2.53406 9.5959 2.58413L16.8915 9.55491C16.999 9.65797 17.1429 9.71421 17.2918 9.71131C17.4407 9.70841 17.5823 9.6466 17.6857 9.53944C17.9016 9.31584 17.8836 8.9467 17.659 8.7319Z' fill='#41837F'/></g><defs><clipPath id='clip0_2_266'><rect width='18' height='18' fill='white' transform='translate(0.399994 0.147461)'/></clipPath></defs></svg>"
				],
				'meta-commodities' => [
					'title' => 'Meta Commodities',
					'icon' => "<svg fill='#41837F' width='20' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' viewBox='0 0 32 40' xml:space='preserve'><g><path d='M25.4,16.1H6.6c-0.9,0-1.5,0.8-1.4,1.6l1.9,7.2C7.2,25.5,7.8,26,8.4,26h0.9c0,1.4,1.1,2.6,2.6,2.6c1.4,0,2.6-1.2,2.6-2.6   h3.1c0,1.4,1.1,2.6,2.6,2.6c1.4,0,2.6-1.2,2.6-2.6h0.9c0.7,0,1.2-0.5,1.3-1.1l1.9-7.2C26.9,16.9,26.3,16.1,25.4,16.1z M11.9,27.1   c-0.6,0-1.1-0.5-1.1-1.1c0-0.6,0.5-1.1,1.1-1.1c0.6,0,1.1,0.5,1.1,1.1C13,26.6,12.5,27.1,11.9,27.1z M20.1,27.1   c-0.6,0-1.1-0.5-1.1-1.1c0-0.6,0.5-1.1,1.1-1.1c0.6,0,1.1,0.5,1.1,1.1C21.2,26.6,20.7,27.1,20.1,27.1z'/><path d='M8.8,15.2h5.5c0.8,0,1.4-0.9,1.2-1.9l-0.6-2.5c-0.1-0.6-0.6-1.1-1.2-1.1H9.3c-0.6,0-1,0.4-1.2,1.1l-0.6,2.5   C7.3,14.3,7.9,15.2,8.8,15.2z'/><path d='M17.1,10.9l-0.6,2.5c-0.2,0.9,0.4,1.9,1.2,1.9h5.5c0.8,0,1.4-0.9,1.2-1.9l-0.6-2.5c-0.1-0.6-0.6-1.1-1.2-1.1h-4.3   C17.8,9.8,17.3,10.2,17.1,10.9z'/><path d='M13.3,8.9h5.5c0.8,0,1.4-0.9,1.2-1.9l-0.6-2.5c-0.1-0.6-0.6-1.1-1.2-1.1h-4.3c-0.6,0-1,0.4-1.2,1.1L12.1,7   C11.9,7.9,12.4,8.9,13.3,8.9z'/></g><text x='0' y='47' fill='#41837F' font-size='5px' font-weight='bold' font-family=''Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif'>Created by Mas Dhimas</text><text x='0' y='52' fill='#41837F' font-size='5px' font-weight='bold' font-family=''Helvetica Neue', Helvetica, Arial-Unicode, Arial, Sans-serif'>from the Noun Project</text></svg>"
				],
				'meta-linhas-gerais' => [
					'title' => 'Meta Linhas Gerais',
					'icon' => "<svg fill='#41837F' height='auto' width='20'  id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 512.00 512.00' xml:space='preserve' stroke='#41837F'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <g> <g> <polygon points='444.235,97.882 444.235,37.647 399.059,37.647 399.059,97.882 112.941,97.882 112.941,37.647 67.765,37.647 67.765,97.882 0,97.882 0,158.118 512,158.118 512,97.882 '></polygon> </g> </g> <g> <g> <path d='M30.118,203.294v271.059h451.765V203.294H30.118z M210.824,361.412h-37.647v37.647H128v-37.647H90.353v-45.176H128 v-37.647h45.176v37.647h37.647V361.412z M421.647,361.412H301.176v-45.176h120.471V361.412z'></path> </g> </g> </g></svg>"
				],
				'meta-oficinas' => [
					'title' => 'Meta Oficinas',
					'icon' => "<?xml version='1.0' encoding='UTF-8' standalone='no'?><svg
   viewBox='0 0 58 66.879997'
   x='0px'
   y='0px'
   version='1.1'
   id='svg2'
   sodipodi:docname='noun-tool-5345477.svg'
   width='20'
   height='auto'
   inkscape:version='1.3.2 (091e20ef0f, 2023-11-25)'
   xmlns:inkscape='http://www.inkscape.org/namespaces/inkscape'
   xmlns:sodipodi='http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd'
   xmlns='http://www.w3.org/2000/svg'
   xmlns:svg='http://www.w3.org/2000/svg'>
  <sodipodi:namedview
     id='namedview2'
     pagecolor='#ffffff'
     bordercolor='#000000'
     borderopacity='0.25'
     inkscape:showpageshadow='2'
     inkscape:pageopacity='0.0'
     inkscape:pagecheckerboard='0'
     inkscape:deskcolor='#d1d1d1'
     inkscape:zoom='5.08125'
     inkscape:cx='63.862239'
     inkscape:cy='80'
     inkscape:window-width='1920'
     inkscape:window-height='1011'
     inkscape:window-x='0'
     inkscape:window-y='32'
     inkscape:window-maximized='1'
     inkscape:current-layer='svg2' />
  <defs
     id='defs1'>
    <style
       id='style1'>.cls-1{fill-rule:evenodd;}</style>
  </defs>
  <title
     id='title1'>3</title>
  <g
     data-name='1'
     id='g1'
     transform='translate(-35,-30.560001)'
     style='fill:#41837f;fill-opacity:1'>
    <path
       class='cls-1'
       d='M 61.3,80.7 V 70.26 l -3.2,-3.2 H 47.65 V 60.94 H 58.1 l 3.2,-3.2 V 47.3 h 6.11 v 10.44 l 3.2,3.2 h 10.45 v 6.12 H 70.61 l -3.2,3.2 V 80.7 Z M 64,97.44 35,80.72 V 47.28 L 64,30.56 93,47.28 V 80.72 Z M 64.35,85.85 A 21.8,21.8 0 1 0 42.56,64.06 21.8,21.8 0 0 0 64.35,85.85 Z'
       id='path1'
       style='fill:#41837f;fill-opacity:1' />
  </g>
</svg>"
				],
				'cadastros' => [
					'title' => 'Cadastros',
					'icon' => "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='19' viewBox='0 0 24 19' fill='none'><path d='M10.6857 4.60461C10.6857 5.62759 10.2793 6.60867 9.55598 7.33202C8.83262 8.05538 7.85154 8.46175 6.82857 8.46175C5.80559 8.46175 4.82451 8.05538 4.10115 7.33202C3.3778 6.60867 2.97142 5.62759 2.97142 4.60461C2.97142 3.58163 3.3778 2.60055 4.10115 1.8772C4.82451 1.15384 5.80559 0.747467 6.82857 0.747467C7.85154 0.747467 8.83262 1.15384 9.55598 1.8772C10.2793 2.60055 10.6857 3.58163 10.6857 4.60461ZM20.9714 4.60461C20.9714 5.11114 20.8717 5.6127 20.6778 6.08067C20.484 6.54864 20.1999 6.97385 19.8417 7.33202C19.4835 7.69019 19.0583 7.97431 18.5903 8.16815C18.1224 8.36199 17.6208 8.46175 17.1143 8.46175C16.6078 8.46175 16.1062 8.36199 15.6382 8.16815C15.1702 7.97431 14.745 7.69019 14.3869 7.33202C14.0287 6.97385 13.7446 6.54864 13.5507 6.08067C13.3569 5.6127 13.2571 5.11114 13.2571 4.60461C13.2571 3.58163 13.6635 2.60055 14.3869 1.8772C15.1102 1.15384 16.0913 0.747467 17.1143 0.747467C18.1373 0.747467 19.1183 1.15384 19.8417 1.8772C20.565 2.60055 20.9714 3.58163 20.9714 4.60461ZM15.7386 18.7475C15.7977 18.327 15.8286 17.8989 15.8286 17.4618C15.8315 15.4417 15.1519 13.4799 13.9 11.8946C14.8772 11.3304 15.9858 11.0334 17.1142 11.0333C18.2427 11.0333 19.3512 11.3304 20.3285 11.8946C21.3058 12.4588 22.1173 13.2703 22.6815 14.2475C23.2458 15.2248 23.5428 16.3333 23.5429 17.4618V18.7475H15.7386ZM6.82857 11.0332C8.53353 11.0332 10.1687 11.7105 11.3743 12.9161C12.5798 14.1217 13.2571 15.7568 13.2571 17.4618V18.7475H0.399994V17.4618C0.399994 15.7568 1.07729 14.1217 2.28288 12.9161C3.48847 11.7105 5.1236 11.0332 6.82857 11.0332Z' fill='#41837F'/></svg>"
				],
				'aprovacoes' => [
					'title' => 'Aprovações',
					'icon' => "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='19' viewBox='0 0 19 19' fill='none'><rect x='0.399994' y='0.147461' width='18' height='18' rx='9' fill='#41837F'/><path d='M13.4 6.14746L8.01538 12.1475L6.39999 10.3493' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>"
				]
			);
			break;
		case 'varejista':
			$contents = array(
				'dashboard' => [
					'title' => 'Informações do Varejo',
					'icon' => "<svg class='w-6 h-6 text-[#41837F]' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm9.4-5.5a1 1 0 1 0 0 2 1 1 0 1 0 0-2ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4c0-.6-.4-1-1-1h-2Z' clip-rule='evenodd'/></svg>"
				],
//				'metas' => [
//					'title' => 'Metas',
//					'icon' => "<svg class='w-6 h-6 text-verde-inter' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M14 7h-4v3a1 1 0 1 1-2 0V7H6a1 1 0 0 0-1 1L4 19.7A2 2 0 0 0 6 22h12c1 0 2-1 2-2.2L19 8c0-.5-.5-.9-1-.9h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 1 1 8 0v1h-2V6a2 2 0 0 0-2-2Z' clip-rule='evenodd'/></svg>"
//				],
				'cadastros' => [
					'title' => 'Cadastros',
					'icon' => "<svg class='w-6 h-6 text-verde-inter' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M5 8a4 4 0 1 1 7.8 1.3l-2.5 2.5A4 4 0 0 1 5 8Zm4 5H7a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h2.2a3 3 0 0 1-.1-1.6l.6-3.4a3 3 0 0 1 .9-1.5L9 13Zm9-5a3 3 0 0 0-2 .9l-6 6a1 1 0 0 0-.3.5L9 18.8a1 1 0 0 0 1.2 1.2l3.4-.7c.2 0 .3-.1.5-.3l6-6a3 3 0 0 0-2-5Z' clip-rule='evenodd'/></svg>"
				],
				'configuracoes' => [
					'title' => 'Configurações',
					'icon' => "<svg class='w-6 h-6 text-verde-inter' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M9.6 2.6A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2l.5.3a2 2 0 0 1 2.9 0l1.4 1.3a2 2 0 0 1 0 2.9l.1.5h.1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2l-.3.5a2 2 0 0 1 0 2.9l-1.3 1.4a2 2 0 0 1-2.9 0l-.5.1v.1a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2l-.5-.3a2 2 0 0 1-2.9 0l-1.4-1.3a2 2 0 0 1 0-2.9l-.1-.5H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2l.3-.5a2 2 0 0 1 0-2.9l1.3-1.4a2 2 0 0 1 2.9 0l.5-.1V4c0-.5.2-1 .6-1.4ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z' clip-rule='evenodd'/></svg>"
				]
			);
			break;
		case 'oficina':
			$contents = array(
				'dashboard' => [
					'title' => 'Informações',
					'icon' => "<svg class='w-6 h-6 text-[#41837F]' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm9.4-5.5a1 1 0 1 0 0 2 1 1 0 1 0 0-2ZM10 10a1 1 0 1 0 0 2h1v3h-1a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-1v-4c0-.6-.4-1-1-1h-2Z' clip-rule='evenodd'/></svg>"
				],
				'metas' => [
					'title' => 'Metas',
					'icon' => "<svg class='w-6 h-6 text-verde-inter' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M14 7h-4v3a1 1 0 1 1-2 0V7H6a1 1 0 0 0-1 1L4 19.7A2 2 0 0 0 6 22h12c1 0 2-1 2-2.2L19 8c0-.5-.5-.9-1-.9h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 1 1 8 0v1h-2V6a2 2 0 0 0-2-2Z' clip-rule='evenodd'/></svg>"
				],
				'configuracoes' => [
					'title' => 'Configurações',
					'icon' => "<svg class='w-6 h-6 text-verde-inter' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='#41837F' viewBox='0 0 24 24'><path fill-rule='evenodd' d='M9.6 2.6A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2l.5.3a2 2 0 0 1 2.9 0l1.4 1.3a2 2 0 0 1 0 2.9l.1.5h.1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2l-.3.5a2 2 0 0 1 0 2.9l-1.3 1.4a2 2 0 0 1-2.9 0l-.5.1v.1a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2l-.5-.3a2 2 0 0 1-2.9 0l-1.4-1.3a2 2 0 0 1 0-2.9l-.1-.5H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2l.3-.5a2 2 0 0 1 0-2.9l1.3-1.4a2 2 0 0 1 2.9 0l.5-.1V4c0-.5.2-1 .6-1.4ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z' clip-rule='evenodd'/></svg>"
				]
			);
			break;
	}
	return $contents;
}

