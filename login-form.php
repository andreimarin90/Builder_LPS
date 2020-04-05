<?php
$url = (isset($_GET['buy']) && !empty($_GET['buy'])) ? bbtb_get_paypal_page_full_link($_GET['buy']) . '&login=yes' : get_permalink() . '?login=yes';
?>
<div id="bbtb_validate_toke_container" class="bbtb_validate_toke_container">
	<form class="margin-bottom-40" action="<?php echo esc_url($url) . '#pricing'; ?>" method="post" class="paypal-loginform" name="loginform" id="loginform">
		<div class="input-wrapper">
			<input type="text" class="form-control" name="log" id="user_login2" placeholder="<?php esc_html_e('Username','bbt_builder'); ?>" autocomplete="off" required />
		</div>

		<div class="input-wrapper">
			<input type="password" class="form-control" name="pwd" id="user_pass2" placeholder="<?php esc_html_e('Password','bbt_builder'); ?>" autocomplete="off" required />
			<span class="help-block"><a href="<?php echo  esc_url( home_url('/') );?>wp-login.php?action=lostpassword"><?php esc_html_e('Forgot your password?','bbt_builder') ?></a></span>
		</div>
		
		<input type="hidden" name="redirect_to" value="<?php echo esc_url($url); ?>" />
		
		<button name="wp-submit" id="wp-submit" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-pink btn-large btn-wide border-radius box-shadow progress-button progress-button-effect bbtb-login-form" data-loading="<?php esc_html_e('LOG IN...','bbt_builder') ?>"><?php esc_html_e('LOG IN','bbt_builder') ?></button>
		<?php wp_nonce_field( 'ajax-login-nonce', 'bbtb-security' ); ?>
	</form>

	<div id="error-messages-box" class="error-messages-box" style="display:none; margin-top:30px;"></div>
	<div id="success-messages-box" class="success-messages-box" style="display:none; margin-top:30px;"></div>
</div>