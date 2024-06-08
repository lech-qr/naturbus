<?php
	
	/*  Redirect To Theme Options Page on Activation  */
	if (is_admin() && isset($_GET['activated'])) {
	    wp_redirect(admin_url('themes.php'));
	}
	
	/*  Load custom admin scripts & styles  */
	function autozone_load_custom_wp_admin_style()	{
		wp_enqueue_media();
		
		wp_register_script( 'autozone_custom_wp_admin_script', get_template_directory_uri() . '/js/custom-admin.js', array( 'jquery' ) );
	    wp_localize_script( 'autozone_custom_wp_admin_script', 'meta_image',
	        array(
	            'title' => esc_html__( 'Choose or Upload an Image', 'autozone' ),
	            'button' => esc_html__( 'Use this image', 'autozone' ),
	        )
	    );
	    wp_enqueue_script( 'autozone_custom_wp_admin_script' );
	    wp_enqueue_style('autozone-custom', get_template_directory_uri() . '/css/custom-admin.css');
	    
	    // Add the color picker css file
	    wp_enqueue_style( 'wp-color-picker' );
	    // Include our custom jQuery file with WordPress Color Picker dependency
	    wp_enqueue_script( 'autozone-color', get_template_directory_uri() . '/js/custom-script.js', array( 'wp-color-picker' ), false, true );
	}
	
	function autozone_add_editor_styles() {
		add_editor_style( 'autozone-editor-style.css' );
	}

	add_filter('login_headerurl', create_function('', "return get_home_url('/');"));
	add_filter('login_headertitle', create_function('', 'return false;'));
	add_action('admin_enqueue_scripts', 'autozone_load_custom_wp_admin_style');
	add_action('admin_init', 'autozone_add_editor_styles' );

    
    function autozone_staticblock_admin_notice(){
    
        $post_type = isset($_GET['post_type']) ?  $_GET['post_type'] : ''  ;
    
        if ( isset($_GET['post'] ))
            $post_type =   get_post($_GET['post'])->post_type;
    
        if ( $post_type == 'staticblocks'  ) {
            echo '<div class="notice notice-error  is-dismissible tmpl-notice-error"> 
                     <p>
                     '.esc_html__( 'Please activate WPBakery Page Builder  for Static Blocks post type', 'autozone' ).'
                     <a href="'.get_admin_url().'admin.php?page=vc-roles">'.esc_html__( 'here', 'autozone' ).'</a>
                     </p>
                 </div>';
        }
    }
    add_action('admin_notices', 'autozone_staticblock_admin_notice');
	
	
	/* Admin Panel */
	require_once(get_template_directory() . '/library/core/admin/admin-panel.php');
	
	
	require_once(get_template_directory() . '/library/core/admin/class-tgm-plugin-activation.php');
	
	require_once(get_template_directory() . '/library/core/admin/post-fields.php');

	require_once(get_template_directory() . '/library/core/admin/functions.php');
	

?>
