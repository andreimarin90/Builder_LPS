jQuery(document).ready(function() {
    var $ = jQuery;
	
	$('.js-export-token-form-show').on('click', function(){
		$(this).parents('.export-container.no-purchase-code').hide();
		$('.purchase-code').show();
		
		return false;
	});
	
	jQuery('.btn-paypal-default').on('click', function(){
		var message = jQuery(this).attr('data-message');
		var show_div = jQuery(this).attr('data-div');
		
		if(message.length !== 0) {
			alert(message);
		}
		
		if(show_div.length !== 0) {
			jQuery('.' + show_div).show();
		}	
		
		return false;
	});
	
	//token validation
	$('.bbt-validate-product-key').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var $form = $this.parent('form');
		
		var error_div = $form.siblings('#error-messages-box');
		var success_div = $form.siblings('#success-messages-box');
		error_div.empty().hide(); success_div.empty().hide();
		
		var btn_text = $this.find('.button-content').text();
		var btn_loading_text = $this.attr('data-loading');
		$this.find('.button-content').text(btn_loading_text);
		
		var key_input = $form.find('#paypal-token-id').val();
		var template_slug = $form.find('#paypal-template-slug').attr('value');
		var redirect_url = $form.attr('action');
		
		//check if not empty
		if(key_input.length === 0) {
			error_div.text('Empty Product Key').show();
			$this.find('.button-content').text(btn_text);
			return;
		}
		//check if there is a template slug
		if(template_slug.length === 0) {
			error_div.text('No template slug provided').show();
			$this.find('.button-content').text(btn_text);
			return;
		}
		
		var security = $form.find('#bbtb-security').val();

		$.ajax({
			url: bigbang_ajax.url,
			type: 'POST',
			data: {
				action: 'bbt_validate_paypal_product_key',
				key: key_input,
				security : security,
				template_slug : template_slug
			}
		})
			.done(function(result) {
				//console.log(result);
				var obj = JSON.parse(result);

				$this.find('.button-content').text(btn_text);
				
				if(obj.error === 'no') {	
					$form.hide();				
					success_div.html(obj.text).show();
					//add username in myaccount and export pages
					setTimeout(function(){
						window.location = redirect_url;
					}, 2000);
				}
				else {
					error_div.html(obj.text).show();
				}

			})
			.fail(function(error,message) {
				console.error(error,message);
			});

		return false;
	});
	
	//ajax login
	$('.bbtb-login-form').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var $form = $this.parent('form');
		var btn_text = $this.text();
		
		$this.parent('form').siblings('#error-messages-box').hide();
		$this.parent('form').siblings('#success-messages-box').hide();

		var username = $form.find('#user_login2').val();
		var pass = $form.find('#user_pass2').val();
		var redirect_url = $form.attr('action');
		

		//check if not empty username
		if(username.length === 0)
			$form.find('#user_login2').css('border', '1px solid red');
		else
			$form.find('#user_login2').removeAttr('style');

		//check if not empty username
		if(pass.length === 0)
			$form.find('#user_pass2').css('border', '1px solid red');
		else
			$form.find('#user_pass2').removeAttr('style');

		//if not empty username and pass then maka an ajax request
		if(username.length !== 0 && pass.length !== 0)
		{
			var security = $form.find('#bbtb-security').val();
			
			var btn_loading_text = $this.attr('data-loading');
			$this.text(btn_loading_text);

			$.ajax({
				url: bigbang_ajax.url,
				type: 'POST',
				data: {
					action: 'bbt_paypal_login_form',
					username: username,
					pass : pass,
					security : security
				}
			})
				.done(function(result) {
					//console.log(result);
					var obj = JSON.parse(result);
					
					$this.text(btn_text);

					if(obj.loggedin === 'yes'){
						$form.hide();
						$form.siblings('#success-messages-box').empty().show().text(obj.message);
						//add username in myaccount and export pages
						setTimeout(function(){
							$this.parent('form').siblings('#error-messages-box').hide();
							$this.parent('form').siblings('#success-messages-box').hide();
							window.location.href = redirect_url;
						}, 2000);
					}
					else {
						$form.siblings('#error-messages-box').empty().show().text(obj.message);
					}

				})
				.fail(function(error,message) {
					console.error(error,message);
				});
		}

		return false;
	});
});