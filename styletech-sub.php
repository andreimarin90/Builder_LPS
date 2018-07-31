<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Pingbacks -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<?php 

/*
Template Name: Styletech Subs
*/ 
?>
<body>
	<?php //require_once('theme_includes/header_nav.php'); ?>

	<!-- Main Banner -->
	<div class="main-header" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/bg-1.jpg);">
		<div class="header-inner">
			<h1 class="header-title">Styletech Subs</h1>
			<div class="header-buttons">
				<a href="<?php echo esc_url(get_permalink());?>?add-to-cart=230310" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">Subscribe</a>
			</div>
		</div>
	</div>
	<!--/ Main Banner -->
	<!--/ Section Features -->
<?php get_footer(); ?>
<?php wp_footer( );?>
</body>
</html>