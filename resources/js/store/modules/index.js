import camelCase from 'lodash/camelCase';

// Getting all the js files
const requireModule = require.context(".", false, /\.js$/); 

const modules = {};

requireModule.keys().forEach(fileName => {
    // reject the index.js file
    if (fileName === './index.js') return;
    const moduleName = camelCase(fileName.replace(/(\.\/|\.js)/g, ''));
    modules[moduleName] = requireModule(fileName).default;
});

export default modules;