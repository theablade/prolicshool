const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);
mix.copy("node_modules/admin-lte/dist/**/*", "public/admin-lte");
