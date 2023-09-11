import path from 'path';
import { fileURLToPath } from 'url';
import resolve from '@rollup/plugin-node-resolve';
import alias from '@rollup/plugin-alias';
import terser from '@rollup/plugin-terser';
import commonjs from '@rollup/plugin-commonjs';
import scss from 'rollup-plugin-scss'
import postcss from 'postcss'
import autoprefixer from 'autoprefixer'
//import postcssRTLCSS from 'postcss-rtlcss';
//import { Mode, Source, Autorename } from 'postcss-rtlcss/options';

/**
 * Define extensions to be resolved via alias.
 *
 * @since 1.0.0 
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
 * @since 1.0.0 
 */
const assets = {
    "mainJs": {
        "source": "./public/assets/src/app.public.js",
        "dist": "./public/assets/build/public.min.js",
    },
    "conditionalJs": {
        "source": "",
        "dist": "",
    },
    "scss": {
        "dist": "./public/assets/build/public.min.css",
        "distName": "public.min.css",
        "exclude": [],
    },
    "rtlcss": {
        "source": "./public/assets/build/public.min.css",
        "dist": "./public/assets/build/public.rtl.min.css",
    }
}

export default [
    {
        input: assets['mainJs']['source'],
        output: {
            file: assets['mainJs']['dist'],
            format: 'umd', // "iife", "umd", "esm", "cjs"
            name: 'mainJs',
        },
        plugins: [
            resolve(),
            commonjs(),
            terser(),
            scss({
                outputStyle: 'compressed',
                output: assets['scss']['dist'],
                fileName: assets['scss']['distName'],
                exclude: assets['scss']['exclude'],
                sourceMap: true,
                processor: () => postcss(
                    [
                        autoprefixer(),
                    ]
                ),
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
    //{
    //    input: assets['conditionalJs']['source'],
    //    output: {
    //        file: assets['conditionalJs']['dist'],
    //        ...jsCommonOptions
    //    },
    //    plugins: [
    //        resolve(),
    //        commonjs(),
    //        terser(),
    //    ]
    //}
];