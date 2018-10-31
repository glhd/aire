import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import babel from 'rollup-plugin-babel';

const plugins = [
	resolve(),
	commonjs({
		include: 'node_modules/**',
	}),
	babel({
		exclude: 'node_modules/**'
	})
];

export default [
	{
		input: 'js/src/main.js',
		output: {
			file: 'js/dist/aire.js',
			format: 'iife'
		},
		plugins
	}, {
		input: 'js/src/Aire.js',
		output: {
			file: 'js/dist/aire-umd.js',
			name: 'Aire',
			format: 'umd'
		},
		plugins
	}, {
		input: 'js/src/Aire.js',
		output: {
			file: 'js/dist/aire.mjs',
			format: 'esm'
		},
		plugins
	}
];
