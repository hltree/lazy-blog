const babel = require("gulp-babel"),
    gulp = require("gulp"),
    glob = require("gulp-sass-glob"),
    nano = require("gulp-cssnano"),
    rename = require("gulp-rename"),
    sass = require("gulp-sass"),
    sourcemap = require("gulp-sourcemaps"),
    uglify = require("gulp-uglify"),
    through2 = require('through2');


gulp.task("build-css", () => {
    return gulp
        .src("./dev/scss/style.scss")
        .pipe(sourcemap.init())
        .pipe(glob())
        .pipe(sass())
        .pipe(nano())
        .pipe(sourcemap.write())
        .pipe(through2.obj((chunk, enc, callback)=>{
            const date = new Date();
            chunk.stat.atime = date;
            chunk.stat.mtime = date;
            callback(null, chunk);
        }))
        .pipe(gulp.dest("./build/css"));
});

gulp.task("build-js", () => {
    return gulp
        .src("./dev/js/main.js")
        .pipe(
            babel({
                presets: ["@babel/preset-env"]
            })
        )
        .pipe(uglify())
        .pipe(
            rename({
                extname: ".min.js"
            })
        )
        .pipe(through2.obj((chunk, enc, callback)=>{
            const date = new Date();
            chunk.stat.atime = date;
            chunk.stat.mtime = date;
            callback(null, chunk);
        }))
        .pipe(gulp.dest("./build/js"));
});

gulp.task("default", gulp.series("build-css", "build-js"));

gulp.task("watch", () => {
    gulp.watch("./dev/scss/*.scss", gulp.series("build-css", "build-js"));
});
