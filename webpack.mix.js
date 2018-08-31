let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require("laravel-mix-purgecss");

const fs = require('fs');
const path = require('path');


const moduleFolder = './Modules';

const dirs = p => fs.readdirSync(p).filter(f => fs.statSync(path.resolve(p,f)).isDirectory())

let modules = dirs(moduleFolder);
/*
modules.forEach(function(m){
    let js = path.resolve(moduleFolder,m,'Asset','js', m.toLowerCase()+'.js');
    mix.js(js);
    let scss = path.resolve(moduleFolder,m,'Asset','scss', m.toLowerCase()+'.scss');
    mix.sass(scss);
    /!*path.join(__dirname, "./!**!/!*.html"),
        path.join(__dirname, "./!**!/!*.vue"),
        path.join(__dirname, "./!**!/!*.js"),
        path.join(__dirname, "./!**!/!*.css")*!/
});*/

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
   .sass('resources/assets/sass/app.scss', 'public/css').options({
       processCssUrls: false, postCss:[tailwindcss('./tailwind.js')],
    })
    .purgeCss();
