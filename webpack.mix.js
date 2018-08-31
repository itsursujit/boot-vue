let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
require("laravel-mix-purgecss");
let path =require("path");
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

module.exports = {
    configureWebpack: {
        plugins: [
            new PurgeCssPlugin({
                paths: glob.sync([
                    path.join(__dirname, "./**/*.html"),
                    path.join(__dirname, "./**/*.vue"),
                    path.join(__dirname, "./**/*.js"),
                    path.join(__dirname, "./**/*.css")
                ]),
                extractors: [
                    {
                        extractor: TailwindExtractor,
                        extensions: ["css", "js", "html", "vue"]
                    }
                ]
            })
        ]
    }
}