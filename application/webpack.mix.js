const mix = require('laravel-mix');

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

mix.js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .scripts([
        'node_modules/select2/dist/js/select2.js',
        'node_modules/jquery-mask-plugin/dist/jquery.mask.js'
    ], 'public/library/js/vendor.js')
    .styles([
        'node_modules/select2/dist/css/select2.css',
    ], 'public/library/css/vendor.css');
