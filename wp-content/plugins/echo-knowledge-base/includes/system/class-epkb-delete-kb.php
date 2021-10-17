<?php

/**
 * Delete All KB
 *
 */
class EPKB_Delete_KB {

	private $message = array(); // error/warning/success messages

	function __construct() {
		// Handle manage kb buttons and other, set messages here
		$this->handle_form_actions();
	}

	/**
	 * Return HTML form to delete all KBs data
	 */
	public function get_delete_all_kbs_data_form() {

		// only administrators can handle this page
		if ( ! current_user_can('manage_options') ) {
			return '';
		}

		$html = new EPKB_HTML_Elements();

		ob_start();     ?>

		<form class="epkb-delete-kbs" action="<?php echo admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( EPKB_KB_Config_DB::DEFAULT_KB_ID ) . '&page=epkb-add-ons#other' ); ?>" method="post">      <?php

			$html->text_basic( array(
				'value' => '',
				'name'    => 'delete_text',
			) );
			$html->submit_button( __( 'Delete All', 'echo-knowledge-base' ), 'epkb_delete_all', '', '', true, '', 'epkb-error-btn' );   ?>

		</form>     <?php

		// show any notifications
		foreach ( $this->message as $class => $message ) {
			echo  EPKB_Utilities::get_bottom_notice_message_box( $message, '', $class );
		}

		return ob_get_clean();
	}

	// Handle actions that need reload of the page - manage tab and other from addons
	private function handle_form_actions() {
		/** @global wpdb $wpdb */
		global $wpdb;

		if ( empty($_REQUEST['action']) ) {
			return;
		}

	   // clear any messages
		$this->message = array();
        update_option( 'epkb_delete_all_kb_data', '' );

		// verify that request is authentic
		if ( ! isset( $_REQUEST['_wpnonce_epkb_delete_all'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce_epkb_delete_all'], '_wpnonce_epkb_delete_all' ) ) {
		  $this->message['error'] = __( 'Error occurred', 'echo-knowledge-base' ) . ' (1)';
		  return;
		}

		// ensure user has correct permissions
		if ( ! current_user_can( 'manage_options' ) ) {
		  $this->message['error'] = __( 'You do not have permission.', 'echo-knowledge-base' );
		  return;
		}

		// ensure user wants to delete the KB data
		$action = EPKB_Utilities::post( 'action' );
		if ( empty($action) || $action != 'epkb_delete_all' ) {
          $this->message['error'] = __( 'Error occurred', 'echo-knowledge-base' ) . ' (2)';
          return;
		}

		// Delete Data
		if ( EPKB_Utilities::post( 'delete_text' ) != 'delete' ) {
			$this->message['error'] = sprintf( __( 'Write "%s" in input box to delete ALL KB data', 'echo-knowledge-base' ), 'delete' );
			return;
		}

		$db_kb_config = new EPKB_KB_Config_DB();
		$all_kb_ids = $db_kb_config->get_kb_ids();
		foreach ( $all_kb_ids as $kb_id ) {
			self::delete_kb_data( $kb_id );
		}

		// Remove all database tables
		$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "epkb_kb_search_data" );
		$wpdb->query( "DROP TABLE IF EXISTS " . $wpdb->prefix . "epkb_article_ratings" );

       update_option( 'epkb_delete_all_kb_data', 'delete' );

       $this->message['success'] = __( 'All articles and categories deleted. Options will be deleted when plugin is uninstalled.', 'echo-knowledge-base' );
	}

	/**
	 * Delete given KB data
	 * @param $kb_id
	 */
	private function delete_kb_data( $kb_id ) {

		// delete all KB post type posts
		$post_type = EPKB_KB_Handler::get_post_type( $kb_id );
		$kb_posts = get_posts( array(
				'post_type'   => $post_type,
				'post_status' => 'any',
				'posts_per_page' => -1,
			)
		);
		if ( ! empty($kb_posts) ) {
			foreach ($kb_posts as $post) {
				if ( EPKB_KB_Handler::is_kb_post_type($post->post_type) && $post->post_type == $post_type ) {
					wp_delete_post($post->ID, true);
				}
			}
		}

		// delete all KB categories and terms
		$kb_category = EPKB_KB_Handler::get_category_taxonomy_name( $kb_id );
		$kb_tag = EPKB_KB_Handler::get_tag_taxonomy_name( $kb_id );

		// Delete all KB CATEGORIES
		$terms = get_terms( $kb_category, array('hide_empty' => false) );
		if ( ! is_wp_error($terms) && is_array($terms) ) {
			foreach( $terms as $term ) {
				if ( isset($term->term_id) && $term->taxonomy == $kb_category )
					wp_delete_term( $term->term_id, $term->taxonomy );
			}
		}

		// Delete all KB TERMS
		$terms = get_terms( $kb_tag, array('hide_empty' => false) );
		if ( ! is_wp_error($terms) && is_array($terms) ) {
			foreach( $terms as $term ) {
				if ( isset($term->term_id) && $term->taxonomy == $kb_tag )
					wp_delete_term( $term->term_id, $term->taxonomy );
			}
		}
	}
}