<?php
/**
 * Set up the default theme options
 *
 * @param string $name  The option name
 *
 * @since likeawiki 0.1
 */

add_action( 'customize_register', 'likeawiki_customize_register' );
// Register the new customizer settings and controls
 
function likeawiki_customize_register($wp_customize) {

        /**
         * Add a custom section into customizer
         * for fonts and tooltip controls
         */
        $wp_customize->add_section( 'likeawiki_fonts', array(
            'title' => __( 'Tools and Font sizes', 'likeawiki' ),
            'description' => __( 'Add Tools and Change font size of page text.
                                  No HTML tags allowed.', 'likeawiki' ),
            'priority' => 35
        ) );

        // add settings for ******** =tool bar options
        $wp_customize->add_setting( 'likeawiki_checkbox', array(
             'default'           => 0,
             'transport'         => 'refresh',
             
             'sanitize_callback' => 'likeawiki_sanitize_checkbox',
             'capability'        => 'edit_theme_options'
        ) );
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize,
        'likeawiki_checkbox', 
        array(
            'label'   => __( 'Checkbox to replace default text and use any Widget from Theme > Widgets.', 'likeawiki' ),
            'section' => 'likeawiki_fonts',
            'type'    => 'checkbox',
            'priority' => 1
        ) ) );

        // ******** =first text field
        $wp_customize->add_setting( 'likeawiki_theme_options[likeawiki_t1]', 
        array(
             'default'            => '',
             'type' => 'option',
             'sanitize_callback' => 'wp_kses_post',
             'capability' => 'edit_theme_options'
        ) );
        $wp_customize->add_control( 'likeawiki_theme_options[likeawiki_t1]', 
        array(
             'label'    => __( 'First tool', 'likeawiki' ),
             'section' => 'likeawiki_fonts',
             'priority' => 3
        ) );

        // ******** =second text field
        $wp_customize->add_setting( 'likeawiki_theme_options[likeawiki_t2]', 
        array(
             'default'            => '',
             'type' => 'option',
             'sanitize_callback' => 'wp_kses_post',
             'capability' => 'edit_theme_options'
        ) );
        $wp_customize->add_control( 'likeawiki_theme_options[likeawiki_t2]', 
        array(
             'label'    => __( 'Second tool', 'likeawiki' ),
             'section' => 'likeawiki_fonts',
             'priority' => 4
        ) );

        // ******** =third text field
        $wp_customize->add_setting( 'likeawiki_theme_options[likeawiki_t3]', array(
             'default'            => '',
             'type' => 'option',
             'sanitize_callback' => 'wp_kses_post',
             'capability' => 'edit_theme_options'
        ) );
        $wp_customize->add_control( 'likeawiki_theme_options[likeawiki_t3]', array(
             'label'    => __( 'Third tool', 'likeawiki' ),
             'section' => 'likeawiki_fonts',

             'priority' => 5
        ) );

        // ******** =fourth text field
        $wp_customize->add_setting( 'likeawiki_theme_options[likeawiki_t4]', array(
             'default'            => '',
             'type' => 'option',
             'sanitize_callback' => 'wp_kses_post',
             'capability' => 'edit_theme_options'
        ) );
        $wp_customize->add_control( 'likeawiki_theme_options[likeawiki_t4]', array(
             'label'    => __( 'Fourth tool', 'likeawiki' ),
             'section' => 'likeawiki_fonts',

             'priority' => 5
        ) );

        // ******** =font size selector
        $wp_customize->add_setting('likeawiki_theme_options[likeawiki_font_size]', array(
             'default'          => '16',
             'type'             => 'option',
            'sanitize_callback' => 'likeawiki_sanitize_number',
            'capability' => 'edit_theme_options'
        ) );
        $wp_customize->add_control('likeawiki_theme_options[likeawiki_font_size]', array(
            'label'      => __('Select Font Size', 'likeawiki'),
            'description' => __('Affects all page content size.', 'likeawiki'),
            'type'       => 'select',
            'choices'    => array(
                                 9 =>  9, 10 => 10, 12 => 12, 13 => 13, 14 => 14,
                                15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19,
                                20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24,
                                25 => 25 ),
            'name'     => 'font_size',
            'section'  => 'likeawiki_fonts',
            'settings' => 'likeawiki_theme_options[likeawiki_font_size]'
        ) );

		// ******** =Color options
		 $wp_customize->add_setting( 'likeawiki_theme_options[link_color]', array(
			'default'           => '#033383',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability' => 'edit_theme_options'
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'    => __( 'Link Color', 'likeawiki' ),
			'section'  => 'colors',
			'settings' => 'likeawiki_theme_options[link_color]'
		) ) );
}

// @since v 1.1
function likeawiki_styles_method() {

    $options = get_option( 'likeawiki_theme_options' );

    echo '<style type="text/css" id="likeawiki-inline-css">';
    echo "#sidebar a, article.content-area a { color: {$options['link_color']} !important; }";
    echo "body > div { font-size: {$options['font_size']}px !important; }";
    echo '</style>';

}
add_action( 'wp_head', 'likeawiki_styles_method' );

// simple checkbox sanitizer
function likeawiki_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

// register new sanitizer
//apply_filters( 'likeawiki_sanitize_number', 'likeawiki_sanitize_number' )
function likeawiki_sanitize_number( $input ) {
      if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
