<?php 
$url = (isset($_GET['buy']) && !empty($_GET['buy'])) ? bbtb_get_paypal_page_full_link($_GET['buy']) . '&valid=yes' : get_permalink() . '?valid=yes';
?>
<div class="bbtb_validate_toke_container">
	<div class="export-container no-purchase-code clearfix">
		<div class="col-md-6 col-sm-6 col-centered">
			<a href="<?php echo esc_url('https://bigbangthemes.net/user/?page=license&ref=https%3A%2F%2Fbigbangthemes.net');?>" target="_blank" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-pink btn-large btn-wide border-radius box-shadow"><?php esc_html_e('GENERATE TOKEN','bbt_builder'); ?></a>

			<a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect btn btn-pink btn-large btn-wide border-radius box-shadow js-export-token-form-show">
				<?php esc_html_e('I already have a token','bbt_builder'); ?>
			</a>

			<a href="<?php echo esc_url('https://bigbangthemes.net/knowledgebase/email-template-builder-token-not-valid/'); ?>" target='_blank' class="link-help">
				<?php esc_html_e('Help me find my Token ID','bbt_builder'); ?>
			</a>
		</div>
		
	</div>

	<div class="export-container purchase-code clearfix">
		<div class="col-md-6 col-sm-6 col-centered">
			<form class="export-token-form" method="post" action="<?php echo esc_url($url) . '#pricing'; ?>" name="validatetokenform" id="validatetokenform">
				<div class="export-input">
					<input type="text" class="form-control" id="paypal-token-id" name="token-id" placeholder="Token ID">
				</div>

				<button class="mdl-button mdl-js-button mdl-js-ripple-effect progress-button progress-button-effect btn btn-pink btn-large btn-wide border-radius box-shadow bbt-validate-product-key" data-loading="<?php esc_html_e('SUBMIT...','bbt_builder') ?>">
					<span class="button-content"><?php esc_html_e('SUBMIT','bbt_builder') ?></span>
					<span class="progress">
						<span class="progress-inner"></span>
					</span>
				</button>
				
				<input type="hidden" id="paypal-template-slug" value="<?php echo isset($_GET['buy']) && !empty($_GET['buy']) ? esc_html($_GET['buy']) : '';?>">
				<?php wp_nonce_field( 'ajax-token-validate-nonce', 'bbtb-security' ); ?>
			</form>

			<div id="error-messages-box" class="error-messages-box" style="display:none; margin-top:30px;"></div>
			<div id="success-messages-box" class="success-messages-box" style="display:none; margin-top:30px;"></div>
		</div>
	</div>
</div>