var path = require('path');
var webpack = require('webpack');
var yaml = require('js-yaml');
var fs = require('fs');
var config = yaml.safeLoad(fs.readFileSync('tools/config.yaml', 'utf8'));

module.exports = {
  entry: config.src.entryJs,
  resolve: {
    modules: config.webpack.resolve.modules,
    alias: {
      underscore: 'lodash/core' // FIXME: дублирует cherry pick
    }
  },
  output: {
    filename: '[name].js',
    path: path.resolve(config.dist.dev.js)
  },
  module: {
    rules: [
      {
        test: require.resolve('jquery'),
        use: [
          {
            loader: 'expose-loader',
            options: 'jQuery'
          },
          {
            loader: 'expose-loader',
            options: '$'
          }
        ]
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      backbone: 'backbone'
    }),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor',
      minChunks: Infinity
    })
  ]
};
