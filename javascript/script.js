/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

// set the modal menu element
const $targetEl = document.getElementById('modalEl');

// options with default values
const options = {
	placement: 'bottom-right',
	backdrop: 'dynamic',
	backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
	closable: true,
	onHide: () => {
		console.log('modal is hidden');
	},
	onShow: () => {
		console.log('modal is shown');
	},
	onToggle: () => {
		console.log('modal has been toggled');
	}
};
