<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/includes/muStyle.css" />
<div id="muThe">
	<div class="muTheG">感谢您使用FullStack主题，有问题或意见<a href="http://www.imyy.org" target="_blank">点击这里</a>!</div>
	<div class="muTit">
		<a class="muTitac" href="javascript:">主题设置</a>
		<a href="javascript:">功能开关</a>
		<a href="javascript:">SEO设置</a>
	</div>
	<?php include('functions.php');?>
	<form  action="" method="post">
	<div class="muDivs">
		<h2>网站标题</h2>
		<table>
			<tr>
				<td>主标题：</td>
				<td><input class="muText" name="blogname"  type="text" value="<?php echo get_option('blogname'); ?>"/></td>
				<td>标题-后面的内容</td>
			</tr>
			<tr>
				<td>副标题：</td>
				<td><input class="muText" name="blogdescription" type="text" value="<?php echo get_option('blogdescription'); ?>"/></td>
				<td>标题-前面的的内容</td>
			</tr>
			<?php 
		        wp_enqueue_script('media-upload');
		        wp_enqueue_script('thickbox');
		        wp_enqueue_script('my-upload');
		        wp_enqueue_style('thickbox'); 
		    ?>
			<tr>
				<td>LOGO：</td>
				<td>
					 <input id="upload_image" name="muLogo" type="text" value="<?php echo get_option('muLogo'); ?>" style="width:370px;"/>
    				<input id="upload_image_button" type="button" style="width:auto;height:28px;" value="上传图片" /> 
				</td>
				<td>220*60左右像素的图片/td>
			</tr>
			<tr>
				<td>底部一行：</td>
				<td><textarea rows="5" cols="43" name="footerText"><?php echo get_option('footerText'); ?></textarea></td>
				<td>底部第一行，可以加入超链接代码，如：&lt;a href="www.imyy.org"&gt;Full Stack主题&lt;/a&gt;</td>
			</tr>
			<tr>
				<td>底部二行：</td>
				<td style="color: red;">FullStack</td>
				<td></td>
			</tr>
		</table>
	</div>
	<div class="muDivs" style="display: none;">
		<h2>功能开关设置</h2>
		<table>
			<tr>
				<td>首页幻灯片：</td>
				<td><input class="much" id="muBanFor" type="checkbox" name="banCh" <?php if(get_option('banCh')=== "on"){ echo "checked"; }?> /></td>
				<td><label for="muBanFor">首页是否显示幻灯片,大小970px*455px或同等比例的图片显示效果最佳!</label></td>
			</tr>
			<tr>
				<td>相关文章：</td>
				<td ><input class="much" id="muXgFor" type="checkbox" name="xgCh" <?php if(get_option('xgCh')=== "on"){ echo "checked"; }?> /></td>
				<td><label for="muXgFor">文章内容页底部是否显示相关文章！</label></td>
			</tr>
			<tr>
				<td>同步副标题：</td>
				<td ><input class="much" id="muFbFor" type="checkbox" name="fbCh"  <?php if(get_option('fbCh')=== "on"){ echo "checked"; }?> /></td>
				<td><label for="muFbFor">网站头部logo后面的副标题是否显示！</label></td>
			</tr>
			<tr>
				<td>图片缓慢放大</td>
				<td ><input class="much" id="muImgFor" type="checkbox" name="ImgCh"  <?php if(get_option('ImgCh')=== "on"){ echo "checked"; }?> /></td>
				<td><label for="muImgFor">网站所有图片，鼠标移入缓慢放大效果！</label></td>
			</tr>
		</table>
	</div>
	<div class="muDivs" style="display: none;">
		<h2>SEO设置</h2>
		<table>
			<tr>
				<td>关键字Keyword：</td>
				<td><input class="muText" type="text" name="muKey" value="<?php echo get_option('muKey'); ?>"/></td>
				<td>用英文输入状态的逗号隔开</td>
			</tr>
			<tr>
				<td>描述description</td>
				<td><textarea rows="5" cols="43" name="muDescript"><?php echo get_option('muDescript'); ?></textarea></td>
				<td>网站描述</td>
			</tr>
		</table>
	</div>
	<input class="muSub" type="submit" name="submit" value="保存"/>
	</form>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".muTit a").click(function(){
		$(".muDivs").hide().eq($(".muTit a").index(this)).show();
		$(this).addClass("muTitac").siblings().removeClass("muTitac");
	});
	
        jQuery('#upload_image_button').click(function() {
         formfield = jQuery('#upload_image').attr('name');
         // show Wordpress' uploader modal box
         tb_show('', '<?php echo admin_url(); ?>media-upload.php?type=image&amp;TB_iframe=true');
         return false;
        });
        window.send_to_editor = function(html) {
         // this will execute automatically when a image uploaded and then clicked to 'insert to post' button
         imgurl = jQuery('img',html).attr('src');
         // put uploaded image's url to #upload_image
         jQuery('#upload_image').val(imgurl);
         tb_remove();
        }
	});
	
		
jQuery(document).ready(function($){
	$('.muTit a').click(function(){
		var j = $('.muTit a').index($(this)[0]);
		cookie.set("wrappera",j,"1");
		$('.muTit a').eq(j).addClass('muTitac').siblings().removeClass('muTitac');
		$('.muDivs').eq(j).show().siblings('.muDivs').hide();
		return false;
	})
	
	var ckGet = cookie.get('wrappera');
	$('.muTit a').eq(ckGet).addClass('muTitac').siblings().removeClass('muTitac');
	$('.muDivs').eq(ckGet).show().siblings('.muDivs').hide();

});

	
/*cookie方法*/
var cookie = {
	set:function(key,val,time){//设置cookie方法
		var date=new Date(); //获取当前时间
		var expiresDays=time;  //将date设置为365天以后的时间
		date.setTime(date.getTime()+expiresDays*24*3600*1000); //将tips的cookie设置为10天后过期 
		document.cookie=key + "=" + val +";expires="+date.toGMTString();  //设置cookie
	},
	get:function(key){//获取cookie方法
		/*获取cookie参数*/
		var getCookie = document.cookie.replace(/[ ]/g,"")  //获取cookie，并且将获得的cookie格式化，去掉空格字符
		var arrCookie = getCookie.split(";")  //将获得的cookie以"分号"为标识 将cookie保存到arrCookie的数组中
		var tips;  //声明变量tips
		for(var i=0;i<arrCookie.length;i++){   //使用for循环查找cookie中的tips变量
			var arr=arrCookie[i].split("=");   //将单条cookie用"等号"为标识，将单条cookie保存为arr数组
			if(key==arr[0]){  //匹配变量名称，其中arr[0]是指的cookie名称，如果该条变量为tips则执行判断语句中的赋值操作
				tips=arr[1];   //将cookie的值赋给变量tips
				break;   //终止for循环遍历
			} 
		}
		return tips;

	}
}
	
</script>