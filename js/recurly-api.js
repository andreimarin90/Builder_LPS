jQuery(document).ready(function($) {
	var recurlyPublicApiKey = 'ewr1-zt3dc3P4KgI3lmRgmvquit',
		templateList = bbt_script_vars.templateList;

	recurly.configure(recurlyPublicApiKey);

	const elements = recurly.Elements();

	//const cardElement = elements.CardElement();
	const cardNumberElement = elements.CardNumberElement({
		style: {
			placeholder: {
				content: 'Card Number'
			}
		}
	});

	const cardMonthElement = elements.CardMonthElement({
		style: {
			placeholder: {
				content: 'Expiry Month'
			}
		}
	});

	const cardYearElement = elements.CardYearElement({
		style: {
			placeholder: {
				content: 'Expiry Year'
			}
		}
	});

	const cardCvvElement = elements.CardCvvElement({
		style: {
			placeholder: {
				content: 'CVV'
			}
		}
	});

	cardNumberElement.attach('#recurly-cardNumber');
	cardMonthElement.attach('#recurly-cardMonth');
	cardYearElement.attach('#recurly-cardYear');
	cardCvvElement.attach('#recurly-cardCvv');

	const templateListNode = $('#templatesList');

	$.each(templateList, function(index, value) {
		templateListNode.append('<option value="' + index + '">' + value + '</option>');
	});

	var checkoutForm = $('#checkout-form');
	var planName = '';

	const checkoutPricing = recurly.Pricing.Checkout();

	$('[data-plan]').on('click', function() {
		planName = $(this).data('plan');

		checkoutPricing
			.subscription(recurly.Pricing.Subscription()
				.plan(planName, { quantity: 1 })
				.catch(function (err) {
					// err.code
				})
				.done()
			)
			.catch(function (err) {
				// err.code
			})
			.done(function (price) {
				// price object as emitted by 'change' event
			});

		$('#checkoutModal').modal('show');
	});

	function showErrors(data) {
		checkoutForm.find('.form-field').find('.error').text('');

		$.each(data.details, function(index, el) {
			checkoutForm.find('.' + el.field).find('.error').text(el.messages[0]);
		});
	}

	document.querySelector('#checkout-form').addEventListener('submit', function (event) {
		const form = this;
		event.preventDefault();

		recurly.token(elements, form, function (err, token) {
			if (err) {
				showErrors(err);
			} else {
				// recurly.js has filled in the 'token' field, so now we can submit the
				// form to your server

				checkoutForm.find('.form-field').find('.error').text('');
				console.log(token.id); //"BCdTz8BB3r3zMZ2Id8rwBg"
				console.log(token.type); //"credit_card"

				$.ajax({
					type: checkoutForm.attr('method'),
					url: checkoutForm.attr('action'),
					data: {token_id: token.id, plan_code: planName},
					dataType: "json",
					contentType: "application/json; encoding=utf-8",
					success: function (response) {


						console.log(response);


					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});
	});























});
