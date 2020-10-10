jQuery(document).ready(function($) {
	const   recurlyPublicApiKey = 'ewr1-zt3dc3P4KgI3lmRgmvquit',
			templateList 		= bbt_script_vars.templateList,
			templateListNode 	= $('#templatesList'),
			checkoutForm 		= $('#checkout-form'),
			checkoutModal 		= $('#checkoutModal'),
			changePlanModal  	= $('#changePlanModal'),
			isUserLoggedIn 		= bbt_script_vars.isUserLoggedIn,
			hasActiveSubscription = bbt_script_vars.hasActiveSubscription,
		    currentSubscription = bbt_script_vars.currentSubscription,
			errorCode 			= 1,
			successCode 		= 0;

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

	$.each(templateList, function(index, value) {
		templateListNode.append('<option value="' + index + '">' + value + '</option>');
	});

	$('[data-plan]').on('click', function() {
		let planCode = $(this).data('plan');
		if(hasActiveSubscription === false) {
			checkoutModal.modal('show');
			checkoutModal.find('[name="subscription-plan"]').val(planCode);
		} else {
			changePlanModal.modal('show');
			changePlanModal.find('[name="subscription-plan"]').val(planCode);
		}
	});

	function showErrors(data) {
		checkoutForm.find('.form-field').removeClass('has-error');
		setTimeout(function() {
			checkoutForm.find('.form-field').removeClass('has-error').find('.error').text('');

			$.each(data.details, function(index, el) {
				checkoutForm.find('.' + el.field).addClass('has-error').find('.error').text(el.messages[0]);
			});
		}, 200);
	}

	function sendToServer(params, successMessageNode, errorMessageNode, submitButton) {
		$.ajax({
			type: 'POST',
			url: bbt_script_vars.ajaxUrl,
			data: params,
			dataType: "json",
			beforeSend : function () {
				//TODO::some waiting modal or loading animation
			},
			success: function (response) {
				if(parseInt(response.code) === successCode) {
					successMessageNode.html('Success!!!')
				} else {
					errorMessageNode.html(response.message);
				}
			},
			complete : function () {
				submitButton.toggleClass('disabled', false);
				setTimeout(function () {
					location.reload();
				}, 2000);
			},
			error: function (error) {
				console.log(error);
			}
		});
	}

	checkoutForm.on('submit', function (event) {
		event.preventDefault();
		let form = $(this),
			submitButton = form.find('button.btn'),
			successMessageNode = form.find('.success-message p'),
			errorMessageNode = form.find('.error-message p');

		submitButton.toggleClass('disabled', true);

		recurly.token(elements, form, function (err, token) {
			if (err) {
				showErrors(err);
				submitButton.toggleClass('disabled', false);
				return;
			}
			showErrors([]);

			// recurly.js has filled in the 'token' field, so now we can submit the
			// form to your server

			let params = {
				action 		: isUserLoggedIn ? 'bbtb_subscribe_current_user' : 'bbtb_create_new_subscribed_user',
				tokenId 	: token.id,
				planCode	: form.find('[name="subscription-plan"]').val(),
				email		: form.find('[name="email"]').val(),
				nickname    : form.find('[name="nickname"]').val(),
				firstname	: form.find('[data-recurly="first_name"]').val(),
				lastname 	: form.find('[data-recurly="last_name"]').val(),
				country  	: form.find('[data-recurly="country"]').val(),
				zip   		: form.find('[data-recurly="postal_code"]').val(),
				city		: form.find('[data-recurly="city"]').val(),
				address		: form.find('[data-recurly="address1"]').val(),
				password	: form.find('[name="password"]').val(),
				rpassword	: form.find('[name="rpassword"]').val(),
			};
			sendToServer(params, successMessageNode, errorMessageNode, submitButton);
		});
	});

	changePlanModal.on('submit', function (event) {
		event.preventDefault();
		let form = $(this),
			submitButton = form.find('button.btn'),
			successMessageNode = form.find('.success-message p'),
			errorMessageNode = form.find('.error-message p');

		submitButton.toggleClass('disabled', true);

		let params = {
			action 		: 'bbtb_subscribe_current_user',
			planCode	: form.find('[name="subscription-plan"]').val(),
		};

		sendToServer(params, successMessageNode, errorMessageNode, submitButton);
	});
});
