module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
          dist: {
            files: [{
              expand: true,
              cwd: 'public/css/sass',
              src: ['drim-share.scss'],
              dest: 'public/css',
              ext: '.css'
            }]
          }
        },

        postcss: {
            options: {
                map: true, // inline sourcemaps
                processors: [
                    require('pixrem')(),
                    require('autoprefixer')({browsers: 'last 2 versions'}),
                    require('cssnano')()
                ]
            },
            dist: {
                src: 'public/css/drim-share.css',
                dest: 'public/css/drim-share.min.css'
            }
        },

        watch: {
            grunt: {
                options: {
                reload: true
                },
                files: ['Gruntfile.js']
            },
            css: {
                files: ['public/css/sass/*.scss', 'public/css/sass/**/*.scss'],
                tasks: ['sass', 'postcss']
            },
        },

        makepot: {
            target: {
                options: {
                    domainPath: 'languages',
                    exclude: [
                        'docs/.*',
                        'node_modules/.*',
                        'vendor/.*',
                        'wpcs/.*'
                    ],
                    type: 'wp-plugin'
                }
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-wp-i18n');

    grunt.registerTask('default', ['watch']);

    grunt.registerTask('pot', [
        'makepot'
    ]);

}
