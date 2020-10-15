jQuery(document).ready(function($) {
	const   templateList 		= bbt_script_vars.templateList,
			templateListNode 	= $('#templatesList'),
			templateSelectionForm 	= $('.choose-templates-form'),
			isUserLoggedIn 		= bbt_script_vars.isUserLoggedIn,
			hasActiveSubscription = bbt_script_vars.hasActiveSubscription,
		    currentSubscription = bbt_script_vars.currentSubscription;

	const checkboxTemplate = function(index, value) {
		return '<li><div class="checkbox"><input type="checkbox" id="' + index + '" name="' + index + '"><label for="' + index + '">' + value + '</label></div></li>';
	};

	$.each(templateList, function(index, value) {
		templateListNode.append(checkboxTemplate(index, value));
	});

	let checkboxes = templateListNode.find('input[type="checkbox"]');

	checkboxes.on('change', function() {
		checkboxes.siblings('label').removeClass('disabled');

		if (checkboxes.filter(':checked').length === 6) {
			checkboxes.not(':checked').siblings('label').addClass('disabled');
		}
	});

	templateSelectionForm.on('submit', function(event) {
		event.preventDefault();

		console.log(templateSelectionForm.serialize());
	});









});
