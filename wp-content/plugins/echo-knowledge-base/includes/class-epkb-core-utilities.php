<?php

/**
 * Various KB Core utility functions
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_Core_Utilities {

	/**
	 * Retrieve a KB article with security checks
	 *
	 * @param $post_id
	 * @return null|WP_Post - return null if this is NOT KB post
	 */
	public static function get_kb_post_secure( $post_id ) {

		if ( empty($post_id) ) {
			return null;
		}

		// ensure post_id is valid
		$post_id = EPKB_Utilities::sanitize_int( $post_id );
		if ( empty($post_id) ) {
			return null;
		}

		// retrieve the post and ensure it is one
		$post = get_post( $post_id );
		if ( empty($post) || ! is_object($post) || ! $post instanceof WP_Post ) {
			return null;
		}

		// verify it is a KB article
		if ( ! EPKB_KB_Handler::is_kb_post_type( $post->post_type ) ) {
			return null;
		}

		return $post;
	}

	/**
	 * Retrieve KB ID.
	 *
	 * @param WP_Post $post
	 * @return int|NULL on ERROR
	 */
	public static function get_kb_id( $post=null ) {
		global $eckb_kb_id;

		$kb_id = '';
		$post = $post === null ? get_post() : $post;
		if ( ! empty($post) && $post instanceof WP_Post ) {
			$kb_id = EPKB_KB_Handler::get_kb_id_from_post_type( $post->post_type );
		}

		$kb_id = empty($kb_id) || is_wp_error($kb_id) ? ( empty($eckb_kb_id) ? '' : $eckb_kb_id ) : $kb_id;
		if ( empty($kb_id) ) {
			EPKB_Logging::add_log("KB ID not found", $kb_id);
			return null;
		}

		return $kb_id;
	}

	/**
	 * Verify kb id is number and is an existing KB ID
	 * @param $kb_id
	 * @return int
	 */
	public static function sanitize_kb_id( $kb_id ) {
		$kb_ids = epkb_get_instance()->kb_config_obj->get_kb_ids();
		$kb_id = EPKB_Utilities::sanitize_int( $kb_id, EPKB_KB_Config_DB::DEFAULT_KB_ID );
		return in_array( $kb_id, $kb_ids ) ? $kb_id : EPKB_KB_Config_DB::DEFAULT_KB_ID;
	}

	public static function is_run_setup_wizard_first_time() {

		$kb_main_pages = epkb_get_instance()->kb_config_obj->get_value( EPKB_KB_Config_DB::DEFAULT_KB_ID, 'kb_main_pages' );

		// not null if demo KB not yet created after installation
		$run_setup = EPKB_Utilities::get_wp_option( 'epkb_run_setup', null );

		return empty( $kb_main_pages ) && $run_setup !== null;
	}

	/**
	 * Handle submission of admin error
	 */
	public static function handle_report_admin_error() {
		global $wp_version;

		// verify that request is authentic
		if ( empty( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], '_epkb_admin_submit_error_form_nonce' ) ) {
			wp_send_json_error( __( 'You do not have permission to edit this knowledge base', 'echo-knowledge-base' ) );
		}

		$first_version = get_option( 'epkb_version_first' );
		$active_theme = wp_get_theme();
		$theme_info = $active_theme->get( 'Name' ) . ' ' . $active_theme->get( 'Version' );

		$email = EPKB_Utilities::post( 'email', '[Email name is missing]', 'email', 50 );
		$first_name = EPKB_Utilities::post( 'first_name' );
		$first_name = empty($first_name) ? '[First name is missing]' : substr( $first_name, 0, 30 );

		$error = EPKB_Utilities::post( 'admin_error' );
		$error = empty($error) ? '[Error details are missing]' : substr( $error, 0, 5000 );

		$kb_config = epkb_get_instance()->kb_config_obj->get_kb_config_or_default( EPKB_KB_Config_DB::DEFAULT_KB_ID );
		$kb_main_page_url = EPKB_KB_Handler::get_first_kb_main_page_url( $kb_config );

		// send feedback
		$api_params = array(
			'epkb_action' => 'epkb_report_error',
			'plugin_name' => EPKB_Utilities::is_amag_on() ? 'Access Manager' : 'EPKB',
			'plugin_version' => class_exists( 'Echo_Knowledge_Base' ) ? Echo_Knowledge_Base::$version : 'N/A',
			'first_version' => empty( $first_version ) ? 'N/A' : $first_version,
			'wp_version' => $wp_version,
			'theme_info' => $theme_info,
			'email' => $email,
			'first_name' => $first_name,
			'editor_error' => $error,
			'kb_main_page' => $kb_main_page_url
		);

		// Call the API
		$response = wp_remote_post(
			esc_url_raw( add_query_arg( $api_params, 'https://www.echoknowledgebase.com' ) ),
			array(
				'timeout' => 15,
				'body' => $api_params,
				'sslverify' => false
			)
		);

		// let user know if it succeeded
		if ( ! is_wp_error( $response ) && $response['response']['code'] >= 200 && $response['response']['code'] < 300 ) {
			wp_send_json_success( __( 'Thank you. We will get back to you soon.', 'echo-knowledge-base' ) );
		} else {
			wp_send_json_error( EPKB_Utilities::report_generic_error( 0, __( 'Could not submit the error.', 'echo-knowledge-base' ) ) );
		}
	}

	/**
	 * Merge core KB config with add-ons KB specs
	 *
	 * @param $kb_id
	 *
	 * @return array
	 */
	public static function retrieve_all_kb_specs( $kb_id ) {

		$feature_specs = EPKB_KB_Config_Specs::get_fields_specification( $kb_id );

		// get add-on configuration from user changes if applicable
		$add_on_specs = apply_filters( 'epkb_add_on_config_specs', array() );
		if ( ! is_array( $add_on_specs ) || is_wp_error( $add_on_specs ) ) {

			$message =
				"<div class='eckb-bottom-notice-message'>
					<div class='contents'>
						<span class='error'>
							<p> " . __( 'Could not change KB specs.', 'echo-knowledge-base' ) . " (8) </p>
						</span>
					</div>
					<div class='epkb-close-notice icon_close'></div>
				</div>";

			wp_die( json_encode( array( 'error' => true, 'message' => $message ) ) );
		}

		// merge core and add-on specs
		return array_merge( $add_on_specs, $feature_specs );
	}

	/**
	 * Get list of archived KBs
	 *
	 * @return array
	 */
	public static function get_archived_kbs() {
		$all_kb_configs = epkb_get_instance()->kb_config_obj->get_kb_configs();
		$archived_kbs = [];
		foreach ( $all_kb_configs as $one_kb_config ) {
			if ( $one_kb_config['id'] !== EPKB_KB_Config_DB::DEFAULT_KB_ID && self::is_kb_archived( $one_kb_config['status'] ) ) {
				$archived_kbs[] = $one_kb_config;
			}
		}
		return $archived_kbs;
	}

	/**
	 * For given Main Page, retrieve its slug by passed page ID
	 *
	 * @param $kb_main_page_id
	 *
	 * @return string
	 */
	public static function get_main_page_slug( $kb_main_page_id ) {

		$kb_page = get_post( $kb_main_page_id );
		if ( empty( $kb_page ) ) {
			return '';
		}

		$slug      = urldecode( sanitize_title_with_dashes( $kb_page->post_name, '', 'save' ) );
		$ancestors = get_post_ancestors( $kb_page );
		foreach ( $ancestors as $ancestor_id ) {
			$post_ancestor = get_post( $ancestor_id );
			if ( empty( $post_ancestor ) ) {
				continue;
			}
			$slug = urldecode( sanitize_title_with_dashes( $post_ancestor->post_name, '', 'save' ) ) . '/' . $slug;
			if ( $kb_main_page_id == $ancestor_id ) {
				break;
			}
		}

		return $slug;
	}

	/**
	 * For given Main Page, retrieve its slug by passed page object
	 *
	 * @param $kb_main_page
	 * @return string
	 */
	public static function get_main_page_slug_by_obj( $kb_main_page ) {

		if ( empty( $kb_main_page ) || empty( $kb_main_page->post_name ) ) {
			return '';
		}

		$slug = urldecode( sanitize_title_with_dashes( $kb_main_page->post_name, '', 'save' ) );
		$ancestors = get_post_ancestors( $kb_main_page );
		foreach ( $ancestors as $ancestor_id ) {
			$post_ancestor = get_post( $ancestor_id );
			if ( empty( $post_ancestor ) ) {
				continue;
			}
			$slug = urldecode( sanitize_title_with_dashes( $post_ancestor->post_name, '', 'save' ) ) . '/' . $slug;
			if ( $kb_main_page->ID == $ancestor_id ) {
				break;
			}
		}

		return $slug;
	}

	public static function is_kb_main_page() {
		global $eckb_is_kb_main_page;
		$ix = (isset($eckb_is_kb_main_page) && $eckb_is_kb_main_page) || EPKB_Utilities::get('is_kb_main_page') == 1 ? 'mp' : 'ap';
		return $ix == 'mp';
	}

	/**
	 * Check if KB is ARCHIVED.
	 *
	 * @param $kb_status
	 * @return bool
	 */
	public static function is_kb_archived( $kb_status ) {
		return $kb_status === 'archived';
	}

	/**
	 * Detect whether Frontend Editor can be shown
	 *
	 * @param $kb_config
	 * @return string
	 */
	public static function is_frontend_editor_hidden( $kb_config ) {
		$issues_found = '';

		if ( $kb_config['article-structure-version'] == 'version-1' ) {
			$issues_found .= 'Before accessing the frontend Editor, we need to update your setup to use our new article HTML structure. ' .
			                 'You might need to make adjustments to your article page after the update. Would you like to proceed? ';
		}

		if ( class_exists('Echo_Elegant_Layouts') && version_compare(Echo_Elegant_Layouts::$version, '2.6.0', '<') ) {
			$issues_found .= 'Please upgrade Elegant Layouts plugin to the 2.6.0 version before accessing the frontend Editor. ';  // do not translate
		}

		if ( class_exists('Echo_Advanced_Search') && version_compare(Echo_Advanced_Search::$version, '2.14.0', '<') ) {
			$issues_found .= 'Please upgrade Advanced Search plugin to the 2.14.0 version before accessing the frontend Editor. ';
		}

		if ( class_exists('Echo_Article_Rating_And_Feedback') && version_compare(Echo_Article_Rating_And_Feedback::$version, '1.4.0', '<') ) {
			$issues_found .= 'Please upgrade Article Rating & Feedback plugin to the 1.4.0 version before accessing the frontend Editor. ';
		}

		if ( class_exists('Echo_Widgets') && version_compare(Echo_Widgets::$version, '1.9.0', '<') ) {
			$issues_found .= 'Please upgrade KB Widgets plugin to the 1.9.0 version before accessing the frontend Editor. ';
		}

		return $issues_found;
	}


	/**************************************************************************************************************************
	 *
	 *                     CATEGORIES
	 *
	 *************************************************************************************************************************/

	/**
	 *
	 * USED TO HANDLE ALL CATEGORIES REGARDLESS OF USER PERMISSIONS.
	 *
	 * Get all existing KB categories.
	 *
	 * @param $kb_id
	 * @param string $order_by
	 * @return array|null - return array of KB categories (empty if not found) or null on error
	 */
	public static function get_kb_categories_unfiltered( $kb_id, $order_by='name' ) {
		/** @var wpdb $wpdb */
		global $wpdb;

		$order = $order_by == 'name' ? 'ASC' : 'DESC';
		$order_by = $order_by == 'date' ? 'term_id' : $order_by;   // terms don't have date so use id
		$kb_category_taxonomy_name = EPKB_KB_Handler::get_category_taxonomy_name( $kb_id );
		$result = $wpdb->get_results( $wpdb->prepare("SELECT t.*, tt.*
												   FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
												   WHERE tt.taxonomy IN (%s) ORDER BY " . esc_sql('t.' . $order_by) . ' ' . $order . ' ', $kb_category_taxonomy_name ) );
		return isset($result) && is_array($result) ? $result : null;
	}

	/**
	 * USED TO HANDLE ALL CATEGORIES REGARDLESS OF USER PERMISSIONS.
	 *
	 * Get KB Article categories.
	 *
	 * @param $kb_id
	 * @param $article_id
	 * @return array|null - categories belonging to the given KB Article or null on error
	 */
	public static function get_article_categories_unfiltered( $kb_id, $article_id ) {
		/** @var $wpdb Wpdb */
		global $wpdb;

		if ( empty($article_id) ) {
			return null;
		}

		// get article categories
		$post_taxonomy_objs = $wpdb->get_results( $wpdb->prepare(
			"SELECT * FROM $wpdb->term_taxonomy
																	 WHERE taxonomy = '%s' and term_taxonomy_id in
																	(SELECT term_taxonomy_id FROM $wpdb->term_relationships WHERE object_id = %d) ",
			EPKB_KB_Handler::get_category_taxonomy_name( $kb_id ), $article_id ) );
		if ( ! empty($wpdb->last_error) ) {
			return null;
		}

		return $post_taxonomy_objs === null || ! is_array($post_taxonomy_objs) ? array() : $post_taxonomy_objs;
	}

	/**
	 * USED TO HANDLE ALL CATEGORIES REGARDLESS OF USER PERMISSIONS.
	 *
	 * Retrieve KB Category.
	 *
	 * @param $kb_id
	 * @param $kb_category_id
	 * @return WP_Term|false
	 */
	public static function get_kb_category_unfiltered( $kb_id, $kb_category_id ) {
		$term = get_term_by('id', $kb_category_id, EPKB_KB_Handler::get_category_taxonomy_name( $kb_id ) );
		if ( empty($term) || ! $term instanceof WP_Term ) {
			EPKB_Logging::add_log( "Category is not KB Category: " . $kb_category_id . " (35)", $kb_id );
			return false;
		}

		return $term;
	}
}
