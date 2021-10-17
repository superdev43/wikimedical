<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display KB configuration menu and pages
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_Configuration_Page {

	private $message = array(); // error/warning/success messages
	private $export_link = array(); // link to the file for export
	private $kb_config;
	private $kb_main_pages;
	private $settings_view_contexts = ['admin_eckb_access_order_articles_write', 'admin_eckb_access_config_write'];

	function __construct() {

		// reset cache and get latest KB config
		epkb_get_instance()->kb_config_obj->reset_cache();
		$this->kb_config = epkb_get_instance()->kb_config_obj->get_current_kb_configuration();
		$this->kb_main_pages = EPKB_KB_Handler::get_kb_main_pages( $this->kb_config );

		// handle user interactions
		if ( EPKB_Utilities::post( 'action' ) == 'epkb_update_article_v2' ) {
			$this->kb_config = $this->switch_user_to_article_v2();
		}

		$this->handle_form_actions();
	}

	/**
	 * Displays the KB Config page with top panel + sidebar + preview panel
	 */
	public function display_kb_config_page() {

		// get current add-ons configuration
		$wizard_kb_config = $this->kb_config;
		$wizard_kb_config = apply_filters( 'epkb_all_wizards_get_current_config', $wizard_kb_config, EPKB_KB_Handler::get_current_kb_id() );
		if ( is_wp_error( $wizard_kb_config ) ) {
			echo '<p>' . esc_html__( 'Could not retrieve KB configuration.', 'echo-knowledge-base' ) . ' (777: ' . $wizard_kb_config->get_error_message() . ') ' . EPKB_Utilities::contact_us_for_support() . '</p>';
			return;
		}
		if ( empty($wizard_kb_config) || ! is_array($wizard_kb_config) || count($wizard_kb_config) < 100 ) {
			echo '<p>' . esc_html__( 'Could not retrieve KB configuration.', 'echo-knowledge-base' ) . ' (7782) ' . EPKB_Utilities::contact_us_for_support() . '</p>';
			return;
		}

		EPKB_HTML_Admin::admin_page_css_missing_message();


		//-------------------------------- WIZARDS --------------------------------

		// Check if Frontend Editor disabled
		$frontend_editor_hide_reason = EPKB_Core_Utilities::is_frontend_editor_hidden( $this->kb_config );

		// should we display Setup Wizard or KB Configuration?
		if ( isset( $_GET['setup-wizard-on'] ) && EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_frontend_editor_write' ) ) {
			$handler = new EPKB_KB_Wizard_Setup();
			$handler->display_kb_setup_wizard( $wizard_kb_config['id'] );
			return;
		}

		// should we display Wizard or KB Configuration?
		if ( isset( $_GET['wizard-theme'] ) ) {
			$handler = new EPKB_KB_Wizard();
			if ( $frontend_editor_hide_reason != '' ) {
				EPKB_HTML_Admin::deprecated_wizard_warning();
			}
			$handler->display_kb_wizard( $wizard_kb_config );
			return;
		}

		// should we display Features Wizard or KB Configuration?
		if ( isset( $_GET['wizard-features'] ) ) {
			$handler = new EPKB_KB_Wizard_Features();
			if ( $frontend_editor_hide_reason != '' ) {
				EPKB_HTML_Admin::deprecated_wizard_warning();
			}
			$handler->display_kb_wizard( $wizard_kb_config );
			return;
		}


		//---------------------- GENERAL CONFIGURATION PAGE -----------------------

		/**
		 * Views of the Configuration Admin Page - show limited content for users that did not complete Setup Wizard
		 */
		if ( isset( $_GET['archived-kbs'] ) ) {
			$admin_page_views = self::get_archvied_kbs_views_config();

		} else {
			$admin_page_views = EPKB_Core_Utilities::is_run_setup_wizard_first_time()
				? self::get_run_setup_first_views_config()
				: $this->get_regular_views_config( $wizard_kb_config, $frontend_editor_hide_reason );
		}   ?>

		<!-- Admin Page Wrap -->
		<div id="ekb-admin-page-wrap" class="ekb-admin-page-wrap epkb-config-container epkb-kb-config">    <?php

			/**
			 * ADMIN HEADER (KB logo and list of KBs dropdown)
			 */
			EPKB_HTML_Admin::admin_header( EPKB_HTML_Admin::admin_header_content( $this->kb_config, ['admin_eckb_access_order_articles_write', 'admin_eckb_access_frontend_editor_write'] ) );

			/**
			 * ADMIN TOOLBAR
			 */
			EPKB_HTML_Admin::admin_toolbar( $admin_page_views );

			/**
			 * ADMIN SECONDARY TABS
			 */
			EPKB_HTML_Admin::admin_secondary_tabs( $admin_page_views );

			/**
			 * LIST OF SETTINGS IN TABS
			 */
			EPKB_HTML_Admin::admin_settings_tab_content( $admin_page_views, '', $frontend_editor_hide_reason );

			/**
			 * Warning for Frontend Editor
			 */
			if ( $frontend_editor_hide_reason != '' ) {   ?>

				<!--  WARNING for FRONTEND EDITOR -->
				<div id='epkb-editor-disabled'>  <?php
					EPKB_Utilities::dialog_box_form( array(
						'id' => 'epkb-editor-disabled-popup',
						'title' => __( 'Warning', 'echo-knowledge-base' ),
						'body' => $frontend_editor_hide_reason,
						'accept_type' => 'warning',
						'accept_label' => __( 'OK', 'echo-knowledge-base' ),
						'form_method' => 'post',
						'form_inputs' => array(
							0 => '<input type="hidden" name="_wpnonce_update_kbs" value="' . esc_attr( wp_create_nonce( "_wpnonce_update_kbs" ) ) . '">',
							1 => '<input type="hidden" name="action" value="epkb_update_article_v2">',
							2 => '<input type="hidden" name="epkb_kb_id" value="' . esc_attr( $this->kb_config['id'] ) . '">'
						),
					) ); ?>
				</div>			<?php
			}

			// Generic confirmation box
			EPKB_HTML_Forms::generic_confirmation_box();    ?>

		</div>  <?php

		/**
		 * Show any notifications
		 */
		foreach ( $this->message as $class => $message ) {
			echo  EPKB_Utilities::get_bottom_notice_message_box( $message, '', $class );
		}
	}

	/**
	 * KB Design: Box Editors List
	 *
	 * @return false|string
	 */
	private function show_frontend_editor_links() {

		$editor_urls = EPKB_Editor_Utilities::get_editor_urls( $this->kb_config );

		ob_start();

		// Main page link to editor
		if ( $editor_urls['main_page_url'] != '' ) {
			EPKB_HTML_Forms::call_to_action(array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/basic-layout-light.jpg',
				'title' => __('Main Page', 'echo-knowledge-base' ),
				'btn_text' => __('Configure', 'echo-knowledge-base' ),
				'btn_url' => $editor_urls['main_page_url'],
				'btn_target' => "_blank"
			) );
		} else {
			EPKB_HTML_Forms::call_to_action( array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/basic-layout-light.jpg',
				'title'         => __( 'Main Page', 'echo-knowledge-base' ),
				'content'       => __( 'No Main Page Found', 'echo-knowledge-base' ),
				'btn_text'      => __( 'Add Shortcode', 'echo-knowledge-base' ),
				'btn_url'       => admin_url( "edit.php?post_type=" . EPKB_KB_Handler::get_post_type( $this->kb_config['id'] ) . "&page=epkb-kb-configuration&wizard-global" ),
				'btn_target'	  => "_blank",
				'wizard_type'   => "not_found"
			) );
		}

		// Article page link to editor
		if ( $editor_urls['article_page_url'] != '' ) {
			EPKB_HTML_Forms::call_to_action( array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/article-page.jpg',
				'title'         => __( 'Article Page', 'echo-knowledge-base' ),
				'btn_text'      => __( 'Configure', 'echo-knowledge-base' ),
				'btn_url'       => $editor_urls['article_page_url'],
				'btn_target'    => "_blank"
			) );
		} else {
			EPKB_HTML_Forms::call_to_action( array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/article-page.jpg',
				'title'         => __( 'Article Page', 'echo-knowledge-base' ),
				'content'       => __( 'All articles have no Category. Please assign your article to categories.', 'echo-knowledge-base' ),
				'btn_text'      => __( 'Add New Article', 'echo-knowledge-base' ),
				'btn_url'       => admin_url( "post-new.php?post_type=" . EPKB_KB_Handler::get_post_type( $this->kb_config['id'] ) ),
				'btn_target'    => "_blank",
				'wizard_type'   => "not_found"
			) );
		}

		// Archive page link to editor
		if ( $this->kb_config['templates_for_kb'] == 'current_theme_templates' ) {
			EPKB_HTML_Forms::call_to_action(array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/category-archive-page.jpg',
				'title' => __( 'Category Archive Page', 'echo-knowledge-base' ),
				'content' => sprintf(  __( 'The KB template option is set to the Current Theme. You need to configure your Archive Page template in ' .
					'your theme settings. For details about the KB template option see %s', 'echo-knowledge-base' ),
					' <a href="https://www.echoknowledgebase.com/documentation/current-theme-template-vs-kb-template/" target="_blank">' . esc_html__( 'here', 'echo-knowledge-base' ) . '.' . '</a> ' )
			) );
		} else if ( $editor_urls['archive_url'] != '' ) {
			EPKB_HTML_Forms::call_to_action(array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/category-archive-page.jpg',
				'title' => __('Category Archive Page', 'echo-knowledge-base'),
				'btn_text' => __('Configure', 'echo-knowledge-base'),
				'btn_url' => $editor_urls['archive_url'],
				'btn_target' => "_blank"
			) );
		} else {
			EPKB_HTML_Forms::call_to_action(array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/category-archive-page.jpg',
				'title' => __('Category Archive Page', 'echo-knowledge-base'),
				'content' => __('No Categories Found', 'echo-knowledge-base'),
				'btn_text' => __('Add New Category', 'echo-knowledge-base'),
				'btn_url' => admin_url('edit-tags.php?taxonomy=' . EPKB_KB_Handler::get_category_taxonomy_name( $this->kb_config['id'] ) .'&post_type=' . EPKB_KB_Handler::get_post_type( $this->kb_config['id'] )),
				'btn_target' => "_blank",
				'wizard_type'   => "not_found"
			) );
		}

		// Advanced Search Page
		if ( EPKB_Utilities::is_advanced_search_enabled() && $editor_urls['search_page_url'] != '' ) {
			EPKB_HTML_Forms::call_to_action( array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/search-result-page.png',
				'title'         => __( 'Search Results Page', 'echo-knowledge-base' ),
				'btn_text'      => __( 'Configure', 'echo-knowledge-base' ),
				'btn_url'       => $editor_urls['search_page_url'],
				'btn_target'    => "_blank"
			) );
		} else if ( EPKB_Utilities::is_advanced_search_enabled() ) {
			EPKB_HTML_Forms::call_to_action( array(
				'style' => 'style-1',
				'icon_img_url'  => 'img/editor/basic-layout-light.jpg',
				'title'         => __( 'Search Results Page', 'echo-knowledge-base' ),
				'content'       => __( 'To edit the Search Results page, be sure you have a KB Main Page.', 'echo-knowledge-base' ),
				'btn_text'      => __( 'Configure KB Main Page', 'echo-knowledge-base' ),
				'btn_url'       => admin_url( "edit.php?post_type=" . EPKB_KB_Handler::get_post_type( $this->kb_config['id'] ) . "&page=epkb-kb-configuration#settings__kb-urls" ),
				'btn_target'	  => "_blank",
				'wizard_type'   => "not_found"
			) );
		}

		return ob_get_clean();
	}

	/**
	 * Help Dialog: Box Content
	 *
	 * @return false|string
	 */
	private static function show_help_dialog_option() {

		ob_start(); ?>

		<!--  Help Dialog Tab Content -->
		<div class="epkb-config-content-wrapper" id="epkb-help-dialog-content">
			<div class="epkb-help-dialog-content__img">
				<img src="<?php echo esc_url( Echo_Knowledge_Base::$plugin_url . 'img/featured-screenshots-help-dialog-example.jpg' ); ?>">
			</div>
		</div>  <?php

		return ob_get_clean();
	}

	/**
	 * Get Export Box
	 *
	 * @return false|string
	 */
	private function get_export_box() {

		$kb_id = $this->kb_config['id'];

		ob_start();    ?>

		<!-- Export Config -->
		<div class="epkb-admin-info-box">
			<div class="epkb-admin-info-box__body">
				<p><?php _e( 'This will export the following KB settings:', 'echo-knowledge-base'); ?></p>
				<?php $this->display_import_export_info(); ?>
				<form class="epkb-export-kbs" action="<?php echo esc_url( add_query_arg( array( 'active_kb_tab' => $kb_id, 'active_action_tab' => 'export' ) ) ); ?>" method="post">
					<p><?php _e( 'You can export KB and add-ons configuration.', 'echo-knowledge-base'); ?></p>
					<input type="hidden" name="_wpnonce_manage_kbs" value="<?php echo esc_attr( wp_create_nonce( "_wpnonce_manage_kbs" ) ); ?>"/>
					<input type="hidden" name="action" value="epkb_export_knowledge_base"/>
					<input type="hidden" name="emkb_kb_id" value="<?php echo esc_attr( $kb_id ); ?>"/>
					<input type="submit" class="epkb-primary-btn" value="<?php esc_html_e( 'Export Configuration', 'echo-knowledge-base' ); ?>" /><br/>
					<?php if ( ! empty( $this->export_link[$kb_id] ) ) { ?>
						<a href="<?php echo esc_url( $this->export_link[$kb_id] ); ?>" download class="epkb_download_export_link info-btn"><?php esc_html_e( 'Download Export File', 'echo-knowledge-base' ); ?></a>
					<?php } ?>
				</form>
			</div>
		</div>		<?php

		return ob_get_clean();
	}

	/**
	 * Get Import Box
	 *
	 * @return false|string
	 */
	private function get_import_box() {

		// reset cache and get latest KB config
		epkb_get_instance()->kb_config_obj->reset_cache();

		ob_start();     ?>

		<!-- Import Config -->
		<div class="epkb-admin-info-box">
			<div class="epkb-admin-info-box__body">
				<p><?php echo  __( 'This import will overwrite the following KB settings:', 'echo-knowledge-base' ); ?></p>
				<?php $this->display_import_export_info(); ?>
				<form class="epkb-import-kbs" action="<?php echo esc_url( add_query_arg( array( 'active_kb_tab' => $this->kb_config['id'], 'active_action_tab' => 'import' ) ) ); ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_wpnonce_manage_kbs" value="<?php echo wp_create_nonce( "_wpnonce_manage_kbs" ); ?>"/>
					<input type="hidden" name="action" value="epkb_import_knowledge_base"/>
					<input type="hidden" name="emkb_kb_id" value="<?php echo esc_attr( $this->kb_config['id'] ); ?>"/>
					<input class="epkb-form-label__input epkb-form-label__input--text" type="file" name="import_file" required><br>
					<input type="submit" class="epkb-primary-btn" value="<?php esc_attr_e( 'Import Configuration', 'echo-knowledge-base' ); ?>" /><br/>
				</form>
			</div>
		</div>  <?php

		return ob_get_clean();
	}

	/**
	 * Get Import Ad Box
	 *
	 * @return false|string
	 */
	private function get_import_ad_box() {

		ob_start();

		$this->display_import_ad();

		return ob_get_clean();
	}

	private function display_import_ad() {

		if ( EPKB_Utilities::is_export_import_enabled() ) {
			return;
		}

		EPKB_HTML_Forms::advertisement_ad_box( array(
			'icon'              => 'epkbfa-linode',
			'title'             => 'Import / Export Add-on',
			'img_url'           => 'https://www.echoknowledgebase.com/wp-content/uploads/edd/2020/08/KB-Import-Export-Banner.jpg',
			'desc'              => __( 'Import articles and categories into your knowledge base.', 'echo-knowledge-base' ),
			'list'              => array(
				__( 'Import articles from another knowledge base software', 'echo-knowledge-base' ),
				__( 'Generate articles from different content sources and systems', 'echo-knowledge-base' ),
				__( 'Use CSV as a quick way to add short articles', 'echo-knowledge-base' )
			),
			'btn_text'          => 'Buy Now!',
			'btn_url'           => 'https://www.echoknowledgebase.com/wordpress-plugin/kb-import-export/',
			'btn_color'         => 'green',

			'more_info_text'    => 'More Information',
			'more_info_url'     => 'https://www.echoknowledgebase.com/documentation/import-articles/',
			'more_info_color'   => 'blue',
			'box_type'			   => 'new-feature',
		));
	}

	private function display_import_export_info() {		?>
		<ul>
			<li><?php _e('Configuration for all text, styles, features.', 'echo-knowledge-base'); ?></li>
			<li><?php _e('Configuration for all add-ons.', 'echo-knowledge-base'); ?></li>
		</ul>
		<p><?php _e('Instructions:', 'echo-knowledge-base'); ?></p>
		<ul>
			<li><?php _e('Test import and export on your staging or test site before importing configuration in production.', 'echo-knowledge-base'); ?></li>
			<li><?php _e('Always back up your database before starting the import.', 'echo-knowledge-base'); ?></li>
			<li><?php _e('Preferably run import outside of business hours.', 'echo-knowledge-base'); ?></li>
		</ul>		<?php
	}

	/***
	 * Handle Form Action
	 *
	 * @return mixed
	 */
	private function switch_user_to_article_v2() {

		// convert article structure to version 2
		$result = epkb_get_instance()->kb_config_obj->set_value( $this->kb_config['id'], 'article-structure-version', 'version-2' );
		if ( is_wp_error( $result ) ) {
			$this->message['error'] = __( 'Something went wrong', 'echo-knowledge-base' ) . ' (64)';
			return $this->kb_config;
		}

		if ( $this->kb_config['article_toc_enable'] == 'on' ) {

			if ( $this->kb_config['article_toc_position'] == 'left' ) {
				$this->kb_config['article_sidebar_component_priority']['toc_left'] = 1;
				$this->kb_config['article-right-sidebar-toggle'] = 'on';
			} else if ( $this->kb_config['article_toc_position'] == 'right' ) {
				$this->kb_config['article_sidebar_component_priority']['toc_right'] = 1;
				$this->kb_config['article-right-sidebar-toggle'] = 'on';
			} else if ( $this->kb_config['article_toc_position'] == 'middle' ) {
				$this->kb_config['article_sidebar_component_priority']['toc_content'] = 1;
				$this->kb_config['article-right-sidebar-toggle'] = 'on';
			}
		}

		$this->kb_config['article-structure-version'] = 'version-2';

		$new_config = EPKB_Editor_Controller::reset_layout( $this->kb_config, $this->kb_config );
		$result = epkb_get_instance()->kb_config_obj->update_kb_configuration( $new_config['id'], $new_config );
		if ( is_wp_error( $result ) ) {

			/* @var $result WP_Error */
			$message = $result->get_error_message();
			if ( empty($message) ) {
				$this->message['error'] = __( 'Could not save the new configuration', 'echo-knowledge-base' ) . '(3)';
			} else {
				$this->message['error'] = __( 'Configuration NOT saved due to following problem:' . $message, 'echo-knowledge-base' );
			}

		} else {
			// redirect to editor page if change successful
			wp_redirect( EPKB_Editor_Utilities::get_one_editor_url( 'main_page', 'templates' ) );
		}

		return $this->kb_config;
	}

	/**
	 * Show multilingual settings
	 *
	 * @return false|string
	 */
	private function show_multilingual_settings() {

		ob_start();

		EPKB_HTML_Elements::checkbox_toggle( array(
							'id'            => 'epkb_wpml_enable',
							'text'          => 'WPML Enable',
							'textLoc'       => 'left',
							'topDesc'       => '<a href="https://www.echoknowledgebase.com/documentation/setup-wpml-for-knowledge-base/" target="_blank">' . esc_html__( 'Follow WPML setup instructions here.', 'echo-knowledge-base' ) . '</a>',
							'checked'       => ( ! empty( $this->kb_config['wpml_is_enabled'] ) && $this->kb_config['wpml_is_enabled'] == 'on' ),
						) );
		echo '<input type="hidden" id="_wpnonce_epkb_wpml_enable" name="_wpnonce_epkb_wpml_enable" value="' . esc_attr( wp_create_nonce( "_wpnonce_epkb_wpml_enable" ) ) . '"/>';
		echo '<input type="hidden" id="epkb_wpml_enable_kb_id" name="epkb_wpml_enable_kb_id" value="' . esc_attr( $this->kb_config['id'] ) . '"/>';

		return ob_get_clean();
	}

	/**
	 * Get configuration array for regular views of KB Configuration page
	 *
	 * @param $wizard_kb_config
	 * @param $frontend_editor_hide_reason
	 * @return array[]
	 */
	private function get_regular_views_config( $wizard_kb_config, $frontend_editor_hide_reason ) {

		$wizard_ordering = new EPKB_KB_Wizard_Ordering();
		$wizard_global = new EPKB_KB_Wizard_Global( $wizard_kb_config );

		$errors_tab_config = $this->get_errors_view_config();

		/**
		 * VIEW: Overview
		 */
		$overview_view_config = array(

			// Shared
			'active' => empty( $errors_tab_config ),
			'minimum_required_capability' => EPKB_Admin_UI_Access::get_author_capability(),
			'list_key' => 'overview',
			'kb_config_id' => $this->kb_config['id'],
			'is_frontend_editor_hidden' => false,

			// Top Panel Item
			'label_text' => __( 'Overview', 'echo-knowledge-base' ),
			'icon_class' => 'epkbfa epkbfa-cubes',

			// Show actions row with Archive/Delete buttons only for non default and active KBs
			'list_top_actions_html' => ( $this->kb_config['id'] == EPKB_KB_Config_DB::DEFAULT_KB_ID || EPKB_Core_Utilities::is_kb_archived( $this->kb_config['status'] ) ) ? '' : $this->get_kb_actions(),

			// Boxes List
			'boxes_list' => array(

				// Box: About KB
				array(
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_author_capability(),
					'class' => 'epkb-admin__boxes-list__box__about-kb',
					'title' => __( 'About KB', 'echo-knowledge-base' ),
					'description' => '',
					'html' => $this->get_about_kb_box(),
				),

				// Box: KB Name
				array(
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
					'class' => 'epkb-admin__boxes-list__box__kb-name',
					'title' => __( 'KB Nickname', 'echo-knowledge-base' ),
					'description' => __( 'Give your Knowledge Base a name. The name will show when we refer to it or when you see a list of post types.', 'echo-knowledge-base' ),
					'html' => $this->get_kb_name_box(),
				),

				// Box: KB Location
				array(
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
					'class' => 'epkb-admin__boxes-list__box__kb-location',
					'title' => __( 'KB Location', 'echo-knowledge-base' ),
					'description' => '',
					'html' => $this->get_kb_location_box(),
				)
			),
		);

		/**
		 * VIEW: KB Design
		 */
		$kb_design_view_config = array(

			// Shared
			'active' => false,
			'list_key' => 'kb-design',
			'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_frontend_editor_write' ),
			'kb_config_id' => $this->kb_config['id'],
			'is_frontend_editor_hidden' => $frontend_editor_hide_reason != '',

			// Top Panel Item
			'label_text' => __( 'KB Design', 'echo-knowledge-base' ),
			'icon_class' => 'epkbfa epkbfa-paint-brush',

			// Boxes List
			'boxes_list' => array(

				// Box: Configure Frontend Editors
				array(
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_frontend_editor_write' ),
					'class' => 'epkb-admin__boxes-list__box__editors-list',
					'title' => __( 'Configure text, fonts, colors, and style for your Knowledge Base.', 'echo-knowledge-base' ),
					'html' => $this->show_frontend_editor_links(),
				),
			),
		);

		/**
		 * VIEW: HELP DIALOG
		 */
		/* TODO $help_dialog_view_config = array(

			// Shared
			'minimum_required_capability' => EPKB_Admin_UI_Access::get_editor_capability(),
			'list_key' => 'help-dialog',

			// Top Panel Item
			'label_text' => __( 'Help Dialog', 'echo-knowledge-base' ),
			'icon_class' => 'ep_font_icon_help_dialog',

			// Boxes List
			'boxes_list' => array(

				// Box: Help Dialog Content
				array(
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_editor_capability(),
					'class' => 'epkb-admin__boxes-list__box__enable-help-dialog',
					'title' => __( 'Get Help Dialog Widget', 'echo-knowledge-base' ),
					'html' => self::show_help_dialog_option(),
				),
			)
		); */

		/**
		 * VIEW: SETTINGS
		 */
		$kb_url_boxes = [];
		if ( empty( $this->kb_main_pages ) ) {
			$kb_url_boxes[] = array(
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
				'title' => __( 'Control Your Knowledge Base URL', 'echo-knowledge-base' ),
				'html' => EPKB_HTML_Admin::display_no_shortcode_warning( $this->kb_config, true ),
				'class' => 'epkb-admin__warning-box',
			);

		} else {

			// Box: Category Name in KB URL
			$kb_url_boxes[] = array(
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
				'title' => __( 'Category Name in KB URL', 'echo-knowledge-base' ),
				'html' => EPKB_HTML_Elements::checkbox_toggle( array(
					'id'            => 'categories_in_url_enabled__toggle',
					'textLoc'       => 'right',
					'data'          => 'on',
					'toggleOnText'  => __( 'yes', 'echo-knowledge-base' ),
					'toggleOffext'  => __( 'no', 'echo-knowledge-base' ),
					'checked'       => $this->kb_config['categories_in_url_enabled'] == 'on',
					'return_html'   => true,
					'topDesc'       => __( 'Should article URLs contain the slug of their categories?', 'echo-knowledge-base' ),
				) ),
				'class' => 'epkb-admin__toggle-box',
			);

			// Box: Control Your Knowledge Base URL
			$kb_url_boxes[] = array(
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
				'title' => __( 'Control Your Knowledge Base URL', 'echo-knowledge-base' ),
				'html' => $wizard_global->show_kb_urls_global_wizard(),
				'class' => 'epkb-admin__wizard-box',
			);
		}

		// call first to set proper permissions
		$various_settings = $this->get_various_secondary_tab();

		$settings_view_config = array(

			// Shared
			'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( $this->settings_view_contexts ),
			'list_key' => 'settings',

			// Top Panel Item
			'label_text' => __( 'Settings', 'echo-knowledge-base' ),
			'icon_class' => 'epkbfa epkbfa-cogs',

			// Secondary Panel Items
			'secondary' => array(

				// SECONDARY VIEW: Order Articles
				array(

					// Shared
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_order_articles_write' ),
					'active' => ! EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_config_write' ),
					'list_key' => 'order-articles',

					// Secondary Panel Item
					'label_text' => __( 'Order Articles', 'echo-knowledge-base' ),

					// Secondary Boxes List
					'boxes_list' => array(

						// Box: Ordering Settings
						array(
							'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_order_articles_write' ),
							'title' => __( 'Ordering Settings', 'echo-knowledge-base' ),
							'html' => $wizard_ordering->show_article_ordering( $wizard_kb_config ),
						),
					),
				),

				// SECONDARY VIEW: KB URLs
				array(

					// Shared
					'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
					'active' => true,
					'list_key' => 'kb-urls',

					// Secondary Panel Item
					'label_text' => __( 'KB URL', 'echo-knowledge-base' ),

					// Secondary Boxes List
					'boxes_list' => $kb_url_boxes,
				),

				// SECONDARY VIEW: ACCESS CONTROL
				array(

					// Shared
					'list_key' => 'access-control',

					// Secondary Panel Item
					'label_text' => __( 'Access Control', 'echo-knowledge-base' ),

					// Secondary Boxes List
					'list_top_actions_html' => '<div class="epkb-admin__list-actions-row">' . EPKB_HTML_Elements::submit_button_v2( __( 'Save Access Control Settings', 'echo-knowledge-base' ), 'epkb_save_access_control', 'epkb-admin__save-access-control-btn', '', true, true, 'epkb-success-btn' ) . '</div>',
					'boxes_list' => EPKB_Admin_UI_Access::get_access_boxes( $this->kb_config ),
				),

				// SECONDARY VIEW: Various
				$various_settings,
			),
		);

		/**
		 * VIEW: TOOLS
		 */

		// Export Boxes from add-ons
		$add_on_export_boxes = apply_filters( 'epkb_config_page_export_boxes', [], $this->kb_config );
		if ( empty( $add_on_export_boxes ) || ! is_array( $add_on_export_boxes ) ) {
			$add_on_export_boxes = [];
		}

		// Import Boxes from add-ons
		$add_on_import_boxes = apply_filters( 'epkb_config_page_import_boxes', [], $this->kb_config );
		if ( empty( $add_on_import_boxes ) || ! is_array( $add_on_import_boxes ) ) {
			$add_on_import_boxes = [];
		}

		// Tools View config
		$tools_view_config = array(

			// Shared
			'list_key' => 'tools',

			// Top Panel Item
			'label_text' => __( 'Tools', 'echo-knowledge-base' ),
			'icon_class' => 'epkbfa epkbfa-wrench',

			// Secondary Panel Items
			'secondary' => array(

				// SECONDARY VIEW: EXPORT
				array(

					// Shared
					'list_key' => 'export',
					'active' => true,

					// Secondary Panel Item
					'label_text' => __( 'Export', 'echo-knowledge-base' ),

					// Secondary Boxes List
					'boxes_list' => array_merge( array(

						// Box: Export
						array(
							'title' => __( 'Export KB Configuration', 'echo-knowledge-base' ),
							'html' => $this->get_export_box(),
						) ),

						// Export boxes from add-ons
						$add_on_export_boxes
					),
				),

				// SECONDARY VIEW: IMPORT
				array(

					// Shared
					'list_key' => 'import',

					// Secondary Panel Item
					'label_text' => __( 'Import', 'echo-knowledge-base' ),

					// Secondary Boxes List
					'boxes_list' => EPKB_Utilities::is_admin() ? array_merge( array(

						// Box: Import
						array(
							'title' => __( 'Import KB Configuration', 'echo-knowledge-base' ),
							'html' => $this->get_import_box(),
						),

						// Box: Import Ad - show only if EPIE add-on is not activated
						( EPKB_Utilities::is_export_import_enabled()
							? []
							: array(
								'class' => 'epkb-admin__boxes-list__box__tools-import-ad',
								'html' => $this->get_import_ad_box() )
						) ),

						// Import boxes from add-ons
						$add_on_import_boxes
					) : [],
				),
			),
		);

		/**
		 * OUTPUT VIEWS CONFIG
		 */

		// compose views
		$core_views = [];

		if ( ! empty( $errors_tab_config ) ) {
			$core_views[] = $errors_tab_config;
		}

		$core_views[] = $overview_view_config;

		// Limited config for archived KBs
		if ( ! EPKB_Core_Utilities::is_kb_archived( $this->kb_config['status'] ) ) {
			$core_views[] = $kb_design_view_config;
			$core_views[] = $settings_view_config;
			$core_views[] = $tools_view_config;
		}

		/*if ( ! EPKB_Utilities::is_help_dialog_enabled() ) {
			$core_views[] = $help_dialog_view_config;
		}*/

		/**
		 * Add-on views for KB Configuration page
		 */
		$add_on_views = apply_filters( 'eckb_admin_config_page_views', [], $this->kb_config );
		if ( empty( $add_on_views ) || ! is_array( $add_on_views ) ) {
			$add_on_views = [];
		}

		// Full config for published KBs
		return array_merge( $core_views, $add_on_views );
	}

	/**
	 * Get configuration array for views of KB Configuration page before the first KB setup
	 *
	 * @return array[]
	 */
	private static function get_run_setup_first_views_config() {

		return array(

			// VIEW: SETUP WIZARD
			array(

				// Shared
				'list_key' => 'setup-wizard',

				// Top Panel Item
				'label_text' => __( 'Setup Wizard', 'echo-knowledge-base' ),
				'icon_class' => 'epkbfa epkbfa-cogs',

				'boxes_list' => array(

					// Box: Setup Wizard Message
					array(
						'html' => self::get_setup_wizard_message(),
						'class' => 'epkb-admin__notice'
					),
				),
			),
		);
	}

	/**
	 * Return message to complete Setup Wizard
	 *
	 * @return false|string
	 */
	private static function get_setup_wizard_message() {

		ob_start();     ?>

		<div class="epkb-admin__setup-wizard-warning">     <?php

			EPKB_HTML_Forms::notification_box_top( array(
				'type'  => 'success',
				'title' => __( 'Thank you for installing our Knowledge Base. Get started by running our Setup Wizard.', 'echo-knowledge-base' ),
				'desc'  => '<span>' . EPKB_HTML_Admin::get_kb_admin_page_link( 'page=epkb-kb-configuration&setup-wizard-on', __( 'Start the Setup Wizard', 'echo-knowledge-base' ), false ) . '</a></span>'
			) ); ?>

		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Get configuration array for Errors view of KB Configuration page
	 *
	 * @return array
	 */
	private function get_errors_view_config() {

		$error_boxes = array();

		// KB missing shortcode error message
		if ( empty( $this->kb_main_pages ) ) {
			$error_boxes[] = array(
				'icon_class' => 'epkbfa-exclamation-circle',
				'title' => __( 'Missing shortcode', 'echo-knowledge-base' ),
				'html' => EPKB_HTML_Admin::display_no_shortcode_warning( $this->kb_config, true ),
				'class' => 'epkb-admin__warning-box',
			);
		}

		// License issue messages from add-ons
		$add_on_messages = apply_filters( 'epkb_add_on_license_message', array() );
		if ( ( ! empty( $add_on_messages ) && is_array( $add_on_messages ) ) || did_action( 'kb_overview_add_on_errors' ) ) {

			foreach ( $add_on_messages as $add_on_name => $add_on_message ) {

				$add_on_name = str_replace( array( '2', '3', '4' ), '', $add_on_name );

				array_push( $error_boxes, array(
					'icon_class' => 'epkbfa-exclamation-circle',
					'class' => 'epkb-admin__boxes-list__box__addons-license',
					'title' => $add_on_name . ': ' . __( 'License issue', 'echo-knowledge-base' ),
					'description' => '',
					'html' => $add_on_message,
				) );
			}
		}

		return empty( $error_boxes )
			? array()
			: array(

				// Shared
				'active' => true,
				'list_key' => 'errors',

				// Top Panel Item
				'label_text' => __( 'Errors', 'echo-knowledge-base' ),
				'icon_class' => 'page-icon overview-icon epkbfa epkbfa-exclamation-triangle',

				// Boxes List
				'boxes_list' => $error_boxes,
			);
	}

	/**
	 * Get About KB settings box
	 *
	 * @return false|string
	 */
	private function get_about_kb_box() {

		ob_start();     ?>

		<div class="epkb-kb__btn-wrap">       <?php
			echo EPKB_HTML_Admin::get_current_kb_main_page_link( $this->kb_config, __( 'View My Knowledge Base', 'echo-knowledge-base' ), 'epkb-kb__cta-link' );      ?>
		</div>  <?php

		if ( EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_need_help_read' ) ) {   ?>
			<div>       <?php
				echo EPKB_HTML_Admin::get_kb_admin_page_link( 'page=epkb-kb-need-help#getting-started', __( 'Getting Started', 'echo-knowledge-base' ), false );      ?>
			</div>      <?php
		}

		// DEPRECATED
		do_action( 'eckb_manage_show_header' );

		return ob_get_clean();
	}

	/**
	 * Get KB Name settings box
	 * Note: KB Name is used in drop-down, reference to the KB and in CPT name
	 *
	 * @return false|string
	 */
	private function get_kb_name_box() {

		ob_start();     ?>

		<!-- Options -->
		<div class="epkb-admin__kb-rename">
			<div class="epkb-admin__kb-rename__name">
				<span class="epkb-admin__kb-rename__label"><?php esc_html_e( 'Nickname: ', 'echo-knowledge-base'); ?></span>
				<span id="epkb-admin__kb-rename__value"><?php echo esc_html( $this->kb_config['kb_name'] ); ?></span>
				<span class="epkb-edit-toggle"><i class="epkbfa epkbfa-pencil"></i></span>
			</div>
			<div class="epkb-admin__kb-rename__edit">
				<form method="post" id="epkb-admin__kb-rename__form">
					<input type="hidden" name="epkb_kb_id" value="<?php echo esc_attr( $this->kb_config['id'] ); ?>"/>
					<input type="text" name="epkb_kb_name_input" value="<?php echo esc_attr( $this->kb_config['kb_name'] ); ?>">
					<input value="<?php esc_attr_e( 'Save', 'echo-knowledge-base' ); ?>" type="submit" class="epkb-primary-btn">
				</form>
			</div>
		</div>      <?php

		// Show status only for archived KBs
		if ( EPKB_Core_Utilities::is_kb_archived( $this->kb_config['status'] ) ) {     ?>
			<div class="epkb-admin__kb-status"><span class="epkb-admin__kb-status__label"><?php esc_html_e( 'Status:', 'echo-knowledge-base' ); ?> </span><span class="epkb-admin__kb-status__value"><?php echo esc_html( ucfirst( $this->kb_config['status'] ) ); ?></span></div><?php
			do_action( 'eckb_admin_config_page_kb_status', $this->kb_config );
		}

		return ob_get_clean();
	}

	/**
	 * Get KB Location settings box
	 *
	 * @return false|string
	 */
	private function get_kb_location_box() {

		ob_start();

		// If no Main Pages were detected for the current KB
		if ( empty( $this->kb_main_pages ) ) {
			EPKB_HTML_Admin::display_no_shortcode_warning( $this->kb_config );

		// If at least one KB Main Page exists for the current KB
		} else {
			$kb_main_page_url = EPKB_KB_Handler::get_first_kb_main_page_url( $this->kb_config );
			$kb_page_id = EPKB_KB_Handler::get_first_kb_main_page_id( $this->kb_config );     ?>

			<div class="epkb-admin__chapter"><?php esc_html_e( 'Your knowledge base will be displayed on the page with KB shortcode: ', 'echo-knowledge-base' ); ?><strong>[epkb-knowledge-base id=<?php echo esc_attr( $this->kb_config['id'] ); ?>]</strong></div>
			<table class="epkb-admin__chapter__wrap">
				<tbody>
					<tr class="epkb-admin__chapter__content">
						<td><span><?php esc_html_e( 'Page Title: ', 'echo-knowledge-base' ); ?></span></td>
						<td><span><?php echo esc_html( $this->kb_config['kb_main_pages'][$kb_page_id] ); ?></span></td>
						<td><a class="epkb-kb__wizard-link" href="<?php echo get_edit_post_link( $kb_page_id ); ?>" target="_blank"><?php _e( 'Change Title', 'echo-knowledge-base' ); ?></a></td>
					</tr>
					<tr class="epkb-admin__chapter__content">
						<td><span><?php esc_html_e( 'Page / KB URL: ', 'echo-knowledge-base' ); ?></span></td>
						<td><a href="<?php echo esc_url( $kb_main_page_url ); ?>" target="_blank"><?php echo esc_html(  $kb_main_page_url ); ?><i class="ep_font_icon_external_link"></i></a></td>
						<td><a class="epkb-kb__wizard-link epkb-admin__step-cta-box__link" data-target="settings__kb-urls" href="#settings__kb-urls"><?php esc_html_e( 'Change KB URL', 'echo-knowledge-base' ); ?></a></td>
					</tr>
				</tbody>
			</table>      <?php

			// If user has multiple pages with KB Shortcode then let them know
			if ( count( $this->kb_main_pages ) > 1 ) {        ?>
				<div class="epkb-admin__chapter"><?php echo sprintf( esc_html__( 'Note: You have other pages with KB shortcode that are currently %snot used%s: ', 'echo-knowledge-base' ), '<strong>', '</strong>' ); ?></div>
				<ul class="epkb-admin__items-list">    <?php

					foreach ( $this->kb_main_pages as $page_id => $page_info ) {

						// Do not show relevant KB Main Page in the extra Main Pages list
						if ( $page_id == $kb_page_id ) {
							continue;
						}   ?>

						<li><span><?php echo esc_html( $page_info['post_title'] ); ?></span> <a href="<?php echo esc_url( get_edit_post_link( $page_id ) ); ?>" target="_blank"><?php esc_html_e( 'Edit page', 'echo-knowledge-base' ); ?></a></li><?php
					}   ?>

				</ul>
				<div class="epkb-admin__light-warning-message">
					<h4><?php esc_html_e( "It's best to delete these pages unless you have a very specific reason for having them.", 'echo-knowledge-base' ); ?></h4>
				</div>  <?php
			}
		}

		return ob_get_clean();
	}

	/**
	 * Get actions row for KB - archive/activate/delete
	 *
	 * @return false|string
	 */
	private function get_kb_actions() {

		ob_start();     ?>

		<div class="epkb-admin__list-actions-row">    <?php
			do_action( 'eckb_admin_config_page_overview_actions', $this->kb_config );   ?>
		</div>      <?php

		return ob_get_clean();
	}

	/**
	 * Handle actions that need reload of the page - KB Configuration page and other from addons
	 */
	private function handle_form_actions() {

		if ( empty( $_REQUEST['action'] ) ) {
			return;
		}

		// clear any messages
		$this->message = array();

		// verify that request is authentic
		if ( ! isset( $_REQUEST['_wpnonce_manage_kbs'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce_manage_kbs'], '_wpnonce_manage_kbs' ) ) {
			$this->message['error'] = EPKB_Utilities::report_generic_error( 1 );
			return;
		}

		// only admin user can handle these actions
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// retrieve KB ID we are saving
		$kb_id = empty( $_POST['emkb_kb_id'] ) ? '' : EPKB_Utilities::sanitize_get_id( $_POST['emkb_kb_id'] );
		if ( empty( $kb_id ) || is_wp_error( $kb_id ) ) {
			EPKB_Logging::add_log( "received invalid kb_id when archiving/deleting KB", $kb_id );
			$this->message['error'] = EPKB_Utilities::report_generic_error( 2 );
			return;
		}

		// retrieve current KB configuration
		$current_config = epkb_get_instance()->kb_config_obj->get_kb_config( $kb_id );
		if ( is_wp_error( $current_config ) ) {
			EPKB_Logging::add_log("Could not retrieve KB config when manage KB", $kb_id );
			$this->message['error'] = EPKB_Utilities::report_generic_error( 5, $current_config );
			return;
		}

		// EXPORT CONFIG
		if ( EPKB_Utilities::post( 'action' ) == 'epkb_export_knowledge_base' ) {
			$export = new EPKB_Export_Import();
			$this->message = $export->download_export_file( $kb_id );
			if ( empty($this->message) ) {
				exit;
			}
			return;
		}

		// IMPORT CONFIG
		if ( EPKB_Utilities::post( 'action' ) == 'epkb_import_knowledge_base' ) {
			$import = new EPKB_Export_Import();
			$this->message = $import->import_kb_config( $kb_id );
			return;
		}

		$this->message = apply_filters( 'eckb_handle_manage_kb_actions', $this->message, $kb_id, $current_config );
		$this->message = empty($this->message) ? [] : $this->message;
	}

	/**
	 * Get configuration array for archived KBs
	 *
	 * @return array
	 */
	private static function get_archvied_kbs_views_config() {

		$views_config = array(

			// View: Archived KBs
			array(

				// Shared
				'active' => true,
				'list_key' => 'archived-kbs',

				// Top Panel Item
				'label_text' => __( 'Archived KBs', 'echo-knowledge-base' ),
				'icon_class' => 'epkbfa epkbfa-cubes',

				// Boxes List
				'boxes_list' => array(

				),
			),
		);

		$archived_kbs = EPKB_Core_Utilities::get_archived_kbs();
		foreach ( $archived_kbs as $one_kb_config ) {

			$views_config[0]['boxes_list'][] = array(
				'class' => '',
				'title' => $one_kb_config['kb_name'],
				'description' => '',
				'html' => self::get_archived_kb_box_html( $one_kb_config ),
			);
		}

		return $views_config;
	}

	/**
	 * Get HTML for one archived KB box
	 *
	 * @param $kb_config
	 *
	 * @return false|string
	 */
	private static function get_archived_kb_box_html( $kb_config ) {

		ob_start();

		if ( ! EPKB_Utilities::is_multiple_kbs_enabled() ) {    ?>
			<div><?php esc_html_e( 'To manage non-default KBs you need Multiple KB add-on to be activated.', 'echo-knowledge-base' ); ?></div><?php
		}

		do_action( 'eckb_admin_config_page_kb_status', $kb_config );

		return ob_get_clean();
	}

	private function get_add_ons_settings( $filter ) {

		$add_on_setting = apply_filters( $filter, [], $this->kb_config );
		if ( empty( $add_on_setting ) || ! is_array( $add_on_setting ) ) {
			return [];
		}

		$context = empty( $add_on_setting['minimum_required_capability_context'] ) ? EPKB_Admin_UI_Access::get_admin_capability() : $add_on_setting['minimum_required_capability_context'];
		$add_on_setting['minimum_required_capability'] = EPKB_Admin_UI_Access::get_context_required_capability( [$context] );

		return $add_on_setting;
	}

	private function get_various_secondary_tab() {

		$various_settings = [];

		// Setting: WPML Settings
		if ( current_user_can( EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ) ) ) {
			$various_settings[] = array(
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_config_write' ),
				'title' => __( 'WPML', 'echo-knowledge-base' ),
				'html' => $this->show_multilingual_settings() );
		}

		// Setting: Sidebar Intro Text
		$sidebar_intro_text_settings = $this->get_add_ons_settings( 'epkb_config_page_sidebar_intro_settings' );
		if ( ! empty( $sidebar_intro_text_settings ) ) {
			$various_settings = array_merge( $various_settings, [ $sidebar_intro_text_settings ] );
			$this->settings_view_contexts[] = 'admin_eckb_access_frontend_editor_write';
		}

		return empty( $various_settings )
			? null
			: array(

				// Shared
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( 'admin_eckb_access_frontend_editor_write' ),
				'list_key' => 'various',

				// Secondary Panel Item
				'label_text' => __( 'Various', 'echo-knowledge-base' ),

				// Secondary Boxes List
				'boxes_list' => $various_settings,
			);
	}
}
