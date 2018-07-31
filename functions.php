<?php


add_action( 'wp_enqueue_scripts', 'builder_lp_child_scripts' );
function builder_lp_child_scripts(){
	
	if(is_page_template('emailer.php') || is_page_template('free-dd.php')) {
	//Smooth Scroll
	wp_enqueue_script('child-modernizr', get_stylesheet_directory_uri() . '/js/libs/modernizr.min.js', array('jquery'), null, true);


	wp_enqueue_script('child-bootstrap', get_stylesheet_directory_uri() . '/js/libs/bootstrap.min.js', array('jquery'), null, true);

	wp_enqueue_script('child-bbt-placeholder', get_stylesheet_directory_uri() . '/js/jquery-1.12.3.min.js', array('jquery'), null, true);

	wp_enqueue_script('child-bbt-placeholder', get_stylesheet_directory_uri() . '/js/jquery.powerful-placeholder.min.js', array('jquery'), null, true);
	wp_enqueue_script('child-bbt-owl', get_stylesheet_directory_uri() . '/js/owl.carousel.js', array('jquery'), null, true);
	wp_enqueue_script('child-bbt-mousewheel', get_stylesheet_directory_uri() . '/js/jquery.mousewheel.min.js', array('jquery'), null, true);
	wp_enqueue_script('child-bbt-touchSwipe', get_stylesheet_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), null, true);

	wp_enqueue_script('child-material-js', 'https://code.getmdl.io/1.1.3/material.min.js', array('jquery'), null, true);

	wp_enqueue_script('child-bbt-navigation1', get_stylesheet_directory_uri() . '/js/bbt.navigation1.js', array('jquery'), null, true);
	wp_enqueue_script('child-bbt-js', get_stylesheet_directory_uri() . '/js/bbt.js', array('jquery'), null, true);


	wp_enqueue_style( 'child-material-icons', 'https://code.getmdl.io/1.1.3/material.blue-indigo.min.css' );
	wp_enqueue_style( 'child-helpers-css', get_stylesheet_directory_uri() . '/css/helpers.css' );
	wp_enqueue_style( 'child-bbt-css', get_stylesheet_directory_uri() . '/css/bbt.css' );
	}
}

add_action( 'wp_print_scripts', 'bbt_deregister_unneeded_scripts', 15 );
function bbt_deregister_unneeded_scripts() {
    if(is_page_template('emailer.php') || is_page_template('free-dd.php')){
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_script( 'jquery-blockui' );
		wp_dequeue_script( 'wc-js-cookie' );
		wp_dequeue_script( 'woocommerce' );
		wp_dequeue_script( 'wc-add-to-cart' );
		wp_dequeue_script( 'wc-cart-fragments' );
    }
}

add_action( 'wp_print_styles', 'bbt_deregister_styles', 100 );
function bbt_deregister_styles() {
	if(is_page_template('emailer.php') || is_page_template('free-dd.php')){
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce-general' );
		wp_dequeue_style( 'wordfenceAJAXcss' ) ;
		wp_dequeue_style( 'yoast-seo-adminbar' );
		wp_dequeue_style( 'bbt_builder-bootstrap-css-css' );
	}
}

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

<<<<<<< HEAD
// if(is_page_template('emailer.php')) {
// }

add_filter( 'wpseo_canonical', '__return_false' );

//remove add to cart message
add_filter( 'wc_add_to_cart_message_html', '__return_null' );
=======

//add_action( 'save_post', 'set_private_categories' );

// if(is_page_template('emailer.php')) {
// }
>>>>>>> 524a3dead2dd2aad308c7e6a1f62826465d53c23
