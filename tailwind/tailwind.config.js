// Set the Preflight flag based on the build target.
const includePreflight = 'editor' === process.env._TW_TARGET ? false : true;

module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
		"./node_modules/flowbite/**/*.js"
	],

	theme: {
		// Extend the default Tailwind theme.

		extend: {
			boxShadow: {
				'button': '0 0 40px -15px rgba(0, 0, 0, 0.3)',
			},
			colors: {
				verde: "#41837F",
				'verde-10%': "#F8F9FA",
				'cinza-10%': "rgba(113, 113, 113, 0.1)",
				customgreen: '#448771'
			},
			background_image: {
				contactBg: "url('../img/Background.svg')"
			}
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),

		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		require('flowbite/plugin'),


		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
