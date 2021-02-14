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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sourceMaps();

mix.js('resources/js/admin/admin.js', 'public/js')
    .sourceMaps();


mix.sass('resources/css/app.scss', 'public/css').sourceMaps();
mix.sass('resources/css/service_page.scss', 'public/css').sourceMaps();
