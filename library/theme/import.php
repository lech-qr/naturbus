<?php

function autozone_import_files() {
    
    
    add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
    
    add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
    
    
    
    return array(
		array(
            'import_file_name'              => esc_html__( 'AutoZone Theme', 'autozone' ),
            'local_import_file'             => get_template_directory().'/library/demo-files/content.xml',
            'import_widget_file_url'     => esc_url('http://assets.templines.com/import-demo/autozone/autozone.wie'),
            'import_customizer_file_url' => esc_url('http://assets.templines.com/import-demo/autozone/autozone.dat'),
            'import_preview_image_url'      => '',
            'import_notice'                 => '',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'autozone_import_files' );


function autozone_after_import( $selected_import ) {

    $menu_arr = array();
    $main_menu = get_term_by('name', 'main-menu', 'nav_menu');
    if(is_object($main_menu))
        $menu_arr['primary_nav'] = $main_menu->term_id;
    $top_menu = get_term_by('name', 'top', 'nav_menu');
    if(is_object($main_menu))
        $menu_arr['top_nav'] = $main_menu->term_id;
    set_theme_mod( 'nav_menu_locations', $menu_arr );

    $term = get_term_by('slug', 'sedans', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/2016-honda-civic-front_10909_032_376x188_wa-200x107.png');
    }
    $term = get_term_by('slug', 'luxury-cars', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/banner-new4-196x130.png');
    }
    $term = get_term_by('slug', 'suvs', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/10474_31.png');
    }
    $term = get_term_by('slug', 'sports', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/lamba.png');
    }
    $term = get_term_by('slug', 'truck', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/truck.png');
    }
    $term = get_term_by('slug', 'vans-trucks', 'auto-body');
    if( isset($term->term_id) ){
        $auto_t_id = $term->term_id;
        update_option("pixad_body_thumb$auto_t_id", content_url().'/uploads/2016/09/2016-Ford-TransitConnect-XLT.png');
    }

    $slider_array = array(
        get_template_directory()."/library/revslider/home_slider.zip",
        get_template_directory()."/library/revslider/home-blue.zip",
    );

    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
    set_theme_mod( 'autozone_footer_block', '2101' );

    $absolute_path = __FILE__;
    $path_to_file = explode( 'wp-content', $absolute_path );
    $path_to_wp = $path_to_file[0];

    require_once( $path_to_wp.'/wp-load.php' );
    require_once( $path_to_wp.'/wp-includes/functions.php');

    $slider = new RevSlider();

    foreach($slider_array as $filepath){
     $slider->importSliderFromPost(true,true,$filepath);
    }

}
add_action( 'pt-ocdi/after_import', 'autozone_after_import' );

?>