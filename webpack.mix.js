const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .scripts('node_modules/jquery/dist/jquery.js','public/site/jquery.js')
    .scripts('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/site/bootstrap.min.css')
    .scripts('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/site/bootstrap.min.css.map')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.js', 'public/site/bootstrap.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js.map', 'public/site/bootstrap.bundle.js.map')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/site/bootstrap.bundle.min.js')
    .scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'public/site/bootstrap.bundle.min.js.map')
