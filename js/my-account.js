jQuery(document).ready(function($) {
	const   templateList 		= bbt_script_vars.templateList,
			templateListNode 	= $('#templatesList'),
			checkoutForm 		= $('#checkout-form'),
			checkoutModal 		= $('#checkoutModal'),
			changePlanModal  	= $('#changePlanModal'),
			isUserLoggedIn 		= bbt_script_vars.isUserLoggedIn,
			hasActiveSubscription = bbt_script_vars.hasActiveSubscription,
		    currentSubscription = bbt_script_vars.currentSubscription,
			errorCode 			= 1,
			successCode 		= 0;

	$.each(templateList, function(index, value) {
		templateListNode.append('<li data-value="' + index + '">' + value + '</li>');
	});


});
