<?php

function autozone_fonts_url($post_id) {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Lora, translate this to 'off'. Do not translate
	* into your own language.
	*/

	$autozone_font = autozone_get_option('font', get_option('autozone_default_font'));
	$autozone_font_weights = autozone_get_option('font_weights', get_option('autozone_default_font_weights'));

    $autozone = _x( 'on', 'Roboto fonts: on or off', 'autozone' );

	if ( 'off' !== $autozone ) {
		$font_families = array();

        if ( 'off' !== $autozone ) {
			$font_families[] = 'Raleway:300,400,500,600,700,800|Ubuntu:300,400,500,700|Droid+Serif:400italic';
		}

		if( $autozone_font != '' ) {
			$cf = $autozone_font;
			if ( $autozone_font_weights != '' )
				$cf .= ':'.$autozone_font_weights;
			$font_families[] = $cf;
		}

		$query_args = array(
			'family' => str_replace('%2B', '+', urlencode( implode( '|', $font_families ) )),
			'subset' => urlencode( 'latin,cyrillic,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


add_action('wp_enqueue_scripts', 'autozone_load_styles_and_scripts');
add_filter('body_class','autozone_browser_body_class');

add_filter('woocommerce_enqueue_styles', 'autozone_load_woo_styles');
function autozone_load_woo_styles($styles){
	if (isset($styles['woocommerce-general']) && isset($styles['woocommerce-general']['src'])){
		$styles['woocommerce-general']['src'] = get_template_directory_uri() . '/assets/woocommerce/css/woocommerce.css';
	}
	if (isset($styles['woocommerce-layout']) && isset($styles['woocommerce-layout']['src'])){
		$styles['woocommerce-layout']['src'] = get_template_directory_uri() . '/assets/woocommerce/css/woocommerce-layout.css';
	}
	return $styles;
}

function autozone_load_styles_and_scripts(){

    wp_enqueue_style('style', get_stylesheet_uri());

    /* PRIMARY CSS */
    wp_enqueue_style('autozone-master', get_template_directory_uri() . '/css/master.css?1');
    wp_enqueue_style('autozone-assetscss', get_template_directory_uri() . '/assets/assets.min.css');
    wp_enqueue_style('autozone-fonts', autozone_fonts_url(get_the_ID()), array(), null );

    /* PLUGIN CSS */
    
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/fonts/fontawesome/css/font-awesome.min.css');

    /* MAIN CSS */

    /* HEADER CSS */
    wp_enqueue_style('autozone-header', get_template_directory_uri() . '/assets/header/header.css');
    wp_enqueue_style('autozone-header-yamm', get_template_directory_uri() . '/assets/header/yamm.css');

    // jQuery
    wp_enqueue_script('migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.js', array('jquery') , '3.3', false);

    // Bootstrap Core JavaScript
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery') , '3.3', false);
    wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery') , '3.3', false);
    
     wp_enqueue_script('assets.min.js', get_template_directory_uri() . '/assets/assets.min.js', array('jquery') , '1.1', true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js' );
	//wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

    // User agent
    //wp_enqueue_script('cssua', get_template_directory_uri() . '/js/cssua.min.js', array() , '3.3', true);

    // Waypoint
    wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array() , '3.3', true);

    // Isotope filter
    //wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/isotope/jquery.isotope.min.js', array() , '3.3', true);
    //wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/events/masonry.pkgd.min.js', array() , '3.3', true);
    //wp_enqueue_script('easypiechart', get_template_directory_uri() . '/assets/rendro-easy-pie-chart/jquery.easypiechart.min.js', array() , '3.3', true);
// Nouislider
    //wp_enqueue_script('nouislider_js', get_template_directory_uri() . '/assets/nouislider/nouislider.min.js', array() , '3.3', true);
    //wp_enqueue_script('wNumb', get_template_directory_uri() . '/assets/nouislider/wNumb.min.js', array() , '3.3', true);


  
    // Google Maps
    //wp_enqueue_script('google-maps', autozone_google_map_url(), array( 'jquery' ), null , true);

    
    
    
 
    

    wp_enqueue_script('slidebar', get_template_directory_uri() . '/assets/header/slidebar.js', array('jquery') , '1.1', true);
    wp_enqueue_script('autozone-header', get_template_directory_uri() . '/assets/header/header.js', array('jquery') , '1.1', true);
    wp_enqueue_script('slidebars', get_template_directory_uri() . '/assets/header/slidebars.js', array('jquery') , '1.1', true);
    wp_enqueue_script('doubletap', get_template_directory_uri() . '/assets/header/doubletap.js', array('jquery') , '1.1', true);


  

    wp_enqueue_script('autozone-custom', get_template_directory_uri() . '/js/custom.js', array() , '1.1', true);

    wp_enqueue_style('autozone-dynamic-styles', admin_url('admin-ajax.php').'?action=dynamic_styles&pageID='.get_the_ID());

}

function autozone_google_map_url() {
	$query_args = array(
		'sensor' => urlencode( 'false' ),
	);
	$map_url = add_query_arg( $query_args, 'http://maps.googleapis.com/maps/api/js' );
	return esc_url_raw( $map_url );
}

function autozone_dynamic_styles() {
	include( get_template_directory().'/css/dynamic-styles.php' );
	exit;
}
add_action('wp_ajax_dynamic_styles', 'autozone_dynamic_styles');
add_action('wp_ajax_nopriv_dynamic_styles', 'autozone_dynamic_styles');

function autozone_browser_body_class($classes = '') {
    $classes[] = 'animated-css';
    $classes[] = 'layout-switch';

    if (autozone_get_option('header_settings_type')){
        $headerType = autozone_get_option('header_settings_type');
        $classes[] =  'home-construction-v' . $headerType;
    }

    return $classes;
}

?>