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

mix.js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/admin_app.js', 'public/admin/js')
  .combine([
      //'resources/assets/admin/js/jquery-2.1.1.js',
      //'resources/assets/admin/js/bootstrap.js',
      'resources/assets/admin/js/plugins/metisMenu/jquery.metisMenu.js',
      'resources/assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js',
      //'resources/assets/admin/js/plugins/gritter/jquery.gritter.min.js',
      //'resources/assets/admin/js/plugins/jquery-ui/jquery-ui.min.js',
      'resources/assets/admin/js/plugins/pace/pace.min.js',
      'resources/assets/admin/js/plugins/toastr/toastr.min.js',
  ], 'public/admin/js/admin_plugin.js', './')
  .copy('resources/assets/admin/js/admin.js', 'public/admin/js/admin.js')
  .js('resources/assets/js/front_app.js', 'public/front/js')
  .combine(['resources/assets/front/js/crum-mega-menu.js',
   'resources/assets/front/js/swiper.jquery.min.js',
   'resources/assets/front/js/theme-plugins.js',
   'resources/assets/front/js/main.js',
   'resources/assets/front/js/form-actions.js',
   'resources/assets/front/js/velocity.min.js',
   'resources/assets/front/js/ScrollMagic.min.js',
   'resources/assets/front/js/animation.velocity.min.js'
 ], 'public/front/js/front.js', './')
   /*.copy('resources/assets/front/js/crum-mega-menu.js', 'public/front/js/crum-mega-menu.js')
   .copy('resources/assets/front/js/swiper.jquery.min.js', 'public/front/js/swiper.jquery.min.js')
   .copy('resources/assets/front/js/theme-plugins.js', 'public/front/js/theme-plugins.js')
   .copy('resources/assets/front/js/main.js', 'public/front/js/main.js')
   .copy('resources/assets/front/js/form-actions.js', 'public/front/js/form-actions.js')
   .copy('resources/assets/front/js/velocity.min.js', 'public/front/js/velocity.min.js')
   .copy('resources/assets/front/js/ScrollMagic.min.js', 'public/front/js/ScrollMagic.min.js')
   .copy('resources/assets/front/js/animation.velocity.min.js', 'public/front/js/animation.velocity.min.js')*/
   .sass('resources/assets/sass/app.scss', 'public/css')
   .sass('resources/assets/admin/sass/admin.scss', 'public/admin/css')
   .combine([
      'resources/assets/admin/vendor/animate/animate.css',
      'resources/assets/admin/vendor/toastr/toastr.min.css'
   ], 'public/admin/css/admin_plugin.css')
   .combine([
      'resources/assets/front/css/fonts.css',
      'resources/assets/front/css/crumina-fonts.css',
      'resources/assets/front/css/normalize.css',
      'resources/assets/front/css/grid.css',
      'resources/assets/front/css/base.css',
      'resources/assets/front/css/blocks.css',
      'resources/assets/front/css/layouts.css',
      'resources/assets/front/css/modules.css',
      'resources/assets/front/css/widgets-styles.css',
      'resources/assets/front/css/jquery.mCustomScrollbar.min.css',
      'resources/assets/front/css/swiper.min.css',
      'resources/assets/front/css/primary-menu.css',
      'resources/assets/front/css/magnific-popup.css'
   ], 'public/front/css/front.css');
