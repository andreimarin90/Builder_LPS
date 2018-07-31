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
Template Name: Woocommerce Template
*/ 
?>
<body>

	<?php require_once('theme_includes/header_nav.php'); ?>

	<!-- Main Banner -->
	<div class="main-header" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/bg-1.jpg);">
		<div class="header-inner">
			<div class="header-pre-title"><span>THE BEST IN THE INDUSTRY</span></div>
			<h1 class="header-title">Drag&Drop Email Builder</h1>
			<div class="header-description">
				Use our drag&drop tools to easily customize your next email template.
				Export the code and use it with any Email sending service to engage your clients.
			</div>
			<div class="header-buttons">
				<a href="https://themeforest.net/item/kahuna-giant-multipurpose-email-builder-access/15158486" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">BUY NOW</a>
			</div>
		</div>
	</div>
	<!--/ Main Banner -->

	<!-- Section Features -->
	<section class="section section-features" id="features">
			<?php the_content(); ?>
	</section>
	<!--/ Section Features -->
<?php get_footer(); ?>
<?php wp_footer( );?>
</body>
</html>