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

mix.webpackConfig({
    devtool: 'eval',
    mode: 'development',
    devServer: {
        watchOptions: {
            exclude: [/bower_components/, /node_modules/, /docker/]
        }
    }
});

mix.vue({version: 2}).js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .webpackConfig({devtool: 'source-map'});
// .browserSync({
//     proxy: 'localhost:80'
// })

if (mix.inProduction()) {
    mix.version();
}
