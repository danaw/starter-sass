var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var postcss      = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var plumber = require('gulp-plumber');

gulp.task('sass', function() {
  return gulp.src('scss/style.scss')
    .pipe(sass({ style: 'compressed' }))
    .pipe(plumber())
    .pipe(postcss([autoprefixer]))
    .pipe(gulp.dest('./'))
});
gulp.task('watch', function() {
	gulp.watch('**/*.scss', ['sass'])
});
gulp.task('default', ['sass', 'watch']);