var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSingleRuntimeChunk()
  .enableSassLoader()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .addEntry('welcome', './assets/js/welcome.js')
  .addEntry('stock', './assets/js/stock.js')
  .addEntry('comments', './assets/js/comments.js')
  .enableVueLoader()
;

module.exports = Encore.getWebpackConfig();
