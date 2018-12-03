/* eslint-disable no-console */

var gulp = require('gulp');
var yargs = require('yargs');
var fs = require('fs');
var exec = require('child_process').exec;
var yaml = require('js-yaml');
var browserSync = require('browser-sync').create();
var gulpIf = require('gulp-if');
var sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var assets = require('postcss-assets');
var autoprefixer = require('autoprefixer');
var cssnano = require('cssnano');
var rename = require('gulp-rename');
var runSequence = require('run-sequence').use(gulp);
var svgSprite = require('gulp-svg-sprite');
var webpack = require('webpack-stream');
var del = require('del');

var wpDevConfig = require('./tools/webpack.dev.js');
var wpProdConfig = require('./tools/webpack.prod.js');
var config = yaml.safeLoad(fs.readFileSync('./tools/config.yaml', 'utf8'));
var argv = yargs.argv;

function getDist(key) {
  return config.dist[argv.production ? 'prod' : 'dev'][key];
}

gulp.task('css', function cssTask() {
  var postcssPlugins = [
    assets(config.assets),
    autoprefixer()
  ];

  if (argv.production) {
    postcssPlugins.push(cssnano(config.cssnano));
  }

  return gulp.src(config.src.entryScss)
    .pipe(gulpIf(!argv.production, sourcemaps.init()))
    .pipe(sass(config.sass).on('error', sass.logError))
    .pipe(postcss(postcssPlugins))
    .pipe(gulpIf(!argv.production, sourcemaps.write('./maps/')))
    .pipe(gulpIf(argv.production, rename({ suffix: '.min' })))
    .pipe(gulp.dest(getDist('css')))
    .pipe(gulpIf(argv.bs, browserSync.stream({ match: '**/*.css' })));
});

gulp.task('js', function jsTask() {
  var wpConfig = argv.production ? wpProdConfig : wpDevConfig;

  return gulp.src(config.src.entryJs.all)
    .pipe(webpack(wpConfig))
    .pipe(gulp.dest(getDist('js')));
});

gulp.task('watch', ['css'], function watchTask() {
  if (argv.bs) {
    browserSync.init(config.browserSync);
  }

  gulp.watch(config.src.watchScss, ['css']);

  gulp.src(config.src.entryJs.all)
    .pipe(webpack(Object.assign({
      watch: true
    }, wpDevConfig)))
    .pipe(gulp.dest(getDist('js')));
});

gulp.task('start', ['serve', 'watch']);

gulp.task('svg', function svgTask() {
  return gulp.src(config.src.svgSprite)
    .pipe(svgSprite(config.svgSprite))
    .pipe(gulp.dest(getDist('svg')));
});

gulp.task('assets', function assetsTask() {
  var fonts = gulp.src(config.src.fonts)
    .pipe(gulp.dest(getDist('fonts')));

  return fonts;
});

gulp.task('serve', function serveTask() {
  exec(
    'php ./yii serve --docroot=frontend/web ' + config.browserSync.proxy,
    function execCallback(err, stdout, stderr) {
      console.log(stdout);
      console.log(stderr);
    }
  );
});

gulp.task('clean', function cleanTask() {
  return del([
    getDist('css'),
    getDist('js'),
    getDist('fonts'),
    getDist('svg')
  ]);
});

gulp.task('build', function buildTask(cb) {
  argv.production = true;

  // https://github.com/gulpjs/gulp/blob/master/docs/recipes/running-tasks-in-series.md
  // Gulp умеет выполнять задачи по очереди через зависимости,
  // но данная реализация неуклюжа, поэтому используется сторонний модуль.
  // При обновлении до Gulp 4 необходимо заменить на нативные средства.
  runSequence('clean', /*'svg',*/ [
    'assets',
    'css',
    'js'
  ], cb);
});

gulp.task('default', ['build']);

gulp.task('test', function(){
  console.log('test task ok');
});
