const js = require("javascript-obfuscator");
const fs = require("fs");
const CleanCSS = require('clean-css');
const minify = require('html-minifier').minify;

findHtmlCssFiles("../");
const allowedFolders = ["js", "css"];

function findHtmlCssFiles(location) {
    fs.readdir(location, function (err, files) {
        if (err) return console.error(err);
        for (let i = 0; i < files.length; i++) {
            if (allowedFolders.includes(files[i])) {
                const file = location + "/" + files[i];
                fs.stat(file, async (err, stats) => {
                    if (err) {
                        console.error(err);
                        return;
                    }
                    if (stats.isFile()) {
                        const fileContent = fs.readFileSync(file, "utf8");
                        if (files[i].endsWith(".html")) {
                            let result = minify(fileContent, {
                                removeComments: true,
                                includeAutoGeneratedTags: false,
                                minifyCSS: false,
                                minifyJS: false,
                                minifyURLs: false,
                                collapseWhitespace: true
                            });
                            fs.writeFileSync(file, result, "utf8");
                        } else if (files[i].endsWith(".css")) {
                            let result = new CleanCSS({}).minify(fileContent);
                            fs.writeFileSync(file, result.styles, "utf8");
                        } else if (files[i].endsWith(".js")) {
                            let result = js.obfuscate(fileContent, {
                                // high performance
                                compact: true,
                                controlFlowFlattening: false,
                                deadCodeInjection: false,
                                debugProtection: false,
                                debugProtectionInterval: 0,
                                disableConsoleOutput: false,
                                identifierNamesGenerator: 'hexadecimal',
                                log: true,
                                numbersToExpressions: false,
                                renameGlobals: false,
                                selfDefending: false,
                                simplify: true,
                                splitStrings: false,
                                stringArray: true,
                                stringArrayCallsTransform: false,
                                stringArrayCallsTransformThreshold: 0.5,
                                stringArrayEncoding: [],
                                stringArrayIndexShift: true,
                                stringArrayRotate: true,
                                stringArrayShuffle: true,
                                stringArrayWrappersCount: 1,
                                stringArrayWrappersChainedCalls: true,
                                stringArrayWrappersParametersMaxCount: 2,
                                stringArrayWrappersType: 'variable',
                                stringArrayThreshold: 0.75,
                                unicodeEscapeSequence: false
                            });
                            fs.writeFileSync(file, result.getObfuscatedCode(), "utf8");
                        }
                    } else if (stats.isDirectory()) {
                        console.log("[Folder] " + file);
                        findHtmlCssFiles(file);
                    } else {
                        console.log("[Unknown] " + file);
                    }
                });
            }
        }
    });
}
