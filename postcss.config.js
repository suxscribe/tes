const next = require('postcss-cssnext');

module.exports = ({ options }) => {
  const plugins = [
    next({
      features: {
        autoprefixer: { grid: true }
      }
    }),
  ];

  if (options.mode === 'production') {
    plugins.push(
      require('cssnano')({
        preset: [
          'advanced',
          { discardComments: { 'removeAll': true },
            autoprefixer: { grid: false },
            zindex: false},
          ],
      }),
    );
  }

  return {
    plugins,
  };
};
