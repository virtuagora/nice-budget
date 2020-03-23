let mix = require('laravel-mix');

mix.sass('app/stylesheet/nice-budget.scss', 'public/assets/css')
    .js('app/components/nice-budget.js', 'public/assets/js')
    .js('app/components/nice-budget-admin.js', 'public/assets/js')
    .js('app/components/nice-budget-installer.js', 'public/assets/js')
    .extract(['vue'])
    .setPublicPath('public/')
    .webpackConfig({ devtool: "inline-source-map" });