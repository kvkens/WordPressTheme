module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        banner: '/*! Full Stack JavaScript Theme www.imyy.org <%= grunt.template.today("yyyy-mm-dd HH:MM:ss") %> Builder By Kvkens */\n',
        footer : '\r /*Full Stack Theme www.imyy.org  <%=pkg.name %> Builder By Kvkens */',
        sourceMap: false,
        sourceMapName: 'build/main.map'
      },
      build: {
        src: ['fullstack/js/loading.js','fullstack/js/index.js','fullstack/js/gg.js','fullstack/js/lightbox.js'],
        dest: 'fullstack/js/fullstack.min.js'
      }
    },
	//压缩css
	cssmin: {
		//文件头部输出信息
		options: {
			banner:'/*! Full Stack Theme CSS www.imyy.org <%= grunt.template.today("yyyy-mm-dd HH:MM:ss") %> Builder By Kvkens */\n',
			//美化代码
			beautify: {
				//中文ascii化，非常有用！防止中文乱码的神配置
				ascii_only: true
			}
		},
		my_target: {
			files: [
				{
					//expand: true,
					//相对路径
					//cwd: 'css/',
					src: ['fullstack/css/media.css','fullstack/css/highlightx.css','fullstack/css/lightbox.css'],
					//src : ['htdocs/wp-content/themes/fullstack/fonts/fonts.css'],
					dest: 'fullstack/css/base.min.css'
				}
			]
		}
	}
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // Default task(s).
  grunt.registerTask('default', ['uglify','cssmin']);
  grunt.registerTask('js', ['uglify']);
	grunt.registerTask('css', ['cssmin']);


};