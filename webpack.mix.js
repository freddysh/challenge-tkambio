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

mix.js(['resources/js/app.js'/*,'vendor/adminlte/dist/js/adminlte.min.js'*/], 'public/js')
    .vue()
    // .postCss('vendor/adminlte/dist/css/adminlte.min.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
