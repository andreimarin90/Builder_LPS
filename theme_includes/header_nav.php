<!-- Header -->
<header class="header transparent" itemscope itemtype="http://schema.org/WPHeader">
	<div class="header-flex">
		<div class="site-logo"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt=""/></a></div>

		<ul class="main-menu">
			<li><a href="#">Home</a></li>
			<li><a href="http://bigbangthemes.net/BBT_Builder/drag-drop-email-template-builder/#features">Why BBT Builder</a></li>
			<li><a href="http://bigbangthemes.net/BBT_Builder/drag-drop-email-template-builder/#testimonials">Testimonials</a></li>
			<li><a href="https://themeforest.net/user/BigBangThemes" rel="nofollow">Templates</a></li>
			<!-- <li><a href="#">Portfolio</a></li> -->
			<!-- <li><a href="#">Profile</a></li> -->
			<?php if(is_page_template('free-dd.php' )): ?>
				<li><a href="http://bigbangthemes.net/BBT_Builder/template/emailer/" rel="nofollow" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-white btn-transparent">get started</a></li>
			<?php else: ?>
				<li><a href="http://bigbangthemes.net/BBT_Builder/template/emailer/" rel="nofollow" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-white btn-transparent">get started</a></li>
			<?php endif; ?>
		</ul>

		<div class="main-menu-link"><a href="#"></a></div>
	</div>
</header>
<!--/ Header -->