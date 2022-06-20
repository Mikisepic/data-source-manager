const mix = require('laravel-mix');

mix.disableNotifications();
mix.browserSync('127.0.0.1:8000');

mix
  .js('resources/js/app.js', 'public/js')
  .vue()
  .sass('resources/sass/index.scss', 'public/css');
