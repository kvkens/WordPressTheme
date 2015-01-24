$(document).ready(function(){
	var topMain=$("#header").height()+1//是头部的高度加头部与nav导航之间的距离
	var nav=$("#nav");
	$(window).scroll(function(){
		if ($(window).scrollTop()>topMain && $(window).width()>980){//如果滚动条顶部的距离大于topMain则就nav导航就添加类.nav_scroll，否则就移除
			nav.addClass("navFiexd");
		}else{
			nav.removeClass("navFiexd");
		}
	});
	$(".meNav").click(function(){
		$(".meNavs").slideToggle();
	});
	
	if($(window).width()>980){
		$(".inConc h2 a").click(function(){
			$(this).html("页面正在加载，请稍候...");
		});
	}
})