// purely for WebStorm
const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '@': path.join(__dirname, 'resources/js'),
      '~': path.resolve(__dirname),
    }
  }
};
