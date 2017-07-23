'use strict';

jQuery(function($) {

	var $window = $(window),
		$body = $('body'),
		screenWidth = $window.width(),
		screenHeight = $window.height(),
		scrollBarWidth = 0;

	$window.on('resize orientationchange', function() {
		screenWidth = $window.width();
		screenHeight = $window.height();
	});

	$window.on('load', function() {
		$window.resize();
	});

	window.bbt = {
		init : function() {
			this.resizedEvent(400); // Trigger Event after Window is Resized
			this.ieWarning(); // IE<9 Warning
			this.disableEmptyLinks(); // Disable Empty Links
			this.toolTips(); // ToolTips Init
			this.placeHolders(); // PlaceHolders Init
			this.checkBoxes(); // Styled CheckBoxes, RadioButtons
			this.scrollToAnchors(); // Smooth Scroll to Anchors
			this.scrollBarWidthDetection(); // ScrollBar Width Detection
			this.videoPlayerRatio(); // Video Player Ratio

			this.dropDownMenu(); // Dropdown Menu in Header
			this.stickySideBar(); // Sticky SideBar
			this.lastItemLabel('.post-meta'); // Post Meta First Item
			this.parallaxInit(); // Parallax
			this.lightBox(); // LightBox (swipeBox)
			this.owlSlidersInit(); // Owl Carousels

			//this.screenResInfo(); // Screen Resolution Info for Developers
		},

		resizedEvent : function(delay) {
			var resizeTimerId;

			$window.on('resize orientationchange', function() {
				clearTimeout(resizeTimerId);

				resizeTimerId = setTimeout( function() {
					$window.trigger('resized');
				}, delay);
			});
		},

		ieWarning : function() {
			if ($('html').hasClass('oldie')) {
				$body.empty().html('Please, Update your Browser to at least IE9');
			}
		},

		disableEmptyLinks : function() {
			$('[href="#"], .btn.disabled').on('click', function(event) {
				event.preventDefault();
			});
		},

		toolTips : function() {
			$('[data-toggle="tooltip"]').tooltip();
		},

		placeHolders : function() {
			if ($('[placeholder]').length) {
				$.Placeholder.init();
			}
		},

		checkBoxes : function() {
			$.fn.customInput = function() {
				$(this).each(function () {
					var container = $(this),
						input = container.find('input'),
						label = container.find('label');

					input.on('update', function() {
						input.is(':checked') ? label.addClass('checked') : label.removeClass('checked');
					})
						.trigger('update')
						.on('click', function() {
							$('input[name=' + input.attr('name') + ']').trigger('update');
						});
				});
			};

			$('.checkbox, .radio').customInput();
		},

		scrollToAnchors : function() {
			$('.anchor[href^="#"]').on('click', function(e) {
				e.preventDefault();
				var speed = 1,
					boost = 1,
					offset = 30,
					target = $(this).attr('href'),
					currPos = parseInt($window.scrollTop(), 10),
					targetPos = target!="#" && $(target).length==1 ? parseInt($(target).offset().top, 10) - offset : 0,
					distance = targetPos - currPos;

				boost = Math.abs(distance * boost / 1000);

				$("html, body").animate({scrollTop: targetPos}, parseInt(Math.abs(distance / (speed + boost)), 10));
			});
		},

		scrollBarWidthDetection : function() {
			$body.append('<div class="scrollbar-detect"><span></span></div>');

			var scrollBarDetect = $('.scrollbar-detect');

			scrollBarWidth = scrollBarDetect.width() - scrollBarDetect.find('span').width();

			scrollBarDetect.remove();
		},

		videoPlayerRatio : function() {
			function setRatio() {
				$('.video-player').each(function() {
					var self = $(this),
						ratio = self.attr('width') && self.attr('height') ? self.attr('width') / self.attr('height') : 16/9,
						videoWidth = self.width();

					self.css({height: parseInt(videoWidth / ratio)});

					self.trigger('videoPlayerRatioSet');
				});
			}

			setRatio();

			$window.on('resized', function() {
				setRatio();
			});
		},

		dropDownMenu : function() {
			$('.main-menu').bbtNavigation1({
				animationIn: 'growInBigY',
				animationOut: 'growOutBigY',
				mobileBreakPoint: 991
			});
		},

		stickySideBar : function() {
			$('.sidebar-sticky').each(function() {
				var sidebar = $(this);

				$window.on('resized', function() {
					if($window.width() > 767 - scrollBarWidth) {
						sidebar.stick_in_parent({
							offset_top: 120
						});
					} else {
						sidebar.trigger('sticky_kit:detach');
					}
				});
			});
		},

		lastItemLabel : function(selector) {
			$(selector).each(function() {
				$(this).children().eq(0).addClass('first');
				$(this).children().eq(-1).addClass('last');
			});
		},

		parallaxInit : function() {
			$.fn.parallax = function() {
				var parallax = $(this),
					xPos = parallax.data('parallax-position') ? parallax.data('parallax-position') : 'center',
					speed = parallax.data('parallax-speed') || parallax.data('parallax-speed') == 0 ? parallax.data('parallax-speed') : .1;

				function runParallax() {
					var scrollTop = $window.scrollTop(),
						offsetTop = parallax.offset().top,
						parallaxHeight = parallax.outerHeight();

					if (scrollTop + screenHeight > offsetTop && offsetTop + parallaxHeight > scrollTop) {
						var yPos = parseInt((offsetTop - scrollTop) * speed, 10);

						parallax.css({
							backgroundPosition: xPos + ' ' + yPos + 'px'
						});
					}
				}

				if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
					parallax.css({
						backgroundAttachment: 'fixed'
					});
					runParallax();
				}
				$window.on('scroll', function () {
					if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
						parallax.css({
							backgroundAttachment: 'fixed'
						});
						runParallax();
					}
				});
				$window.on('resized', function () {
					if (screenWidth > 1000 && !parallax.hasClass('parallax-disabled')) {
						parallax.css({
							backgroundAttachment: 'fixed'
						});
						runParallax();
					} else {
						parallax.css({
							backgroundPosition: '50% 0',
							backgroundAttachment: 'scroll'
						});
					}
				});
			};

			$('.parallax').each(function () {
				$(this).parallax();
			});
		},

		lightBox : function() {
			$('.swipebox, .swipebox-video').swipebox({
				removeBarsOnMobile: false,
				autoplayVideos: true
			});
		},

		owlSlidersInit : function() {
			// Testimonials Slider
			$('.testimonials-slider').owlCarousel({
				singleItem: true,
				navigation : false,
				pagination : true
			});
		},

		screenResInfo : function() {
			var container = $('<div class="screen-resolution hidden-xs" style="position: fixed; top: 20px; right: 0; z-index: 9999; padding: 4px; background-color: #eee;"></div>'),
				breakPoint = '@xxs';

			container.appendTo($body);

			$window.on('resize orientationchange', function() {
				breakPoint = '@xxs';

				if(screenWidth + scrollBarWidth > 479) breakPoint = '@xs';
				if(screenWidth + scrollBarWidth > 767) breakPoint = '@sm';
				if(screenWidth + scrollBarWidth > 991) breakPoint = '@md';
				if(screenWidth + scrollBarWidth > 1229) breakPoint = '@xmd';
				if(screenWidth + scrollBarWidth > 1359) breakPoint = '@lg';
				if(screenWidth + scrollBarWidth > 1459) breakPoint = '@xlg';
				if(screenWidth + scrollBarWidth > 1799) breakPoint = 'full';

				container.text((screenWidth + scrollBarWidth) + ' x ' + screenHeight + ' ' + breakPoint);
			});
		}
	};

	bbt.init();
});