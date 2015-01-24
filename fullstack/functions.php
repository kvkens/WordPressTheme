<?php 
//添加后台链接菜单
add_filter( 'pre_option_link_manager_enabled', '__return_true' ); 
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');
//注册首页小工具   
if(function_exists('register_sidebar')){
	register_sidebar(array(
		'name'=>'首页侧边栏',
		'id' => 'home-sidebar',
		'before_widget' => '<div class="sidebar-h">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	}
register_nav_menus();
//后台添加顶级菜单
add_action('admin_menu', 'add_diy_menu');  
function add_diy_menu() {
add_menu_page( '主题设置', '主题设置', 'administrator', 'custompage', 'my_function_menu', '', 59);
add_submenu_page('custompage', '公告设置', '公告设置', 'administrator', 'admin-gg', 'my_function_g');
}
function my_function_menu() { 
	include('includes/themes_options.php');//后台设置
}
//载入公告设置页面函数
function my_function_g() { 
	include('includes/gg.php');//公告设置
}


/* 修改标签云默认字体 */
function rbt_tag_cloud_filter($args) {
$args = array(
"largest" => "14",
"smallest" => "14",
"number" => "14",
"unit" => "px",
);
return $args;
}
add_filter("widget_tag_cloud_args", "rbt_tag_cloud_filter");
// 导航
register_nav_menus();
//特色图像
add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 970, 455, true );  
//文章浏览次数
function get_post_views ($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }
    echo number_format_i18n($count);
}
function set_post_views () {
    global $post;
    $post_id = $post -> ID;
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if (is_single() || is_page()) {
        if ($count == '') {
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }
    }
}
add_action('get_header', 'set_post_views');
/* 分页 */
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 首页 </a>";}
	previous_posts_link(' 上一页 ');
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 尾页 </a>";}}
}
//评论

//缩略图
function index_thumbnail(){  
    global $post;  
    if ( has_post_thumbnail() ){  
        $domsxe = simplexml_load_string(get_the_post_thumbnail());  
        $thumbnailsrc = $domsxe->attributes()->src;  
        echo $thumbnailsrc;  
    } else {  
        $content = $post->post_content;  
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
        $n = count($strResult[1]);  
        if($n > 0){  
            echo $strResult[1][0];  
        }else {  
            $random = mt_rand(1, 10); 
            echo get_bloginfo('template_url').'/images/noimg.jpg'; 
        }  
    }  
}  
//面包屑
function cmp_breadcrumbs() {
	$delimiter = '>'; // 分隔符
	$before = '<span class="current">'; // 在当前链接前插入
	$after = '</span>'; // 在当前链接后插入
	if ( !is_home() && !is_front_page() || is_paged() ) {
		// echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">'.__( '' , 'cmp' );
		global $post;
		$homeLink = home_url();
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( '<span class="glyphicon glyphicon-home"></span>首页' , 'cmp' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) { // 分类 存档
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) { // 天 存档
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) { // 月 存档
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) { // 年 存档
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) { // 文章
			if ( get_post_type() != 'post' ) { // 自定义文章类型
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else { // 文章 post
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) { // 附件
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) { // 页面
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { // 父级页面
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { // 搜索结果
			echo $before ;
			printf( __( '搜索结果: %s', 'cmp' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) { //标签 存档
			echo $before ;
			printf( __( '标签: %s', 'cmp' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) { // 作者存档
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( '作者: %s', 'cmp' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) { // 404 页面
			echo $before;
			_e( 'Not Found', 'cmp' );
			echo  $after;
		}
		if ( get_query_var('pageds') ) { // 分页
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'cmp' ), get_query_var('pageds') );
		}
		echo '</div>';
	}
}


//移除多余代码
remove_action( 'wp_head', 'wp_enqueue_scripts', 1 ); //Javascript的调用
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
remove_action( 'wp_head', 'noindex', 1 );
remove_action( 'wp_head', 'wp_print_styles', 8 );//载入css
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style() {
global $wp_widget_factory;
remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
}
add_action('get_header', 'remove_admin_login_header'); function
remove_admin_login_header() { remove_action('wp_head',
'_admin_bar_bump_cb'); }
//禁止加载WP自带的jquery.js
if ( !is_admin() ) { // 后台不禁止
function my_init_method() {
wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
}
add_action('init', 'my_init_method');
}
wp_deregister_script( 'l10n' );
//移除仪表盘多余
function ludou_remove_dashboard_widgets() {
   // Globalize the metaboxes array, this holds all the widgets for wp-admin
   global $wp_meta_boxes;
   // 删除面板
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
   unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
   unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_duoshuo']);
   // 添加面板
   wp_add_dashboard_widget('mumu_help_widget', '主题信息', 'mumu_dashboard_help');
}
function mumu_dashboard_help() {
  include('includes/getAjax.php');//后台设置   
}
add_action('wp_dashboard_setup', 'ludou_remove_dashboard_widgets' );
// 后台登陆logo 
 add_filter('login_headerurl', create_function(false,"return get_bloginfo( 'siteurl' );"));
 add_filter('login_headertitle', create_function(false,"return get_bloginfo( 'name' );"));
 function nowspark_login_head() {
    echo '<style type="text/css">body.login #login h1 a {background:url(../wp-content/themes/fullstack/images/logo.png) no-repeat center transparent;height: 75px;width:315px;padding:0;margin:0 auto 1em;}</style>';
}
add_action("login_head", "nowspark_login_head");
//禁用Open Sans
class Disable_Google_Fonts {
public function __construct() {
add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
}
public function disable_open_sans( $translations, $text, $context, $domain ) {
if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
$translations = 'off';
}
return $translations;
}
}
$disable_google_fonts = new Disable_Google_Fonts;
//主题代码结束
?>