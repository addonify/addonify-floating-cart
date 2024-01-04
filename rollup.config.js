import path from 'path';
import { fileURLToPath } from 'url';
import resolve from '@rollup/plugin-node-resolve';
import alias from '@rollup/plugin-alias';
import terser from '@rollup/plugin-terser';
import commonjs from '@rollup/plugin-commonjs';
import scss from 'rollup-plugin-scss';
import postcss from 'postcss'
import cssnano from 'cssnano'
import autoprefixer from 'autoprefixer'
import postcssRTLCSS from 'postcss-rtlcss';
import { Mode, Source } from 'postcss-rtlcss/options';

/**
 * Define extensions to be resolved via alias.
 *
 * @since 1.2.2
 */
const customResolver = resolve({
    extensions: ['.mjs', '.js', '.jsx', '.json', '.sass', '.scss']
});

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname);

/**
 * Prepare global options.
 * Holds path & name of source and destination assets.
 *
 * @since 1.2.2 
 */
const assets = {
    "mainJs": {
        "source": "./public/assets/src/app.public.js",
        "dist": "./public/assets/build/public.min.js",
    },
    "scss": {
        "src": "./public/assets/src/scss",
        "dist": "./public/assets/build/public.min.css",
        "distName": "public.min.css",
    },
}

export default [
    {
        input: assets['mainJs']['source'],
        output: {
            file: assets['mainJs']['dist'],
            name: 'mainJs',
            format: 'umd', // "iife", "umd", "esm", "cjs"
        },
        plugins: [
            resolve(),
            commonjs(),
            terser(),
            scss({
                output: assets['scss']['dist'],
                fileName: assets['scss']['distName'],
                sourceMap: true,
                watch: assets['scss']['src'],
                processor: async () => postcss([
                    autoprefixer(),
                    postcssRTLCSS({
                        mode: Mode.override,
                        source: Source.ltr,
                    }),
                    cssnano()
                ])
            }),
            alias({
                entries: [{
                    find: 'src',
                    replacement: path.resolve(rootDir, './public/assets/src/')
                }],
                customResolver
            })
        ]
    }
];