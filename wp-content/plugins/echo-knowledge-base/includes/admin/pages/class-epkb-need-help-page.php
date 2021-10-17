<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Display Need Help? admin page
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_Need_Help_Page {

	private $kb_config;

	public function __construct() {
		$this->kb_config = epkb_get_instance()->kb_config_obj->get_current_kb_configuration();
	}

	/**
	 * Display Need Help page
	 */
	public function display_need_help_page() {

		$admin_page_views = $this->get_regular_views_config();

		EPKB_HTML_Admin::admin_page_css_missing_message( true );   ?>

		<div id="ekb-admin-page-wrap" class="ekb-admin-page-wrap epkb-kb-need-help">    <?php

			// Notification after successful completion of Setup Wizard
			if ( isset( $_GET['epkb_after_kb_setup'] ) ) {  ?>
				<div id="epkb-kb__need-help__after-setup-wizard-dialog">   <?php
					EPKB_HTML_Forms::notification_box_top( array(
						'type'              => 'success',
						'title'             => __( 'Congratulations!', 'echo-knowledge-base' ),
						'desc'              => __( 'Your Knowledge Base setup is complete. You can now add your articles and customize the KB.', 'echo-knowledge-base' ),
						'button_confirm'    => __( 'OK', 'echo-knowledge-base' ),
						'close_target'      => '#epkb-kb__need-help__after-setup-wizard-dialog',
					) );    ?>
				</div>      <?php
			}

			/**
			 * ADMIN HEADER (KB logo and list of KBs dropdown)
			 */
			EPKB_HTML_Admin::admin_header( EPKB_HTML_Admin::admin_header_content( $this->kb_config, ['admin_eckb_access_need_help_read'] ) );

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
			EPKB_HTML_Admin::admin_settings_tab_content( $admin_page_views );    ?>

			<div class="eckb-bottom-notice-message"></div>
		</div>	    <?php
	}

	/**
	 * Get configuration for regular views
	 *
	 * @return array
	 */
	private function get_regular_views_config() {

		return array(

			// VIEW: Getting Started
			array(

				// Shared
				'active' => true,
				'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( ['admin_eckb_access_need_help_read'] ),
				'list_key' => 'getting-started',

				// Top Panel Item
				'label_text' => __( 'Getting Started', 'echo-knowledge-base' ),
				'icon_class' => 'epkbfa epkbfa-graduation-cap',

				// Boxes List
				'boxes_list' => array(

					// Box: Getting Started
					array(
						'minimum_required_capability' => EPKB_Admin_UI_Access::get_context_required_capability( ['admin_eckb_access_need_help_read'] ),
						'html' => $this->getting_started_tab(),
					),
				),
			),

			// VIEW: Features
			EPKB_Need_Help_Features::get_page_view_config(),

			// VIEW: Contact Us
			EPKB_Need_Help_Contact_Us::get_page_view_config(),
		);
	}

	/**
	 * Get content for Getting Started tab
	 *
	 * @return false|string
	 */
	private function getting_started_tab() {

		$kb_flags = EPKB_Utilities::get_wp_option( 'epkb_flags', [], true );

		$steps_list = [];
		$step_number = 1;

		// Setup Wizard
		if ( EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_frontend_editor_write' ) ) {
			$steps_list[] = array(
				'content_icon_class' => in_array( 'completed_setup_wizard_' . $this->kb_config['id'], $kb_flags ) ? 'epkbfa epkbfa-check-circle' : '',
				'icon_class' => '',
				'icon_img_url' => 'img/need-help/rocket-2.jpg',
				'title' => $step_number++ . '. ' . __( 'Setup Wizard', 'echo-knowledge-base' ),
				'desc' => __( 'Set up your Knowledge Base name, url, and design in just two steps.', 'echo-knowledge-base' ),
				'html' => EPKB_HTML_Admin::get_kb_admin_page_link( 'page=epkb-kb-configuration&setup-wizard-on', __( 'Launch Setup Wizard', 'echo-knowledge-base' ) ),
			);
		}

		if ( ! EPKB_Core_Utilities::is_run_setup_wizard_first_time() ) {

			if ( in_array( 'opened_frontend_editor', $kb_flags ) ) {
				$editor_urls = EPKB_Editor_Utilities::get_editor_urls( $this->kb_config );
			} else {
				$editor_urls = EPKB_Editor_Utilities::get_editor_urls( $this->kb_config, 'templates' );
			}

			// Features link
			$steps_list[] = array(
				'id' => 'epkb-admin__step-cta-box__features',
				'content_icon_class' => in_array( 'features_tab_visited', $kb_flags ) ? 'epkbfa epkbfa-check-circle' : '',
				'icon_class' => '',
				'icon_img_url' => 'img/need-help/mountain-flag.jpg',
				'title' => $step_number++ . '. ' . __( 'Explore Features', 'echo-knowledge-base' ),
				'desc' => __( 'Get familiar with features and how they function.', 'echo-knowledge-base' ),
				'html' => '<a class="epkb-kb__wizard-link epkb-admin__step-cta-box__link" data-target="features" href="#features">' . esc_html__( 'Explore Features', 'echo-knowledge-base' ) . '</a>' );

			// KB Articles and KB Categories
			$steps_list[] = array(
				'icon_class' => '',
				'icon_img_url' => 'img/need-help/notepad-pencil.jpg',
				'title' => $step_number++ . '. ' . __( 'Enter Your Content - Articles and Categories', 'echo-knowledge-base' ),
				'desc' => __( 'Populate your Knowledge Base with articles and categories.', 'echo-knowledge-base' ),
				'html' => EPKB_HTML_Admin::get_kb_admin_page_link( '', esc_html__( 'Edit KB Articles', 'echo-knowledge-base' ) ) . ' ' .
					( current_user_can( 'manage_categories' ) ? '<a class="epkb-kb__wizard-link" href="' . esc_url( admin_url( '/edit-tags.php?taxonomy=' . EPKB_KB_Handler::get_category_taxonomy_name( $this->kb_config['id'] ) .
						'&post_type=' . EPKB_KB_Handler::get_post_type( $this->kb_config['id'] ) ) ) . '" target="_blank">' . esc_html__( 'Edit KB Categories', 'echo-knowledge-base' ) . '</a>' : '' ) );

			// frontend Editor
			if ( EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_frontend_editor_write' ) ) {
				$steps_list[] = array(
					'icon_class' => '',
					'icon_img_url' => 'img/need-help/palette.jpg',
					'title' => $step_number . '. ' . __( 'Customize Colors, Labels, and Fonts', 'echo-knowledge-base' ),
					'desc' => __( 'Easily change the style and look of KB pages with our frontend Editor.', 'echo-knowledge-base' ),
					'html' => ( empty( $editor_urls['main_page_url'] ) ? '' :
							'<a class="epkb-kb__wizard-link" href="' . esc_url( $editor_urls['main_page_url'] ) . '" target="_blank">' . esc_html__( 'Customize KB Main Page', 'echo-knowledge-base' ) . '</a>' ) . ' ' .
						( empty( $editor_urls['article_page_url'] ) ? '' :
							'<a class="epkb-kb__wizard-link" href="' . esc_url( $editor_urls['article_page_url'] ) . '" target="_blank">' . esc_html__( 'Customize KB Article Page', 'echo-knowledge-base' ) . '</a>' ) . ' ' );
			}
		}

		ob_start();     ?>

		<div class="epkb-kbnh__getting-started-container">

			<!-- Getting Started - header container  -->
			<div class="epkb-kbnh__gs__header-container">
				<div class="epkb-kbnh__header__img">
					<img src="<?php echo esc_url( Echo_Knowledge_Base::$plugin_url . 'img/guy-on-laptop.jpg' ); ?>">
				</div>
				<div class="epkb-kbnh__header__text">
					<h2 class="epkb-kbnh__header__title"><?php esc_html_e( 'Welcome to Echo Knowledge Base!', 'echo-knowledge-base' ); ?></h2>
					<p class="epkb-kbnh__header__desc"><?php esc_html_e( 'Thank you for choosing Echo KB, the most powerful WordPress Knowledge Base plugin.', 'echo-knowledge-base' ); ?></p>
					<!--	<p><?php //_e( 'Our Knowledge Base is easy to setup:', 'echo-knowledge-base' ); ?></p> -->
					<ul>
						<!-- <li>choose one of the 27 pre-made designs <a href="#" target="_blank">here <span class="epkbfa epkbfa-external-link"></span></a></li>
						<li>customize its colors, labels, font, and features <a href="#" target="_blank">here <span class="epkbfa epkbfa-external-link"></span></a></li>
						<li>enter your content: articles, categories and tags. <a href="#" target="_blank">See how <span class="epkbfa epkbfa-external-link"></span></a></li> -->
						<li><?php esc_html_e( 'Easy to set up and use.', 'echo-knowledge-base' ); ?></li>
						<li><?php esc_html_e( 'Features focused on effective documentation for your users.', 'echo-knowledge-base' ); ?></li>
						<li><?php esc_html_e( 'Friendly and timely support from our team.', 'echo-knowledge-base' ); ?></li>
					</ul>
					<p class="epkb-kbnh__header__desc"><?php esc_html_e( 'Thanks for using our Knowledge Base!', 'echo-knowledge-base' ); ?></p>    <?php

					// Show this block only if user completed Setup Wizard
					if ( ! EPKB_Core_Utilities::is_run_setup_wizard_first_time() ) {
						echo EPKB_HTML_Admin::get_current_kb_main_page_link( $this->kb_config, __( 'View My Knowledge Base', 'echo-knowledge-base' ), 'epkb-kb__cta-link' );
					}   ?>
					<div class="epkb-kbnh__header__link-container">
						<span class="epkb-kbnh__link__text"><a href="https://www.echoknowledgebase.com/documentation/" target="_blank"><?php esc_html_e( 'View Online Documentation', 'echo-knowledge-base' ); ?></a></span>
						<span class="epkb-kbnh__link__icon epkbfa epkbfa-external-link"></span>
					</div>


				</div>
			</div>

			<!-- Gettings Started - content container -->
			<div class="epkb-admin__content">   <?php

				foreach ( $steps_list as $step ) {
					EPKB_HTML_Forms::display_step_cta_box( $step );
				}   ?>

			</div>

		</div>		<?php

		return ob_get_clean();
	}

	private function video_tutorials_tab() {
		ob_start();     ?>

		<div class="epkb-kbnh__video-tutorials-container">

			<div class="epkb-kbnh__section-container">
				<div class="epkb-kbnh__common-videos-container">

					<div class="epkb-kbnh__cv__list">
						<?php
						EPKB_HTML_Forms::video_info_box( array(
							'title'     => 'Setup Knowledge Base Layouts and Colors',
							'video_src' => 'https://www.youtube.com/embed/WTihgYwSM6A',
							'desc'      => 'In this video we will show you how to choose a Layout and colors for your Knowledge base Main page and article pages.',
							'keywords'  => array('setup','layout','colors','article page')
						));
						EPKB_HTML_Forms::video_info_box( array(
							'title'     => 'How to Control Access for Groups and Teams',
							'video_src' => 'https://www.youtube.com/embed/0uObJZwgO_g',
							'desc'      => 'KB Groups add-on helps you organize your users into KB Groups. Use it to separate users based on the category access each group needs.',
							'keywords'  => array('access','groups','teams','restrict')

						));
						EPKB_HTML_Forms::video_info_box( array(
							'title'     => 'Changing your Knowledge Base Category Icons',
							'video_src' => 'https://www.youtube.com/embed/gbi-seMLLgo',
							'desc'      => 'We will show you how to choose custom Icons for your Knowledge Base Categories.',
							'keywords'  => array('layout','categories','category','icon')

						));
						?>
					</div>

				</div>
			</div>

		</div>

		<?php return ob_get_clean();
	}
}
