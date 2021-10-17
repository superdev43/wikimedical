<?php

/**
 * HTML forms and boxes for admin pages
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_HTML_Forms {

	/********************************************************************************
	 *
	 *                                   BOXES
	 *
	 ********************************************************************************/
	
	/**
	 * HTML Notification box with Title and Body text.
	 * $values:
	 *  string $value['id']            ( Optional ) Container ID, used for targeting with other JS
	 *  string $value['type']          ( Required ) ( error, success, warning, info )
	 *  string $value['title']         ( Required ) The big Bold Main text
	 *  HTML   $value['desc']          ( Required ) Any HTML P, List etc...
	 * @since version 6.8.0
	 * @param array $args
	 */
	public static function notification_box_top( $args = array() ) {

		$icon = '';
		switch ( $args['type']) {
			case 'error':   $icon = 'epkbfa-exclamation-triangle';
				break;
			case 'success': $icon = 'epkbfa-check-circle';
				break;
			case 'warning': $icon = 'epkbfa-exclamation-circle';
				break;
			case 'info':    $icon = 'epkbfa-info-circle';
				break;
		}		?>

		<div <?php echo isset( $args['id'] ) ? 'id="' . $args['id'] . '"' : ''; ?> class="epkb-notification-box-basic <?php echo 'epkb-notification-box-basic--' . $args['type']; ?>">

			<div class="epkb-notification-box-basic__icon">
				<div class="epkb-notification-box-basic__icon__inner epkbfa <?php echo $icon; ?>"></div>
			</div>

			<div class="epkb-notification-box-basic__body">
				<h4 class="epkb-notification-box-basic__body__title"><?php echo $args['title']; ?></h4>
				<div class="epkb-notification-box-basic__body__desc"><?php echo $args['desc']; ?></div>     <?php

				if ( ! empty( $args['button_confirm'] ) ) {  ?>
					<div class="epkb-notification-box-basic__buttons-wrap">
						<span class="epkb-notification-box-basic__button-confirm"<?php echo empty( $args['close_target'] ) ? '' : ' data-target="' . $args['close_target'] . '"'; ?>><?php echo $args['button_confirm']; ?></span>
					</div>     <?php
				}   ?>
			</div>

		</div>    <?php
	}

	/**
	 * Show a box with Icon, Title, Description and Link
	 *
	 * @param $args array

	 * - ['icon_class']     Icon Beside title
	 * - ['icon_img_url']   Icon URL beside title
	 * - ['title']          Title above Video
	 * - ['video_src']      URL of Video source
	 * - ['desc']           Description text under video
	 * - ['keywords']       This will be used for on page search via JS. This will output hidden keywords for each video box.
	 */
	public static function video_info_box( $args ) { ?>

		<div class="epkb-video-container">

			<!-- Header -------------------->
			<div class="epkb-v__header-container">
				<h4 class="epkb__header__title"><?php echo $args['title']; ?></h4>      <?php

				if ( isset( $args['icon_class'] ) ) { ?>
					<span class="epkb__header__icon epkbfa <?php echo $args['icon_class']; ?>"></span>				<?php
				} else if ( isset($args['icon_img_url'] ) ) { ?>
					<span class="epkb__header__img">
						 <img src="<?php echo Echo_Knowledge_Base::$plugin_url . '' . $args['icon_img_url']; ?>">
					 </span>				<?php
				}				 ?>

			</div>

			<!-- Body ---------------------->
			<div class="epkb-v__video-container">
				<iframe width="" height="" src="<?php echo $args['video_src']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>			<?php

			if ( isset( $args['desc'] ) ) { ?>
				<div class="epkb-v__desc-container">
					<p><?php echo $args['desc'];?></p>
				</div>			<?php
			}	?>

			<div class="epkb-v__keywords-container">				<?php
				foreach( $args['keywords'] as $keyword ){
					echo $keyword.' ';
				}				?>
			</div>

		</div>	<?php
	}

	/**
	 * Display box for Call to Action step on Need Help page
	 *
	 * @param $step
	 */
	public static function display_step_cta_box( $step ) {    ?>
		<div class="epkb-admin__step-cta-box"<?php echo ( isset( $step['id'] ) ? ' id="' . esc_attr( $step['id'] ) . '"' : '' ); ?>>

			<?php if(  isset( $step['icon_img_url'] ) ) { ?>
			<div class="epkb-admin__step-cta-box__img-container">
				<img src=" <?php echo esc_url( Echo_Knowledge_Base::$plugin_url . '' . $step['icon_img_url'] ); ?>">
			</div>
			<?php } ?>
			<div class="epkb-admin__step-cta-box__icon-wrap">
				<span class="epkb-admin__step-cta-box__icon <?php echo esc_attr( $step['icon_class'] ); ?>"></span>
			</div>
			<div class="epkb-admin__step-cta-box__content">
				<h4 class="epkb-admin__step-cta-box__header"><?php echo esc_html( $step['title'] ); ?></h4>     <?php

				if ( isset( $step['content_icon_class'] ) ) {   ?>
					<span class="epkb-admin__step-cta-box__content__icon <?php echo esc_attr( $step['content_icon_class'] ); ?>"></span>    <?php
				}   ?>

				<p class="epkb-admin__step-cta-box__desc"><?php echo esc_html( $step['desc'] ); ?></p>
				<div class="epkb-admin__step-cta-box__body"><?php echo wp_kses( $step['html'], EPKB_Utilities::get_allowed_html_tags( ['image', 'link', 'form'] ) ); ?></div>
			</div>
		</div>      <?php
	}

	/**
	 * HTML Advertisement Box
	 * This box will have a title, image, either a description or list a button and more info link.
	 * $values:
	 * @param: string $args['id']              ( Optional ) Container ID, used for targeting with other JS
	 * @param: string $args['class']           ( Optional ) Container CSS, used for targeting with CSS
	 * @param: string $args['icon']            ( Optional ) Icon to display ( from this list: https://fontawesome.com/v4.7.0/icons/ )
	 * @param: string $args['title']           ( Required ) The text title
	 * @param: string $args['img_url']         ( Required ) URL of image.
	 * @param: string $args['desc']            ( Optional ) Paragraph Text
	 * @param: array  $args['list']            ( Optional ) array() of list items.
	 * @param: string $args['btn_text']        ( Optional ) Button Text
	 * @param: string $args['btn_url']         ( Optional ) Button URL
	 * @param: string $args['btn_color']       ( Required ) blue,yellow,orange,red,green
	 * @param: string $args['more_info_text']  ( Optional ) More Info Text
	 * @param: string $args['more_info_url']   ( Optional ) More Info URL
	 * @param: string $args['more_info_color'] ( Required ) blue,yellow,orange,red,green
	 * @param $args
	 */
	public static function advertisement_ad_box( $args ) {

		$args = EPKB_HTML_Elements::add_defaults( $args );		?>

		<div<?php echo empty( $args['id'] ) ? '' : ' id="' . $args['id'] . '"'; ?> class="epkb-admin-ad-container <?php echo $args['class']; ?>">

			<!----- Box Type ----->
			<span class="epkb-admin-ad-container__widget"> <i class="epkbfa epkbfa-puzzle-piece " aria-hidden="true"></i><?php echo __( 'Plugin', 'echo-knowledge-base'); ?></span>

			<!----- Header ----->
			<div class="epkb-aa__header-container">
				<div class="epkb-header__icon epkbfa <?php echo $args['icon']; ?>"></div>
				<div class="epkb-header__title"><?php echo $args['title']; ?></div>
			</div>

			<!----- Body ------->
			<div class="epkb-aa__body-container">
				<div class="featured_img">
					<img class="epkb-body__img" src="<?php echo $args['img_url']; ?>" alt="<?php echo $args['title']; ?>">
				</div>
				<p class="epkb-body__desc"><?php echo $args['desc']; ?></p>

				<ul class="epkb-body__check-mark-list-container">					<?php
					if ( $args['list'] ) {
						foreach ($args['list'] as $item) {
							echo '<li class="epkb-check-mark-list__item">';
							echo '<span class="epkb-check-mark-list__item__icon epkbfa epkbfa-check"></span>';
							echo '<span class="epkb-check-mark-list__item__text">' . $item . '</span>';
							echo '</li>';
						}
					}					?>
				</ul>

			</div>

			<!----- Footer ----->
			<div class="epkb-aa__footer-container">
				<?php if ( $args['btn_text'] ) { ?>
					<a href="<?php echo $args['btn_url']; ?>" target="_blank" class="epkb-body__btn epkb-body__btn--<?php echo $args['btn_color']; ?>"><?php echo $args['btn_text']; ?></a>
				<?php } ?>


				<?php if ( $args['more_info_text'] ) { ?>
					<a href="<?php echo $args['more_info_url']; ?>" target="_blank" class="epkb-body__link epkb-body__link--<?php echo $args['more_info_color']; ?>">
						<span class="epkb-body__link__icon epkbfa epkbfa-info-circle"></span>
						<span class="epkb-body__link__text"><?php echo $args['more_info_text']; ?></span>
						<span class="epkb-body__link__icon-after epkbfa epkbfa-angle-double-right"></span>

					</a>
				<?php } ?>
			</div>
		</div>	<?php
	}

	/**
	 * Show a box with Icon, Title, Description and Link
	 *
	 * @param $args array
	 * - ['container_class']    Main class for custom CSS for specific CTA
	 * - ['style']              The style of the Call to Action
	 *                          style-1: Center Aligned Icon top
	 *                          style-2: Left Aligned Icon top
	 * - ['icon_class']         Top Icon to display ( Choose between these available ones: https://fontawesome.com/v4.7.0/icons/ )
	 * - ['title']              H3 title of the box.
	 * - ['content']            Body content of the box.
	 * - ['btn_text']           Show button and the text of the button at the bottom of the box, if no text is defined no button will show up.
	 * - ['btn_url']            Button URL.
	 * - ['btn_target']         __blank
	 */
	public static function call_to_action( $args ) {

		$args = EPKB_HTML_Elements::add_defaults( $args ); ?>

		<div class="epkb-call-to-action-container <?php echo $args['container_class']; ?> <?php echo 'epkb-call-to-action--'.$args['style']; ?>">

			<!-- Header -------------------->
			<div class="epkb-cta__header">
				<h3 class="epkb-cta__header__title"><?php echo $args['title']; ?></h3>				<?php
				if ( isset( $args['icon_class'] ) ) { ?>
					<span class="epkb-cta__header__icon epkbfa <?php echo $args['icon_class']; ?>"></span>				<?php
				} elseif ( isset($args['icon_img_url'] ) ) { ?>
					<span class="epkb-cta__header__img">
						 <img src="<?php echo Echo_Knowledge_Base::$plugin_url . '' . $args['icon_img_url']; ?>">
					 </span>				<?php
				}				 ?>
			</div>

			<!-- Body ---------------------->			<?php
			if ( isset( $args['content'] ) ) { ?>
				<div class="epkb-cta__body">
					<?php echo empty($args['content']) ? '' : $args['content']; ?>
				</div>			<?php
			}

			if ( ! empty($args['btn_target']) ) {    ?>
				<!-- Footer ---------------------->
				<div class="epkb-cta__footer">
					<a class="epkb-cta__footer__button" href="<?php echo esc_url( $args['btn_url'] ); ?>" target="<?php echo isset( $args['btn_target'] ) ? esc_attr( $args['btn_target'] ) : ''; ?>"><?php echo $args['btn_text']; ?></a>
				</div>  <?php
			} ?>

		</div>	<?php
	}

	/**
	 * Show single Settings Box for Admin Page
	 *
	 * @param $box_options
	 */
	public static function admin_settings_box( $box_options ) {   ?>

		<!-- Admin Box -->
		<div class="epkb-admin__boxes-list__box <?php echo $box_options['class']; ?>">  <?php

			// Display header
			if ( ! empty( $box_options['title'] ) ){    ?>
				<h4 class="epkb-admin__boxes-list__box__header<?php echo empty( $box_options['icon_class'] ) ? '' : ' epkb-kbc__boxes-list__box__header--icon ' . $box_options['icon_class']; ?>"><?php echo $box_options['title']; ?></h4>   <?php
			}

			// Display description
			if ( ! empty( $box_options['description'] ) ){    ?>
				<p class="epkb-admin__boxes-list__box__desc"><?php echo $box_options['description']; ?></p>   <?php
			}

			// Display HTML Content     ?>
			<div class="epkb-admin__boxes-list__box__content"><?php echo $box_options['html']; ?></div>

		</div> <?php
	}

	/**
	 * Generic Confirmation Box - user can only click 'OK' button
	 *
	 * @param string $title
	 * @param string $accept_label
	 */
	public static function generic_confirmation_box( $title='', $accept_label='' ) { ?>

		<div id="epkb-admin__generic-confirmation-box">

			<!---- Header ---->
			<div class="epkb-admin__generic-confirmation-box__header">
				<h4><?php echo empty( $accept_label ) ? __( 'Configuration Saved', 'echo-knowledge-base' ) : $title; ?></h4>
			</div>

			<!---- Body ---->
			<div class="epkb-admin__generic-confirmation-box__body"></div>

			<!---- Footer ---->
			<div class="epkb-admin__generic-confirmation-box__footer">
				<div class="epkb-admin__generic-confirmation-box__footer__accept">
					<span class="epkb-admin__generic-confirmation-box__accept-btn">
						<?php echo empty( $accept_label ) ? __( 'OK', 'echo-knowledge-base' ) : $accept_label; ?>
					</span>
				</div>
			</div>

		</div>

		<div class="epkb-admin__generic-confirmation-box__overlay"></div>      <?php
	}


	/********************************************************************************
	 *
	 *                                   NOT USED
	 *
	 ********************************************************************************/

	/**
	 * Section with informaiton on HTML page.
	 * $values:
	 * @param: string $icon            Icon to display
	 * @param: string $title           The text title
	 * @param: string $dec             Text for box
	 * @param: string $buttonText      Text for Button
	 * @param: string $buttonURL       Link
	 * @param string $buttonClass
	 * @param string $buttonText2
	 * @param string $buttonURL2
	 */
	public function page_info_section( $icon, $title, $dec, $buttonText, $buttonURL, $buttonClass='epkb-aibb-btn--blue', $buttonText2='', $buttonURL2='' ) { ?>

		<div class="epkb-admin-info-box">

			<div class="epkb-admin-info-box__header">
				<div class="epkb-admin-info-box__header__icon <?php echo $icon; ?>"></div>
				<div class="epkb-admin-info-box__header__title"><?php echo $title; ?></div>
			</div>

			<div class="epkb-admin-info-box__body">
				<p><?php echo $dec; ?></p>
				<?php if ( $buttonText ) { ?>
					<a href="<?php echo $buttonURL; ?>" target="_blank" class="epkb-aibb-btn <?php echo $buttonClass; ?>"><?php echo $buttonText; ?></a>
				<?php } ?>
				<?php if ( $buttonText2 ) { ?>
					<a href="<?php echo $buttonURL2; ?>" target="_blank" class="epkb-aibb-btn epkb-aibb-btn--blue"><?php echo $buttonText2; ?></a>
				<?php } ?>
			</div>

		</div>	<?php
	}

	/**
	 * Show a box with Icon, Title, and a list of questions the user can select from to see the answer
	 *
	 * @param $args array
	 * - ['container_class']    Main class for custom CSS for specific CTA
	 * - ['style']              The style of the list of questions
	 *                          style-1: Center Aligned Icon top
	 *                          style-2: Left Aligned Icon top
	 *                          style-3: Monster Insights design ( Icon on left if defined )
	 * - ['icon_color']         HEX color Exaple: FFF, 000
	 * - ['icon_class']         Top Icon to display ( Choose between these available ones: https://fontawesome.com/v4.7.0/icons/ )
	 * - ['title']              H3 title of the box.
	 * - ['content']            Body content of the box.
	 * - ['btn_text']           Show button and the text of the button at the bottom of the box, if no text is defined no button will show up.
	 * - ['btn_url']            Button URL.
	 * - ['btn_target']         __blank
	 */
	public function questionnaire( $args ) {

		$args = EPKB_HTML_Elements::add_defaults( $args ); ?>

		<div class="epkb-questionnaire-container <?php echo $args['container_class']; ?> <?php echo 'epkb-questionnaire--'.$args['style']; ?>">

			<!-- Header -------------------->
			<div class="epkb-Q__header">
				<h3 class="epkb-Q__header__title"><?php echo $args['title']; ?></h3>

				<?php if ( isset( $args['icon_class'] ) ) { ?>
					<span class="epkb-Q__header__icon epkbfa <?php echo $args['icon_class']; ?>" style="color:#<?php echo $args['icon_color']; ?>;"></span>
				<?php } elseif ( isset($args['icon_img_url'] ) ) { ?>
					<span class="epkb-Q__header__img">
						 <img src="<?php echo Echo_Knowledge_Base::$plugin_url . '' . $args['icon_img_url']; ?>">
					 </span>
				<?php  }				 ?>

			</div>

			<!-- Body ---------------------->			<?php
			if ( isset( $args['questionnaire'] ) ) { ?>
				<div class="epkb-Q__body">

					<?php if ( !empty( $args['desc'] ) ) { ?>
						<div class="epkb-Q__body__desc"><?php echo $args['desc']; ?></div>
					<?php }

					$count = 1;
					foreach ($args['questionnaire'] as $questions ) {

						$active = '';
						/*if ( $count == 1 ) {
							$active = 'eckb-Q__list__item--active';
						} */

						echo '<div class="eckb-Q__list__item-container ' . $active . '">';

						echo '<div class="eckb-Q__item__question">';
						echo '<div class="eckb-Q__item__question__text"><div class="eckb-Q__item__question__icon epkbfa epkbfa-check-circle"></div>' . $questions[0] . '</div>';
						echo '<div class="eckb-Q__item__question__toggle-icon epkbfa epkbfa-plus-square"></div>';
						echo '</div>';

						echo '<div class="eckb-Q__item__answer">';
						echo '<div class="eckb-eckb-Q__item__answer__text">' . ( empty($questions[1]) ? '' : $questions[1] ) . '</div>';
						echo '</div>';

						echo '</div>';
						$count++;
					}					 ?>

				</div>			<?php
			}

			if ( ! empty($args['btn_target']) ) {    ?>
				<!-- Footer ---------------------->
				<div class="epkb-Q__footer">
					<a class="epkb-Q__footer__button" href="<?php echo esc_url( $args['btn_url'] ); ?>" target="<?php echo isset( $args['btn_target'] ) ? esc_attr( $args['btn_target'] ) : ''; ?>"><?php echo $args['btn_text']; ?></a>
				</div>  <?php
			} ?>

		</div>	<?php
	}

	/**
	 * Get an HTML Table for a list of items
	 *
	 * @param $list_of_items
	 * @param $total_items_number
	 * @param $item_primary_key
	 * @param $item_column_fields - item's fields which need to display as columns
	 * @param $item_row_fields - item's fields which need to display as rows
	 * @param $item_optional_row_fields - item's fields which need to display as rows only if they are not empty
	 * @param $delete_action
	 * @param $load_more_action
	 *
	 * @return false|string
	 */
	public static function get_html_table( $list_of_items, $total_items_number, $item_primary_key, $item_column_fields, $item_row_fields, $item_optional_row_fields, $delete_action, $load_more_action ) {

		$columns_count = count( $item_column_fields ) + 1;  // +1 is set for actions row

		ob_start();     ?>

		<!--Items List -->
		<table class="epkb-admin__items-list">

			<!-- Items List Header -->
			<thead class="epkb-admin__items-list__header">
				<tr>    <?php

					foreach( $item_column_fields as $field_title ) {    ?>
						<th class="epkb-admin__items-list__field"><?php echo $field_title; ?></th>    <?php
					}    ?>

					<th class="epkb-admin__items-list__field"><?php _e( 'Action', 'echo-knowledge-base' ); ?></th>
				</tr>
			</thead>    <?php

			// Items list body
			echo self::get_html_table_rows( $list_of_items, $item_primary_key, $item_column_fields, $item_row_fields, $item_optional_row_fields, $delete_action, $columns_count );    ?>

			<!-- Items List No Results -->
			<tbody class="epkb-admin__items-list__no-results">
				<tr>
					<td colspan="<?php echo $columns_count; ?>"><?php echo __( 'No entries found.', 'echo-knowledge-base' ); ?></td>
				</tr>
			</tbody>
		</table>    <?php

		// Show message that more items exist
		$items_left = $total_items_number - count( $list_of_items );
		if ( $items_left > 0 ) {    ?>

			<!-- More Items -->
			<div class="epkb-admin__items-list__more-items-message">
				<form>
					<input type="hidden" name="page_number" value="1"/>   <?php
					EPKB_HTML_Elements::submit_button_v2( __( 'Click here to load more entries.', 'echo-knowledge-base' ), $load_more_action, 'epkb-admin__items-list__more-items-message__button', '', false );   ?>
				</form>
			</div>  <?php
		}

		return ob_get_clean();
	}

	/**
	 * Get items as rows of HTML table
	 *
	 * @param $list_of_items
	 * @param $item_primary_key
	 * @param $item_column_fields
	 * @param $item_row_fields
	 * @param $item_optional_row_fields
	 * @param $delete_action
	 * @param $columns_count
	 *
	 * @return false|string
	 */
	public static function get_html_table_rows( $list_of_items, $item_primary_key, $item_column_fields, $item_row_fields, $item_optional_row_fields, $delete_action, $columns_count ) {

		ob_start();

		foreach ( $list_of_items as $item ) {   ?>

			<!-- Item -->
			<tbody class="epkb-admin__items-list__item">   <?php

			// Column fields
			self::display_item_column_fields( $item, $item_column_fields, $item_primary_key, $delete_action );

			// Row fields
			self::display_item_row_fields( $item, $item_row_fields, $columns_count );

			// Optional row fields
			self::display_item_optional_row_fields( $item, $item_optional_row_fields, $columns_count );   ?>

			</tbody>    <?php
		}

		return ob_get_clean();
	}

	/**
	 * Display single item's fields as columns
	 *
	 * @param $item
	 * @param $item_column_fields
	 * @param $item_primary_key
	 * @param $delete_action
	 */
	private static function display_item_column_fields( $item, $item_column_fields, $item_primary_key, $delete_action ) {   ?>

		<tr class="epkb-admin__items-list__column-fields">     <?php

			// Display item's fields
			foreach ( $item_column_fields as $field_key => $field_title ) {   ?>
				<td class="epkb-admin__items-list__column-field"><?php echo $item->$field_key; ?></td>    <?php
			}   ?>

			<td class="epkb-admin__items-list__field epkb-admin__items-list__field-actions">
				<form method="post" class="epkb-admin__items-list__field-actions__form">
					<input type="hidden" name="item_id" value="<?php echo $item->$item_primary_key; ?>"/>   <?php

					EPKB_HTML_Elements::submit_button_v2(
									__( 'Delete', 'echo-knowledge-base' ),
									$delete_action,
									'epkb-admin__items-list__field-actions__button',
									'',
									false,
									false,
									'epkb-error-btn'
					);      ?>
				</form>
			</td>

		</tr> <?php
	}

	/**
	 * Display single item's fields as rows
	 *
	 * @param $item
	 * @param $item_row_fields
	 * @param $columns_count
	 */
	private static function display_item_row_fields( $item, $item_row_fields, $columns_count ) {

		// Display item's fields
		foreach ( $item_row_fields as $field_key => $field_title ) {
			self::display_item_row_field( $field_title, $item->$field_key, $columns_count );
		}
	}

	/**
	 * Display single item's optional fields as rows only if they are not empty
	 *
	 * @param $item
	 * @param $item_optional_row_fields
	 * @param $columns_count
	 */
	private static function display_item_optional_row_fields( $item, $item_optional_row_fields, $columns_count ) {

		// Display item's fields
		foreach ( $item_optional_row_fields as $field_key => $field_title ) {

			if ( empty( $item->$field_key ) ) {
				continue;
			}

			self::display_item_row_field( $field_title, $item->$field_key, $columns_count );
		}
	}

	/**
	 * Display single item's field as row
	 *
	 * @param $field_title
	 * @param $field_value
	 * @param $columns_count
	 */
	private static function display_item_row_field( $field_title, $field_value, $columns_count ) {  ?>

		<tr class="epkb-admin__items-list__row-field">
			<td colspan="<?php echo $columns_count; ?>">
				<p class="epkb-admin__items-list__row-field__title"><?php echo $field_title; ?>:</p>
				<div class="epkb-admin__items-list__row-field__content"><?php echo wpautop( $field_value ); ?></div></td>
		</tr>   <?php
	}
}
