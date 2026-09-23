var path = require('path');
var yaml = require('js-yaml');
var fs = require('fs');
var { merge } = require('webpack-merge');
var TerserPlugin = require('terser-webpack-plugin');
var devConfig = require('./webpack.dev.js');
var config = yaml.load(fs.readFileSync(path.resolve(__dirname, 'config.yaml'), 'utf8'));

module.exports = merge(devConfig, {
  mode: 'production',
  devtool: false,
  output: {
    filename: '[name].min.js',
    path: path.resolve(config.dist.prod.js)
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        extractComments: false
      })
    ]
  }
});
