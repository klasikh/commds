const path = require('path');

// var webpack = require('webpack');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
   // plugins: {
    //    new webpack.DefinePlugin({
    //        __VUE_OPTIONS_API__: true,
    //        __VUE_PROD_DEVTOOLS__: false,
    //    })
    //},
    // externals: {
    //     // only define the dependencies you are NOT using as externals!
    //     canvg: "canvg",
    //     html2canvas: "html2canvas",
    //     dompurify: "dompurify"
    // },
};
