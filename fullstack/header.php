<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Cache-Control" content="no-transform" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title><?php if ( is_home() ) {
        bloginfo('description'); echo " - ";  bloginfo('name');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title(); echo " - ";bloginfo('name');
    } elseif (is_search() || is_tag() || is_archive() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到-'; bloginfo('name');
    } else {
        wp_title('',true);
    } ?>
</title>
<meta name="keywords" content="<?php echo get_option('muKey'); ?>" />
<meta name="description" content="<?php echo get_option('muDescript'); ?>" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"/>
<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/css/base.min.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/css/lightbox.css" />
<link rel="stylesheet" href="<?php bloginfo('template_directory')?>/fonts/fonts.min.css" />
<script type="text/javascript" src="<?php bloginfo('template_directory')?>/js/jquery-1.10.2.min.js" ></script>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?> RSS Feed" href="<?php bloginfo('rss2_url');?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name');?> Atom Feed" href="<?php bloginfo('atom_url');?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<style type="text/css">
<?php if(get_option('ImgCh')=== "on"){ echo " a img:hover{-webkit-transform: translate3d(0, 0, 0);-webkit-perspective: 0;-webkit-backface-visibility: hidden;-webkit-transform: scale(1.1);-moz-transform: scale(1.1);transform: scale(1.1);} "; }?>
</style>
<?php wp_head(); ?>
</head>
	<?php flush(); ?>
<body class="custom-background homeBlog">
	<div id="header">
		<div class="top">
			<span class="logo">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_option('muLogo'); ?>" title="<?php bloginfo('name'); ?>"/></a>
				 <i><?php if(get_option('fbCh')=== "on"){ echo bloginfo('description'); }?></i>
			</span>
			<span class="search">
				<?php get_search_form(); ?>
			</span>
		</div>
		
		<nav id="nav">
			<div class="meNav" ><?php bloginfo('name'); ?><em></em></div>
			<div class="meNavs" style="display: none;">
					<?php  wp_nav_menu( array( 'menu' => 'mymenu', 'depth' => 2) );?>
			</div>
			<div class="nav " >
				<?php  wp_nav_menu( array( 'menu' => 'mymenu', 'depth' => 2) );?>
			</div>
		</nav>
		<div style="display: none;" id="loading"><div style="width: 0%; display: block;"></div></div>
		<script>$("#loading").show(); $("#loading div").animate({width:"30%"});</script>
	</div>