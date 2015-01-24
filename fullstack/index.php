<?php get_header(); ?>
<div id="content">
		<div class="crumbs">
			<?php if( is_home() ) {?>
			<div id="gg"><ul>
					 <?php $acnum = get_option('ggNum');	for($j=1; $j<=$acnum; $j++){?>
   					 <?php if( is_home() && get_option("ggCh".$j.'')=== "on") : ?> <li><i class="glyphicon glyphicon-volume-up"></i><?php echo get_option('ggCon'.$j.'');?></li><?php endif; }?>
   				</ul>
   			</div>
			<?php }	if(function_exists('cmp_breadcrumbs')){ cmp_breadcrumbs(); }?> 
			<!--面包屑-->
			</div>
			<div class="main">
				<!--slider start-->
				
				<?php if ( is_home() && !is_paged() && get_option("banCh")=== "on" ) { ?>
				<div class="slide_container sliders">
				      <ul class="rslides" id="slider">
					<?php	 if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail() ) { ?>
				        <li>
				         <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				          <p class="caption"><?php the_title( ); ?></p>
				        </li>
				      <?php } ?>
				<?php endwhile; ?>
				      </ul>
			    </div>
			    <?php }  ?>
				<!--slider end-->
			    <div class="clear"></div>
			    <div class="inCon box">
			    	<ul>
					<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			    		<li>
						<?php if( is_home() && is_sticky() && !is_paged()){ ?> <h2 class="inZD"><span>[置顶]</span><a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></h2> <?php } else{?>
			    			<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_directory')?>/timthumb.php?src=<?php index_thumbnail(); ?>&h=177&w=236&zc=1" alt="<?php the_title(); ?>" alt="<?php the_title( ); ?>" /></a>
			    			<div class="inConc">
			    				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>"><?php the_title( ); ?></a></h2>
			    				<div class="autor">
			    					<span><i class="glyphicon glyphicon-user"></i><?php the_author_posts_link(); ?></span>
			    					<span><i class="glyphicon glyphicon-folder-open"></i>
			    						<?php  $category = get_the_category();
											if($category[0]){
												echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; }?>
									</span>
			    					<span><i class="glyphicon glyphicon-time"></i><?php the_time('Y-n-j') ?></span>
			    					<span><i class="glyphicon glyphicon-eye-open"></i><?php get_post_views($post -> ID); ?>℃</span>
			    					<span><i class="glyphicon glyphicon-comment"></i><a href="#"><?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></a></span>
			    				</div>
			    				<p><a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(strip_tags(apply_filters(‘the_content’, $post->post_content)), 0, 280,……); ?></a></p>
			    				<div class="inTag">
			    					<i class="glyphicon glyphicon-tags"></i>
			    					<?php the_tags('标签：', ', ', ''); ?>
			    				</div>
			    			</div>
			    			<div class="rMore"><a href="<?php the_permalink(); ?>">阅读全文</a></div>
							<?php } ?>
			    		</li>
			    	<?php endwhile; wp_reset_query();?>
			    	</ul>
			    	<div class="fanye">
						<div class="page_navi"><?php par_pagenavi(9); ?></div>
					</div>
					<?php else : ?>
					<h2 class="noText"><i class="glyphicon glyphicon-warning-sign"></i>没有找到任何文章！</h2>
					<?php endif; ?>
			    	<div class="clear"></div>
			    </div>
			</div>
			<?php get_sidebar(); ?> 
			<div class="clear"></div>
			<div class="iTop"><a id="atoTop" href="javascript:void(0)"><i class="glyphicon glyphicon-arrow-up" id="iTopIco"></i></a></div>
		</div>
		<div class="clear"></div>
<?php get_footer(); ?>