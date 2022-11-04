<?php
/*
Template Name: Page My Account
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="canonical" href="<?php the_permalink() ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('my-account-page')?>>

<!-- Section Pricing -->
<section class="section">
	<div class="container">
		<div class="section-header text-center">
			<!--<div class="section-pre-title"><span>AFFORDABLE PLANS</span></div>-->
			<h2 class="section-title">My <em>Account</em></h2>
		</div>

		<form class="choose-templates-form" action="#" method="post">
			<h2 class="form-title">Select up to 6 templates</h2>
			<ul id="templatesList" class="templates-list"></ul>
			<button class="btn mdl-button mdl-js-button mdl-js-ripple-effect" type="submit">Save Selection</button>
		</form>
	</div>
</section>
<!--/ Section Pricing -->

<?php wp_footer( );?>

</body>
</html>
