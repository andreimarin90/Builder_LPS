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
			this.mainSlider(); // Bootstrap Slider
			this.thumbSliderInit(); // Thumbnail Slider
			this.instagramLazy(); // Lazy Load Instagram Images
			this.slidingImage(20); // Sliding Image (speed)
			this.slidingImage2(10); // Sliding Image on Hover (speed)

			this.screenResInfo(); // Screen Resolution Info for Developers
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
			// Main Slider
			$('.main-slider.owl-carousel').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : true
			});

			// Post Slider
			$('.post-slider').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});

			// Recipe Slider
			$('.recipe-slider').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});

			// Demos Slider
			$('.demos-slider').owlCarousel({
				items : 3,
				itemsDesktop : [1359, 3],
				itemsDesktopSmall : [1229, 2],
				itemsTablet : [767, 1],
				itemsMobile : [479, 1],
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});























			// Instagram Slider
			$('.instagram-slider').owlCarousel({
				items : 7,
				itemsDesktop : [1359, 6],
				itemsDesktopSmall : [1229, 5],
				itemsTablet : [767, 4],
				itemsMobile : [479, 2],
				navigation: false,
				navigationText : false,
				pagination: false
			});

			// Featured Posts Slider
			$('.featured-posts-slider').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});

			// Featured Posts Slider Style 2
			$('.featured-posts-slider2').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : true
			});

			// Featured Posts Slider Style 3
			$('.featured-posts-slider3').owlCarousel({
				items : 2,
				itemsDesktop : [1359, 2],
				itemsDesktopSmall : [1229, 2],
				itemsTablet : [767, 1],
				itemsMobile : [479, 1],
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});

			// Featured Posts Slider Style 4
			$('.featured-posts-slider4').owlCarousel({
				singleItem: true,
				navigation : false,
				navigationText : ['', ''],
				pagination : true
			});

			// Featured Posts Slider Style 5
			(function() {
				var slider = $('.featured-posts-slider5');

				slider.owlCarousel({
					items : 3,
					itemsDesktop : [1342, 2],
					itemsDesktopSmall : [1229, 2],
					itemsTablet : [767, 1],
					itemsMobile : [479, 1],
					navigation : true,
					navigationText : ['', ''],
					pagination : false,
					addClassActive: true,
					afterInit: function() {
						slider.find('.owl-item').removeClass('current');
						slider.find('.owl-item.active').eq(1).addClass('current');

						if (slider.find('.owl-item.active').eq(1).index() === 1) {
							slider.find('.owl-item').eq(0).addClass('current');
						}

						if (slider.find('.owl-item.active').eq(1).index() === slider.find('.owl-item').length - 2) {
							slider.find('.owl-item').eq(-1).addClass('current');
						}
					},
					afterMove: function(e) {
						slider.find('.owl-item').removeClass('current');
						slider.find('.owl-item.active').eq(1).addClass('current');

						if (slider.find('.owl-item.active').eq(1).index() === 1) {
							slider.find('.owl-item').eq(0).addClass('current');
						}

						if (slider.find('.owl-item.active').eq(1).index() === slider.find('.owl-item').length - 2) {
							slider.find('.owl-item').eq(-1).addClass('current');
						}
					}
				});
			})();

			// Featured Posts Slider Style 6
			$('.featured-posts-slider6').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : false
			});

			// Featured Posts Slider Style 7
			$('.featured-posts-slider7').owlCarousel({
				singleItem: true,
				navigation : false,
				navigationText : ['', ''],
				pagination : true
			});

			// Featured Posts Slider Style 8
			$('.featured-posts-slider8').owlCarousel({
				singleItem: true,
				navigation : true,
				navigationText : ['', ''],
				pagination : true
			});

			// Featured Posts Slider
			$('.featured-posts-slider9').owlCarousel({
				singleItem: true,
				navigation : false,
				navigationText : ['', ''],
				pagination : true
			});
			
			// Related Posts Slider
			$('.related-posts-slider').owlCarousel({
				items : 3,
				itemsDesktop : [1359, 3],
				itemsDesktopSmall : [1229, 3],
				itemsTablet : [767, 2],
				itemsMobile : [479, 1],
				navigation: true,
				navigationText : false,
				pagination: false
			});
		},

		mainSlider : function() {
			$.fn.mainSliderApi = function() {
				var slider = $(this),
					isBig = slider.hasClass('main-slider-big') ? true : false,
					items = slider.find('.item'),
					animateClass;

				function setSliderHeight(extraHeight) {
					if(screenWidth > 767) {
						items.css({
							height: screenHeight + extraHeight
						});
					} else {
						items.css({
							height: screenHeight
						});
					}

					$window.trigger('sliderHeightSet');
				}

				if(isBig) {
					setSliderHeight(0);

					$window.on('resized', function() {
						setSliderHeight(0);
					});
				}

				slider.find('[data-animate-in], [data-animate-out]').addClass('animated');

				if(items.length < 2) {
					slider.find('.carousel-indicators').addClass('hidden');
					slider.find('.carousel-control').addClass('hidden');
				}

				function animation(dir) {
					slider.find('.active [data-animate-' + dir + ']').each(function () {
						var self = $(this);
						animateClass = self.data('animate-' + dir);

						self.addClass(animateClass);
					});
				}

				function animationReset(dir) {
					slider.find('[data-animate-' + dir + ']').each(function () {
						var self = $(this);
						animateClass = self.data('animate-' + dir);

						self.removeClass(animateClass);
					});
				}

				if (Modernizr.cssanimations) {
					animation('in');

					slider.on('slid.bs.carousel', function () {
						animationReset('out');
						setTimeout(function () {
							animation('in');
						}, 0);
					});
					slider.on('slide.bs.carousel', function () {
						animationReset('in');
						setTimeout(function () {
							animation('out');
						}, 0);
					});
				}

				if (Modernizr.touch) {
					slider.find('.carousel-inner').swipe({
						swipeLeft: function() {
							$(this).parent().carousel('prev');
						},
						swipeRight: function() {
							$(this).parent().carousel('next');
						},
						threshold: 30
					});
				}
			};

			var mainSlider = $('#main-slider');

			mainSlider.carousel({interval: mainSlider.data('interval'), pause: 'none'}).mainSliderApi();
		},

		thumbSliderInit : function() {
			$.fn.imageSliderApi = function () {
				var slider = $(this),
					imagesWrap = slider.find('.slider-images-wrap'),
					images = slider.find('.slider-images'),
					thumbsWrap = slider.find('.slider-thumbs-wrap'),
					thumbs = slider.find('.slider-thumbs'),
					prev = slider.find('.prev'),
					next = slider.find('.next'),
					sliderHeight = slider.data('height') ? slider.data('height') : 400;

				if(screenWidth < 1024) {
					sliderHeight = sliderHeight / 1.4;
				}

				if(screenWidth < 480) {
					sliderHeight = sliderHeight / 1.6;
				}

				images.trigger('destroy');
				thumbs.trigger('destroy');

				images.find('li').removeClass().css({
					width: imagesWrap.width(),
					height: sliderHeight
				});

				thumbsWrap.css({
					height: sliderHeight + 2
				});

				thumbs.find('li').removeClass().css({
					width: thumbsWrap.width(),
					height: (sliderHeight + 2) / 3 - 2
				});

				images.carouFredSel({
					prev : prev,
					next : next,
					circular: false,
					infinite: false,
					items: 1,
					auto: false,
					scroll: {
						fx: 'quadratic',
						onBefore: function() {
							var pos = $(this).triggerHandler('currentPosition');

							thumbs.find('li').removeClass('active');
							thumbs.find('li.item' + pos).addClass('active');

							if(pos < 1) {
								thumbs.trigger('slideTo', [pos, true]);
							} else {
								thumbs.trigger('slideTo', [pos - 1, true]);
							}
						}
					},
					onCreate: function() {
						images.find('li').each(function(i) {
							$(this).addClass('item' + i);
						});
					}
				}).trigger('slideTo', [0, true]);

				thumbs.carouFredSel({
					direction: 'up',
					auto: false,
					infinite: false,
					circular: false,
					scroll: {
						items : 1
					},
					onCreate: function() {
						thumbs.find('li').each(function(i) {
							$(this).addClass( 'item' + i ).on('click', function() {
								images.trigger('slideTo', [i, true]);
							});
						});
						thumbs.find('.item0').addClass('active');
					}
				});

				images.swipe({
					swipeLeft: function() {
						images.trigger('next');
					},
					swipeRight: function() {
						images.trigger('prev');
					},
					threshold: 30,
					excludedElements: ''
				});
			};

			var imageSlider = $('.thumbnail-slider');

			if(imageSlider.length) {
				$window.on('load resized', function() {
					imageSlider.each(function() {
						$(this).imageSliderApi();
					});
				});
			}
		},

		instagramLazy : function() {
			function lazyImages() {
				$('img.instagram_load').each(function() {

					if($(window).scrollTop() + screenHeight >= $(this).offset().top - 800) {
						$(this).attr('src', $(this).attr('data-source'));
					}
				});
			}

			lazyImages();

			$window.on('scroll', lazyImages);
		},

		slidingImage : function(speed) {
			function imageAnimate(node, speed) {
				var container = node.find('.slide-container');
				var distance = parseInt((container.find('img').height() - container.height()), 10);
				var isStopped = false;
				//var image = container.find('img');
				//var interval;
				//var counter = 0;

				container.stop(true,true).scrollTop(0);

				/*clearInterval(interval);
				counter = 0;*/

				if (distance <= 0) return;

				(function loop() {
					$window.on('image.state.changed', function() {
						isStopped = true;
					});

					if (isStopped) return false;

					container.animate(
						{scrollTop: distance},
						distance * speed,
						'linear',
						function () {
							container.animate(
								{scrollTop: 0},
								distance * speed,
								'linear',
								loop
							);
						}
					);
				}());

				/*image.css({
					transition: 'transform ' + (distance * speed) + 'ms linear'
				});

				interval = setInterval(function() {
					if (counter % 2 === 0) {
						image.css({
							transform: 'translate3d(0, ' + (- distance) + 'px, 0)'
						});
					} else {
						image.css({
							transform: 'translate3d(0, 0, 0)'
						});
					}

					counter ++;
				}, distance * speed);*/
			}

			$window.on('load resized', function() {
				$window.trigger('image.state.changed');

				$('.block-sliding-image').each(function() {
					imageAnimate($(this), speed ? speed : 4);
				});
			});

			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				$window.trigger('image.state.changed');

				$(e.target.getAttribute('href')).find('.block-sliding-image').each(function() {
					imageAnimate($(this), speed ? speed : 4);
				});
			});
		},

		slidingImage2 : function(speed) {
			function imageAnimate(node, speed) {
				var container = node.find('.slide-container');
				var image = container.find('img');
				var distance = parseInt((container.find('img').height() - container.height()), 10);

				container.off('mouseenter mouseleave');

				if (distance <= 0) return;

				image.css({
					transition: 'transform ' + (distance * speed) + 'ms linear'
				});

				container.hover(function() {
					image.css({
						transform: 'translate3d(0, ' + (- distance) + 'px, 0)'
					});
				},
				function() {
					image.css({
						transform: 'translate3d(0, 0, 0)'
					});
				});
			}

			$window.on('load resized', function() {
				$('.block-sliding-image2').each(function() {
					imageAnimate($(this), speed ? speed : 4);
				});
			});

			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				setTimeout(function() {
					$(e.target.getAttribute('href')).find('.block-sliding-image2').each(function() {
						imageAnimate($(this), speed ? speed : 4);
					});
				}, 500);
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