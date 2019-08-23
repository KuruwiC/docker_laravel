const mix = require('laravel-mix')

mix.browserSync({
    proxy: {
        target: 'nginx'
    }
})
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .version()
