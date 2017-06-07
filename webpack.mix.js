const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
	'resources/assets/js/app.js',
	'resources/assets/js/custom.js',
	'vendor/yajra/laravel-datatables-buttons/src/resources/assets/buttons.server-side.js',
	], 'public/js')
   // app css
   .sass('resources/assets/sass/app.scss', 'public/css');
