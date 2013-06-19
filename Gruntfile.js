// The wrapper function
module.exports = function(grunt) {

	// Project and task configuration
	grunt.initConfig({
		less: {
			development: {
				options: {
					compress: true,
					yuicompress: true,
					optimization: 2
				},
				files: {
					"assets/css/main.css": "build/app/less/main.less",
				}
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
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-closure-compiler');

	// Define tasks
	grunt.registerTask('default', ['less', 'concat', 'closure-compiler']);
	grunt.registerTask('compile-js', ['closure-compiler']);

};