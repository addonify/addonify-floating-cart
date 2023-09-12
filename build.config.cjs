const archiver = require('archiver');
const fs = require('fs');

/**
 * Tweak variables as required.
 *
 * @since 1.2.1
 */
const outputZipName = 'addonify-floating-cart.zip';

const excludeFiles = [
    '.DS_Store',
    '.gitignore',
    '.gitattributes',
    '.editorconfig',
    '.eslintignore',
    '.eslintrc.js',
    '.prettierignore',
    '.prettierrc.js',
    '.distignore',
    'composer.json',
    'composer.lock',
    'composer.phar',
    'phpcs.xml.dist',
    'phpunit.xml.dist',
    'notice.json',
    'webpack.config.js',
    'webpack.mix.cjs',
    'webpack.mix.js',
    'rollup.config.js',
    'package.json',
    'package-lock.json',
    'build.config.cjs',
    'tsconfig.json',
    'ts-node.config.json',
    'addonify-floating-cart.zip',

    'node_modules/**',
    '.git/**/*',
    '.github/**',
    '.wordpress-org/**',
    'admin/src/**', // Exclude admin assets source files.
    'admin/assets/scss/**', // Exclude admin SCSS source files.
    'public/assets/src/**', // Exclude public assets source files.
];

/**
 * Archiver logic. 
 * Do not change unless required.
 *
 * @return {Promise} promise.
 * @since 1.2.1
 */
const makeZipFile = async () => {
    new Promise((resolve, reject) => {

        const archive = archiver("zip", {
            zlib: { level: 9 },
        });

        const output = fs.createWriteStream(outputZipName);

        output.on("open", function () {

            console.log("\n⌛ Please wait, creating ZIP...[" + new Date().toLocaleString() + "]\n");
        });

        output.on("close", function () {

            console.log("\n✨ ZIP created. Size: " + convertBytes(archive.pointer()) + ". [" + new Date().toLocaleString() + "]\n");

            resolve();
        });

        archive.on("error", function (err) {
            console.error(err);
            reject(err);
        });

        archive.glob("**/*", {
            cwd: "./",
            ignore: excludeFiles,
        });

        archive.pipe(output);
        archive.finalize();
    });
}

// 🦄 Let's invoke the function & wait....
makeZipFile().catch((err) => { throw err });

/**
 * Changes bytes to KB or MB depending on the size.
 *
 * @param {number} bytes.
 * @return {string} size.
 * @since 1.2.1
 */
const convertBytes = (bytes) => {
    switch (true) {
        case (bytes < 1000000):
            return (bytes / 1000).toFixed(2) + ' KB';
        case (bytes < 1000000000):
            return (bytes / 1000000).toFixed(2) + ' MB';
        default:
            return bytes + ' Bytes';
    }
}