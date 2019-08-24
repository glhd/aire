const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const build = require('./tasks/build.js');

require('laravel-mix-purgecss');

mix.disableSuccessNotifications();

mix.setPublicPath('source/assets/build');

mix.webpackConfig({
	plugins: [
		build.jigsaw,
		build.browserSync(),
		build.watch(['source/**/*.md', 'source/**/*.php', 'source/**/*.css', '!source/**/_tmp/*']),
	]
});

mix.js('source/_assets/js/aire-docs.js', 'js')
	.postCss('source/_assets/css/aire-docs.css', 'css', [
		tailwindcss,
	])
	.options({
		processCssUrls: false,
	})
	.version();

if (mix.inProduction()) {
	mix.purgeCss();
}
