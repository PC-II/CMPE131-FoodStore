const path = require('path');
module.exports = {
  mode: 'development',
  entry: {
    ai: path.resolve(__dirname, 'SRC/ai.js'),
    index: path.resolve(__dirname, 'SRC/index.js')
  },
  output: {
    path: path.resolve(__dirname, 'JS'),
    filename: '[name].js',
  },
  watch: true,
}