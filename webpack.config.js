const Encore = require('@symfony/webpack-encore');
const path = require('path');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())

    // Loaders
    .enableVueLoader()
    .enableSassLoader(function (options) {
        options.includePaths = [
            'node_modules',
            'assets/sass',
        ]
    }, {
        resolveUrlLoader: false,
    })

    // Entries
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', './assets/sass/app.scss')

    // Shared
    .createSharedEntry('js/vendor', [
        'animejs',
        'moment',
        'vue',
        'vuex',
        'vue-router',
    ])
;

let config = Encore.getWebpackConfig();

config.resolve.alias = {
    '@app': path.resolve(__dirname, 'assets/js'),
};

module.exports = config;
