var webpack = require('webpack');
var merge = require('webpack-merge');
var devConfig = require('./webpack.dev.js');
var path = require('path');
var yaml = require('js-yaml');
var fs = require('fs');
var config = yaml.safeLoad(fs.readFileSync('tools/config.yaml', 'utf8'));

module.exports = merge(devConfig, {
  output: {
    filename: '[name].min.js',
    path: path.resolve(config.dist.prod.js)
  },
  plugins: [
    new webpack.LoaderOptionsPlugin({
      minimize: true,
      debug: false
    })//,
    /*new webpack.optimize.UglifyJsPlugin({
      beautify: false,
      mangle: {
        screw_ie8: true,
        keep_fnames: true
      },
      compress: {
        screw_ie8: true
      },
      comments: false
    })*/
  ]
});
