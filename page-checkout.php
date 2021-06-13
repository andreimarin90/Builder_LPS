<?php
/*
Template Name: Page Checkout
*/
$currentSubscription = \Recurly\Service\SubscriptionService::getCurrentUserSubscriptionCode();
$userData = getUserData();
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

<!--TODO::move it to my-account START-->
<?php $account = (new \Recurly\Service\AccountService())->getAccount(wp_get_current_user()) ?>
<?php $accountBillingInfo = $account->getBillingInfo() ?>
<?php $billingAddress = $accountBillingInfo->getAddress() ?>
<?php $accountPaymentMethod = $accountBillingInfo->getPaymentMethod() ?>
<?php $accountBalance = (new \Recurly\Service\AccountBalanceService())->getBalance(wp_get_current_user()) ?>
<?php $subscriptions = (new \Recurly\Service\SubscriptionService)->getUserSubscriptionData(wp_get_current_user()) ?>
<?php $invoices = (new \Recurly\Service\InvoiceService())->getUserRecurlyInvoices(wp_get_current_user()) ?>
<div class="recurly-account-container">
    <div class="row">
        <div class="col-sm-8">
            <!-- Subscriptions -->
            <section class="section">
                <h2 class="section-title">Subscriptions</h2>

                <div class="section-panel">
                    <?php foreach ($subscriptions as $subscription) { ?>
                        <div class="subscription-item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <h4 class="subscription-name"><span class="status-tooltip status-<?= $subscription->getState() ?>" data-toggle="tooltip" data-title="<?= ucfirst( $subscription->getState() ) ?>"></span><?= ucfirst($subscription->getPlan()->getCode()) ?></h4>
                                </div>

                                <div class="col-sm-5 text-right">
                                    <a href="#"
                                       class="link"
                                       data-toggle="modal"
                                       data-target="#cancelSubscriptionModal"
                                       data-subscription-ends="<?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getCurrentPeriodEndsAt(), true) ?>"
                                       data-subscription-id="<?= $subscription->getId() ?>">Cancel Subscription</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="subscription-info">
                                        <table class="table">
                                            <tbody><tr>
                                                <th>Current Period</th>
                                                <td><?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getCurrentPeriodStartedAt()) ?> - <?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getCurrentPeriodEndsAt()) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Term Behavior</th>
                                                <?php if($subscription->getAutoRenew()) { ?>
                                                    <td>Auto-Renewing</td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th>Collection</th>
                                                <td>Automatic</td>
                                            </tr>
                                            <tr>
                                                <th>Renews On</th>
                                                <td><?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getCurrentPeriodEndsAt(), true) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Started On</th>
                                                <td><?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getActivatedAt(), true) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Latest Invoice</th>
                                                <?php foreach ($invoices as $invoice) { ?>
                                                    <td>
                                                        <a href="#"
                                                           class="show-invoice"
                                                           data-invoice-id="<?= $invoice->getId() ?>"
                                                           data-invoice-number="<?= $invoice->getNumber() ?>">#<?= $invoice->getNumber() ?>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="table-bg-gray">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th colspan="2">
                                                        Next invoice on <?= \Recurly\Helper\RecurlyHelper::convertDate($subscription->getCurrentPeriodEndsAt()) ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <span class="quantity"><?= $subscription->getQuantity() ?> x </span>
                                                        <?= ucfirst($subscription->getPlan()->getCode()) ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <span class="price"><?= $subscription->getSubtotal() ?>
                                                            <span class="price-currency"> <?= $subscription->getCurrency() ?></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="hr" colspan="2"></td>
                                                </tr>
                                                <tr>
                                                    <th>Current Total</th>
                                                    <th class="text-right">
                                                        <span class="price"><?= $subscription->getSubtotal() ?>
                                                            <span class="price-currency"> <?= $subscription->getCurrency() ?></span>
                                                        </span>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <!--/ Subscriptions -->

            <!-- Invoices -->
            <section class="section">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="section-title">Invoices</h2>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="#" class="link" data-open-section="#recurly-account-invoices">All Invoices</a>
                    </div>
                </div>

                <div class="section-panel">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Issued On</th>
                                <th>Due On</th>
                                <th>Status</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $invoice) { ?>
                                <tr>
                                    <td>
                                        <a href="#"
                                           class="show-invoice"
                                           data-invoice-id="<?= $invoice->getId() ?>"
                                           data-invoice-number="<?= $invoice->getNumber() ?>">#<?= $invoice->getNumber() ?>
                                        </a>
                                    </td>
                                    <td>
	                                    <?= \Recurly\Helper\RecurlyHelper::convertDate($invoice->getCreatedAt()) ?>
                                    </td>
                                    <td>
	                                    <?= \Recurly\Helper\RecurlyHelper::convertDate($invoice->getDueAt()) ?>
                                    </td>
                                    <td>
                                        <?= ucfirst($invoice->getState()) ?>
                                    </td>
                                    <td class="text-right">
                                        <span class="price"><?= $invoice->getSubtotal() ?>
                                            <span class="price-currency"> <?= $invoice->getCurrency() ?></span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="#"
                                           class="pdf download-invoice"
                                           data-invoice-id="<?= $invoice->getId() ?>"
                                           data-invoice-number="<?= $invoice->getNumber() ?>">
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <!--/ Invoices -->
        </div>

        <div class="col-sm-4">
            <!-- Account Balance -->
            <section class="section margin-top-50">
                <div class="section-panel">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Account Balance</th>
                            <?php
                            /** @var \Recurly\Resources\AccountBalanceAmount $balance */
                            foreach ($accountBalance->getBalances() as $balance) { ?>
                                <td class="text-right">
                                    <span class="price"><?= $balance->getAmount() ?>
                                        <span class="price-currency">
                                            <?= $balance->getCurrency() ?>
                                        </span>
                                    </span>
                                </td>
                            <?php } ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <!--/ Account Balance -->

            <!-- Billing Information -->
            <section class="section">
                <div class="row">
                    <div class="col-sm-9">
                        <h2 class="section-title">Billing Information</h2>
                    </div>

                    <div class="col-sm-3 text-right">
                        <a href="#" class="link" data-open-section="#recurly-account-billing-info">Edit</a>
                    </div>
                </div>

                <div class="section-panel">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <td><?= $accountBillingInfo->getFirstName() ?> <?= $accountBillingInfo->getLastName() ?></td>
                        </tr>
                        <tr>
                            <th>Credit Card</th>
                            <td>
                                <div class="PaymentInfo">
                                    <div class="PaymentInfo-icon PaymentInfo-icon--<?= $accountPaymentMethod->getCardType() ?>"></div>
                                    <div class="PaymentInfo-identifier fs-exclude PaymentInfo-identifier--reduced"><?= $accountPaymentMethod->getLastFour() ?></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Expiration</th>
                            <td><?= $accountPaymentMethod->getExpMonth() ?>/<?= $accountPaymentMethod->getExpYear() ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                <?= $billingAddress->getStreet1() ?>
                                <br>
                                <?= $billingAddress->getCity() ?>
                                <?= $billingAddress->getRegion() ?>
                                <?= $billingAddress->getPostalCode() ?>
                                <br>
                                Locale::getDisplayregion('-' . $billingAddress->getCountry())
                            </td>
            <!--/ Billing Information -->

            <select class="select-panel select-simple">
                <option selected disabled>Need To Change Payment Method?</option>
                <option value="1">Bank Account</option>
                <option value="2">Credit Card</option>
            </select>
        </div>
    </div>
</div>
<!--TODO::move it to my-account END-->

<?php /** @var \Recurly\Resources\Invoice $invoice */ ?>
<?php $invoice = $invoices->getFirst() ?>
<?php $invoiceAddress = $invoice->getAddress() ?>
<!-- Recurly Account Single Invoice -->
<div id="recurly-account-single-invoice" class="account-content-section account-content-subsection dynamic">
    <div class="subsection-inner">
        <a href="#" class="subsection-close" data-close-account-subsection></a>

        <div class="recurly-account-container">
            <div class="row">
                <div class="col-sm-8">
                    <section class="section margin-bottom-0">
                        <h2 class="section-title">Invoice #<?= $invoice->getNumber() ?> <a class="pdf" data-toggle="tooltip" data-title="Download PDF" href="#"></a></h2>

                        <div class="section-panel">
                            <!-- Invoice -->
                            <div class="recurly-invoice">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="invoice-box merchant">
                                            <h4 class="title">CodeCrew LLC</h4>
                                            <div class="description">
                                                Alexander J Melone CodeCrew LLC 5527 Shattuck Avenue 305<br/>
                                                Oakland, CA 94609<br/>
                                                United States<br/>
                                                Email: crew@codecrew.us
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="invoice-box summary">
                                            <h4 class="title">Invoice</h4>
                                            <dl>
                                                <dt>Invoice #</dt>
                                                <dd><?= $invoice->getNumber() ?></dd>
                                                <dt>Billed On</dt>
                                                <dd><?= \Recurly\Helper\RecurlyHelper::convertDate( $invoice->getClosedAt() ) ?></dd>
                                                <dt>Terms</dt>
                                                <dd>On-Receipt</dd>
                                                <dt>Due On</dt>
                                                <dd><?= \Recurly\Helper\RecurlyHelper::convertDate( $invoice->getDueAt() ) ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="invoice-box recipient">
                                            <div class="title">Bill To</div>
                                            <div class="description">
	                                            <?= sprintf( '%s %s<br/>%s<br/>%s %s<br/>%s',
	                                                         $invoiceAddress->getFirstName(),
	                                                         $invoiceAddress->getLastName(),
	                                                         $invoiceAddress->getStreet1(),
	                                                         $invoiceAddress->getCity(),
	                                                         $invoiceAddress->getPostalCode(),
	                                                         Locale::getDisplayregion( '-' . $billingAddress->getCountry() )
	                                            ) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="overview">
                                            <div class="overview-row clearfix">
                                                <div class="status status-<?= $invoice->getState() ?>"><?= $invoice->getState() ?></div>
                                                <div class="date">on <?= $invoice->getClosedAt() ?></div>
                                            </div>
                                            <div class="overview-row">
                                                <div class="amount"><?= $invoice->getSubtotal() ?> <span class="currency"><?= $invoice->getCurrency() ?></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th class="text-right">Qty</th>
                                        <th class="text-right">Price</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php /** @var \Recurly\Resources\LineItem $item */ ?>
                                    <?php foreach ($invoice->getLineItems() as $item) { ?>
                                        <tr>
                                            <td style="min-width: 4rem;">
                                                <?= sprintf('%s - %s',
                                                            \Recurly\Helper\RecurlyHelper::convertDate( $item->getStartDate() ),
                                                            \Recurly\Helper\RecurlyHelper::convertDate( $item->getEndDate() )
                                                ) ?>
                                            </td>
                                            <td style="max-width: 14rem; min-width: 7rem;"><?= $item->getDescription() ?></td>
                                            <td class="text-right" style="min-width: 3rem"><?= $item->getQuantity() ?></td>
                                            <td class="text-right" style="min-width: 5rem"><?= $item->getUnitAmount() ?></td>
                                            <td class="text-right" style="min-width: 5rem"><?= $item->getSubtotal() ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-7">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td class="text-right"><?= $invoice->getSubtotal() ?></td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <strong>Total</strong>
                                                </th>
                                                <td class="text-right">
                                                    <strong><?= $invoice->getTotal() ?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Paid</th>
                                                <td class="text-right"><?= $invoice->getPaid() ?></td>
                                            </tr>
                                            <tr class="balance-amount">
                                                <th>Amount Due</th>
                                                <td class="text-right"><?= $invoice->getBalance() ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <ul class="notes">
                                    <li>
                                        <div class="note-title">Payments</div>
                                        <div class="note-content">
                                            <table>
                                                <tbody>
                                                <?php /** @var \Recurly\Resources\Transaction $transaction */ ?>
                                                <?php foreach ($invoice->getTransactions() as $transaction) { ?>
                                                    <tr>
                                                        <th><?= \Recurly\Helper\RecurlyHelper::convertDate( $transaction->getCreatedAt() ) ?></th>
                                                        <td><?= sprintf( '$19.99 Payment from %s ··· %s',
	                                                                     $transaction->getAmount(),
	                                                                     $transaction->getPaymentMethod()->getCardType(),
	                                                                     $transaction->getPaymentMethod()->getLastFour()
		                                                    ) ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="note-title">Notes</div>
                                        <div class="note-content">All amounts in <?= $invoice->getCurrency() ?></div>
                                    </li>
                                </ul>
                            </div>
                            <!--/ Invoice -->
                        </div>
                    </section>
                </div>

                <div class="col-sm-4">
                    <section class="section margin-top-50">
                        <div class="section-panel">
                            <div class="invoice-summary">
                                <div class="amount-due">
                                    <div class="title">Amount Due</div>
                                    <div class="description">$0.00 <span>USD</span></div>
                                </div>

                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                    </tr>
                                    <tr>
                                        <td>Paid</td>
                                        <td>10 Feb 2021</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="section-panel">
                            <div class="payment-history">
                                <h4 class="title">Payment History</h4>

                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>10 Feb 2021</th>
                                        <td><span class="price">$19.99<span class="price-currency"> USD</span></span> Payment from Visa ··· 1111</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Recurly Account Single Invoice -->

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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscription === RecurlySubscription::SUBSCRIPTION_BRONZE ? 'disabled' : '' ?>" data-plan="<?= RecurlySubscription::SUBSCRIPTION_BRONZE ?>">Choose</a>
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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscription === RecurlySubscription::SUBSCRIPTION_SILVER ? 'disabled' : '' ?>" data-plan="<?= RecurlySubscription::SUBSCRIPTION_SILVER ?>">Choose</a>
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
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn <?= $currentSubscription === RecurlySubscription::SUBSCRIPTION_GOLD ? 'disabled' : '' ?>" data-plan="<?= RecurlySubscription::SUBSCRIPTION_GOLD ?>">Choose</a>
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
