<?php

defined('ABSPATH') || exit;

/**
 * Implement Theme Customizer additions and adjustments.
 * https://codex.wordpress.org/Theme_Customization_API
 *
 * How do I "output" custom theme modification settings? https://developer.wordpress.org/reference/functions/get_theme_mod
 * echo get_theme_mod( 'copyright_info' );
 * or: echo get_theme_mod( 'copyright_info', 'Default (c) Copyright Info if nothing provided' );
 *
 * "sanitize_callback": https://codex.wordpress.org/Data_Validation
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function boldfinance_customize($wp_customize)
{
	/**
	 * Initialize sections
	 */
	$wp_customize->add_section(
		'theme_header_section',
		array(
			'title' => __('Header', 'boldfinance'),
			'priority' => 1000,
		)
	);

	/**
	 * Section: Page Layout
	 */
	// Header Logo.
	$wp_customize->add_setting(
		'header_logo',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_logo',
			array(
				'label' => __('Upload Header Logo', 'boldfinance'),
				'description' => __('Height: &gt;80px', 'boldfinance'),
				'section' => 'theme_header_section',
				'settings' => 'header_logo',
				'priority' => 1,
			)
		)
	);

	// Predefined Navbar scheme.
	$wp_customize->add_setting(
		'navbar_scheme',
		array(
			'default' => 'default',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_scheme',
		array(
			'type' => 'radio',
			'label' => __('Navbar Scheme', 'boldfinance'),
			'section' => 'theme_header_section',
			'choices' => array(
				'navbar-light bg-light' => __('Default', 'boldfinance'),
				'navbar-dark bg-dark' => __('Dark', 'boldfinance'),
				'navbar-dark bg-primary' => __('Primary', 'boldfinance'),
			),
			'settings' => 'navbar_scheme',
			'priority' => 1,
		)
	);

	// Fixed Header?
	$wp_customize->add_setting(
		'navbar_position',
		array(
			'default' => 'static',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'navbar_position',
		array(
			'type' => 'radio',
			'label' => __('Navbar', 'boldfinance'),
			'section' => 'theme_header_section',
			'choices' => array(
				'static' => __('Static', 'boldfinance'),
				'fixed_top' => __('Fixed to top', 'boldfinance'),
				'fixed_bottom' => __('Fixed to bottom', 'boldfinance'),
			),
			'settings' => 'navbar_position',
			'priority' => 2,
		)
	);

	// Search?
	$wp_customize->add_setting(
		'search_enabled',
		array(
			'default' => '1',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'search_enabled',
		array(
			'type' => 'checkbox',
			'label' => __('Show Searchfield?', 'boldfinance'),
			'section' => 'theme_header_section',
			'settings' => 'search_enabled',
			'priority' => 3,
		)
	);

	$wp_customize->add_section(
		'color_palette_section',
		array(
			'title' => __('Kolory', 'boldfinance'),
			'priority' => 1003,
		)
	);

	$wp_customize->add_setting(
		'primary',
		array(
			'default' => '#7000FF',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary',
			array(
				'label' => __('primary', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'primary',
			)
		)
	);
	$wp_customize->add_setting(
		'primary_btn_color',
		array(
			'default' => '#7000FF',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_btn_color',
			array(
				'label' => __('primary_btn_color', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'primary_btn_color',
			)
		)
	);

	$wp_customize->add_setting(
		'primary_hover',
		array(
			'default' => '#401675',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_hover',
			array(
				'label' => __('primary_hover', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'primary_hover',
			)
		)
	);
	$wp_customize->add_setting(
		'secondary',
		array(
			'default' => '#D9D9D9',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary',
			array(
				'label' => __('second', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'secondary',
			)
		)
	);
	$wp_customize->add_setting(
		'black',
		array(
			'default' => '#000000',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'black',
			array(
				'label' => __('black', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'black',
			)
		)
	);
	$wp_customize->add_setting(
		'white',
		array(
			'default' => '#ffffff',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'white',
			array(
				'label' => __('white', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'white',
			)
		)
	);


	$wp_customize->add_setting(
		'border',
		array(
			'default' => '#E4E4E4',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'border',
			array(
				'label' => __('border', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'border',
			)
		)
	);

	//griadient colors
	$wp_customize->add_setting(
		'griadient_top_color',
		array(
			'default' => '#7001FF',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'griadient_top_color',
			array(
				'label' => __('griadient_top_color', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'griadient_top_color',
			)
		)
	);

	$wp_customize->add_setting(
		'griadient_bottom_color',
		array(
			'default' => '#1400FF',
			'transport' => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'griadient_bottom_color',
			array(
				'label' => __('griadient_bottom_color', 'boldfinance'),
				'section' => 'color_palette_section',
				'settings' => 'griadient_bottom_color',
			)
		)
	);

	//cienie 

	$wp_customize->add_setting(
		'shadow_check',
		array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shadow_check',
		array(
			'type' => 'checkbox',
			'label' => __('Pokazuj cienie', 'boldfinance'),
			'section' => 'color_palette_section',
			'settings' => 'shadow_check',
		)
	);
	

	$wp_customize->add_setting(
		'shadow_hover_check',
		array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'shadow_hover_check',
		array(
			'type' => 'checkbox',
			'label' => __('Pokazuj cienie po najechaniu (hover)', 'boldfinance'),
			'section' => 'color_palette_section',
			'settings' => 'shadow_hover_check',
		)
	);
	

	

}
add_action('customize_register', 'boldfinance_customize');

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 */
function boldfinance_customize_preview_js()
{
	wp_enqueue_script('customizer', get_template_directory_uri() . '/inc/customizer.js', array('jquery'), null, true);
}
add_action('customize_preview_init', 'boldfinance_customize_preview_js');