<?php
/**
 * Notices for js errors 
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_Error_Handler {

	public function __construct() {

		// add script to the page
		add_action( 'admin_enqueue_scripts', [ 'EPKB_Error_Handler', 'add_assets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_assets' ] );

		// add message to the page
		add_action( 'admin_footer', [ $this, 'add_error_popup' ] );
		add_action( 'wp_footer', [ $this, 'add_error_popup' ] );
   }
	
	public static function add_assets() { ?>
		<link rel="stylesheet" id="epkb-js-error-handlers-css" href="<?php echo esc_url( Echo_Knowledge_Base::$plugin_url . 'css/error-handlers.css' ); ?>" media="all">
		<script src="<?php echo esc_url( Echo_Knowledge_Base::$plugin_url . 'js/error-handlers.js' ); ?>" type="text/javascript"></script><?php
	}

	/**
	 * Show JS errors caught by JS error handler
	 */
	public static function add_error_popup() {
	   echo '
			<div style="display:none;" class="epkb-js-error-notice">
				<div class="epkb-js-error-close">&times;</div>
				<div class="epkb-js-error-title">' . esc_html__( 'We found a JavaScript error on this page caused by a plugin', 'echo-knowledge-base' ) . '</div>
				<div class="epkb-js-error-body">
					<div class="epkb-js-error-msg"></div>' .
	                ' ' . esc_html__( 'inside this file:', 'echo-knowledge-base' ) . ' <div class="epkb-js-error-url"></div>' . '
				</div>
				<div>' . EPKB_Utilities::contact_us_for_support() . '</div>
				<div class="epkb-js-error-about">' . esc_html__( 'Check browser console for more information', 'echo-knowledge-base' ) . '</div>
			</div>';
	}

	public static function get_ns_error_text() {
	    ob_start(); ?>
        <p><?php esc_html_e( 'Please check to see if you enabled browser ad blocker? You can add this URL address to ad blocker exceptions in the browser.', 'echo-knowledge-base' ); ?></p>
        <p><?php esc_html_e( 'Also try to clear your browser cache, then log out and back in.', 'echo-knowledge-base' ); ?></p>        <?php
        return ob_get_clean();
	}

    public static function get_csr_error_text() {
        return sprintf( '%s <a href="%s" target="_blank">%s</a>',
	        esc_html__( 'We detected CSP error. See the reference article about CSP', 'echo-knowledge-base' ), 'https://www.echoknowledgebase.com/documentation/content-security-policy/',
	        esc_html__( 'here', 'echo-knowledge-base' )
        );
    }

    public static function timeout1_error() {
	    return esc_html__( 'The front-end Editor is taking long to load. Please wait a bit longer.', 'echo-knowledge-base' );
    }

	public static function timeout2_error() {
		ob_start(); ?>
		<p><?php esc_html_e( 'Please check if you have any errors reported in admin > Tools > Site Health.', 'echo-knowledge-base' ); ?></p>
		<p><?php esc_html_e( 'Try a different browser.', 'echo-knowledge-base' ); ?></p>        <?php
		return ob_get_clean();
	}

	public static function other_error_found() {
		return ''; //esc_html__( 'We found an issue with your website configuration.', 'echo-knowledge-base' );
	}

}
