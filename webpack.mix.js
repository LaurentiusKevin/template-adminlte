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

mix
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/@fortawesome/fontawesome-free', 'public/plugins/fontawesome-free')
    .copy('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/js/bootstrap.bundle.js.map')
    .copy('node_modules/sweetalert2', 'public/plugins/sweetalert2');
