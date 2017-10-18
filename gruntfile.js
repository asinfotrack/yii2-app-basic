module.exports = function(grunt) {

	//configuration
	grunt.initConfig({
		watch: {
			css: {
				files: 'assets/src/scss/**/*.scss',
				tasks: ['buildCss']
			},
			js: {
				files: 'assets/src/js/**/*.js',
				tasks: ['buildJs']
			},
			jsLib: {
				files: 'assets/lib/js/**/*.js',
				tasks: ['buildJsLib']
			}
		},

		sass: {
			site: {
				options: {
					style: 'expanded',
					lineNumbers: true,
					sourcemap: 'none'
				},
				files: [{
					expand: true,
					cwd: 'assets/src/scss/',
					src: ['**/*.scss'],
					dest: 'web/css/',
					ext: '.css'
				}]
			}
		},

		less: {
			bootstrap: {
				options: {
					style: 'expanded',
					lineNumbers: true,
					sourcemap: 'none'
				},
				files: [{
					expand: true,
					cwd: 'assets/src/less/',
					src: ['**/*.less'],
					dest: 'web/css/',
					ext: '.css'
				}]
			}
		},

		cssmin: {
			site: {
				files: [{
					expand: true,
					cwd: 'web/css/',
					src: ['*.css', '!*.min.css'],
					dest: 'web/css/',
					ext: '.min.css'
				}]
			},
			bootstrap: {
				src: 'web/css/bootstrap.css',
				dest: 'web/css/bootstrap.min.css'
			},
			sweetalert: {
				src: 'vendor/bower/sweetalert/dist/sweetalert.css',
				dest: 'web/css/sweetalert.min.css'
			},
			magnificPopup: {
				src: 'vendor/roman444uk/yii2-magnific-popup/assets/css/magnific-popup.css',
				dest: 'web/css/magnific-popup.min.css'
			}
		},

		uglify: {
			site: {
				files: [{
					expand: true,
					cwd: 'assets/src/js',
					src: ['*.js', '!*.min.js'],
					dest: 'web/js/',
					ext: '.min.js',
				}]
			},
			yii: {
				files: [{
					expand: true,
					cwd: 'vendor/yiisoft/yii2/assets',
					src: ['*.js', '!*.min.js'],
					dest: 'web/js/',
					ext: '.min.js',
					mangle: false
				}]
			},
			yiiPjax: {
				src: 'vendor/bower/yii2-pjax/jquery.pjax.js',
				dest: 'web/js/jquery.pjax.min.js',
				mangle: false
			},
		},

		modernizr: {
			dist: {
				parseFiles: true,
				dest: 'web/js/modernizr-custom.min.js',
				tests: [
					"css/flexbox",
					"css/flexboxlegacy",
					"css/flexboxtweener",
					"css/flexwrap",
					"storage/localstorage",
					"storage/sessionstorage"
				],
				uglify: true,
			}
		},

		concat: {
			cssLib: {
				options: {
					separator: grunt.util.linefeed + grunt.util.linefeed + grunt.util.linefeed,
				},
				nonull: true,
				src: [
					'web/css/sweetalert.min.css',
					'web/css/magnific-popup.min.css',
					'vendor/rmrevin/yii2-fontawesome/assets/css/font-awesome.min.css',
					'web/css/bootstrap.min.css'
				],
				dest: 'web/css/lib.min.css'
			},
			jsLib: {
				options: {
					separator: grunt.util.linefeed + ';' + grunt.util.linefeed + grunt.util.linefeed,
				},
				nonull: true,
				src: [
					'vendor/bower/jquery/dist/jquery.min.js',
					'vendor/bower/jquery-ui/jquery-ui.min.js',
					'vendor/bower/jquery-ui/ui/minified/datepicker.min.js',
					'vendor/bower/jquery-ui/ui/i18n/datepicker-de.js',
					'vendor/bower/jquery-ui/ui/i18n/datepicker-fr-CH.js',
					'vendor/bower/jquery-ui/ui/i18n/datepicker-it-CH.js',
					'vendor/bower/jquery-ui/ui/i18n/datepicker-en-GB.js',
					'web/js/modernizr-custom.min.js',
					'vendor/roman444uk/yii2-magnific-popup/assets/js/jquery.magnific-popup.min.js',
					'vendor/bower/sweetalert/dist/sweetalert.min.js',
					'web/js/yii.min.js',
					'web/js/jquery.pjax.min.js',
					'vendor/bower/bootstrap/dist/js/bootstrap.min.js',
					'vendor/asinfotrack/yii2-toolbox/assets/src/ajax-toggle-button.js',
					'vendor/asinfotrack/yii2-toolbox/assets/src/email-disguise.js',
				],
				dest: 'web/js/lib.min.js'
			}
		},

		copy: {
			flags: {
				files: [
					{
						expand: true,
						cwd: 'vendor/components/flag-icon-css/flags/1x1/',
						src: '**',
						dest: 'web/flags/1x1/',
						flatten: true,
						filter: 'isFile'
					},
					{
						expand: true,
						cwd: 'vendor/components/flag-icon-css/flags/4x3/',
						src: '**',
						dest: 'web/flags/4x3/',
						flatten: true,
						filter: 'isFile'
					}
				]
			},
			js: {
				expand: true,
				src: 'assets/src/js/init.js',
				dest: 'web/js/',
				flatten: true
			},
			jsLib: {
				expand: true,
				src: 'vendor/bower/cytoscape/dist/cytoscape.min.js',
				dest: 'web/js/',
				flatten: true
			},
			fonts: {
				files: [
					{
						expand: true,
						cwd: 'assets/src/fonts/',
						src: '**',
						dest: 'web/fonts/',
						flatten: true,
						filter: 'isFile'
					},
					{
						expand: true,
						cwd: 'vendor/rmrevin/yii2-fontawesome/assets/fonts/',
						src: '**',
						dest: 'web/fonts/',
						flatten: true,
						filter: 'isFile'
					}
				]
			},
		},

		clean: {
			cssLib: ['web/css/bootstrap.css','web/css/bootstrap.min.css','cssmin:magnificPopup','web/css/sweetalert.min.css'],
			jsLib: ['web/js/yii.min.js', 'web/js/jquery.pjax.min.js'],
			modernizr: ['web/js/modernizr-custom.min.js']
		}
	});

	//loading of npm tasks
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-modernizr');

	//task definitions
	grunt.registerTask('buildCssLib', ['less:bootstrap','cssmin:bootstrap','cssmin:sweetalert','concat:cssLib','clean:cssLib','copy:fonts','copy:flags']);
	grunt.registerTask('buildCss', ['sass', 'cssmin:site']);
	grunt.registerTask('buildJsLib', ['clean:modernizr','uglify:yii','uglify:yiiPjax','modernizr:dist','concat:jsLib','clean:jsLib','copy:jsLib']);
	grunt.registerTask('buildJs', ['uglify:site', 'copy:js']);

	grunt.registerTask('build', ['buildJsLib','buildJs','buildCssLib','buildCss']);
	grunt.registerTask('default', ['watch']);

};
