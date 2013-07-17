// The wrapper function
module.exports = function(grunt) {

	// Project and task configuration
	grunt.initConfig({
		less: {
			development: {
				options: {
					compress: false,
					yuicompress: false,
					optimization: 2
				},
				files: {
					"build/app/css/main.css": "build/less/main.less",
                    "vendor/clevertech/yiibooster/assets/css/bootstrap.css": "build/less/local-bootstrap.less"
				}
			}
		},
        clean: {
            development: ["assets/assets/*"],
        },
        copy: {
            main: {
                files: [
                    {expand: true, flatten: false, cwd: "build/app/", src: "**/**", dest: "assets/"}
                ]
            }
        },
		concat: {
			options: {
				separator: "\n\n"
			},
			dist: {
				src: [
					'build/app/js/main.js'
				],
				dest: 'assets/js/main.js'
			}
		},
		"closure-compiler": {
			main: {
				closurePath: 'build/closure-compiler',
				js: 'assets/js/main.js',
				jsOutputFile: 'assets/js/main.min.js',
                reportFile: 'build/reports/reports.txt',
				maxBuffer: 500,
				options: {
					compilation_level: 'SIMPLE_OPTIMIZATIONS',
					language_in: 'ECMASCRIPT5_STRICT'
				}
			}
		},
		watch: {
			styles: {
				files: ['build/app/less/**/*.less'],
				tasks: ['less'],
				options: {
					nospawn: true
				}
			},
			scripts: {
				files: ['build/app/js/**/*.js'],
				tasks: ['concat'],
				options: {
					nospawn: true
				}
			}
		}
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-closure-compiler');
    grunt.loadNpmTasks('grunt-contrib-clean');

	// Define tasks
	grunt.registerTask('default', ['less', 'copy', 'concat', 'closure-compiler']);
	grunt.registerTask('compile-js', ['closure-compiler']);
	grunt.registerTask('lespaul', ['less', 'copy', 'clean']);

};