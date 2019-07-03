const mix = require('laravel-mix');
const path = require('path');

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

/*
 * npm i jquery --save or yarn add jquery
 * comment out below code to enable jQuery auto loading.
 * this allows you to use $() in all files.
 */
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});

mix.webpackConfig({
    resolve: {
        alias: {
            'src': path.resolve(__dirname, 'resources/src/'),
            'common': path.resolve(__dirname, 'resources/src/common/'),
            'assets': path.resolve(__dirname, 'resources/assets/'),
            'img': path.resolve(__dirname, 'resources/assets/img/'),
            'vue-all': path.resolve(__dirname, 'node_modules/vue/dist/vue.min.js')
        }
    },
    output: {
        publicPath: '/',
        chunkFilename: mix.inProduction() ? 'js/[name].[chunkhash].js' : 'js/[name].js'
    }
});

mix.options({
    postCss: [
        require('autoprefixer')()
    ],
    clearConsole: true
});

mix.sass('./resources/src/common/sass/main.scss', 'public/css/app.css');
mix.js('./resources/src/common/js/main.js', 'public/js/main.js');

mix.sass('./resources/src/users/index.scss', 'public/css/users.css');

mix.js('./resources/src/users/js/slider-edit.js', 'public/js/slider-edit.js')
    .js('./resources/src/users/js/group-edit.js', 'public/js/group-edit.js')
    .js('./resources/src/users/index.js', 'public/js/users.js')
    .extract(['vue', 'jquery', 'axios', 'vuex', 'bootstrap', 'perfect-scrollbar']);

mix.setResourceRoot('/');
mix.disableSuccessNotifications();

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
    // mix.browserSync('app.conversionperfectdev.test');
}
mix.browserSync('app.conversionperfectdev.test');
