module.exports = function(grunt){
  'use strict';
  require('time-grunt')(grunt);
  require('load-grunt-tasks')(grunt);
  var uglify = require('uglify-js')
    , cleancss = require('clean-css')
    , filename = 'all'
    , lessFileName = 'less'
    , coffeeFileName = 'coffee'
    , tmpDir = '.tmp/'
    , publicDir = 'public/'
    , jsPublicDir = publicDir + 'js/'
    , cssPublicDir = publicDir + 'css/'
    , jsFile = tmpDir + filename + '.js'
    , cssFile = tmpDir + filename + '.css'
    , lessFile = tmpDir + 'less/' + lessFileName + '.css'
    , coffeeFile = tmpDir + 'coffee/' + coffeeFileName + '.js'
    , jsPublicFile = publicDir + filename + '.js'
    , cssPublicFile = publicDir + filename + '.css'
    , privateFiles = require('./files.js')(coffeeFile, lessFile)
  ;

  grunt.initConfig({
    clean: {
      all: {
        src: [
          '.tmp/**/*'
        , 'public/js/**/*.js'
        , 'public/css/**/*.css'
        , 'public/img/**/*'
        , 'public/**/*.map'
        ]
      }
    , prod: {
        src: [
          '.tmp/**/*'
        , 'public/**/*.map'
        ]
      }
    , tmp: {
        src: ['.tmp/**/*']
      }
    }
  , coffee: {
      compile: {
        src: privateFiles.coffee
      , dest: coffeeFile
      }
    }
  , less: {
      compile: {
        src: privateFiles.less
      , dest: lessFile
      }
    }
  , copy: {
      js: {
        files: [{
          expand: true
        , src: privateFiles.js
        , dest: jsPublicDir
        }]
      }
    , css: {
        files: [{
          expand: true
        , src: privateFiles.css
        , dest: cssPublicDir
        }]
      }
    }
  , concat: {
      js: {
        options: {
          separator: '\n'
        , process: function(src, filepath) {
            if((!~filepath.indexOf('.min.js'))){
              src = uglify.minify(src, { fromString: true }).code;
            }
            return src;
          }
        }
      , src: privateFiles.js
      , dest: jsFile
      }
    , css: {
        options: {
          separator: ''
        , process: function(src, filepath) {
            if((!~filepath.indexOf('.min.css'))){
              src = new cleancss().minify(src).styles;
            }
            return src;
          }
        }
      , src: privateFiles.css
      , dest: cssFile
      }
    }
  , concat_sourcemap: {
      js: {
        options: {
          sourceRoot: 'js'
        }
      , files:{
          'public/all.js': privateFiles.js
        }
      }
    , css: {
        options: {
          sourceRoot: 'css'
        }
      , files:{
          'public/all.css': privateFiles.css
        }
      }
    }
  , uglify: {
      prod: {
        options: {}
      , src: jsFile
      , dest: jsPublicFile
      }
    }
  , cssmin: {
      prod: {
        options: {}
      , src: cssFile
      , dest: cssPublicFile
      }
    }
  , imagemin: {
      dynamic: {
        options: {
          optimizationLevel: 7
        , progressive: true
        , interlaced: true
        , cache: false
        }
      , files: [{
          expand: true
        , cwd: 'private/img'
        , src: ['**/*.{png,jpg,gif}']
        , dest: 'public/img'
        }]
      }
    }
  , watch: {
      coffee: {
        options: {
          livereload: true
        }
      , files: privateFiles.coffee
      , tasks: [
          'newer:coffee'
        , 'newer:copy:js'
        , 'concat_sourcemap:js'
        ]
      }
    , less: {
        options: {
          livereload: true
        }
      , files: privateFiles.less
      , tasks: [
          'newer:less'
        , 'newer:copy:css'
        , 'concat_sourcemap:css'
        ]
      }
    , js: {
        options: {
          livereload: true
        }
      , files: privateFiles.js
      , tasks: [
          'newer:copy:js'
        , 'concat_sourcemap:js'
        ]
      }
    , css: {
        options: {
          livereload: true
        }
      , files: privateFiles.css
      , tasks: [
          'newer:copy:css'
        , 'concat_sourcemap:css'
        ]
      }
    , html: {
        options: {
          livereload: true
        }
      , files: ['public/**/*.html']
      }
    }
  });

  grunt.registerTask('default', [
    'clean:all'
  , 'coffee'
  , 'less'
  , 'copy'
  , 'concat_sourcemap'
  , 'imagemin'
  , 'clean:tmp'
  , 'watch'
  ]);
  grunt.registerTask('prod', [
    'clean:all'
  , 'coffee'
  , 'less'
  , 'concat'
  , 'uglify'
  , 'cssmin'
  , 'imagemin'
  , 'clean:prod'
  ]);
};
