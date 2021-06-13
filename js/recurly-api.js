jQuery(document).ready(function($) {
	const   recurlyPublicApiKey = 'ewr1-zt3dc3P4KgI3lmRgmvquit',
			templateList 		= bbt_script_vars.templateList,
			templateListNode 	= $('#templatesList'),
			checkoutForm 		= $('#checkout-form'),
			checkoutModal 		= $('#checkoutModal'),
			changePlanModal  	= $('#changePlanModal'),
			isUserLoggedIn 		= bbt_script_vars.isUserLoggedIn,
			firstName			= bbt_script_vars.firstName,
		    lastName			= bbt_script_vars.lastName,
			nickName			= bbt_script_vars.nickName,
			email				= bbt_script_vars.email,
			zip				    = bbt_script_vars.zip,
			countryId    		= bbt_script_vars.countryId,
			city				= bbt_script_vars.city,
			address				= bbt_script_vars.address,
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

		if(!hasActiveSubscription) {
			checkoutModal.find('[name="subscription-plan"]').val(planCode);
			checkoutModal.find('.first_name input').val(firstName);
			checkoutModal.find('.last_name input').val(lastName);
			checkoutModal.find('.nickname input').val(nickName);
			checkoutModal.find('.email input').val(email);
			checkoutModal.find('.postal_code input').val(zip);
			checkoutModal.find('.city input').val(city);
			checkoutModal.find('.address1 input').val(address);
			checkoutModal.find('.country select').attr('selected', 'selected');
			checkoutModal.find('.modal-title span').text(planCode);
			checkoutModal.modal('show');
		} else {
			changePlanModal.find('[name="subscription-plan"]').val(planCode);
			changePlanModal.find('.modal-title span').text(planCode);
			changePlanModal.modal('show');
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

	function sendToServer(params, overlay, loader, messageNode) {
		loader.removeClass('hidden');
		messageNode.addClass('hidden').removeClass('success error');

		$.ajax({
			type: 'POST',
			url: bbt_script_vars.ajaxUrl,
			data: params,
			dataType: "json",
			beforeSend : function () {
				//TODO::some waiting modal or loading animation
			},
			success: function (response) {
				loader.addClass('hidden');

				if(parseInt(response.code) === successCode) {
					messageNode.html('Success!!!').addClass('success').removeClass('hidden');
				} else {
					messageNode.html(response.message).addClass('error').removeClass('hidden');
				}
			},
			complete : function () {
				setTimeout(function () {
					//location.reload();
					overlay.removeClass('active');
				}, 4000);
			},
			error: function (error) {
				console.log(error);
				loader.addClass('hidden');
				messageNode.html(error.statusText).addClass('error').removeClass('hidden');
				setTimeout(function () {
					overlay.removeClass('active');
				}, 4000);
			}
		});
	}

	checkoutForm.on('submit', function (event) {
		event.preventDefault();

		let form = $(this),
			overlay = form.closest('.modal').find('.modal-overlay'),
			loader = overlay.find('.loader'),
			messageNode = overlay.find('.message');

		overlay.addClass('active');
		loader.removeClass('hidden');
		messageNode.addClass('hidden');

		recurly.token(elements, form, function (err, token) {
			if (err) {
				showErrors(err);
				overlay.removeClass('active');
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

			sendToServer(params, overlay, loader, messageNode);
		});
	});

	changePlanModal.on('submit', function (event) {
		event.preventDefault();

		let form = $(this),
			overlay = form.closest('.modal').find('modal-overlay'),
			loader = overlay.find('.loader'),
			messageNode = overlay.find('.message');

		overlay.addClass('active');

		let params = {
			action 		: 'bbtb_subscribe_current_user',
			planCode	: form.find('[name="subscription-plan"]').val(),
		};

		sendToServer(params, overlay, loader, messageNode);
	});

	$('.overlay-close').on('click', function() {
		$(this).closest('.modal-overlay').removeClass('active');
	});
});
