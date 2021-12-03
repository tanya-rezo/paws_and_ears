const path = require("path");
const fs = require("fs");
const {
  CleanWebpackPlugin
} = require("clean-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin");

const config = {
  entry: ["./src/js/index.js", "./src/scss/style.scss"],
  output: {
    filename: "../dist/js/bundle.js",
  },
  devtool: "source-map",
  mode: "production",
  optimization: {
    minimizer: [
      new TerserPlugin({
        sourceMap: true,
        extractComments: true,
      }),
    ],
  },
  module: {
    rules: [{
      test: /\.(sass|scss)$/,
      include: path.resolve(__dirname, "./src/scss"),
      use: [{
        loader: MiniCssExtractPlugin.loader,
        options: {},
      },
      {
        loader: "css-loader",
        options: {
          sourceMap: true,
          url: false,
        },
      },
      {
        loader: "postcss-loader",
        options: {
          sourceMap: true,
          postcssOptions: {
            plugins: () => [
              require("cssnano")({
                preset: [
                  "default",
                  {
                    discardComments: {
                      removeAll: true,
                    },
                  },
                ],
              }),
            ],
          },
        },
      },
      {
        loader: "sass-loader",
        options: {
          sourceMap: true,
        },
      },
      ],
    },

    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "../dist/css/style.css",
    }),
    new CopyPlugin({
      patterns: [{
        from: "./src/**/*.php",
        to: (path) => {
          return path.absoluteFilename.replace('src', 'dist');
        },
      }, {
        from: "./products/**/*",
        to: ".",
      }, {
        from: "./favicon/**/*",
        to: ".",
      }, {
        from: "./fonts/**/*",
        to: ".",
      }, {
        from: "./php_config/",
        to: ".",
      }, {
        from: "./src/img/**/*",
        to: (path) => {
          return path.absoluteFilename.replace('src', 'dist');
        },
      },],
    }),
  ],
};

module.exports = (env, argv) => {
  if (argv.mode === "production") {
    config.plugins.push(new CleanWebpackPlugin());
  }
  return config;
};