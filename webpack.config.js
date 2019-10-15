const path = require('path');
const fs = require('fs');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const webpack = require('webpack');
const SpriteLoaderPlugin = require('svg-sprite-loader/plugin');
const ImageminWebpWebpackPlugin = require('imagemin-webp-webpack-plugin');
const HappyPack = require('happypack');
const happyThreadPool = HappyPack.ThreadPool({ size: 4 });

const pages = JSON.parse(fs.readFileSync('pages.json')
  .toString())
  .map(pageData => new HtmlWebpackPlugin({
    title: pageData.title,
    filename: path.join('html', `${pageData.name}.html`),
    template: path.join('src', 'pages', pageData.name, `${pageData.name}.pug`),
    chunks: ['common'],
  }));

const dataFolder = path.join('src', 'data');
const data = {};
fs.readdirSync(dataFolder)
  .forEach((file) => {
    const dataSetName = file.replace(/\.[^.]*$/, '');
    try {
      data[dataSetName] = JSON.parse(fs.readFileSync(path.join(dataFolder, file)));
    } catch ( e ) {}
  });

data.projectSliderCount = 4;
data.advantageSliderCount = 3;

module.exports = function (env, argv) {
  return {
    entry: {
      common: './src/common/js/common.js',
    },
    output: {
      publicPath: '/',
      path: path.resolve(__dirname),
      filename: argv.mode === 'development' ? 'js/[name].js' : 'js/[name].[hash:8].js',
    },
    module: {
      rules: [
        {
          test: /\.js$/,
          use: [
            'babel-loader',
          ],
        },
        {
          test: /\.scss$/,
          use: ['happypack/loader?id=file'],
        },
        {
          test: /\.pug$/,
          use: [
            {
              loader: 'html-loader',
              options: {
                attrs: ['link:href', ':data-src', ':data-srcset', 'video:src'],
                interpolate: true,
              },
            },
            {
              loader: 'pug-html-loader',
              options: {
                data: { data: data },
              },
            },
          ],
        },
        {
          exclude: /\.(js|s?css|pug|svg)$/,
          use: {
            loader: 'file-loader',
            options: {
              name: 'media/[name].[hash:8].[ext]',
            },
          },
        },
        {
          test: /\.(jpg|png|gif|svg)$/,
          exclude: /services\/images\/mobile-bg\.jpg$/,
          loader: 'image-webpack-loader',
          enforce: 'pre',
        },
        {
          test: /\.svg$/,
          use: [{
            loader: 'svg-sprite-loader',
          }],
        },
      ],
    },
    target: 'web',
    plugins: [
      ...pages,
      new SpriteLoaderPlugin({ plainSprite: true }),
      // new ImageminWebpWebpackPlugin(),
      new HappyPack({
        id: 'file',
        threadPool: happyThreadPool,
        loaders: [
          {
            loader: 'file-loader',
            options: {
              name: argv.mode === 'development' ? 'css/[name].css' : 'css/[name].[hash:8].css',
            },
          },
          'extract-loader',
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              config: {
                ctx: {
                  mode: argv.mode,
                },
              },
            },
          },
          'sass-loader',
        ],
      }),
      new webpack.ProvidePlugin({
        jQuery: 'jquery',
        $: 'jquery',
        jquery: 'jquery',
        'window.jQuery': 'jquery',
        IScroll: 'fullpage.js/vendors/scrolloverflow.min',
        // fullpage: 'fullpage.js/dist/fullpage.js',
      }),
    ],
    devServer: {
      host: '0.0.0.0',
      setup(app) {
        app.post('*', (req, res) => {
          res.send('POST res sent from webpack dev server');
        });
      },
    },
    resolve: {
      alias: {
        TweenMax: path.resolve(
          'node_modules',
          'gsap/src/uncompressed/TweenMax.js',
        ),
        TweenLite: path.resolve(
          'node_modules',
          'gsap/src/uncompressed/TweenLite.js',
        ),
        TimelineMax: path.resolve(
          'node_modules',
          'gsap/src/uncompressed/TimelineMax.js',
        ),
        ScrollToPlugin: path.resolve(
          'node_modules',
          'gsap/src/uncompressed/plugins/ScrollToPlugin.js',
        ),
        ScrollMagic: path.resolve(
          'node_modules',
          'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js',
        ),
        'debug.addIndicators': path.resolve(
          'node_modules',
          'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js',
        ),
        'animation.gsap': path.resolve(
          'node_modules',
          'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js',
        ),
      },
    },
  };
};
