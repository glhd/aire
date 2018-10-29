import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import babel from 'rollup-plugin-babel';

export default {
	input: 'js/src/main.js',
	output: {
		file: 'js/dist/aire.js',
		format: 'iife'
	},
	plugins: [
		resolve(),
		commonjs({
			include: 'node_modules/**',
		}),
		babel({
			exclude: 'node_modules/**'
		})
	]
};
