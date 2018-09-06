let mix = require('laravel-mix');
require("laravel-mix-purgecss");


const fs = require('fs');
const path = require('path');


const moduleFolder = './Modules';

const dirs = p => fs.readdirSync(p).filter(f => fs.statSync(path.resolve(p,f)).isDirectory());

let modules = dirs(moduleFolder);

modules.forEach(function(m){
    let js = path.resolve(moduleFolder,m, 'Resources','assets','js', 'app.js');
    mix.js(js, 'public/js/' +  m.toLowerCase()+'.js');

    let scss = path.resolve(moduleFolder,m, 'Resources','assets','sass', 'app.scss');
    mix.sass(scss, 'public/css/' + m.toLowerCase()+'.scss');

});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .purgeCss();
