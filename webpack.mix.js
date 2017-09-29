const mix = require('laravel-mix');
const webpack = require('webpack');

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

mix
    .setPublicPath('public')
    .js('resources/assets/js/backend.js', 'public/js')
    .sass('resources/assets/sass/backend.sass', 'public/css')
    .styles(['resources/assets/css/dashicons.css', 'resources/assets/css/editor.css'], 'public/css/editor.css')
    .copy('resources/assets/images', 'public/images')
    .sourceMaps()
    .copy('public', '../../public/vendor/storycms')
    // .copy('public/manifest.json', '../../public/manifest.json')
    // .copy('public/css', '../../public/vendor/storycms-cms/css')
    .copy('public/fonts', '../../public/fonts')
    // .copy('public/js', '../../public/vendor/storycms-cms/js')
    // .copy('public/images', '../../public/vendor/storycms-cms/images')
    .version();


mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/),
        new webpack.NormalModuleReplacementPlugin(/element-ui[\/\\]lib[\/\\]locale[\/\\]lang[\/\\]zh-CN/, 'element-ui/lib/locale/lang/en')
    ],
    resolve: {
        alias: {
          'icons': path.resolve(__dirname, "./node_modules/vue-material-design-icons")
          // 'vue$': 'vue/dist/vue.runtime.esm.js'
        },
        extensions: [
          ".vue"
        ]
    }
});
