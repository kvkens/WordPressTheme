<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/includes/muStyle.css" />
<div id="muThe">
	<div class="muTheG">感谢您使用FullStack主题，有问题或意见<a href="http://www.imyy.org" target="_blank">点击这里</a>留言！</div>
	<form  action="" method="post">
	<?php include('ggFunctions.php');?>
	<div class="muDivs">
		<h2>公告</h2>
			<hr id="ggHr">
		<table>
			<?php get_option('ggNum')?$num = get_option('ggNum'):$num =1;?>
		<form action="" method="post">
			<tr>
				<td>公告条数：</td>
				<td><input class="gNum" name="ggNum"  type="text" value="<?php echo get_option('ggNum'); ?>" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'")"/></td>
				<td>设置公告的编辑条数(只能输入数字且大于0小于等于20！)</td>
			</tr>
			<tr>
				<td> </td>
				<td><input class="ggNumSub" type="submit" name="submit" value="保存"/></td>
				<td> </td>
			</tr>
		</form>
		</table>
		<hr id="ggHr">
		<p class="muGgp">显示在导航条下面，支持HTML代码。（建议不要再这里插入一些影响布局的代码）</p>
		<?php 	for($i=1; $i<=$num; $i++){  ?>
		<table id="muTable">
			<tr>
				<td>公告（<?php echo $i ?>）：</td>
				<td><input class="muText" name="ggCon<?php echo $i ?>"  type="text" value="<?php echo get_option('ggCon'.$i.''); ?>"/></td>
				<td><input class="much" id="muGgFor" type="checkbox" name="ggCh<?php echo $i ?>"  <?php if(get_option("ggCh".$i.'')=== "on"){ echo "checked"; }?> /></td>
			</tr>
		</table>
		<?php }?>
	</div>
	<input class="muSub" type="submit" name="submit" value="保存"/>
	</form>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.10.2.min.js"></script>

