const defaultConfig = require('tailwindcss/defaultConfig');

module.exports = {
	theme: {
		colors: {
			...defaultConfig.theme.colors,
			'salmon': '#f4645f',
		}
	},
	variants: {
		...defaultConfig.variants,
		textColor: ['responsive', 'hover', 'focus', 'group-hover'],
	},
	plugins: [],
};
