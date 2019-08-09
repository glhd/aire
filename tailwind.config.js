const defaultConfig = require('tailwindcss/defaultConfig');

module.exports = {
	theme: {
		colors: {
			...defaultConfig.theme.colors,
			'salmon': '#f4645f',
		},
		maxWidth: {
			...defaultConfig.theme.maxWidth,
			'4/5': '80%',
		},
	},
	variants: {
		...defaultConfig.variants,
		textColor: ['responsive', 'hover', 'focus', 'group-hover'],
	},
	plugins: [
		require('@tailwindcss/custom-forms'),
	],
};
