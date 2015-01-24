function AutoScroll(obj) {
	$(obj).find("ul:first").animate({
		marginTop: "-25px"
	}, 500, function() {
		$(this).css({
			marginTop: "0px"
		}).find("li:first").appendTo(this);
	});
}
$(document).ready(function() {
	var myar = setInterval('AutoScroll("#gg")', 3000);
	//当鼠标放上去的时候，滚动停止，鼠标离开的时候滚动开始
	$("#gg").hover(function() {
		clearInterval(myar);
	}, function() {
		myar = setInterval('AutoScroll("#gg")', 3000)
	});
	$("#atoTop").on("click", function(event) {
		$('html,body').animate({
			scrollTop: '0px'
		}, 800);
	});
});