import path from 'path'
import fs from 'fs'
import { glob } from 'glob'
import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import sharp from 'sharp'
import browserSync from 'browser-sync'

const sass = gulpSass(dartSass)
const bs = browserSync.create()

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*',
    php: [
        'views/**/*.php',
        'controllers/**/*.php',
        'models/**/*.php',
        'includes/**/*.php',
        'classes/**/*.php',
        'public/index.php',
        'Router.php'
    ]
}

export function css( done ) {
    src(paths.scss, {sourcemaps: true})
        .pipe( sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('./public/build/css', {sourcemaps: '.'}) );
    done()
}

export function js( done ) {
    src(paths.js)
      .pipe(terser())
      .pipe(dest('./public/build/js'))
    done()
}

export async function imagenes(done) {
    const srcDir = './src/img';
    const buildDir = './public/build/img';
    const images =  await glob('./src/img/**/*')

    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        procesarImagenes(file, outputSubDir);
    });
    done();
}

function procesarImagenes(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)

    if (extName.toLowerCase() === '.svg') {
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        fs.copyFileSync(file, outputFile);
    } else {
        const outputFile = path.join(outputSubDir, `${baseName}${extName}`);
        const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`);
        const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`);
        const options = { quality: 80 };

        sharp(file).jpeg(options).toFile(outputFile);
        sharp(file).webp(options).toFile(outputFileWebp);
        sharp(file).avif().toFile(outputFileAvif);
    }
}

function reload(done) {
    bs.reload()
    done()
}

export function serve(done) {
    bs.init({
        proxy: 'localhost:8000',
        port: 3000,
        open: true,
        notify: true,
        ghostMode: false
    })
    done()
}

export function dev() {
    watch( paths.scss, series(css, reload) );
    watch( paths.js, series(js, reload) );
    watch('src/img/**/*.{png,jpg,jpeg,svg}', series(imagenes, reload));
    watch( paths.php, reload );
}

export default series( js, css, imagenes, serve, dev )
