(function($) {
	$.fn.bbtNavigation1 = function(options) {
		var settings = $.extend({
			animationIn: 'growInBig',
			animationOut: 'growOutBig',
			mobileBreakPoint: 991
		}, options);

		var $body = $('body'),
			$window = $(window),
			screenWidth = $window.width(),
			screenHeight = $window.height();

		$window.on('resized', function() {
			screenWidth = $window.width();
			screenHeight = $window.height();
		});

		this.each(function() {
			var navContainer = $(this),
				navWrapper = navContainer.closest('.header'),
				navItems = navContainer.find('li'),
				prevScrollPosition = 0,
				currentScrollPosition = 0,
				stickyOffset = 0;

			navContainer.find('ul').addClass('hidden');
			navItems.has('ul').addClass('parent');
			navItems.children('a').not('.btn').addClass('menu-link');

			if(!navWrapper.hasClass('transparent')) {
				var placeholder = $('<div class="header-placeholder"/>');

				placeholder.insertAfter(navWrapper);

				$window.on('resized', function() {
					placeholder.css({
						height: navWrapper.outerHeight(true)
					});
				});
			}

			navItems.hover(function() {
				if (screenWidth > settings.mobileBreakPoint) {
					var self = $(this),
						dropdown = self.children('ul');

					if(dropdown.length) {
						dropdown.removeClass('hidden');

						if (Modernizr.cssanimations) {
							dropdown.addClass(settings.animationIn + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
								dropdown.removeClass(settings.animationIn + ' animated hidden');
								dropdown.off('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend');
							});
						}
					}
				}
			}, function() {
				if (screenWidth > settings.mobileBreakPoint) {
					var self = $(this),
						dropdown = self.children('ul');

					if (Modernizr.cssanimations) {
						dropdown.removeClass(settings.animationIn + ' animated hidden').addClass(settings.animationOut + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							dropdown.removeClass(settings.animationOut + ' animated').addClass('hidden');
							dropdown.off('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend');
						});
					} else {
						dropdown.addClass('hidden');
					}
				}
			});

			// Sticky Menu
			// Navigation Show/Hide on Scroll Up/Down
			/*$window.on('scroll', function() {
				currentScrollPosition = $window.scrollTop();

				if (currentScrollPosition > prevScrollPosition && currentScrollPosition > stickyOffset) {
					*//*navWrapper.css({
						transform: 'translateY(-100%)'
					});*//*

					*//*navWrapper.css({
						position: 'fixed'
					});*//*

					navWrapper.addClass('sticky');
				} else if (currentScrollPosition <= prevScrollPosition) {
					*//*navWrapper.css({
						transform: 'translateY(0)'
					});*//*
				}

				if(currentScrollPosition <= stickyOffset) {
					*//*navWrapper.css({
						position: 'absolute'
					});*//*

					navWrapper.removeClass('sticky');
				}

				prevScrollPosition = currentScrollPosition;

				if(navWrapper.hasClass('transparent') && currentScrollPosition > 0) {
					navWrapper.addClass('transparent-moved');
				} else {
					navWrapper.removeClass('transparent-moved');
				}
			});*/

			// Dropdown Menu for Mobiles
			var menuButton = $('.main-menu-link').find('a'),
				isAnimating = false;

			menuButton.on('click', function() {
				if (isAnimating) return;

				isAnimating = true;

				if (navContainer.hasClass('active')) {
					menuButton.removeClass('active');
					navContainer.removeClass('active');
					$body.removeClass('overflow-hidden');

					if (Modernizr.csstransitions && screenWidth < settings.mobileBreakPoint + 1) {
						navContainer.one('webkitTransitionEnd mozTransitionEnd MSTransitionEnd otransitionend transitionend', function(){
							isAnimating = false;
							navContainer.off('webkitTransitionEnd mozTransitionEnd MSTransitionEnd otransitionend transitionend');

							navContainer.css({
								height: 'auto'
							});
						});
					} else {
						isAnimating = false;

						navContainer.css({
							height: 'auto'
						});
					}

				} else {
					menuButton.addClass('active');
					navContainer.addClass('active');
					$body.addClass('overflow-hidden');

					navContainer.css({
						height: screenHeight - navWrapper.outerHeight() - navWrapper.offset().top + $window.scrollTop()
					});

					$window.on('resized', function() {
						if(screenWidth < settings.mobileBreakPoint + 1) {
							navContainer.css({
								height: screenHeight - navWrapper.outerHeight() - navWrapper.offset().top + $window.scrollTop()
							});
						} else {
							navContainer.css({
								height: 'auto'
							});
						}
					});

					if (Modernizr.csstransitions && screenWidth < settings.mobileBreakPoint + 1) {
						navContainer.one('webkitTransitionEnd mozTransitionEnd MSTransitionEnd otransitionend transitionend', function(){
							isAnimating = false;
							navContainer.off('webkitTransitionEnd mozTransitionEnd MSTransitionEnd otransitionend transitionend');
						});
					} else {
						isAnimating = false;
					}
				}
			});

			navContainer.find('a.menu-link').on('click', function() {
				if (screenWidth < settings.mobileBreakPoint + 1) {
					var self = $(this),
						menuItem = self.parent('li'),
						dropdown = self.siblings('ul');

					if (menuItem.hasClass('active')) {
						dropdown.addClass('hidden');
						menuItem.removeClass('active');
					} else {
						dropdown.removeClass('hidden');
						menuItem.addClass('active');
					}
				}
			});

			$window.on('resized', function() {
				if (screenWidth > settings.mobileBreakPoint) {
					navItems.removeClass('active');
					navItems.find('ul').addClass('hidden');
				}
			});
		});

		return this;
	};
}(jQuery));