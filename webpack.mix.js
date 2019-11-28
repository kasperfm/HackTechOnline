const mix = require('laravel-mix');

let fs = require('fs');

let getFiles = function (dir) {
    // get all 'files' in this directory
    // filter directories
    return fs.readdirSync(dir).filter(file => {
        return fs.statSync(`${dir}/${file}`).isFile();
    });
};

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
    .js('resources/assets/js/echoevents.js', 'public/js')
    .copy('resources/assets/js/moduleloader.js', 'public/js')
    .copy('resources/assets/js/init.js', 'public/js')
    .copy('resources/assets/js/effects.js', 'public/js')
    .copy('resources/assets/js/bondage.min.js', 'public/js/bondage.js')
    //   .extract(['jquery', 'lodash', 'axios'])

    // Jquery UI
    .combine(['resources/assets/js/jquery-ui.min.js', 'resources/assets/js/jquery.dialog.minimize.js'], 'public/js/jquery-ui-bundle.js')
    .copy('resources/assets/css/ui/jquery-ui.min.css', 'public/css/ui/jquery-ui.css')
    .css('resources/assets/css/ui/jqueryui-theme.css', 'public/css/ui/jqueryui-theme.css')
    .sass('resources/assets/css/ui/hto-theme.scss', 'public/css/ui/hto-theme.css')
    .copy('resources/assets/css/ui/images', 'public/css/ui/images')

    // Misc.
    .css('resources/assets/css/animate.css', 'public/css/animate.css')
    .copy('resources/assets/css/bootstrap-grid.min.css', 'public/css/bootstrap-grid.css')
    .js('resources/assets/js/jquery.onenter.js', 'public/js/jquery.onenter.js')
    .js('resources/assets/js/notification-min.js', 'public/js/notification-min.js')
    .combine(['resources/assets/css/notifications.css', 'resources/assets/css/maintenance.css'], 'public/css/misc.css')
    .sass('resources/assets/sass/app.scss', 'public/css')

    // Modules
    .css('resources/assets/css/webpage.css', 'public/css/webpage.css')
    .copy('app/Classes/Game/Modules/**/**/css/**.css', 'public/modules/css')
    .copy('app/Classes/Game/Modules/**/**/js/**.js', 'public/modules/js')

    // VFS Web assets
    .copy('storage/app/vfs/hosts/**/web/img/**.**', 'public/vfs/web/img')
    .copy('storage/app/vfs/hosts/**/web/css/**.css', 'public/vfs/web/css')
    .copy('storage/app/vfs/hosts/**/web/js/**.js', 'public/vfs/web/js');

getFiles('public/modules/js').forEach(function (filepath) {
    mix.combine(['public/modules/js/' + filepath], 'public/modules/js/' + filepath);
});

getFiles('public/vfs/web/js').forEach(function (filepath) {
    mix.combine(['public/vfs/web/js/' + filepath], 'public/vfs/web/js/' + filepath);
});