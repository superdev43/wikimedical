<?php

/**
 * HTML Elements for admin pages excluding boxes
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_HTML_Admin {

	/**
	 * Show Admin Header
	 *
	 * @param $content_html
	 * @param string $position
	 */
	public static function admin_header( $content_html, $position = '' ) {  ?>

		<!-- Admin Header -->
		<div class="epkb-admin__header">
			<div class="epkb-admin__section-wrap <?php echo empty( $position ) ? '' : 'epkb-admin__section-wrap--' . $position; ?> epkb-admin__section-wrap__header">   <?php

				echo $content_html;    ?>

			</div>
		</div>  <?php
	}

	/**
	 * Content for Admin Header - KB Logo, List of KBs
	 *
	 * @param $kb_config
	 * @param array $contexts
	 * @return string
	 */
	public static function admin_header_content( $kb_config, $contexts=[] ) {

		ob_start();

		$link_output = self::get_current_kb_main_page_link( $kb_config, __( 'View KB', 'echo-knowledge-base' ), 'epkb-admin__header__view-kb__link' );
		if ( empty( $link_output ) ) {
			$link_output = '<a href="' . admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( $kb_config['id'] ) . '&page=epkb-kb-configuration&setup-wizard-on' ) . '" class="epkb-admin__header__view-kb__link" target="_blank">' . __( "Setup KB", "echo-knowledge-base" ) . '</a>';
		}

		echo self::get_admin_header_logo();    ?>

		<div class="epkb-admin__header__controls-wrap">

			<!-- KBs List -->
			<p class="epkb-admin__header__label"><?php _e( 'Select KB', 'echo-knowledge-base' ); ?></p>
			<div class="epkb-admin__header__dropdown">      <?php
				self::admin_list_of_kbs( $kb_config, $contexts ); 			?>
			</div>

			<!-- Link to KB View -->
			<div class="epkb-admin__header__view-kb">
				<?php echo $link_output; ?>
			</div>  <?php    ?>
		</div>      <?php

		$result = ob_get_clean();

		return empty( $result ) ? '' : $result;
	}

	/**
	 * Show list of KBs.
	 *
	 * @param $kb_config
	 * @param array $contexts
	 */
	private static function admin_list_of_kbs( $kb_config, $contexts=[] ) {    ?>

		<select id="epkb-list-of-kbs" data-active-kb-id="<?php echo $kb_config['id']; ?>">      <?php

			$found_archived_kbs = false;
			$all_kb_configs = epkb_get_instance()->kb_config_obj->get_kb_configs();
			foreach ( $all_kb_configs as $one_kb_config ) {

				$one_kb_id = $one_kb_config['id'];

				// Do not show archived KBs
				if ( $one_kb_id !== EPKB_KB_Config_DB::DEFAULT_KB_ID && EPKB_Core_Utilities::is_kb_archived( $one_kb_config['status'] ) ) {
					$found_archived_kbs = true;
					continue;
				}

				// Do not render the KB into the dropdown if the current user does not have at least minimum required capability (covers KB Groups)
				$required_capability = EPKB_Admin_UI_Access::get_author_capability( $one_kb_id );
				if ( ! current_user_can( $required_capability ) ) {
					continue;
				}

				// Redirect to All Articles page if the user does not have access for the current page for this KB in drop down
				$redirect_url = '';
				if ( ! empty( $contexts ) ) {
					$required_capability = EPKB_Admin_UI_Access::get_context_required_capability( $contexts, $one_kb_config );
					if ( ! current_user_can( $required_capability ) ) {
						$redirect_url = admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( $one_kb_id ) );
					}
				}

				$kb_name = $one_kb_config[ 'kb_name' ];
				$active = ( $kb_config['id'] == $one_kb_id && ! isset( $_GET['archived-kbs'] ) ? 'selected' : '' );   ?>

				<option data-plugin="core" value="<?php echo empty( $redirect_url ) ? esc_attr( $one_kb_id ) : 'closed'; ?>"<?php echo empty( $redirect_url ) ? '' : ' data-target="' . esc_url( $redirect_url ) . '"'; ?> <?php echo $active; ?>><?php
					esc_html_e( $kb_name ); ?>
				</option>      <?php
			}

			if ( $found_archived_kbs && EPKB_Utilities::post( 'page' ) == 'epkb-kb-configuration' ) {    ?>
				<option data-plugin="core" value="archived"<?php echo isset( $_GET['archived-kbs'] ) ? ' selected' : ''; ?>><?php _e( 'View Archived KBs', 'echo-knowledge-base' ); ?></option>  <?php
			}

			if ( ! EPKB_Utilities::is_multiple_kbs_enabled() && count($all_kb_configs) == 1 ) {     ?>
				<option data-plugin="core" data-link="https://www.echoknowledgebase.com/wordpress-plugin/multiple-knowledge-bases/"><?php _e( 'Get Additional Knowledge Bases', 'echo-knowledge-base' ); ?></option>  <?php
			}

			// Hook to add new options to the admin header dropdown
			if ( current_user_can( EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY ) ) {
				do_action( 'eckb_kb_admin_header_dropdown' );
			}   ?>

		</select>   <?php
	}

	/**
	 * Get  logo container for KB admin header
	 *
	 * @return string
	 */
	public static function get_admin_header_logo() {

		ob_start();     ?>

		<!-- Echo Logo -->
		<div class="epkb-admin__header__logo-wrap">
			<img class="epkb-admin__header__logo-mobile" alt="<?php _e( 'Echo Knowledge Base Logo', 'echo-knowledge-base' ); ?>" src="<?php echo Echo_Knowledge_Base::$plugin_url . 'img/kb-icon.png'; ?>">
			<img class="epkb-admin__header__logo-desktop" alt="<?php _e( 'Echo Knowledge Base Logo', 'echo-knowledge-base' ); ?>" src="<?php echo Echo_Knowledge_Base::$plugin_url . 'img/echo-kb-logo' . ( is_rtl() ? '-rtl' : '' ) . '.png'; ?>">
		</div>  <?php

		$result = ob_get_clean();

		return empty($result) ? '' : $result;
	}

	/**
	 * Fill missing fields in single admin page view configuration array with default values
	 *
	 * @param $page_view
	 * @return array
	 */
	private static function admin_page_view_fill_missing_with_default( $page_view ){

		// Do not fill empty or not valid array
		if ( empty( $page_view ) || ! is_array( $page_view ) ) {
			return $page_view;
		}

		// Default page view
		$default_page_view = array(

			// Shared
			'active' => false,
			'minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'list_id' => '',
			'list_key' => '',
			'kb_config_id' => '',
			'is_frontend_editor_hidden' => false,

			// Top Panel Item
			'label_text' => '',
			'main_class' => '',
			'label_class' => '',
			'icon_class' => '',

			// Secondary Panel Items
			'secondary' => array(),

			// Boxes List
			'list_top_actions_html' => '',
			'top_actions_minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'list_bottom_actions_html' => '',
			'bottom_actions_minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'boxes_list' => array(),

			// List footer HTML
			'list_footer_html' => '',
		);

		// Default secondary view
		$default_secondary = array(

			// Shared
			'list_key' => '',
			'active' => false,
			'minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'is_frontend_editor_hidden' => false,

			// Secondary Panel Item
			'label_text' => '',
			'main_class' => '',
			'label_class' => '',
			'icon_class' => '',

			// Secondary Boxes List
			'list_top_actions_html' => '',
			'top_actions_minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'list_bottom_actions_html' => '',
			'bottom_actions_minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'boxes_list' => array(),
		);

		// Default box
		$default_box = array(
			'minimum_required_capability' => EPKB_Admin_UI_Access::EPKB_ADMIN_CAPABILITY,
			'icon_class' => '',
			'class' => '',
			'title' => '',
			'description' => '',
			'html' => '',
		);

		// Set default view
		$page_view = array_merge( $default_page_view, $page_view );

		// Set default boxes
		foreach ( $page_view['boxes_list'] as $box_index => $box_content ) {

			// Do not fill empty or not valid array
			if ( empty( $page_view['boxes_list'][$box_index] ) || ! is_array( $page_view['boxes_list'][$box_index] ) ) {
				continue;
			}

			$page_view['boxes_list'][$box_index] = array_merge( $default_box, $box_content );
		}

		// Set default secondary views
		foreach ( $page_view['secondary'] as $secondary_index => $secondary_content ) {

			// Do not fill empty or not valid array
			if ( empty( $page_view['secondary'][$secondary_index] ) || ! is_array( $page_view['secondary'][$secondary_index] ) ) {
				continue;
			}

			$page_view['secondary'][$secondary_index] = array_merge( $default_secondary, $secondary_content );

			// Set default boxes
			foreach ( $page_view['secondary'][$secondary_index]['boxes_list'] as $box_index => $box_content ) {

				// Do not fill empty or not valid array
				if ( empty(  $page_view['secondary'][$secondary_index]['boxes_list'][$box_index] ) || ! is_array(  $page_view['secondary'][$secondary_index]['boxes_list'][$box_index] ) ) {
					continue;
				}

				$page_view['secondary'][$secondary_index]['boxes_list'][$box_index] = array_merge( $default_box, $box_content );
			}
		}

		return $page_view;
	}

	/**
	 * Show Admin Toolbar
	 *
	 * @param $admin_page_views
	 */
	public static function admin_toolbar( $admin_page_views ) {     ?>

		<!-- Admin Top Panel -->
		<div class="epkb-admin__top-panel">
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__top-panel">      <?php

				foreach( $admin_page_views as $page_view ) {

					// Optionally we can have null in $page_view, make sure we handle it correctly
					if ( empty( $page_view ) || ! is_array( $page_view ) ) {
						continue;
					}

					// Fill missing fields in admin page view configuration array with default values
					$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

					// Do not render toolbar tab if the user does not have permission
					if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
						continue;
					}   ?>

					<div class="epkb-admin__top-panel__item epkb-admin__top-panel__item--<?php echo $page_view['list_key'];
						echo empty( $page_view['secondary'] ) ? '' : ' epkb-admin__top-panel__item--parent ';
						echo $page_view['main_class']; echo $page_view['is_frontend_editor_hidden'] ? ' epkb-article-structure-dialog' : ''; ?>"
					    <?php echo empty( $page_view['list_id'] ) ? '' : ' id="' . $page_view['list_id'] . '"'; ?> data-target="<?php echo $page_view['list_key']; ?>">
						<div class="epkb-admin__top-panel__icon epkb-admin__top-panel__icon--<?php echo $page_view['list_key']; ?> <?php echo $page_view['icon_class']; ?>"></div>
						<p class="epkb-admin__top-panel__label epkb-admin__boxes-list__label--<?php echo $page_view['list_key']; ?>"><?php echo $page_view['label_text']; ?></p>
					</div> <?php
				}       ?>

			</div>
		</div>  <?php
	}

	/**
	 * Display admin second-level tabs below toolbar
	 *
	 * @param $admin_page_views
	 */
	public static function admin_secondary_tabs( $admin_page_views ) {  ?>

		<!-- Admin Secondary Panels List -->
		<div class="epkb-admin__secondary-panels-list">
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__secondary-panel">  <?php

				foreach ( $admin_page_views as $page_view ) {

					// Optionally we can have null in $page_view, make sure we handle it correctly
					if ( empty( $page_view ) || ! is_array( $page_view ) ) {
						continue;
					}

					// Optionally we can have empty in $page_view['secondary'], make sure we handle it correctly
					if ( empty( $page_view['secondary'] ) || ! is_array( $page_view['secondary'] ) ) {
						continue;
					}

					// Fill missing fields in admin page view configuration array with default values
					$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

					// Do not render toolbar tab if the user does not have permission
					if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
						continue;
					}   ?>

					<!-- Admin Secondary Panel -->
					<div id="epkb-admin__secondary-panel__<?php echo $page_view['list_key']; ?>" class="epkb-admin__secondary-panel">  <?php

						foreach ( $page_view['secondary'] as $secondary ) {

							// Optionally we can have empty in $secondary, make sure we handle it correctly
							if ( empty( $secondary ) || ! is_array( $secondary ) ) {
								continue;
							}

							// Do not render secondary toolbar tab if the user does not have permission
							if ( ! current_user_can( $secondary['minimum_required_capability'] ) ) {
								continue;
							}       ?>

							<div class="epkb-admin__secondary-panel__item epkb-admin__secondary-panel__<?php echo $secondary['list_key']; ?> <?php echo $secondary['active'] ? 'epkb-admin__secondary-panel__item--active' : ''; echo $secondary['is_frontend_editor_hidden'] ? ' epkb-article-structure-dialog' : ''; ?> <?php echo $secondary['main_class']; ?>" data-target="<?php echo $page_view['list_key'] . '__' . $secondary['list_key']; ?>">     <?php

								// Optional icon for secondary panel item
								if ( ! empty( $secondary['icon_class'] ) ) {        ?>
									<span class="epkb-admin__secondary-panel__icon <?php echo $secondary['icon_class']; ?>"></span>     <?php
								}       ?>

								<p class="epkb-admin__secondary-panel__label epkb-admin__secondary-panel__<?php echo $secondary['list_key']; ?>__label"><?php echo $secondary['label_text']; ?></p>
							</div>  <?php

						}   ?>
					</div>  <?php

				}   ?>

			</div>
		</div>  <?php
	}

	/**
	 * Show list of settings for each setting in a tab
	 *
	 * @param $admin_page_views
	 * @param string $content_class
	 * @param string $frontend_editor_hide_reason
	 */
	public static function admin_settings_tab_content( $admin_page_views, $content_class='', $frontend_editor_hide_reason='' ) {    ?>

		<!-- Admin Content -->
		<div class="epkb-admin__content <?php echo $content_class; ?>"> <?php

			if ( $frontend_editor_hide_reason != '' ) { ?>
				<!-- Deprecation Warning -->
				<div class="epkb-admin__section-wrap">      <?php
					self::deprecated_wizard_warning();      ?>
				</div>      <?php
			}

			foreach ( $admin_page_views as $page_view ) {

				// Optionally we can have null in $page_view, make sure we handle it correctly
				if ( empty( $page_view ) || ! is_array( $page_view ) ) {
					continue;
				}

				// Fill missing fields in admin page view configuration array with default values
				$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

				// Do not render view if the user does not have permission
				if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
					continue;
				}   ?>

				<!-- Admin Boxes List -->
				<div id="epkb-admin__boxes-list__<?php echo $page_view['list_key']; ?>" class="epkb-admin__boxes-list">     <?php

					// List body
					self::admin_setting_boxes_for_tab( $page_view );

					// Optional list footer
					if ( ! empty( $page_view['list_footer_html'] ) ) {   ?>
						<div class="epkb-admin__section-wrap epkb-admin__section-wrap__<?php echo $page_view['list_key']; ?>">
							<div class="epkb-admin__boxes-list__footer"><?php echo $page_view['list_footer_html']; ?></div>
						</div>      <?php
					}   ?>

				</div><?php
			}   ?>

		</div><?php
	}

	/**
	 * Show single List of Settings Boxes for Admin Page
	 *
	 * @param $page_view
	 */
	private static function admin_setting_boxes_for_tab( $page_view ) {

		// Boxes List for view without secondary panel
		if ( empty( $page_view['secondary'] ) ) {

			// Make sure we can handle empty boxes list correctly
			if ( empty( $page_view['boxes_list'] ) || ! is_array( $page_view['boxes_list'] ) ) {
				return;
			}   ?>

			<!-- Admin Section Wrap -->
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__<?php echo $page_view['list_key']; ?>">  <?php

				self::admin_settings_display_boxes_list( $page_view );   ?>

			</div>      <?php

		// Boxes List for view with secondary tabs
		} else {

			// Secondary Lists of Boxes
			foreach ( $page_view['secondary'] as $secondary ) {

				// Make sure we can handle empty boxes list correctly
				if ( empty( $secondary['boxes_list'] ) || ! is_array( $secondary['boxes_list'] ) ) {
					continue;
				}   ?>

				<!-- Admin Section Wrap -->
				<div class="epkb-admin__section-wrap epkb-admin__section-wrap__<?php echo $page_view['list_key']; ?>">

					<!-- Secondary Boxes List -->
					<div id="epkb-admin__secondary-boxes-list__<?php echo $page_view['list_key'] . '__' . $secondary['list_key']; ?>" class="epkb-admin__secondary-boxes-list <?php echo $secondary['active'] ? 'epkb-admin__secondary-boxes-list--active' : ''; ?>">   <?php

						self::admin_settings_display_boxes_list( $secondary );   ?>

					</div>

				</div>  <?php
			}
		}
	}

	/**
	 * Display boxes list for admin settings
	 *
	 * @param $page_view
	 */
	private static function admin_settings_display_boxes_list( $page_view ) {

		// Optional buttons row displayed at the top of the boxes list
		if ( ! empty( $page_view['list_top_actions_html'] ) && current_user_can( $page_view['top_actions_minimum_required_capability'] ) ) {
			echo $page_view['list_top_actions_html'];
		}

		// Admin Boxes with configuration
		foreach ( $page_view['boxes_list'] as $box_options ) {

			// Do not render empty or not valid array
			if ( empty( $box_options ) || ! is_array( $box_options ) ) {
				continue;
			}

			// Do not render box if the user does not have permission
			if ( ! current_user_can( $box_options['minimum_required_capability'] ) ) {
				continue;
			}

			EPKB_HTML_Forms::admin_settings_box( $box_options );
		}

		// Optional buttons row displayed at the bottom of the boxes list
		if ( ! empty( $page_view['list_bottom_actions_html'] ) && current_user_can( $page_view['top_actions_minimum_required_capability'] )) {
			echo $page_view['list_bottom_actions_html'];
		}
	}


	/********************************************************************************
	 *
	 *                                   VARIOUS
	 *
	 ********************************************************************************/

	/**
	 * Get link to the current KB main page
	 *
	 * @param $kb_config
	 * @param $link_text
	 * @param string $link_class
	 * @return string
	 */
	public static function get_current_kb_main_page_link( $kb_config, $link_text, $link_class='' ) {

		$link_output = EPKB_KB_Handler::get_first_kb_main_page_url( $kb_config );
		if ( empty( $link_output ) ) {
			return false;
		}
		return '<a href="' . $link_output . '" target="_blank" class="' . $link_class . '">' . $link_text . '</a>';
	}

	/**
	 * Get link to KB admin page
	 *
	 * @param $url_param
	 * @param $label_text
	 * @param bool $target_blank
	 * @return string
	 */
	public static function get_kb_admin_page_link( $url_param, $label_text, $target_blank=true ) {
		return '<a class="epkb-kb__wizard-link" href="' . admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( EPKB_KB_Handler::get_current_kb_id() ) .
		                                                             ( empty($url_param) ? '' : '&' ) . $url_param ) . '"' . ( empty( $target_blank ) ? '' : ' target="_blank"' ) . '>' . $label_text . '</a>';
	}

	/**
	 * Get link to an admin page
	 *
	 * @param $url_param
	 * @param $label_text
	 * @param bool $target_blank
	 * @return string
	 */
	public static function get_admin_page_link( $url_param, $label_text, $target_blank=true ) {
		return '<a class="epkb-kb__wizard-link" href="' . admin_url( '/admin.php' . ( empty($url_param) ? '' : '?' ) . $url_param ) . '"' . ( empty( $target_blank ) ? '' : ' target="_blank"' ) . '>' . $label_text . '</a>';
	}

	/**
	 * We need to add this HTML to admin page to catch WP admin JS functionality
	 *
	 * @param false $include_no_css_message
	 * @param false $support_for_old_design
	 */
	public static function admin_page_css_missing_message( $include_no_css_message=false, $support_for_old_design=false ) {  ?>

		<!-- This is to catch WP JS garbage -->
		<div class="wrap epkb-wp-admin<?php echo $support_for_old_design ? ' epkb-admin-old-design-support' : ''; ?>">
			<h1></h1>
		</div>
		<div class=""></div>  <?php

		if ( $include_no_css_message ) {    ?>
			<!-- This is for cases of CSS incorrect loading -->
			<h1 style="color: red; line-height: 1.2em; background-color: #eaeaea; border: solid 1px #ddd; padding: 20px;" class="epkb-css-working-hide-message">
				<?php _e( 'Please reload the page to refresh CSS styles. That should correctly render the page. This issue is typically caused by timeout or other plugins blocking CSS.' .
				          'If that does not help, contact us for help.', 'echo-knowledge-base' ); ?></h1>   <?php
		}
	}

	/*
	 * Deprecation Wizard Warning
	 */
	public static function deprecated_wizard_warning() {   ?>

		<div class="epkb-admin__deprecated-wizard-warning">     <?php

			$editor_url = add_query_arg( [ 'action' => 'epkb_update_article_v2' ] );

			EPKB_HTML_Forms::notification_box_top( array(
				'type'  => 'error',
				'title' => __( 'Deprecation warning', 'echo-knowledge-base' ),
				'desc'  => '<span>' . __( 'We will discontinue some of the Wizards in the next KB release. Please switch to the frontend Editor by clicking here:', 'echo-knowledge-base' ) . '<a href="' . $editor_url . '">' . __( 'open the frontend Editor', 'echo-knowledge-base' ) . '</a></span>'
				           . '<span>' . __( 'If you have questions or concerns please talk to us and we will gladly help you! ', 'echo-knowledge-base' ) . EPKB_Utilities::contact_us_for_support() . '</span>'
			) ); ?>

		</div>      <?php
	}

	/**
	 * Display modal form for report an error in admin area
	 */
	public static function display_report_admin_error_form() {

		$current_user = wp_get_current_user();      ?>

		<!-- Submit Error Form -->
		<div class="epkb-admin__error-form__container" style="display:none!important;">
			<div class="epkb-admin__error-form__wrap">
				<div class="epkb-admin__scroll-container">
					<div class="epkb-admin__white-box">

						<h4 class="epkb-admin__error-form__title"></h4>
						<div class="epkb-admin__error-form__desc"></div>

						<form id="epkb-admin__error-form" method="post">				<?php

							wp_nonce_field( '_epkb_admin_submit_error_form_nonce' );				?>

							<input type="hidden" name="action" value="epkb_report_admin_error" />
							<div class="epkb-admin__error-form__body">

								<label for="epkb-admin__error-form__first-name"><?php _e( 'Name', 'echo-knowledge-base' ); ?>*</label>
								<input name="first_name" type="text" value="<?php echo $current_user->display_name; ?>" required  id="epkb-admin__error-form__first-name">

								<label for="epkb-admin__error-form__email"><?php _e( 'Email', 'echo-knowledge-base' ); ?>*</label>
								<input name="email" type="email" value="<?php echo $current_user->user_email; ?>" required id="epkb-admin__error-form__email">

								<label for="epkb-admin__error-form__message"><?php _e( 'Error Details', 'echo-knowledge-base' ); ?>*</label>
								<textarea name="admin_error" class="admin_error" required id="epkb-admin__error-form__message"></textarea>

								<div class="epkb-admin__error-form__btn-wrap">
									<input type="submit" name="submit_error" value="<?php _e( 'Submit', 'echo-knowledge-base' ); ?>" class="epkb-admin__error-form__btn epkb-admin__error-form__btn-submit">
									<span class="epkb-admin__error-form__btn epkb-admin__error-form__btn-cancel"><?php _e( 'Cancel', 'echo-knowledge-base' ); ?></span>
								</div>

								<div class="epkb-admin__error-form__response"></div>
							</div>
						</form>

						<div class="epkb-close-notice epkbfa epkbfa-window-close"></div>

					</div>
				</div>
			</div>
		</div>      <?php
	}

	/**
	 * Display or return HTML input for wpnonce
	 *
	 * @param bool $unique
	 * @param false $return_html
	 *
	 * @return false|string|void
	 */
	public static function nonce( $unique=true, $return_html=false ) {

		if ( $return_html ) {
			ob_start();
		}   ?>

		<input type="hidden" name="_wpnonce_epkb_ajax_action" value="<?php echo wp_create_nonce( '_wpnonce_epkb_ajax_action' ); ?>">	<?php

		if ( $return_html ) {
			return ob_get_clean();
		}
	}

	/**
	 * Display warning about missing shortcode
	 *
	 * @param $kb_config
	 * @param bool $return_html
	 *
	 * @return false|string|void
	 */
	public static function display_no_shortcode_warning( $kb_config, $return_html=false ) {

		if ( $return_html ) {
			ob_start();
		}   ?>

		<div class="epkb-admin__warning-message">
			<h4><?php echo esc_html( sprintf( __( 'We did not detect any page with KB shortcode for your knowledge base "%s". You can do the following:', 'echo-knowledge-base' ), $kb_config['kb_name'] ) ); ?></h4>
			<ul class="epkb-admin__items-list">
				<li><?php esc_html_e( 'If you have this page, please re-save it and come back.', 'echo-knowledge-base' ); ?></li>
				<li><?php echo esc_html( sprintf( __( 'Create or update a page and add KB shortcode  [epkb-knowledge-base id=%d] to that page. Save the page and then come back here.', 'echo-knowledge-base' ), $kb_config['id'] ) ); ?></li>
				<li><span><?php esc_html_e( 'Run Setup Wizard to create a new KB Main Page.', 'echo-knowledge-base' ); ?> </span><a href="<?php echo esc_url( admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( $kb_config['id'] ) .
                                            '&page=epkb-kb-configuration&setup-wizard-on' ) ); ?>" target="_blank"><?php esc_html_e( 'Run Setup Wizard', 'echo-knowledge-base' ); ?></a></li>
			</ul>
		</div>  <?php

		if ( $return_html ) {
			return ob_get_clean();
		}
	}
}
