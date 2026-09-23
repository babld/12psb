/* eslint-disable no-console */

var { src, dest, watch, series, parallel } = require('gulp');
var fs = require('fs');
var path = require('path');
var { exec } = require('child_process');
var yaml = require('js-yaml');
var browserSync = require('browser-sync').create();
var gulpIf = require('gulp-if');
var sourcemaps = require('gulp-sourcemaps');
var gulpSass = require('gulp-sass')(require('sass'));
var postcss = require('gulp-postcss');
var assets = require('postcss-assets');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var rename = require('gulp-rename');
var svgSprite = require('gulp-svg-sprite');
var webpack = require('webpack');
var del = require('del');

var wpDevConfig = require('./tools/webpack.dev.js');
var wpProdConfig = require('./tools/webpack.prod.js');
var config = yaml.load(fs.readFileSync(path.resolve(__dirname, 'tools/config.yaml'), 'utf8'));
var argv = {
  production: process.argv.indexOf('--production') !== -1,
  bs: process.argv.indexOf('--bs') !== -1
};

function getDist(key) {
  return config.dist[argv.production ? 'prod' : 'dev'][key];
}

function sassOptions() {
  return Object.assign({}, config.sass, {
    loadPaths: config.sass.includePaths || config.sass.loadPaths || [],
    silenceDeprecations: ['import', 'legacy-js-api', 'global-builtin', 'color-functions']
  });
}

function css() {
  var postcssPlugins = [
    assets(config.assets),
    autoprefixer()
  ];

  if (argv.production) {
    postcssPlugins.push(cssnano(config.cssnano));
  }

  return src(config.src.entryScss)
    .pipe(gulpIf(!argv.production, sourcemaps.init()))
    .pipe(gulpSass(sassOptions()).on('error', gulpSass.logError))
    .pipe(postcss(postcssPlugins))
    .pipe(gulpIf(!argv.production, sourcemaps.write('./maps/')))
    .pipe(gulpIf(argv.production, rename({ suffix: '.min' })))
    .pipe(dest(getDist('css')))
    .pipe(gulpIf(argv.bs, browserSync.stream({ match: '**/*.css' })));
}

function compileJs(done) {
  var wpConfig = argv.production ? wpProdConfig : wpDevConfig;

  webpack(wpConfig, function webpackCallback(err, stats) {
    if (err) {
      done(err);
      return;
    }

    console.log(stats.toString({ colors: true }));

    if (stats.hasErrors()) {
      done(new Error('webpack finished with errors'));
      return;
    }

    done();
  });
}

function watchJs() {
  webpack(wpDevConfig).watch({}, function watchCallback(err, stats) {
    if (err) {
      console.error(err);
      return;
    }

    console.log(stats.toString({ colors: true }));

    if (argv.bs) {
      browserSync.reload();
    }
  });
}

function watchTask() {
  if (argv.bs) {
    browserSync.init(config.browserSync);
  }

  watch(config.src.watchScss, css);
  watchJs();
}

function serve(done) {
  exec(
    'php ./yii serve --docroot=frontend/web ' + config.browserSync.proxy,
    function execCallback(err, stdout, stderr) {
      console.log(stdout);
      console.log(stderr);
    }
  );
  done();
}

function svg() {
  return src(config.src.svgSprite)
    .pipe(svgSprite(config.svgSprite))
    .pipe(dest(getDist('svg')));
}

function copyAssets() {
  return src(config.src.fonts, { encoding: false, allowEmpty: true })
    .pipe(dest(getDist('fonts')));
}

function clean() {
  return del([
    getDist('css'),
    getDist('js'),
    getDist('fonts'),
    getDist('svg')
  ]);
}

function enableProduction(done) {
  argv.production = true;
  done();
}

var build = series(enableProduction, clean, parallel(copyAssets, css, compileJs));

exports.css = css;
exports.js = compileJs;
exports.watch = series(css, watchTask);
exports.start = parallel(serve, exports.watch);
exports.svg = svg;
exports.assets = copyAssets;
exports.serve = serve;
exports.clean = clean;
exports.build = build;
exports.default = build;
exports.test = function test(done) {
  console.log('test task ok');
  done();
};
