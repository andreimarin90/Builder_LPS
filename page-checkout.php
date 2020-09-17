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

<body <?php body_class('checkout-page')?>>

<?php

/*
Template Name: Page Checkout
*/
?>

<!-- Checkout Form -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Checkout Form</h4>
			</div>

			<div class="modal-body">
				<form id="checkout-form" class="checkout-form" action="/checkout" method="post">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-field first_name">
								<input class="form-control" type="text" data-recurly="first_name" placeholder="First Name">
								<div class="error"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-field last_name">
								<input class="form-control" type="text" data-recurly="last_name" placeholder="Last Name">
								<div class="error"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-field number">
								<div class="form-control" id="recurly-cardNumber"></div>
								<div class="error"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-field month">
								<div class="form-control" id="recurly-cardMonth"></div>
								<div class="error"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-field year">
								<div class="form-control" id="recurly-cardYear"></div>
								<div class="error"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-field">
								<div class="form-control" id="recurly-cardCvv"></div>
								<div class="error"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-field postal_code">
								<input class="form-control" type="text" data-recurly="postal_code" placeholder="Postal Code">
								<div class="error"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-field country">
								<input class="form-control" type="text" data-recurly="country" placeholder="Country">
								<div class="error"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-field city">
								<input class="form-control" type="text" data-recurly="city" placeholder="City">
								<div class="error"></div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-field address1">
								<input class="form-control" type="text" data-recurly="address1" placeholder="Address">
								<div class="error"></div>
							</div>
						</div>
					</div>

					<div class="row">
						<!--<div class="col-sm-6">
							<select class="form-control" id="templatesList"></select>
						</div>-->
					</div>









					<!-- Recurly.js will update this field automatically -->
					<input type="hidden" name="recurly-token" data-recurly="token">

					<button class="btn">submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!--/ Checkout Form -->

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
					<div class="pricing-item active">
						<div class="item-badge">special intro pricing</div>
						<h2 class="item-name">Bronze</h2>
						<div class="item-price"><sup>$</sup>19<sup>.99</sup></div>
						<div class="item-description">Per month</div>

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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn" data-plan="bronz">Choose</a>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6">
					<div class="pricing-item">
						<div class="item-badge">best choice</div>
						<h2 class="item-name">Silver</h2>
						<div class="item-price"><sup>$</sup>99<sup>.99</sup></div>
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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn" data-plan="silver">Choose</a>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-12">
					<div class="pricing-item">
						<div class="item-badge">best choice</div>
						<h2 class="item-name">Gold</h2>
						<div class="item-price"><sup>$</sup>249<sup>.99</sup></div>
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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn" data-plan="gold">Choose</a>
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

<?php wp_footer( );?>

</body>
</html>
