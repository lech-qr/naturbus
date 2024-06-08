<?php 
	
	function autozone_customize_general_tab($wp_customize, $theme_name){
	
		$wp_customize->add_section( 'autozone_general_settings' , array(
		    'title'      => esc_html__( 'General Settings', 'autozone' ),
		    'priority'   => 0,
		) );
		
		
		/* logo image */ 
		
		$wp_customize->add_setting( 'autozone_general_settings_logo' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'autozone_general_settings_logo_inverse' , array(
			'default'     => '',
			'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		
		$wp_customize->add_setting( 'autozone_general_settings_logo_text' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );

		$wp_customize->add_setting( 'autozone_general_settings_loader' , array(
		    'default'     => '',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		
		
		$wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'autozone_general_settings_logo',
				array(
				   'label'      => esc_html__( 'Logo image light', 'autozone' ),
				   'section'    => 'autozone_general_settings',
				   'context'    => 'autozone_general_settings_logo',
				   'settings'   => 'autozone_general_settings_logo',
				   'priority'   => 50
				)
	       )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'autozone_general_settings_logo_inverse',
				array(
				   'label'      => esc_html__( 'Logo image dark', 'autozone' ),
				   'section'    => 'autozone_general_settings',
				   'context'    => 'autozone_general_settings_logo_inverse',
				   'settings'   => 'autozone_general_settings_logo_inverse',
				   'priority'   => 60
				)
	       )
	    );

		$wp_customize->add_control(
			'autozone_general_settings_logo_text',
			array(
				'label'    => esc_html__( 'Logo Text', 'autozone' ),
				'section'  => 'autozone_general_settings',
				'settings' => 'autozone_general_settings_logo_text',
				'type'     => 'text',
				'priority'   => 70
			)
		);
	   
		$wp_customize->add_control(
			'autozone_general_settings_loader',
			array(
				'label'    => esc_html__( 'Loader', 'autozone' ),
				'section'  => 'autozone_general_settings',
				'settings' => 'autozone_general_settings_loader',
				'type'     => 'select',
				'choices'  => array(
					'off'  => esc_html__( 'Off', 'autozone' ),
					'usemain' => esc_html__( 'Use on main', 'autozone' ),
					'useall' => esc_html__( 'Use on all pages', 'autozone' ),
				),
				'priority'   => 110
			)
		);

		$wp_customize->add_setting( 'autozone_general_settings_live_editor' , array(
		    'default'     => '0',
		    'transport'   => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		) );
		$wp_customize->add_control(
			'autozone_general_settings_live_editor',
			array(
				'label'    => esc_html__( 'Front Editor Button', 'autozone' ),
				'description' => esc_html__( 'Show button for Visual CSS Style Editor', 'autozone' ),
				'section'  => 'autozone_general_settings',
				'settings' => 'autozone_general_settings_live_editor',
				'type'     => 'select',
				'choices'  => array(
					'0'    => esc_html__( 'Off', 'autozone' ),
					'1'    => esc_html__( 'On', 'autozone' ),
				),
				'priority'   => 170
			)
		);


		
		
	}
	
	