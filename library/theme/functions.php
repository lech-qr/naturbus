<?php

function autozone_site_menu($class = null) {
    if (function_exists('wp_nav_menu')) {
        wp_nav_menu(array(
            'theme_location' => 'primary_nav',
            'container' => false,
            'menu_class' => $class,
            'walker' => new AutoZone_Walker_Menu(),
        ));
    }
}

function autozone_show_breadcrumbs(){
	if ( class_exists( 'WooCommerce' ) && !is_page_template( 'page-home.php' )) woocommerce_breadcrumb();
}

function autozone_wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );

	return array(
		'alt' => is_object($attachment) ? get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) : '',
		'caption' => is_object($attachment) ? $attachment->post_excerpt : '',
		'description' => is_object($attachment) ? $attachment->post_content : '',
		'href' => is_object($attachment) ? get_permalink( $attachment->ID ) : '',
		'src' => is_object($attachment) ? $attachment->guid : '',
		'title' => is_object($attachment) ? $attachment->post_title : ''
	);
}

function autozone_post_read_more(){
    $btn_name = autozone_get_option('blog_settings_readmore');
    $name = ($btn_name) ? $btn_name : esc_html__('Read More','autozone');
    return esc_attr($name);
}

function autozone_limit_words($string, $word_limit) {

	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character

	$words = explode(' ', $string);

	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
 	if($string == "")
		return '';
	else
		return implode(' ', array_slice($words, 0, $word_limit)).'...';
}

function autozone_show_sidebar($type, $custom, $is_autos = 0, $sidebar = 'sidebar-1'){
    global $wp_query;

    $layout = 2;
    $layouts = array(
        1 => 'full',
        2 => 'right',
        3 => 'left',
    );

    if (is_array($custom) && isset($custom['pix_selected_sidebar'])) {
        $sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : $sidebar;
        $layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
    }

    if (!is_active_sidebar($sidebar)) $layout = '1';

    if (isset($layouts[$layout]) && $type === $layouts[$layout]) {
        echo ($is_autos || is_search() ? '<div class="col-md-3"><aside class="sidebar">' : '<div class="col-md-4"><aside class="sidebar">');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar)) {
        }
        echo '</aside></div>';
    }else{
        echo '';
    }

}

/**
 * Filter whether comments are open for a given post type.
 *
 * @param string $status       Default status for the given post type,
 *                             either 'open' or 'closed'.
 * @param string $post_type    Post type. Default is `post`.
 * @param string $comment_type Type of comment. Default is `comment`.
 * @return string (Maybe) filtered default status for the given post type.
 */
function autozone_open_comments_for_page( $status, $post_type, $comment_type ) {
    if ( 'page' === $post_type ) {
        return 'open';
    }
    // You could be more specific here for different comment types if desired
    return $status;
}
add_filter( 'get_default_comment_status', 'autozone_open_comments_for_page', 10, 3 );


function autozone_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
  $rgb = array($r, $g, $b);
//return $rgb; // returns an array with the rgb values
   return implode(",", $rgb); // returns the rgb values separated by commas
}