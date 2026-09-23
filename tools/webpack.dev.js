var path = require('path');
var webpack = require('webpack');
var yaml = require('js-yaml');
var fs = require('fs');
var config = yaml.load(fs.readFileSync(path.resolve(__dirname, 'config.yaml'), 'utf8'));

module.exports = {
  mode: 'development',
  devtool: false,
  context: path.resolve(__dirname, '..'),
  entry: {
    vendor: config.src.entryJs.vendor,
    all: {
      import: config.src.entryJs.all,
      dependOn: 'vendor'
    }
  },
  resolve: {
    modules: config.webpack.resolve.modules.map(function resolveModule(modulePath) {
      return path.resolve(modulePath);
    }),
    alias: {
      underscore: 'lodash/core'
    }
  },
  output: {
    filename: '[name].js',
    path: path.resolve(config.dist.dev.js),
    publicPath: ''
  },
  module: {
    rules: [
      {
        test: require.resolve('jquery'),
        loader: 'expose-loader',
        options: {
          exposes: ['$', 'jQuery']
        }
      }
    ]
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      backbone: 'backbone'
    })
  ],
  optimization: {
    splitChunks: false
  }
};
