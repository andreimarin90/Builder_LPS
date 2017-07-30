<?php
function bbtb_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'bbtb_theme_setup' );

function set_private_categories($post_id) {
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	
	//die();
}
//add_action( 'save_post', 'set_private_categories' );

if(is_page_template('emailer.php')) {
	function builder_lp_child_scripts(){
	    //Smooth Scroll
	    wp_enqueue_script('bbt-js', get_stylesheet_directory_uri() . '/js/bbt.js', array('jquery'), false, true);
	    wp_enqueue_script('bbt-navigation1', get_stylesheet_directory_uri() . '/js/bbt-navigation1.js', array('jquery'), false, true);
	    wp_enqueue_script('bbt-mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), false, true);
	    wp_enqueue_script('bbt-placeholder', get_stylesheet_directory_uri() . '/js/jquery.powerful-placeholder.min.js', array('jquery'), false, true);
	    wp_enqueue_script('bbt-touchSwipe', get_stylesheet_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), false, true);
	    wp_enqueue_script('bbt-owl', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), false, true);

	    wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/js/libs/modernizr.min.js', array('jquery'), false, true);
	    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/libs/bootstrap.min.js', array('jquery'), false, true);

	}
	add_action('wp_enqueue_scripts', 'builder_lp_child_scripts');

	function builder_lp_child_styles() {
	    wp_enqueue_style( 'bbt-css', get_template_directory_uri() . '/css/bbt.css' );
	    wp_enqueue_style( 'helpers-css', get_stylesheet_directory_uri() . '/css/helpers.css' );
	    wp_enqueue_style( 'material-icons', 'https://code.getmdl.io/1.1.3/material.blue-indigo.min.css' );
	}
	add_action( 'wp_enqueue_scripts', 'builder_lp_child_styles' )

}