<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- Pingbacks -->
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="canonical" href="<?php the_permalink() ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class('landing-page')?>>

<?php 

/*
Template Name: Emailer Landing
*/ 
?>

	<?php require_once('theme_includes/header_nav.php'); ?>

	
	<!-- Main Banner -->
	<div class="main-header big" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/bg-1.jpg);">
		<div class="header-inner">
			<div class="header-pre-title"><span>THE BEST IN THE INDUSTRY</span></div>
			<h1 class="header-title">Drag&Drop Email Builder</h1>
			<div class="header-description">
				Use our complete drag&drop tools to easily customize your next email template.
				Export the code and use it with any Email sending service to engage your clients and keep them happy.
			</div>
			<div class="header-buttons">
				<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">TEST NOW</a>
			</div>
		</div>
	</div>
	<!--/ Main Banner -->

	<!-- Section Features -->
	<section class="section section-features">
		<div class="container">
			<div class="section-header">
				<div class="section-pre-title left"><span>GROUNDBREAKING FEATURES</span></div>

				<h2 class="section-title">The <em>all in one</em> <br/>email template builder</h2>

				<div class="section-description">
					<p>
						Ask any email marketer and they will tell you that creating funky fantastic emails that are compatible with all
						email service providers is like chasing the <strong>Holy Grail.</strong> It doesn’t exist!
					</p>
					<p>
						<strong>Until now that is...</strong> By creating a full service, major service provider compatible, drag and drop
						email builder, we think that our tool is the answer you have been looking for.
					</p>
					<p>
						Customize layouts, update background images, change colours and create awesome call to action buttons all from
						within the dashboard via the item’s many modules and solve your email marketing problems <strong>now!</strong>
					</p>
				</div>
			</div>

			<div class="features">
				<ul>
					<li>
						<div class="feature">
							<div class="number"><span>01.</span></div>
							<h4 class="title">Drag and drop builder</h4>
							<div class="description">
								Using a drag and drop builder has never been easier. Left click on
								any module and place it by dragging it over and releasing the mouse.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>02.</span></div>
							<h4 class="title">Efficiently categorised</h4>
							<div class="description">
								Our builder comes with this super useful option allowing you to  edit
								your template and save all your changes and new layouts for later use.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>03.</span></div>
							<h4 class="title">Ready-made templates</h4>
							<div class="description">
								Now included with your purchase you have a series of ready-made
								templates you can choose from. This guarantees high conversion rates!
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>04.</span></div>
							<h4 class="title">Multiple export options</h4>
							<div class="description">
								You can export files in HTML, My Mail, Campaign Monitor and Mailchimp.
								You can also choose to optimize the code  and export a minified version.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>05.</span></div>
							<h4 class="title">Save all your changes</h4>
							<div class="description">
								Our builder comes with a super useful option that allows you to edit
								your template and save all your changes and new layouts for later use.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>06.</span></div>
							<h4 class="title">Load your saved templates</h4>
							<div class="description">
								If you want to access your saved templates you can do that in the
								“Load” section of the specific newsletter you are trying to use.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>07.</span></div>
							<h4 class="title">Preview your work</h4>
							<div class="description">
								We know it is crucial to be able to see the result of your work.
								That’s why the “Preview” options shows how your email looks on multiple devices.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>08.</span></div>
							<h4 class="title">Your account</h4>
							<div class="description">
								The “My Account” section includes your purchases, the most trending
								items with plenty of details and the possibility to rate our work.
							</div>
						</div>
					</li>

					<li>
						<div class="feature">
							<div class="number"><span>09.</span></div>
							<h4 class="title">Extensive documentation</h4>
							<div class="description">
								This section allows you to have access to all you need when it comes
								to documentation and details related to how to use our builder.
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!--/ Section Features -->

	<!-- Section CTA2 -->
	<section class="section section-cta2 dark" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/cta2-bg.jpg);">
		<div class="section-image">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/temp/section-cta2.png" alt=""/>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-sm-6">
					<div class="section-header">
						<h2 class="section-title thin">Fast. Complex. <br/><em>Yet user friendly!</em></h2>

						<div class="section-description">
							<p>
								Our powerful drag&drop email builder comes with features which enable you to build and customize your very
								own asweome looking newsletter layouts in <strong>just seconds</strong>.
							</p>
						</div>
					</div>

					<div class="buttons">
						<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">Read more</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ Section CTA2 -->

	<!-- Section Export -->
	<section class="section section-export">
		<div class="container">
			<div class="section-header text-center">
				<div class="section-pre-title"><span>INNOVATIVE USER INTERFACE</span></div>

				<h2 class="section-title">Extremely <em>easy</em> to use!</h2>

				<div class="section-description text-left">
					<div class="row">
						<div class="col-md-6">
							<p>
								Our <strong>User Interface</strong> design is based on years of research and listening to our customers,
								reacting to what they want and digging deep into our customer support to understand what changes need
								to be made to create <strong>the best</strong> set of <strong>drag and drop email builder</strong> tools available.
							</p>
						</div>

						<div class="col-md-6">
							<p>
								Everything runs from our unique online set of tools so you never have to worry about storage or finding the latest file,
								just log in and everything you need is right there in one place. Simply export your layout in your preferred version type:
								<strong>MailChimp</strong>, <strong>Campaign Monitor</strong> or plain <strong>HTML</strong>.
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="section-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/export.png" alt=""/>
			</div>
		</div>
	</section>
	<!--/ Section Export -->

	<!-- Section Compatibility -->
	<section class="section section-compatibility light">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title thin">Compatible with <br/><em>major email service providers!</em></h2>

				<div class="section-description">
					<p>
						Are you a fan of the WordPress plugin <strong>Mailster</strong> that helps you create, send and track your newsletter campaigns? <br/>
						So are we! That’s why our template is <strong>100% compatible</strong> with it and with major email service providers!
					</p>
				</div>
			</div>

			<ul class="providers clearfix">
				<li><div class="provider"><i class="icon icon-1"></i><span>Mailster</span></div></li>
				<li><div class="provider"><i class="icon icon-2"></i><span>Mailchimp</span></div></li>
				<li><div class="provider"><i class="icon icon-3"></i><span>Campaign Monitor</span></div></li>
				<li><div class="provider"><i class="icon icon-4"></i><span>FreshMail</span></div></li>
				<li><div class="provider"><i class="icon icon-5"></i><span>Vertical Response</span></div></li>
				<li><div class="provider"><i class="icon icon-6"></i><span>Moosend</span></div></li>
				<li><div class="provider"><i class="icon icon-7"></i><span>Active Campaign</span></div></li>
				<li><div class="provider"><i class="icon icon-8"></i><span>iContact</span></div></li>
				<li><div class="provider"><i class="icon icon-9"></i><span>Bronto</span></div></li>
				<li><div class="provider"><i class="icon icon-10"></i><span>ConstantContact</span></div></li>
				<li><div class="provider"><i class="icon icon-11"></i><span>Aweber</span></div></li>
				<li><div class="provider"><i class="icon icon-12"></i><span>StreamSend</span></div></li>
				<li><div class="provider"><i class="icon icon-13"></i><span>Sendgrid</span></div></li>
				<li><div class="provider"><i class="icon icon-14"></i><span>CheetachMail</span></div></li>
				<li><div class="provider"><i class="icon icon-15"></i><span>Contactology</span></div></li>
				<li><div class="provider"><i class="icon icon-16"></i><span>SendinBlue</span></div></li>
				<li><div class="provider"><i class="icon icon-17"></i><span>Marketo</span></div></li>
				<li><div class="provider"><i class="icon icon-18"></i><span>dotMailer</span></div></li>
				<li><div class="provider"><i class="icon icon-19"></i><span>MailGun</span></div></li>
				<li><div class="provider"><i class="icon icon-20"></i><span>MadMimi</span></div></li>
				<li><div class="provider"><i class="icon icon-21"></i><span>Interspire</span></div></li>
				<li><div class="provider"><i class="icon icon-22"></i><span>GetResponse</span></div></li>
				<li><div class="provider"><i class="icon icon-23"></i><span>ExactTarget</span></div></li>
				<li><div class="provider"><i class="icon icon-24"></i><span>Vision6</span></div></li>
				<li><div class="provider"><i class="icon icon-25"></i><span>SendPulse</span></div></li>
				<li><div class="provider"><i class="icon icon-26"></i><span>EmailOctopus</span></div></li>
				<li><div class="provider"><i class="icon icon-27"></i><span>MPZ mail</span></div></li>
				<li><div class="provider"><i class="icon icon-28"></i><span>phpList</span></div></li>
				<li><div class="provider"><i class="icon icon-29"></i><span>MailerLite</span></div></li>
				<li><div class="provider"><i class="icon icon-30"></i><span>Campaigner</span></div></li>
			</ul>

			<div class="text-center">
				<a href="#" class="btn-gradient"><span><em>TEST IT NOW</em></span></a>
			</div>
		</div>
	</section>
	<!--/ Section Compatibility -->

	<!-- Section Icon Generator -->
	<section class="section section-icon-generator blue" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/icon-generator-bg.jpg);">
		<div class="float-container clearfix">
			<div class="section-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/mac.png" alt=""/>
			</div>

			<div class="section-content">
				<div class="section-header">
					<div class="section-pre-title left"><span>THE FIRST OF ITS KIND</span></div>
					<h2 class="section-title">Email <br/><em>Icon Generator</em></h2>

					<div class="section-description">
						<p>
							Now our brilliant <strong>Icon Generator</strong> is included with your purchase - the first of its kind!
							Easily <strong>create unique icons</strong> for your business and spice up your email marketing with super slick icons - simple!
						</p>
					</div>
				</div>

				<ol class="icon-generator-steps">
					<li><span>Click on the icon you want to change.</span></li>
					<li><span>Click on “Search Icon” from the options pannel.</span></li>
					<li><span>Browse through the icons and choose the one you like.</span></li>
					<li><span>Click on the color picker and choose the color you like.</span></li>
					<li><span>You can even add a link to your icon if you need to.</span></li>
					<li><span>Edit the height and width from the two boxes.</span></li>
					<li><span>Save your settings and wait for the magic to happen!</span></li>
				</ol>
			</div>
		</div>
	</section>
	<!--/ Section Icon Generator -->

	<!-- Section Testimonials -->
	<section class="section section-testimonials light">
		<div class="section-content">
			<div class="column-left">
				<div class="section-header">
					<div class="section-pre-title left"><span>TESTIMONIALS</span></div>
					<h2 class="section-title small"><strong>+9500</strong> <em>Happy Customers</em></h2>

					<div class="section-description">
						<p>
							There is a reason why our customers love and trust  our services.
							Their reviews and testimonials are proof of our dedication and high standards. Thank you for choosing us!
						</p>
					</div>
				</div>

				<div class="owl-carousel testimonials-slider">
					<div class="testimonial">
						<div class="testimonial-text">
							This is a fantastic tool! Well designed both technically, and aesthetically. We started using it recently in order
							to update our email blasts - we are a small family owned Art Gallery and the email both was easy to use, exciting
							to setup and highly effective in enabling our brand to look modern, clean and of course, responsive to our customers devices!
						</div>

						<div class="testimonial-author">
							<div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar.png" alt=""/></div>
							<div class="author">greglion</div>
							<div class="job">Art Gallery Owner</div>
						</div>
					</div>

					<div class="testimonial">
						<div class="testimonial-text">
							This is a fantastic tool! Well designed both technically, and aesthetically. We started using it recently in order
							to update our email blasts - we are a small family owned Art Gallery and the email both was easy to use, exciting
							to setup and highly effective in enabling our brand to look modern, clean and of course, responsive to our customers devices!
						</div>

						<div class="testimonial-author">
							<div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar.png" alt=""/></div>
							<div class="author">greglion</div>
							<div class="job">Art Gallery Owner</div>
						</div>
					</div>

					<div class="testimonial">
						<div class="testimonial-text">
							This is a fantastic tool! Well designed both technically, and aesthetically. We started using it recently in order
							to update our email blasts - we are a small family owned Art Gallery and the email both was easy to use, exciting
							to setup and highly effective in enabling our brand to look modern, clean and of course, responsive to our customers devices!
						</div>

						<div class="testimonial-author">
							<div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar.png" alt=""/></div>
							<div class="author">greglion</div>
							<div class="job">Art Gallery Owner</div>
						</div>
					</div>

					<div class="testimonial">
						<div class="testimonial-text">
							This is a fantastic tool! Well designed both technically, and aesthetically. We started using it recently in order
							to update our email blasts - we are a small family owned Art Gallery and the email both was easy to use, exciting
							to setup and highly effective in enabling our brand to look modern, clean and of course, responsive to our customers devices!
						</div>

						<div class="testimonial-author">
							<div class="avatar"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar.png" alt=""/></div>
							<div class="author">greglion</div>
							<div class="job">Art Gallery Owner</div>
						</div>
					</div>
				</div>
			</div>

			<img class="image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/temp/section-testimonials.png" alt=""/>
		</div>
	</section>
	<!--/ Section Testimonials -->

	<!-- Section CTA -->
	<section class="section section-cta" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/temp/section-cta-bg.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<div class="flex-container">
						<div class="column-left">
							<h2 class="section-title">Test It <em>Now!</em></h2>
							<div class="section-description">
								Thanks to groundbreaking innovations background images now work on all email clients.
							</div>
						</div>

						<div class="column-right">
							<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-shadow">TEST NOW</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ Section CTA -->

	<!-- Section Support -->
	<section class="section section-support">
		<div class="container">
			<div class="section-header text-center">
				<div class="section-pre-title"><span>WE ARE HERE FOR YOU</span></div>
				<h2 class="section-title">Awesome <em>item support!</em></h2>
				<div class="section-description">
					<p>
						All our items come with <strong>6 months</strong> of included support. All you have to do is <strong>Contact Us</strong> either through
						the Contact Us section, <strong>Item Comments</strong> or through <strong>Themeforest</strong> so we can make sure we receive your
						questions and answer as soon as possible.
					</p>
				</div>
			</div>

			<ul class="blurbs clearfix">
				<li class="blurb">
					<i class="blurb-icon blurb-icon-1"></i>
					<h4 class="blurb-title">ASK THE AUTHOR</h4>
					<div class="blurb-description">Our authors are available to answer any questions related to the product you are interested in buying.</div>
				</li>

				<li class="blurb">
					<i class="blurb-icon blurb-icon-2"></i>
					<h4 class="blurb-title">HELP WITH BUGS</h4>
					<div class="blurb-description">We offer assistance with bugs and  other issues in order for you to enjoy a great user experience.</div>
				</li>

				<li class="blurb">
					<i class="blurb-icon blurb-icon-3"></i>
					<h4 class="blurb-title">TECHNICAL QUESTIONS</h4>
					<div class="blurb-description">If you have any technical questions about one of our item’s features we will answer them.</div>
				</li>

				<li class="blurb">
					<i class="blurb-icon blurb-icon-4"></i>
					<h4 class="blurb-title">3RD PARTY ASSETS</h4>
					<div class="blurb-description">We are here for you in case you need help with some of the included 3rd party assets.</div>
				</li>
			</ul>

			<div class="text-center">
				<a href="#" class="btn-gradient"><span><em>TEST IT NOW</em></span></a>
			</div>
		</div>
	</section>
	<!--/ Section Support -->

	<?php get_footer(); ?>

	<!-- JS Section -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-37394656-14', 'auto');
    ga('send', 'pageview');

</script>
    <?php wp_footer( );?>



</body>
</html>