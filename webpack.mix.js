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

    // Base

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/register.js', 'public/js')
   .js('resources/assets/js/login.js', 'public/js')
   .copy('resources/assets/js/moduleloader.js', 'public/js')
   .copy('resources/assets/js/init.js', 'public/js')
   .copy('resources/assets/js/effects.js', 'public/js')
//   .extract(['jquery', 'lodash', 'axios', 'vue'])

   // Jquery UI
   .combine(['resources/assets/js/jquery-ui.min.js', 'resources/assets/js/jquery.dialog.minimize.js'], 'public/js/jquery-ui-bundle.js')
   .copy('resources/assets/css/ui/jqueryui-theme.css', 'public/css/ui/jqueryui-theme.css')
   .sass('resources/assets/css/ui/hto-theme.scss', 'public/css/ui/hto-theme.css')
   .copy('resources/assets/css/ui/images', 'public/css/ui/images')

   // Misc.
   .copy('resources/assets/css/animate.css', 'public/css/animate.css')
   .js('resources/assets/js/jquery.onenter.js', 'public/js/jquery.onenter.js')
   .js('resources/assets/js/notification-min.js', 'public/js/notification-min.js')
   .combine(['resources/assets/css/notifications.css', 'resources/assets/css/maintenance.css'], 'public/css/misc.css')
   .sass('resources/assets/sass/app.scss', 'public/css')

    // Modules
   .copy('resources/assets/css/webpage.css', 'public/css/webpage.css')
   .copy('app/Classes/Game/Modules/**/**/css/**.css', 'public/modules/css')
   .copy('app/Classes/Game/Modules/**/**/js/**.js', 'public/modules/js')

    // VFS Web assets
    .copy('storage/app/vfs/hosts/**/web/img/**.**', 'public/vfs/web/');
