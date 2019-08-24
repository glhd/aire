const argv = require('yargs').argv;
const bin = require('./bin');
const command = require('node-cmd');

const BrowserSync = require('browser-sync');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const ExtraWatchWebpackPlugin = require('extra-watch-webpack-plugin');

const env = argv.e || argv.env || 'local';
const port = argv.p || argv.port || 3001;

let browserSyncInstance;

module.exports = {
    jigsaw: {
        apply(compiler) {
            compiler.hooks.done.tap('DonePlugin', (compilation) => {
                command.get(bin.path() + ' build -q ' + env, (error, stdout, stderr) => {
                    console.log(error ? stderr : stdout);

                    if (browserSyncInstance) {
                        browserSyncInstance.reload();
                    }
                });
            });
        }
    },

    watch: function (paths) {
        return new ExtraWatchWebpackPlugin({
            files: paths,
        });
    },

    browserSync: function (proxy) {
        return new BrowserSyncPlugin({
            notify: false,
            port: port,
            proxy: proxy,
            server: proxy ? null : { baseDir: 'build_' + env + '/' },
            https: false,
        },
        {
            reload: false,
            callback: function() {
                browserSyncInstance = BrowserSync.get('bs-webpack-plugin');
            },
        })
    },
};
