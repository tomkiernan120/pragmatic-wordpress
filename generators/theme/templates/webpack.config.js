const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const globImporter = require('node-sass-glob-importer');

module.exports = (env) => {
	return {
		entry: {
			index: './src/js/index.js',
			main: './src/scss/main.scss',
			editor: './src/scss/editor.scss',
		},
		output: {
			filename: '[name].js',
			path: path.resolve(__dirname, 'dist'),
		},
		resolve: {
			alias: {
				jquery: 'jquery/src/jquery',
			},
		},
		devtool: 'source-map',
		mode: env.mode || 'development',
		module: {
			rules: [
				// perform js babelization on all .js files
				{
					test: /\.js$/,
					exclude: /node_modules/,
					use: {
						loader: 'babel-loader',
						options: {
							presets: ['@babel/preset-env'],
						},
					},
				},
				{
					test: /\.s[ac]ss$/i,
					use: [
						// Creates `style` nodes from JS strings
						MiniCssExtractPlugin.loader,
						// Translates CSS into CommonJS
						'css-loader',
						// Compiles Sass to CSS
						{
							loader: 'sass-loader',
							options: {
								sassOptions: {
									importer: globImporter(),
								},
							},
						},
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: '[name].css',
				chunkFilename: '[name].css',
			}),
			new BrowserSyncPlugin({
				// browse to http://localhost:3000/ during development,
				// ./public directory is being served
				host: 'localhost',
				port: 3000,
				proxy: 'http://scitt.local/',
			}),
		],
	};
};
