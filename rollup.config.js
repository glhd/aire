import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import babel from 'rollup-plugin-babel';
import { uglify } from 'rollup-plugin-uglify';

const plugins = [
	resolve(),
	commonjs({
		include: 'node_modules/**',
	}),
	babel({
		exclude: 'node_modules/**'
	})
];

const targets = [
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

if ('production' === process.env.NODE_ENV) {
	targets.push({
		input: 'js/src/main.js',
		output: {
			file: 'js/dist/aire.min.js',
			format: 'iife'
		},
		plugins: [...plugins, uglify()],
	});
	
	targets.push({
		input: 'js/src/Aire.js',
		output: {
			file: 'js/dist/aire-umd.min.js',
			name: 'Aire',
			format: 'umd'
		},
		plugins: [...plugins, uglify()],
	});
}

export default targets;
