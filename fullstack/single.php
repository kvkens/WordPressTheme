<?php get_header(); ?>
<div id="contents">
			<div class="crumbs">
				<?php $options = get_option(‘classic_options’); ?>
<?php if($options[‘notice’] && $options[‘notice_content’]) : ?>
<?php echo($options[‘notice_content’]); ?>
<?php endif; ?>
				
				<?php if(function_exists('cmp_breadcrumbs')) cmp_breadcrumbs();?>
			</div>
			<div class="single">
			<div class="siT">
				<?php if (have_posts()) : the_post(); update_post_caches($posts); ?> 
				<h2><?php the_title( ); ?></h2>
			    	<div class="autor">
			    		<span><i class="glyphicon glyphicon-user"></i><?php the_author_posts_link(); ?></span>
			    		<span><i class="glyphicon glyphicon-folder-open"></i>
			    			<?php  $category = get_the_category();
								if($category[0]){
									echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; }?>
						</span>
			    		<span><i class="glyphicon glyphicon-time"></i><?php the_time('Y-n-j H:i:s') ?></span>
			    		<span><i class="glyphicon glyphicon-eye-open"></i><?php get_post_views($post -> ID); ?>℃</span>
			    		<span><i class="glyphicon glyphicon-comment"></i><a href="#"><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></a></span>
			    	</div>
				<div class="siConP">
					<?php the_content(); ?>
				</div>
				<div class="siTag">
			    	<i class="glyphicon glyphicon-tags"></i>
			    	<?php the_tags('标签：', '，', ''); ?>
			    </div>
			    <div class="sinLink">
				<p>本文固定链接: <a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
				<p>转载请注明: <?php the_author(); ?> <?php the_time('Y-n-j H:i:s') ?></span> 于 <?php bloginfo('name'); ?>发表</p>
				</div>
				<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a><a href="#" class="bds_taobao" data-cmd="taobao" title="分享到我的淘宝"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div>
				<div class="clear"></div>
				<?php else : ?>   
			   <div class="errorbox">   
				   没有文章！   
			   </div>   
			   <?php endif; ?>  
			</div>
				<div class="nPages">
					<span class="nL">上一篇：<?php next_post_link('%link');?></span>
					<span class="nN">下一篇：<?php previous_post_link('%link'); ?></span>
				</div>
				<?php if ( get_option('xgCh')=== "on" ) { ?>
				<div class="tj">
					<h3><i class="glyphicon glyphicon-link"></i>相关文章</h3>
					<ul>
						<?php
						$post_num = 8; 
						global $post;
						$exists_related_ids = array();
						$tmp_post = $post;
						$tags = ''; $i = 0;
						$exists_related_ids[] = $post->ID;
						if ( get_the_tags( $post->ID ) ) {
						foreach ( get_the_tags( $post->ID ) as $tag ) $tags .= $tag->name . ',';
						$tags = strtr(rtrim($tags, ','), ' ', '-');
						$myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$post->ID);
						foreach($myposts as $post) {
						setup_postdata($post);
						?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?></a></li>
						<?php
						$exists_related_ids[] = $post->ID;
						$i += 1;
						}
						}
						if ( $i < $post_num ) {
						$post = $tmp_post; setup_postdata($post);
						$cats = ''; 
						$post_num -= $i;
						foreach ( get_the_category( $post->ID ) as $cat ) $cats .= $cat->cat_ID . ',';
						$cats = strtr(rtrim($cats, ','), ' ', '-');
						$myposts = get_posts('numberposts='.$post_num.'&orderby=rand&category='.$cats.'&exclude='. implode(",", $exists_related_ids));
						foreach($myposts as $post) {
						setup_postdata($post);
						?>
						<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?></a></li>
						<?php
						}
						}
						$post = $tmp_post; setup_postdata($post);
						?></ul>
					<div class="clear"></div>
				</div>
				<?php } ?>
				<?php comments_template(); ?>
			</div>
			<?php get_sidebar(); ?> 
			<div class="clear"></div>
			<div class="iTop"><a id="atoTop" href="javascript:void(0)"><i class="glyphicon glyphicon-arrow-up" id="iTopIco"></i></a></div>
		</div>
	<div class="clear"></div>
<?php get_footer(); ?>