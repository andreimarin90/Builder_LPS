jQuery(document).ready(function($) {
	const 	recurlyPublicApiKey = 'ewr1-zt3dc3P4KgI3lmRgmvquit',
		  	templateList = bbt_script_vars.templateList,
			templateListNode = $('#templatesList'),
			checkoutForm = $('#checkout-form'),
			checkoutModal = $('#checkoutModal'),
			isUserLoggedIn = bbt_script_vars.isUserLoggedIn,
			errorCode = 1,
			successCode = 0;

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

		checkoutModal.modal('show');
		checkoutModal.find('[name="subscription-plan"]').val(planCode);
	});

	function showErrors(data) {
		checkoutForm.find('.form-field').find('.error').text('');

		$.each(data.details, function(index, el) {
			checkoutForm.find('.' + el.field).find('.error').text(el.messages[0]);
		});
	}

	checkoutForm.on('submit', function (event) {
		event.preventDefault();
		let form = $(this),
			submitButton = form.find('button.btn'),
			errorMessageNode = form.find('.error-message p');

		submitButton.toggleClass('disabled', true);

		recurly.token(elements, form, function (err, token) {
			if (err) {
				showErrors(err);
				submitButton.toggleClass('disabled', false);
				return;
			}
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
			};

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
						checkoutModal.modal('hide');
						return;
					}
					errorMessageNode.html(response.message);
				},
				complete : function () {
					submitButton.toggleClass('disabled', false);
				},
				error: function (error) {
					console.log(error);
				}
			});
		});
	});
});
