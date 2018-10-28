let mix = require('laravel-mix');

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

   mix.sass('resources/assets/sass/app.scss', 'public/css')
      .copy('resources/assets/vendor/bootstrap/fonts', 'public/fonts')
      .copy('resources/assets/vendor/font-awesome/fonts', 'public/fonts')
      .styles([
        'resources/assets/vendor/bootstrap/css/bootstrap.css',
        'resources/assets/vendor/animate/animate.css',
        'resources/assets/vendor/font-awesome/css/font-awesome.css',
        'resources/assets/vendor/font-awesome/css/toastr.min.css',
        'resources/assets/vendor/jquery-ui/jquery-ui.min.css',
    ], 'public/css/vendor.css', './')
      .scripts([
        'resources/assets/vendor/jquery/jquery-3.1.1.min.js',
        'resources/assets/vendor/bootstrap/js/bootstrap.js',
        'resources/assets/vendor/metisMenu/jquery.metisMenu.js',
        'resources/assets/vendor/slimscroll/jquery.slimscroll.min.js',
        'resources/assets/vendor/pace/pace.min.js',
        'resources/assets/vendor/jquery-ui/jquery-ui.min.js',
        'resources/assets/js/app.js'
      ], 'public/js/app.js', './')
      .js('resources/assets/js/inspinia.js', 'public/js/inspinia.js')
      .js('resources/assets/vendor/wow/wow.min.js', 'public/js/plugins/wow/wow.min.js');
