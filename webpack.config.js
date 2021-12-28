const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    entry: path.resolve(__dirname, './scripts/main.js'),
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, './dist'),
    },
    plugins: [new MiniCssExtractPlugin()],
    module: {
        rules: [
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: ['style-loader', {
                    loader: MiniCssExtractPlugin.loader, options: {
                        esModule: false,
                    },
                }, 'css-loader', 'sass-loader']
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', { targets: "defaults" }],
                            '@babel/preset-react'
                        ],
                        plugins: [
                            ["@babel/transform-runtime"]
                        ]
                    }
                }
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/,
                type: 'asset/resource',
            },
        ]
    }
}