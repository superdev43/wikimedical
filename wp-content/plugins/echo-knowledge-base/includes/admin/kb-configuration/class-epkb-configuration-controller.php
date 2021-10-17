<?php

/**
 * Control for KB Configuration admin page
 */
class EPKB_Configuration_Controller {

	public function __construct() {

		add_action( 'wp_ajax_epkb_wpml_enable', array( $this, 'wpml_enable' ) );
		add_action( 'wp_ajax_nopriv_epkb_wpml_enable', array( 'EPKB_Utilities', 'user_not_logged_in' ) );

		add_action( 'wp_ajax_epkb_save_access_control', array( 'EPKB_Admin_UI_Access', 'save_access_control' ) );
		add_action( 'wp_ajax_nopriv_epkb_save_access_control', array( 'EPKB_Utilities', 'user_not_logged_in' ) );

		add_action( 'wp_ajax_epkb_update_kb_name', array( $this, 'update_kb_name' ) );
		add_action( 'wp_ajax_nopriv_epkb_update_kb_name', array( 'EPKB_Utilities', 'user_not_logged_in' ) );
	}

	/**
	 * Triggered when user clicks to toggle wpml setting.
	 */
	public function wpml_enable() {

		// wp_die if nonce invalid or user does not have correct permission
		EPKB_Utilities::ajax_verify_nonce_and_admin_permission_or_error_die( '_wpnonce_epkb_wpml_enable', 'admin_eckb_access_config_write' );

		// get KB ID
		$kb_id = (int)EPKB_Utilities::post( 'epkb_kb_id', 0 );
		if ( ! EPKB_Utilities::is_positive_int( $kb_id ) ) {
			EPKB_Utilities::ajax_show_error_die( EPKB_Utilities::report_generic_error( 410 ) );
		}

		$wpml_enable = EPKB_Utilities::post( 'wpml_enable' );
		if ( $wpml_enable != 'on' ) {
			$wpml_enable = 'off';
		}

		$result = epkb_get_instance()->kb_config_obj->set_value( $kb_id, 'wpml_is_enabled', $wpml_enable );
		if ( is_wp_error( $result ) ) {
			EPKB_Utilities::ajax_show_error_die( EPKB_Utilities::report_generic_error( 412, $result ) );
		}

		// we are done here
		if ( $wpml_enable == 'on' ) {
			EPKB_Utilities::ajax_show_info_die( __( 'WPML enabled', 'echo-knowledge-base' ) );
		} else {
			EPKB_Utilities::ajax_show_info_die( __( 'WPML disabled', 'echo-knowledge-base' ) );
		}
	}

	/**
	 * Handle update for KB Nickname
	 */
	public function update_kb_name() {

		// wp_die if nonce invalid or user does not have correct permission
		EPKB_Utilities::ajax_verify_nonce_and_admin_permission_or_error_die( '_wpnonce_epkb_ajax_action', 'admin_eckb_access_config_write' );

		$kb_id = (int)EPKB_Utilities::post( 'epkb_kb_id', 0 );
		if ( ! EPKB_Utilities::is_positive_int( $kb_id ) ) {
			EPKB_Utilities::ajax_show_error_die( EPKB_Utilities::report_generic_error( 414 ) );
		}

		$new_kb_name = EPKB_Utilities::post( 'epkb_kb_name_input' );

		$result = epkb_get_instance()->kb_config_obj->set_value( $kb_id, 'kb_name', $new_kb_name );
		if ( is_wp_error( $result ) ) {
			EPKB_Utilities::ajax_show_error_die( EPKB_Utilities::report_generic_error( 415 ) );
			return;
		}

		// we are done here
		EPKB_Utilities::ajax_show_info_die( esc_html__( 'KB Name Updated', 'echo-knowledge-base' ) );
	}
}