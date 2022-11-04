<?php

/*
Template Name: Page Checkout
*/

use Recurly\Service\SubscriptionService;

$currentSubscription     = SubscriptionService::getUserSubscription( wp_get_current_user() );
$currentSubscriptionCode = $currentSubscription !== null ? $currentSubscription->getPlanCode() : null;

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

<body <?php body_class('checkout-page')?>>

<!-- Checkout Form -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-overlay">
				<a class="overlay-close" href="#"></a>
				<div class="loader"></div>
				<div class="message hidden"></div>
			</div>

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Plan name: <span></span></h4>
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

                    <?php if (is_user_logged_in() === false) {?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-field password">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-field rpassword">
                                    <input class="form-control" type="password" name="rpassword" placeholder="Confirm Your Password">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-field nickname">
                                    <input class="form-control" type="text" name="nickname" placeholder="Nickname">
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-field email">
                                    <input class="form-control" type="text" name="email" placeholder="Email">
                                    <div class="error"></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
							<div class="form-field cvv">
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
								<select class="form-control" data-recurly="country" placeholder="Country">
                                    <?php foreach(getCountries() as $slug => $country) : ?>
                                        <option value="<?= $slug ?>"><?= $country ?></option>
                                    <?php endforeach; ?>
                                </select>
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

                    <!--<div class="message"></div>-->
					<input type="hidden" name="recurly-token" data-recurly="token">
                    <input type="hidden" name="subscription-plan">
					<button class="btn">submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!--/ Checkout Form -->

<!-- Change Plan Form -->
<div class="modal fade" id="changePlanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
			<div class="modal-overlay">
				<div class="loader"></div>
				<div class="message hidden"></div>
			</div>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changePLanModalLabel">Plan name: <span></span></h4>
            </div>

            <div class="modal-body">
                <form id="change-plan-form" class="checkout-form" action="/checkout" method="post">
                    <!--<div class="message"></div>-->
                    <input type="hidden" name="subscription-plan">
                    <button class="btn">Switch to Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Change Plan Form -->

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
							<a href="#"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_BRONZE && $currentSubscription->isActive() ? 'disabled' : '' ?>"
                               data-plan="<?= RecurlySubscription::SUBSCRIPTION_BRONZE ?>">
                                <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_BRONZE && $currentSubscription->isCanceled() ? 'Reactivate' : 'Choose' ?>
                            </a>
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
							<a href="#"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_SILVER && $currentSubscription->isActive() ? 'disabled' : '' ?>"
                               data-plan="<?= RecurlySubscription::SUBSCRIPTION_SILVER ?>">
                                <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_SILVER && $currentSubscription->isCanceled() ? 'Reactivate' : 'Choose' ?>
                            </a>
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
							<a href="#"
                               class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_GOLD && $currentSubscription->isActive() ? 'disabled' : '' ?>"
                               data-plan="<?= RecurlySubscription::SUBSCRIPTION_GOLD ?>">
                                <?= $currentSubscriptionCode === RecurlySubscription::SUBSCRIPTION_GOLD && $currentSubscription->isCanceled() ? 'Reactivate' : 'Choose' ?>
                            </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ Section Pricing -->

<?php wp_footer( );?>

</body>
</html>
