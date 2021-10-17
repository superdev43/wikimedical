<?php

/**
 * Elements of form UI and others
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_HTML_Elements {

	// Form Elements------------------------------------------------------------------------------------------/
	public static function add_defaults( array $input_array, array $custom_defaults=array() ) {

		$defaults = array(
			'id'                => '',
			'name'              => 'text',
			'value'             => '',
			'label'             => '',
			'title'             => '',
			'class'             => '',
			'main_label_class'  => '',
			'label_class'       => '',
			'input_class'       => '',
			'input_group_class' => '',
			'action_class'      => '',
			'container_class'   => '',
			'desc'              => '',
			'info'              => '',
			'placeholder'       => '',
			'readonly'          => false,  // will not be submitted
			'required'          => '',
			'autocomplete'      => false,
			'data'              => false,
			'disabled'          => false,
			'size'              => 3,
			'max'               => 50,
			'current'           => null,
			'options'           => array(),
            'label_wrapper'     => '',
            'input_wrapper'     => '',
            'icon_color'        => '',
            'return_html'       => false,
            'unique'            => true,
            'radio_class'       => '',
			'expanded'          => false
		);
		$defaults = array_merge( $defaults, $custom_defaults );
		return array_merge( $defaults, $input_array );
	}

	private function add_common_defaults( array $input_array, array $custom_defaults=array() ) {
		$defaults = array(
			'id'                => '',
			'name'              => 'text',
			'value'             => '',
			'label'             => '',
			'title'             => '',
			'class'             => '',
			'main_label_class'  => '',
			'label_class'       => '',
			'input_class'       => '',
			'input_group_class' => '',
			'desc'              => '',
			'info'              => '',
			'placeholder'       => '',
			'readonly'          => false,  // will not be submitted
			'required'          => '',
			'autocomplete'      => false,
			'data'              => false,
			'disabled'          => false,
			'size'              => 3,
			'max'               => 50,
			'current'           => null,
			'options'           => array()
		);
		$defaults = array_merge( $defaults, $custom_defaults );
		return array_merge( $defaults, $input_array );
	}

	/**
	 * Renders an HTML Text field
	 *
	 * @param array $args Arguments for the text field
	 * @param bool $return_html
	 * @return false|string
	 */
	public function text( $args = array(), $return_html=false ) {

		if ( $return_html ) {
			ob_start();
		}

		$args = self::add_defaults( $args );

		$id             =  esc_attr( $args['name'] );
		$autocomplete   = ( $args['autocomplete'] ? 'on' : 'off' );
		$readonly       = $args['readonly'] ? ' readonly' : '';

		$data = '';
		if ( ! empty( $args['data'] ) ) {
			foreach ( $args['data'] as $key => $value ) {
				$data .= 'data-' . $key . '="' . $value . '" ';
			}
		}

		if ( empty( $args['main_tag'] ) ) {
			$main_tag = 'li';
		} else {
			$main_tag = $args['main_tag'];
		}		?>

		<<?php echo $main_tag; ?> class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group" >

		<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id ?>">
			<?php echo esc_html( $args['label'] )?>
		</label>

		<div class="input_container <?php echo esc_html( $args['input_class'] ); ?>" id="">
			<input type="text"
			       name="<?php echo $id; ?>"
			       id="<?php echo $id; ?>"
			       autocomplete="<?php echo $autocomplete; ?>"
			       value="<?php echo esc_attr( $args['value'] ); ?>"
			       placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"						<?php
			echo $data . $readonly;						?>
			       maxlength="<?php echo $args['max']; ?>"
			/>
		</div>

		</<?php echo $main_tag; ?>>		<?php

		if ( $return_html ) {
			return ob_get_clean();
		}

		return '';
	}

	/**
	 * Renders an HTML textarea
	 *
	 * @param array $args Arguments for the textarea
	 */
	public function textarea( $args = array() ) {

		$defaults = array(
			'name'        => 'textarea',
			'class'       => 'large-text',
			'rows'        => 4,
			'placeholder' => ''
		);
		$args = self::add_defaults( $args, $defaults );

		$disabled = '';
		if( $args['disabled'] ) {
			$disabled = ' disabled="disabled"';
		}

		$id =  esc_attr( $args['name'] );

		if ( empty( $args['main_tag'] ) ) {
			$main_tag = 'li';
		} else {
			$main_tag = $args['main_tag'];
		}		?>

		<<?php echo $main_tag; ?> class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group" >

		<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id ?>">
			<?php echo esc_html( $args['label'] )?>
		</label>
		<div class="input_container <?php echo esc_html( $args['input_class'] ); ?>">
				<textarea
						rows="<?php echo esc_attr( $args['rows'] ); ?>"
						name="<?php echo esc_attr( $args['name'] ); ?>"
						id="<?php echo $id; ?>"
						value="<?php echo esc_attr( $args['value'] ); ?>"
						placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"
					<?php echo $disabled; ?> >
				</textarea>
		</div>

		</<?php echo $main_tag; ?>>		<?php

		if ( ! empty( $args['info'] ) ) { ?>
			<span class="info-icon"><p class="hidden"><?php echo $args['info']; ?></p></span>		<?php
		}
	}

	/**
	 * Renders an HTML Checkbox
	 *
	 * @param array $args
	 * @param bool $return_html
	 *
	 * @return string
	 */
	public function checkbox( $args = array(), $return_html=false ) {

		if ( $return_html ) {
			ob_start();
		}

		$defaults = array(
			'name'         => 'checkbox',
			'class'        => '',
		);
		$args = self::add_defaults( $args, $defaults );
		$id             =  esc_attr( $args['name'] );
		$checked = checked( "on", $args['value'], false );		?>

		<div class="config-input-group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id; ?>_group">

			<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id; ?>">
				<?php echo esc_html( $args['label'] ); ?>
			</label>

			<div class="input_container <?php echo esc_html( $args['input_class'] ); ?>" id="">
				<input type="checkbox"
				       name="<?php echo $id ?>"
				       id="<?php echo $id ?>"
				       value="on"
					<?php echo $checked; ?> />
			</div>
		</div>			<?php

		if ( $return_html ) {
			return ob_get_clean();
		}

		return '';
	}

	/**
	 * Renders an HTML Toggle ( checkbox )
	 *
	 * @param array $args
	 * textLoc - left, right
	 */
	public static function checkbox_toggle( $args = array() ) {
		$defaults = array(
			'id'            => '',
			'class'         => '',
			'text'          => '',
			'data'          => '',
			'topDesc'       => '',
			'bottomDesc'    => '',
			'textLoc'       => 'left',
			'checked'       => false,
			'toggleOnText'  => __( 'yes', 'echo-knowledge-base' ),
			'toggleOffext'  => __( 'no', 'echo-knowledge-base' ),
			'return_html'   => false,
		);
		$args       = self::add_defaults( $args, $defaults );
		$id         = esc_attr( $args['id'] );
		$text       = esc_attr( $args['text'] );
		$data       = esc_attr( $args['data'] );
		$topDesc    = $args['topDesc'];
		$bottomDesc = $args['bottomDesc'];
		$checked	= esc_attr( $args['checked'] );
		$textLoc    = esc_attr( $args['textLoc'] );

		if ( $args['return_html'] ) {
			ob_start();
		}   ?>

		<div id="<?php echo $id; ?>" class="epkb-settings-control-container epkb-settings-control-type-toggle <?php echo 'epkb-settings-control-type-toggle--'.$textLoc; ?>" data-field="<?php echo $data; ?>">     <?php

			if ( ! empty( $topDesc ) ) {    ?>
				<div class="epkb-settings-control__description"><?php echo $topDesc; ?></div>  <?php
			}   ?>

			<div class="epkb-settings-control__field">
				<label class="epkb-settings-control__title"><?php echo __( $text, 'echo-knowledge-base' ); ?></label>
				<div class="epkb-settings-control__input">
					<label class="epkb-settings-control-toggle">
						<input type="checkbox" class="epkb-settings-control__input__toggle" value="on" name="<?php echo $id; ?>" <?php echo $checked ? 'checked' : '' ?>/>
						<span class="epkb-settings-control__input__label" data-on="<?php echo $args['toggleOnText']; ?>" data-off="<?php echo $args['toggleOffext']; ?>"></span>
						<span class="epkb-settings-control__input__handle"></span>
					</label>
				</div>
			</div>			<?php

			if ( ! empty( $bottomDesc ) ) {     ?>
				<div class="epkb-settings-control__description"><?php echo $bottomDesc; ?></div>  <?php
			}   ?>

		</div>		<?php

		if ( $args['return_html'] ) {
			return ob_get_clean();
		}
	}

	/**
	 * Renders an HTML radio button
	 *
	 * @param array $args
	 */
	public function radio_button( $args = array() ) {

		$defaults = array(
			'name'         => 'radio-buttons',
			'class'        => '',
		);

		$args = self::add_defaults( $args, $defaults );
		$id =  esc_attr( $args['name'] );
		$checked = checked( $args['current'], $args['value'], false );		?>

		<li class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group">

			<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id ?>">
				<?php echo esc_html( $args['label'] )?>
			</label>

			<div class="input_container <?php echo esc_html( $args['input_class'] )?>" id="">
				<input type="radio"
				       name="<?php echo $id ?>"
				       id="<?php echo $id ?>"
				       value="<?php echo esc_attr( $args['value'] ); ?>"
					<?php echo $checked; ?> />
			</div>			<?php

			if ( ! empty( $args['info'] ) ) { ?>
				<span class='info-icon'><p class='hidden'><?php echo $args['info']; ?></p></span>";			<?php
			} ?>

		</li>		<?php
	}

	/**
	 * Renders an HTML drop-down box
	 *
	 * @param array $args
	 */
	public function dropdown( $args = array() ) {

		$defaults = array(
			'name'         => 'select',
		);
		$args = self::add_defaults( $args, $defaults );

		$id =  esc_attr( $args['name'] );		?>

		<li class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group">
			<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id ?>">
				<?php echo esc_html( $args['label'] )?>
			</label>

			<div class="input_container <?php echo esc_html( $args['input_class'] )?>" id="">

				<select name="<?php echo $id ?>" id="<?php echo $id ?>">     <?php
					foreach( $args['options'] as $key => $label ) {
						$selected = selected( $key, $args['current'], false );
						echo '<option value="' . esc_attr($key) . '"' . $selected . '>' . esc_html($label) . '</option>';
					}  ?>
				</select>
			</div>		<?php

			if ( ! empty( $args['info'] ) ) { ?>
				<span class='info-icon'><p class='hidden'><?php echo $args['info']; ?></p></span>			<?php
			}	?>

		</li>		<?php
	}

	/**
	 * Renders several HTML radio buttons in a row
	 *
	 * @param array $args
	 */
	public function radio_buttons_horizontal( $args = array() ) {

		$defaults = array(
			'id'                => 'radio',
			'name'              => 'radio-buttons',
			'main_label_class'  => '',
			'radio_class'       => '',
		);
		$args = self::add_defaults( $args, $defaults );
		$id =  esc_attr( $args['name'] );
		$ix = 0;   		?>

		<li class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group" >

			<span class="main_label <?php echo esc_html( $args['main_label_class'] )?>"><?php echo esc_html( $args['label'] ); ?></span>

			<div class="radio-buttons-horizontal <?php echo esc_html( $args['input_class'] )?>" id="<?php echo $id ?>">
				<ul>					<?php

					foreach( $args['options'] as $key => $label ) {
						$checked = checked( $key, $args['current'], false );						?>

						<li class="<?php echo esc_html( $args['radio_class'] )?>">
							<div class="input_container">
								<input type="radio"
								       name="<?php echo esc_attr( $args['name'] ); ?>"
								       id="<?php echo $id.$ix; ?>"
								       value="<?php echo esc_attr( $key ); ?>"									<?php
								echo $checked				?>
								/>
							</div>

							<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id.$ix ?>">
								<?php echo esc_html( $label )?>
							</label>
						</li>						<?php

						$ix++;
					} //foreach    	?>

				</ul>  <?php

				if ( ! empty( $args['info'] ) ) { ?>
					<span class="info-icon"><p class="hidden"><?php echo ( $args['info'] ); ?></p></span>
				<?php } ?>
			</div><?php

			if ( $args['desc'] ) {
				echo $args['desc'];
			} ?>

		</li>		<?php
	}

	/**
	 * Renders several HTML radio buttons in a column
	 *
	 * @param array $args
	 */
	public function radio_buttons_vertical( $args = array() ) {

		$defaults = array(
			'id'           => 'radio',
			'name'         => 'radio-buttons',
			'class'        => '',
		);
		$args = self::add_defaults( $args, $defaults );

		$ix = 0;
		$id =  esc_attr( $args['name'] );	?>

		<li class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id ?>_group" >

			<span class="main_label <?php echo esc_html( $args['main_label_class'] )?>"><?php echo esc_html( $args['label'] ); ?></span>

			<div class="radio-buttons-vertical <?php echo esc_html( $args['input_class'] )?>" id="<?php echo $id ?>">
				<ul>					<?php

					foreach( $args['options'] as $key => $label ) {
						$id = empty($args['name']) ? '' :  esc_attr($args['name'] ) . '_choice_' . $ix;
						$checked = checked( $key, $args['current'], false );
						$checked_list   = '';

						if( $args['current'] == $key ) {
							$checked_list = 'epkb-radio-checked';
						}						?>

						<li class="<?php echo esc_html( $args['radio_class'] ).' '.$checked_list; ?>">
							<div class="input_container">
								<input type="radio"
								       name="<?php echo esc_attr( $args['name'] ); ?>"
								       id="<?php echo $id; ?>"
								       value="<?php echo esc_attr( $key ); ?>"									<?php
								echo $checked;	?>
								/>
							</div>
							<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id; ?>">
								<?php echo esc_html( $label )?>
							</label>
						</li>						<?php

						$ix++;
					}//foreach					?>

				</ul>
			</div>

		</li>		<?php
	}

	/**
	 * Single Inputs for text_fields_horizontal function
	 * @param array $args
	 */
	public function horizontal_text_input( $args = array() ){

		$args = self::add_defaults( $args );

		//Set Values
		$id             =  esc_attr( $args[ 'name' ] );
		$autocomplete   = ( $args[ 'autocomplete' ] ? 'on' : 'off' );
		$disabled       = $args[ 'disabled' ] ? ' disabled="disabled"' : '';

		$data = '';
		if ( ! empty( $args['data'] ) ) {
			foreach ( $args['data'] as $key => $value ) {
				$data .= 'data-' . $key . '="' . $value . '" ';
			}
		}		?>

		<li class="<?php echo esc_html( $args['text_class'] )?>">

			<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id; ?>">
				<?php echo esc_html( $args['label'] )?>
			</label>
			<div class="input_container">
				<input type="text"
				       name="<?php echo $id; ?>"
				       id="<?php echo $id; ?>"
				       autocomplete='<?php echo $autocomplete; ?>'
				       value="<?php echo esc_attr( $args['value'] ); ?>"
				       placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>"
				       maxlength="<?php echo $args['max']; ?>"					<?php
				echo $data . $disabled;	?>	/>
			</div>

		</li>	<?php
	}

	/**
	 * Renders two text fields. The second text field depends in some way on the first one
	 *
	 * @param array $common - configuration for the main classes
	 * @param array $args1  - configuration for the first text field
	 * @param array $args2  - configuration for the second field
	 */
	public function text_fields_horizontal( $common = array(), $args1 = array(), $args2 = array() ) {

		$defaults = array(
			'name'         => 'text',
			'class'        => '',
		);

		$common = $this->add_common_defaults( $common, $defaults );

		$args1 = self::add_defaults( $args1, $defaults );
		$args2 = self::add_defaults( $args2, $defaults );		?>

		<li class="input_group <?php echo esc_html( $common['input_group_class'] )?>" id="<?php echo $common['id']; ?>_group" >
			<span class="main_label <?php echo esc_html( $common['main_label_class'] )?>"><?php echo esc_html( $common['label'] ); ?></span>
			<div class="text-fields-horizontal <?php echo esc_html( $common['input_class'] )?>">
				<ul>   <?php

					$this->horizontal_text_input($args1);
					$this->horizontal_text_input($args2); ?>

				</ul>
			</div>
		</li>		<?php
	}

	/**
	 * Renders two text fields that related to each other. One field is text and other is select.
	 *
	 * @param array $common
	 * @param array $args1
	 * @param array $args2
	 */
	public function text_and_select_fields_horizontal( $common = array(), $args1 = array(), $args2 = array() ) {

		$args1 = self::add_defaults( $args1 );
		$args2 = self::add_defaults( $args2 );
		$common = $this->add_common_defaults( $common );		?>

		<li class="input_group <?php echo esc_html( $common['input_group_class'] )?>" id="<?php echo $common['id']; ?>_group" >
			<span class="main_label <?php echo esc_html( $common['main_label_class'] )?>"><?php echo esc_html( $common['label'] ); ?></span>
			<div class="text-select-fields-horizontal <?php echo esc_html( $common['input_class'] )?>">
				<ul>  <?php

					$this->text($args1);
					$this->dropdown($args2);

					// HELP
					$help_text = $common['info'];
					if ( ! empty( $help_text ) ) { ?>
						<span class='info-icon'><p class='hidden'><?php echo $help_text; ?></p></span>					<?php
					}	?>

				</ul>
			</div>
		</li>		<?php
	}

	/**
	 * Renders several HTML checkboxes in several columns
	 *
	 * @param array $args
	 * @param $is_single_select
	 */
	public function checkboxes_multi_select( $args = array(), $is_single_select=false ) {

		$defaults = array(
			'id'           => 'checkbox',
			'name'         => 'checkbox',
			'value'        => array(),
			'class'        => '',
			'main_class'   => '',
			'main_tag'     => 'li'
		);
		$args = self::add_defaults( $args, $defaults );
		$id =  esc_attr( $args['name'] );
		$ix = 0;    	?>

		<<?php echo esc_html( $args['main_tag'] ); ?> class="input_group <?php echo esc_html( $args['input_group_class'] ); ?>" id="<?php echo $id; ?>_group" >

		<span class="main_label <?php echo esc_html( $args['main_label_class'] )?>"><?php echo esc_html( $args['label'] ); ?></span>

		<div class="checkboxes-vertical <?php echo esc_html( $args['input_class'] )?>" id="<?php echo $id; ?>">
			<ul>  		<?php

				foreach( $args['options'] as $key => $label ) {

					$tmp_value = is_array($args['value']) ? $args['value'] : array();

					if ( $is_single_select ) {
						$checked = in_array($key, array_keys($tmp_value)) ? '' : 'checked';
					} else {
						$checked = in_array($key, array_keys($tmp_value)) ? 'checked' : '';
					}

					$label = str_replace(',', '', $label);   			?>

					<li class="input_group <?php echo esc_html( $args['input_group_class'] )?>" id="<?php echo $id; ?>_group">							<?php
						if ( $is_single_select ) { ?>
							<input type="hidden" value="<?php echo esc_attr( $key . '[[-HIDDEN-]]' . $label ); ?>" name="<?php echo esc_attr( $args['name'] ) . '_' . $ix; ?>">							<?php
						}	?>

						<label class="<?php echo esc_html( $args['label_class'] )?>" for="<?php echo $id.$ix; ?>">
							<?php echo esc_html( $label ); ?>
						</label>

						<div class="input_container <?php echo esc_html( $args['input_class'] )?>" id="">
							<input type="checkbox"
							       name="<?php echo $id. '-' . $ix; ?>"
							       id="<?php echo $id . '-' . $ix; ?>"
							       value="<?php echo esc_attr( $key ); ?>"
								<?php echo $checked; ?>
							/>
						</div>
					</li>   	<?php

					$ix++;
				} //foreach   	?>

			</ul>
		</div>
		</<?php echo esc_html( $args['main_tag'] )?>>   <?php
	}

	/**
	 * Output submit button  DEPRECATED
	 *
	 * @param string $button_label
	 * @param string $action
	 * @param string $main_class
	 * @param string $html - any additional hidden fields
	 * @param bool $unique_button - is this unique button or a group of buttons - use 'ID' for the first and 'class' for the other
	 * @param bool $return_html
	 * @param string $inputClass
	 * @return string
	 */
	public function submit_button( $button_label, $action, $main_class='', $html='', $unique_button=true, $return_html=false, $inputClass='' ) {

		if ( $return_html ) {
			ob_start();
		}		?>

		<div class="submit <?php echo $main_class; ?>">
			<input type="hidden" name="action" value="<?php echo $action; ?>"/>     <?php

			if ( $unique_button ) {  ?>
				<input type="hidden" id="_wpnonce_<?php echo $action; ?>" name="_wpnonce_<?php echo $action; ?>" value="<?php echo wp_create_nonce( "_wpnonce_$action" ); ?>"/>
				<input type="submit" id="<?php echo $action; ?>" class="<?php echo $inputClass; ?>" value="<?php echo $button_label; ?>" />  <?php
			} else {    ?>
				<input type="submit" class="<?php echo $action . ' ' . $inputClass; ?>" value="<?php echo $button_label; ?>" />  <?php
			}

			echo $html;  ?>
		</div>  <?php

		if ( $return_html ) {
			return ob_get_clean();
		}

		return '';
	}

	/**
	 * Output submit button
	 *
	 * @param string $button_label
	 * @param string $action
	 * @param string $main_class
	 * @param string $html - any additional hidden fields
	 * @param bool $unique_button - is this unique button or a group of buttons - use 'ID' for the first and 'class' for the other
	 * @param bool $return_html
	 * @param string $inputClass
	 * @return string
	 */
	public static function submit_button_v2( $button_label, $action, $main_class='', $html='', $unique_button=true, $return_html=false, $inputClass='' ) {

		if ( $return_html ) {
			ob_start();
		}		?>

		<div class="submit <?php echo esc_attr( $main_class ); ?>">
			<input type="hidden" name="action" value="<?php echo esc_attr( $action ); ?>"/>     <?php

			if ( $unique_button ) {  ?>
				<input type="hidden" name="_wpnonce_epkb_ajax_action" value="<?php echo esc_attr( wp_create_nonce( "_wpnonce_epkb_ajax_action" ) ); ?>"/>
				<input type="submit" id="<?php echo esc_attr( $action ); ?>" class="<?php echo esc_attr( $inputClass ); ?>" value="<?php echo esc_attr( $button_label ); ?>" />  <?php
			} else {    ?>
				<input type="submit" class="<?php echo esc_attr( $action ) . ' ' . esc_attr( $inputClass ); ?>" value="<?php echo esc_attr( $button_label ); ?>" />  <?php
			}

			echo wp_kses( $html, EPKB_Utilities::get_allowed_html_tags( ['form'] ) );  ?>
		</div>  <?php

		if ( $return_html ) {
			return ob_get_clean();
		}

		return '';
	}

	/**
	 * Renders HTML Tabs
	 *
	 * @param array $args Arguments for the tabs and tab content
	 *
	 * tab_size:            Options ( small, large )
	 * icon_color:          Options ( black, red, blue, green )
	 * content_style:       Options ( style-1, style-2 )
	 */
	public function tabs( $args = array() ) {
		$defaults = array(
			'tabs'               => array(
				'icon'              => '',
				'icon_color'        => '',
				'text'              => '',
				'content'           => ''
			),
			'container_class'   => '',
			'container_ID'      => '',
			'tab_size'          => 'small',
			'content_style'     => 'style-1',
		);
		$args = self::add_defaults( $args, $defaults );		?>

		<div id="<?php echo $args['container_ID']; ?>" class="epkb-tabs-container <?php echo 'epkb-tabs--'.$args['tab_size'] . ' ' .'epkb-content--'.$args['content_style'] . ' '. $args['container_class']; ?>">

			<!-- Tabs -->
			<div class="epkb-tabs__header-container">				<?php
				$i = 1;
				foreach ( $args['tabs'] as $tab ) {

					if ( ! empty($tab['hide']) ) {
						continue;
					}

					$activeClass = $i++ == 1 ? 'epkb-header__tab--active' : '';	 ?>
					<div id="tab<?php echo $i; ?>" class="epkb-header__tab <?php echo $activeClass; ?>">
						<div class="epkb-header__tab__icon epkbfa <?php echo $tab['icon'] . ' epkb-icon--' .$tab['icon_color']; ?>"></div>
						<div class="epkb-header__tab__text"><?php echo $tab['text']; ?></div>
					</div>				<?php
				}	?>

			</div>

			<!-- Tab Content -->
			<div class="epkb-tabs__content-container">				<?php
				$i = 1;
				foreach ( $args['tabs'] as $tab ) {

					if ( ! empty($tab['hide']) ) {
						continue;
					}

					$activeClass = $i++ == 1 ? 'epkb-content__tab--active' : '';				?>
					<div id="tab<?php echo $i; ?>_content" class="epkb-content__tab <?php echo $activeClass; ?>">
						<?php echo $tab['content']; ?>
					</div>					<?php
				}	?>
			</div>

		</div>	<?php
	}

	public function table( $args = array() ) {
		$defaults = array(
			'headings'          => array( 'heading 1', 'heading 2', 'heading 3' ),
			'rows'              => array(
				0 => array( 'cell 1', 'cell 2', 'cell 3' ),
			),
			'container_class'   => '',
			'container_ID'      => '',
			'actions'           => 'yes',
			'buttons'           => [],
			'colSizes'          => array(
				'col1' => 25,
				'col2' => 25,
				'col3' => 25,
				'col4' => 25,
				'col5' => 25,
				'col6' => 25,
				'col7' => 25,
				'col8' => 25,
			),
		);
		$args = self::add_defaults( $args, $defaults );		?>

		<style>			<?php
			$colCount = count( $args['headings'] );
			$x =1;
			while(   $x    <=   $colCount    ) { ?>
			<?php echo '#'.$args['container_ID']; ?> .epkb-header__th:nth-child(<?php echo $x; ?>) {	width:<?php echo $args['colSizes']['col'.$x.'']; ?>%; }
			<?php echo '#'.$args['container_ID']; ?> .epkb-content__td:nth-child(<?php echo $x; ?>) {	width:<?php echo $args['colSizes']['col'.$x.'']; ?>%; }
			<?php $x++;
		}            ?>

		</style>
		<div id="<?php echo $args['container_ID']; ?>" class="epkb-table-container <?php echo $args['container_class']; ?>">

			<!-- Header -->
			<div class="epkb-table__header-container">				<?php
				foreach($args['headings'] as $heading ) { ?>
					<span class="epkb-header__th"><?php echo $heading; ?></span>				<?php
				}	?>
			</div>

			<!-- Content -->
			<div class="epkb-table__content-container">				<?php

				if ( empty($args['rows']) ) {   ?>
					<div class="epkb-list-no-results"><?php echo __( 'This table is empty. ', 'echo-knowledge-base' ); ?></div>  <?php
					return;
				}

				$ix = 0;
				foreach ( $args['rows'] as $row ) { ?>

					<div id="epkb-row-id-<?php echo ++$ix; ?>" data-record-id="<?php echo $row[$args['row_id_name']]; ?>" class="epkb-content__row">			<?php
						$col_ix = 0;
						foreach ( $args['headings'] as $counter ) {
							if ( empty($args['column_keys'][$col_ix]) ) {
								continue;
							}
							$column_name = $args['column_keys'][$col_ix++];  ?>
							<span class="epkb-content__td">								<?php
								$value = $row[$column_name];
								if ( is_array( $value ) ) {
									echo '<ul>';
									foreach( $value as $item ) {
										echo '<li>' . $item . '</li>';
									}
									echo '</ul>';
								} else {
									echo $value;
								}								?>
								</span>						<?php
						}

						if ( $args['actions'] == 'yes' ) {
							foreach ( $args['buttons'] as $button ) { ?>
								<span class="epkb-content__td">							<?php
									self::submit_button_v2(
										$button['label'],
										$button['action'],
										$button['main_class'],
										'',
										$button['unique'],
										'',
										$button['input_class']
									); ?>
									</span>  <?php
							}
						}	?>
					</div>				<?php
				}	?>
			</div>
		</div>	<?php
	}

	/**
	 * Renders an HTML Text field
	 * This has Wrappers because you need to be able to wrap both elements ( Label , Input )
	 *
	 * @param array $args Arguments for the text field
	 * @return string Text field
	 */
	public function text_basic( $args = array() ) {

		$args = self::add_defaults( $args );
		$id             = $args['name'];
		$autocomplete   = $args['autocomplete'] ? 'on' : 'off';
		$readonly       = $args['readonly'] ? ' readonly' : '';
		$data = '';
		$label_wrap_open  = '';
		$label_wrap_close = '';
		$input_wrap_open  = '';
		$input_wrap_close = '';

		if ( ! empty( $args['data'] ) ) {
			foreach ( $args['data'] as $key => $value ) {
				$data .= 'data-' . $key . '="' . $value . '" ';
			}
		}
		if ( ! empty( $args['label_wrapper']) ) {
			$label_wrap_open   = '<' . esc_html( $args['label_wrapper'] ) . ' class="' . esc_html( $args['main_label_class'] ) . '" >';
			$label_wrap_close  = '</' . esc_html( $args['label_wrapper'] ) . '>';
		}
		if ( ! empty( $args['input_wrapper']) ) {
			$label_wrap_open   = '<' . esc_html( $args['input_wrapper'] ) . ' class="' . esc_html( $args['input_group_class'] ) . '" >';
			$label_wrap_close  = '<' . esc_html( $args['input_wrapper'] ) . '>';
		}

		if ( ! empty( $args['return_html'] ) ) {
			ob_start();
		}

		echo $label_wrap_open;  ?>
		<label class="<?php echo esc_html( $args['label_class'] ); ?>" for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $args['label'] ); ?></label>		<?php
		echo $label_wrap_close;

		echo  $input_wrap_open; ?>
		<input type="text" name="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_html( $args['input_class'] ); ?>"
		       autocomplete="<?php echo $autocomplete; ?>" value="<?php echo esc_attr( $args['value'] ); ?>"
		       placeholder="<?php echo esc_attr( $args['placeholder'] ); ?>" maxlength="<?php echo $data; ?>" <?php echo $readonly; ?> />		<?php
		echo  $input_wrap_close;

		if ( ! empty( $args['return_html'] ) ) {
			return ob_get_clean();
		}
		return '';
	}
}