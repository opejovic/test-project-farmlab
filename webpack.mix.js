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

   mix.sass('resources/sass/app.scss', 'public/css')
      .copy('resources/vendor/bootstrap/fonts', 'public/fonts')
      .copy('resources/vendor/font-awesome/fonts', 'public/fonts')
      .styles([
        'resources/vendor/bootstrap/css/bootstrap.css',
        'resources/vendor/animate/animate.css',
        'resources/vendor/font-awesome/css/font-awesome.css',
        'resources/vendor/sweetalert/sweetalert.css',
        'resources/vendor/dropzone/basic.css',
        'resources/vendor/dropzone/dropzone.css',
        'resources/vendor/dataTables/datatables.min.css',
    ], 'public/css/vendor.css', './')
      .scripts([
        'resources/vendor/jquery/jquery-3.1.1.min.js',
        'resources/vendor/bootstrap/js/bootstrap.js',
        'resources/vendor/metisMenu/jquery.metisMenu.js',
        'resources/vendor/slimscroll/jquery.slimscroll.min.js',
        'resources/vendor/pace/pace.min.js',
        'resources/vendor/sweetalert/sweetalert.min.js',
        'resources/vendor/dropzone/dropzone.js',
        'resources/vendor/dataTables/datatables.min.js',
        'resources/js/app.js'
      ], 'public/js/app.js', './');
