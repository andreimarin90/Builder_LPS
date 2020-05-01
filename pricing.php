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

<body <?php body_class('landing-page')?>>

<?php 

/*
Template Name: Pricing
*/ 
$is_template = (isset($_GET['buy']) && !empty($_GET['buy']));
?>

	<?php require_once('theme_includes/header_nav.php'); ?>
	<!-- Main Banner -->
	<div class="main-header big style3" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/bg-4.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-sm-7">
					<h1 class="header-title">Want more modules? <br/><em>Subscribe now!</em></h1>
					<div class="header-description">
						With over <strong>500 completely different modules</strong>, <strong>16 ready-made templates</strong> and
						<strong>access to our drag&drop builder</strong>, Connections is going to set a new standard of expectations for you.
					</div>
					<div class="header-buttons">
						<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">Subscribe</a>
					</div>
				</div>
			</div>
		</div>

		<div class="header-image">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/temp/main-header2.png" alt=""/>
		</div>
	</div>
	<!--/ Main Banner -->

	<!-- Section Go Pro 2 -->
	<section class="section section-gopro2 no-padding" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/gopro-bg.png);">
		<div class="flex-container">
			<div class="section-image">
				<ul class="features">
					<li class="active"><span>DRAG&DROP MODULES</span></li>
					<li><span>TEMPLATES</span></li>
					<li><span>EXPORT</span></li>
					<li><span>SAVE</span></li>
					<li><span>LOAD</span></li>
					<li><span>PREVIEW</span></li>
					<li><span>MY ACCOUNT</span></li>
					<li><span>LOG IN</span></li>
					<li><span>DOCUMENTATION</span></li>
					<li><span>PURCHASE</span></li>
				</ul>

				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/temp/gopro2.png" alt=""/>
			</div>

			<div class="section-content">
				<div class="section-header">
					<div class="section-pre-title left"><span>SUBSCRIPTION BENEFITS</span></div>
					<h2 class="section-title">Why <em>Go Pro?</em></h2>

					<div class="section-description">
						<p>
							Increasing engagement rates requires serious creativity. Industry experts recommend a 33% promotional content ratio,
							while the other 77% need to give your customers a good reason to keep following your brand. This can be anything
							from freebies to valuable content.
						</p>
					</div>
				</div>

				<ul class="list">
					<li><span>Twice the number of dragable modules;</span></li>
					<li><span>An additionat 10 premade templates;</span></li>
					<li><span>Unlimited support access during your subscription;</span></li>
					<li><span>Twice the number of dragable modules;</span></li>
					<li><span>An additionat 10 premade templates;</span></li>
					<li><span>Unlimited support access during your subscription;</span></li>
					<li><a href="#">Click here to contact us for more details.</a></li>
				</ul>
			</div>
		</div>
	</section>
	<!--/ Section Go Pro 2 -->

	<!-- Section CTA -->
	<section class="section section-cta style3" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/section-cta-bg2.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="flex-container">
						<div class="column-left">
							<h2 class="section-title">Unlock all modules & options <em>now!</em></h2>
							<div class="section-description">
								According to your pricing plan you can access many more modules and ready-made layouts in seconds.
							</div>
						</div>

						<div class="column-right">
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">Subscribe</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ Section CTA -->

	<!-- Section Pricing -->
	<section class="section section-pricing">
		<div class="container">
			<div class="section-header text-center">
				<div class="section-pre-title"><span>AFFORDABLE PLANS</span></div>
				<h2 class="section-title">Atractive <em>pricing plan!</em></h2>

				<div class="section-description">
					<p>
						<strong>50% off</strong> for the first 500 subscribers! A limited number of subscribers can enjoy a huge discount for life.
						You will be paying <strong class="color-green">$7.50</strong> instead of <strong>$14</strong> if you are lucky enough to be among
						the first 500 subscribers. Save up to <strong class="color-green">$90</strong> per year and access unlimited ways to boost
						your marketing campaigns!
					</p>
				</div>
			</div>
		</div>

		<div id="pricing" class="pricing-plans">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6">
						<div class="pricing-item">
							<div class="item-badge">best choice</div>
							<h2 class="item-name">Free</h2>
							<div class="item-price"><sup>$</sup>0</div>
							<div class="item-description">100% free forever</div>

							<ul class="item-features">
								<li>Free forever</li>
								<li>15 test modules</li>
								<li>No new modules</li>
								<li>No support</li>
								<li>No new templates</li>
								<li>Unlimited exports</li>
								<li>No private conversation</li>
							</ul>

							<div class="buttons">
								<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn">Choose</a>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6">
						<div class="pricing-item">
							<div class="item-badge">best choice</div>
							<h2 class="item-name">Standard</h2>
							<div class="item-price"><sup>$</sup>20</div>
							<div class="item-description">Per month</div>

							<ul class="item-features">
								<li>One time fee</li>
								<li>200 modules</li>
								<li>No new modules</li>
								<li>6 months of support</li>
								<li>No new templates</li>
								<li>Unlimited exports</li>
								<li>No private conversation</li>
							</ul>

							<div class="buttons">
								<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn">Choose</a>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-12">
						<div class="pricing-item active">
							<div class="item-badge">best choice</div>
							<h2 class="item-name">PRO</h2>
							<div class="item-price"><sup>$</sup>10</div>
							<div class="item-description">Per month</div>

							<ul class="item-features">
								<li>Monthly subscription fee</li>
								<li>+800 modules</li>
								<li>New modules every week</li>
								<li>Continuous support</li>
								<li>1 new template per month</li>
								<li>Unlimited exports</li>
								<li>10 minutes private talk</li>
							</ul>

							<div class="buttons">
							<?php
								//$current_user_id = get_current_user_id();
								//update_option("bbt_".$current_user_id."_license_builder", "");
								//update_user_option( $current_user_id, 'payment_info', '');
								//bbtb_pricing_button($is_template);
							?>
                                <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn">Choose</a>
							</div>
						</div>
					</div>

					<?php if(!is_user_logged_in()): ?>
						<div class="col-md-6 col-sm-6">
							<?php get_template_part('login', 'form');?>
						</div>
					<?php else: ?>
						<?php //if(is_bbtb_child_items_exists() && bbtb_child_check_valid_user_key() != 'yes'):?>
							<div class="col-md-12 col-sm-12">
								<?php get_template_part('validate', 'token'); ?>
							</div>
						<?php //elseif(isset($_GET['token']) && !empty($_GET['token']) && $is_template):?>
							<div class="bbt-start-subscription">
								<div class="col-md-12 col-sm-12">
									<?php //bbt_start_subscription($_GET['buy']); ?>
								</div>
							</div>
						<?php //endif; ?>
					<?php endif;?>

				</div>
			</div>
		</div>
	</section>
	<!--/ Section Pricing -->

	<?php get_footer(); ?>

	<!-- JS Section -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-xxxx-xx', 'auto');
    ga('send', 'pageview');

</script>
    <?php wp_footer( );?>



</body>
</html>