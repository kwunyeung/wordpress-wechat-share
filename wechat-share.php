<?php
/*
Plugin Name: 微信 分享到朋友圈
Plugin URI: http://blog.creativeworks.com.hk
Description: Add wechat share
Version: 1.0
Author: Kwun Yeung
Author URI: http://www.creativeworks.com.hk
License: Creativeworks
*/

/*
	avoid a name collision, make sure this function is not
	already defined */

if( !function_exists("wechat-share")){
	include 'Mobile_Detect.php';
	$detect = new Mobile_Detect();
	define( 'PLUGIN_URL', plugin_dir_url(__FILE__) );

	function wechat_share($content){

	/*	there is a text file in the same directory as this script */

		//$fileName = dirname(__FILE__) ."/bottom_of_every_post.txt";
		


	/*	we want to change `the_content` of posts, not pages
		and the text file must exist for this to work */

		if( !is_page() ){
			//echo get_the_excerpt();
		/*	append the text file contents to the end of `the_content` */
			//return $content . stripslashes( $msg );
			//the_excerpt_max_charlength(140);

			if (has_post_thumbnail( $post->ID ) )
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				//print_r($image);
				
				$desc = strip_tags(mb_substr($content, 0, 55));
				
			return '<p class="wechat"><a href="#" class="wechat-follow">關注「造作工房」微信</a></p>'.$content.'<p class="wechat"><a href="#" class="wechat-share">
			<span class="title">'.get_the_title().'</span>
			<span class="link">'.get_permalink().'</span>
			<span class="desc">'.$desc.'</span>
			<span class="img">'.$image[0].'</span>
			分享到朋友圈</a></p>';
		} else{

		/*	if `the_content` belongs to a page or our file is missing
			the result of this filter is no change to `the_content` */

			return $content;
		}
	}

	function enqueue_my_scripts(){
		wp_enqueue_script( 'my_awesome_script', plugins_url('wechat-share/wechat.js'), array('jquery'));	
	}
	
	/*	add our filter function to the hook */

	if ($detect->isMobile()){
		add_action('wp_print_scripts', 'enqueue_my_scripts' );
		add_filter('the_content', 'wechat_share');
	}
}


?>