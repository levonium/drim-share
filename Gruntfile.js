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
                'public/css/drim-share.css' : 'public/css/drim-share.css'
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
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);

}
