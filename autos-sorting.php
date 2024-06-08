<?php 
/***
The template for displaying sorting autos fields.
***/
$data = array_map( 'esc_attr', $_REQUEST );
$per_page_arr = $order_arr = array();
$Settings = new PIXAD_Settings();
$options = $Settings->getSettings( 'WP_OPTIONS', '_pixad_autos_settings', true );
$per_page = $options['autos_per_page'];
$order = isset($options['autos_order']) ? $options['autos_order'] : 'date-desc';
$autos_purpose = (get_post_meta(get_the_ID(), 'pix_page_purpose', true) == "") ? '' : get_post_meta(get_the_ID(), 'pix_page_purpose', true);
foreach($data as $key=>$val){
    if( property_exists('PIXAD_Autos', $key) && $key == 'order' ){
        $order = $val;
    } elseif( property_exists('PIXAD_Autos', $key) && $key == 'per_page' ) {
        $per_page = $val;
    }
}

$per_page_arr = array(
		10 => esc_html__( '10 Autos', 'autozone' ),
		20 => esc_html__( '20 Autos', 'autozone' ),
		50 => esc_html__( '50 Autos', 'autozone' ),
        -1 => esc_html__( 'All Autos', 'autozone' ),
);

$order_arr = array(
		'date-desc' => esc_html__( 'Last Added', 'autozone' ),
		'date-asc' => esc_html__( 'First Added', 'autozone' ),
		'_auto_price-asc' => esc_html__( 'Cheap First', 'autozone' ),
		'_auto_price-desc' => esc_html__( 'Expensive First', 'autozone' ),
		'_auto_make-asc' => esc_html__( 'Make A-Z', 'autozone' ),
		'_auto_make-desc' => esc_html__( 'Make Z-A', 'autozone' ),
		'_auto_year-asc' => esc_html__( 'Old First', 'autozone' ),
		'_auto_year-desc' => esc_html__( 'New First', 'autozone' ),
);

?>


    <div class="sorting" id="pix-sorting">

        <div class="sorting__inner">
            <div class="sorting__item">
                <span class="sorting__title"><?php  esc_html_e( 'Show on page', 'autozone' ); ?></span>
                <div class="select jelect">
                    <input id="jelect-page" name="page" value="0" data-text="imagemin" type="text" class="jelect-input">
                    <div tabindex="0" role="button" class="jelect-current"><?php echo wp_kses_post( $per_page_arr[$per_page] ); ?></div>
                    <ul class="jelect-options">
                        <li data-val="10" class="jelect-option <?php echo ($per_page == 10 ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $per_page_arr[10] ); ?></li>
                        <li data-val="20" class="jelect-option <?php echo ($per_page == 20 ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $per_page_arr[20] ); ?></li>
                        <li data-val="50" class="jelect-option <?php echo ($per_page == 50 ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $per_page_arr[50] ); ?></li>
                        <li data-val="-1" class="jelect-option <?php echo ($per_page == -1 ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $per_page_arr[-1] ); ?></li>
                    </ul>
                </div>
            </div>
            <div class="sorting__item">
                <span class="sorting__title"><?php  esc_html_e( 'Sort by', 'autozone' ); ?></span>
                <div class="select jelect">
                    <input id="jelect-sort" name="sort" value="0" data-text="imagemin" type="text" class="jelect-input">
                    <div tabindex="0" role="button" class="jelect-current"><?php echo wp_kses_post( $order_arr[$order] ); ?></div>
                    <ul class="jelect-options">
                        <li data-val="date-desc" class="jelect-option <?php echo ($order == 'date-desc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['date-desc'] ); ?></li>
                        <li data-val="date-asc" class="jelect-option <?php echo ($order == 'date-asc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['date-asc'] ); ?></li>
                        <li data-val="_auto_price-asc" class="jelect-option <?php echo ($order == '_auto_price-asc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_price-asc'] ); ?></li>
                        <li data-val="_auto_price-desc" class="jelect-option <?php echo ($order == '_auto_price-desc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_price-desc'] ); ?></li>
                        <li data-val="_auto_make-asc" class="jelect-option <?php echo ($order == '_auto_make-asc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_make-asc'] ); ?></li>
                        <li data-val="_auto_make-desc" class="jelect-option <?php echo ($order == '_auto_make-desc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_make-desc'] ); ?></li>
                        <li data-val="_auto_year-asc" class="jelect-option <?php echo ($order == '_auto_year-asc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_year-asc'] ); ?></li>
                        <li data-val="_auto_year-desc" class="jelect-option <?php echo ($order == '_auto_year-desc' ? 'jelect-option_state_active' : ''); ?>"><?php echo wp_kses_post( $order_arr['_auto_year-desc'] ); ?></li>
                    </ul>
                </div>
            </div>
            <div class="sorting__item">
                <input type="hidden" id="sort-purpose" name="purpose" value="<?php echo esc_attr($autos_purpose) ?>">
            </div>
        </div>
    </div><!-- end sorting -->
