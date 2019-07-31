var Encore = require('@symfony/webpack-encore')

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
  .addEntry('list', './assets/js/list.js')
  .addEntry('router-app', './assets/js/router-app.js')
  .enableVueLoader()
  .configureDefinePlugin(options => {
    var dotenv = require('dotenv')
    const env = dotenv.config()

    if (env.error) {
      throw env.error
    }

    options['process.env'].API_TOKEN = JSON.stringify(env.parsed.API_TOKEN)
  })

module.exports = Encore.getWebpackConfig()
