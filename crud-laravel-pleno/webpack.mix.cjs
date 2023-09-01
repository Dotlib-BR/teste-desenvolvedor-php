// webpack.mix.js

let mix = require('laravel-mix');

mix.setResourceRoot('/');

mix.webpackConfig({
    resolve: {
        extensions: ['*', '.wasm', '.mjs', '.js', '.jsx', '.json'],
    },
});
