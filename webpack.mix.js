const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy(
        "node_modules/bootstrap/dist/css/bootstrap.min.css",
        "public/css/bootstrap.min.css"
    )
    .copy(
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "public/js/bootstrap.min.js"
    )
    .copy("node_modules/jquery/dist/jquery.min.js", "public/js/jquery.min.js")
    .copy(
        "node_modules/qr-scanner/qr-scanner.min.js",
        "public/js/qr-scanner.min.js"
    )

    .sourceMaps();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
