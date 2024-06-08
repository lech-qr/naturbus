 <?php /* The Template for displaying all single autos. */
global $post, $PIXAD_Autos, $PIXAD_Country;

$Settings = new PIXAD_Settings();
$settings = $Settings->getSettings( 'WP_OPTIONS', '_pixad_autos_settings', true );
$validate = $Settings->getSettings( 'WP_OPTIONS', '_pixad_autos_validation', true ); // Get validation settings
$validate = pixad::validation( $validate );
$PIXAD_Autos->Query_Args( array('auto_id' => $post->ID) );

$custom =  get_post_custom(get_queried_object()->ID);
$layout = get_post_meta( $post->ID, 'pixad_auto_sidebar_layout', true ) != '' ? get_post_meta( $post->ID, 'pixad_auto_sidebar_layout', true ) : 'right';

$pix_options = get_option('pix_general_settings');
$auto_translate = unserialize( get_option( '_pixad_auto_translate' ) );

$pix_show_description_tab = get_post_meta( get_the_ID(), 'pixad_auto_description_tab', true ) != '' ? get_post_meta( get_the_ID(), 'pixad_auto_description_tab', true ) : 1;
$pix_show_features_tab = get_post_meta( get_the_ID(), 'pixad_auto_features_tab', true ) != '' ? get_post_meta( get_the_ID(), 'pixad_auto_features_tab', true ) : 1;
$title_1 = get_post_meta( get_the_ID(), 'pixad_auto_custom_title_1', true );
$title_2 = get_post_meta( get_the_ID(), 'pixad_auto_custom_title_2', true );
$title_3 = get_post_meta( get_the_ID(), 'pixad_auto_custom_title_3', true );
$pix_show_contacts_tab = get_post_meta( get_the_ID(), 'pixad_auto_contacts_tab', true ) != '' ? get_post_meta( get_the_ID(), 'pixad_auto_contacts_tab', true ) : 1;

$pix_active_description_tab = $pix_active_features_tab = $pix_active_title_1 = $pix_active_title_2 = $pix_active_title_3 = $pix_active_contacts_tab = '';
if($pix_show_description_tab) {
    $pix_active_description_tab = 'active';
} elseif($pix_show_features_tab) {
    $pix_show_features_tab = 'active';
} elseif($title_1) {
    $pix_active_title_1 = 'active';
} elseif($title_2) {
    $pix_active_title_2 = 'active';
} elseif($title_3) {
    $pix_active_title_3 = 'active';
} elseif($pix_show_contacts_tab) {
    $pix_active_contacts_tab = 'active';
}

get_header();

?>
<div class="container">
    <div class="row">
        <?php if ($layout == 'left'):
			get_template_part( 'single', 'pixad-autos-sidebar' );
        endif;?>
        <div class="col-md-8">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
			?>
                <main class="main-content">
					<article class="car-details">
						<div class="car-details__wrap-title clearfix">
							<h2 class="car-details__title"><?php wp_kses_post(the_title()) ?></h2>
							<?php if( $validate['auto-price_show'] && $PIXAD_Autos->get_meta('_auto_price') ): ?>
							<?php $price = is_numeric($PIXAD_Autos->get_meta('_auto_price')) || $PIXAD_Autos->get_meta('_auto_price') == '' ? $PIXAD_Autos->get_price() : $auto_translate[$PIXAD_Autos->get_price()]; ?>
							<div class="car-details__wrap-price"><span class="car-details__price"><span class="car-details__price-inner"><?php echo wp_kses_post($price); ?></span></span></div>
							<?php endif; ?>
						</div>

						<div id="slider-product" class="flexslider slider-product">
						    <?php if( get_post_meta(get_the_ID(), 'pixad_auto_featured', true) ): ?>
                                <span class="card__wrap-label"><span class="card__label"><?php echo wp_kses_post($auto_translate[get_post_meta(get_the_ID(), 'pixad_auto_featured', true)]); ?></span></span>
                            <?php endif; ?>
                            <?php if( $PIXAD_Autos->get_meta('_auto_sale_price') != '' ): ?>
                                <span class="card__wrap-label sale"><?php esc_html_e( 'Sale', 'autozone' ); ?></span>
                            <?php endif; ?>
					        <ul class="slides">

					            <?php
					            $gallery = array();
					            if ( has_post_thumbnail() ) {

					                $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
					                $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
					                $image       		= get_the_post_thumbnail( $post->ID, 'autozone-auto-single', array('title' => $image_title) );

									$values = get_post_custom($post->ID);
									if(isset( $values['pixad_auto_gallery'][0]) ) {
								        $gallery = pixad_json_decode($values['pixad_auto_gallery'][0]);
								    }
								    if(isset($gallery[0]) && !empty($gallery[0]) )  {
								        // The json decode and base64 decode return an array of image ids
								        $attachment_ids = $gallery;
								    }else{
								        $attachment_ids = array();
								    }

								    echo sprintf( '<li><a rel="prettyPhoto[gallery1]" href="%s">%s</a></li>', $image_link, $image );

					                foreach ( $attachment_ids as $attachment_id ) {

					                    $image_link = wp_get_attachment_url( $attachment_id );

					                    $image       = wp_get_attachment_image( $attachment_id, 'autozone-auto-single' );
					                    $image_class = '';
					                    $image_title = esc_attr( get_the_title( $attachment_id ) );

					                    echo sprintf( '<li><a class="prettyPhoto" rel="prettyPhoto[gallery1]" href="%s" title="%s" >%s</a></li>', $image_link, $image_title, $image );

					                }

					            } else {
					                ?>
					                    <img class="no-image" src="<?php echo PIXADRO_CAR_URI .'assets/img/no_image.jpg'; ?>" alt="no-image">
						            <?php
					            }
					            ?>
					        </ul>
					    </div>
					    <?php
						if ( !empty($attachment_ids) && $attachment_ids[0] != -1 ) {
						?>
						    <div id="carousel-product" class="flexslider carousel-product">
						        <ul class="slides">
						        <?php

						            $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
						            $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
						            $image       		= get_the_post_thumbnail( $post->ID, 'autozone-auto-thumb', array('title' => $image_title) );

						            echo sprintf( '<li>%s</li>', $image );

						            foreach ( $attachment_ids as $attachment_id ) {

						                $image_link = wp_get_attachment_url( $attachment_id );

						                $image       = wp_get_attachment_image( $attachment_id, 'autozone-auto-thumb' );
						                $image_class = esc_attr('');
						                $image_title = esc_attr( get_the_title( $attachment_id ) );

						                echo sprintf( '<li>%s</li>', $image );

						            }
						        ?>
						        </ul>
						    </div>
						<?php } ?>
						<div class="wrap-nav-tabs">
							<ul class="nav nav-tabs">
							<?php if ($pix_show_description_tab) : ?>
							    <li class="<?php echo esc_attr($pix_active_description_tab); ?>"><a href="#tab1" data-toggle="tab" aria-expanded="true"><?php  esc_html_e( 'Vehicle Description', 'autozone' ) ?></a></li>
							<?php endif; ?>

							<?php if ($pix_show_features_tab) : ?>
								<li class="<?php echo esc_attr($pix_active_features_tab); ?>"><a href="#tab2" data-toggle="tab" aria-expanded="false"><?php esc_html_e( 'Features', 'autozone' ) ?></a></li>
							<?php endif; ?>

							<?php
								if($title_1 != ''){
									?><li class="<?php echo esc_attr($pix_active_title_1); ?>"><a href="#tab4" data-toggle="tab" aria-expanded="true"><?php echo wp_kses_post( $title_1 ) ?></a></li><?php
								}
								if($title_2 != ''){
									?><li class="<?php echo esc_attr($pix_active_title_2); ?>"><a href="#tab5" data-toggle="tab" aria-expanded="true"><?php echo wp_kses_post( $title_2 ) ?></a></li><?php
								}
								if($title_3 != ''){
									?><li class="<?php echo esc_attr($pix_active_title_3); ?>"><a href="#tab6" data-toggle="tab" aria-expanded="true"><?php echo wp_kses_post( $title_3 ) ?></a></li><?php
								}
							?>

							<?php if ($pix_show_contacts_tab) : ?>
								<li class="<?php echo esc_attr($pix_active_contacts_tab); ?>"><a href="#tab3" data-toggle="tab" aria-expanded="false"><?php esc_html_e( 'Contact', 'autozone' ) ?></a></li>
							<?php endif; ?>
							</ul>
						</div>
						<div class="tab-content">
						    <?php if ($pix_show_description_tab) : ?>
							<div class="tab-pane <?php echo esc_attr($pix_active_description_tab); ?>" id="tab1">
								<?php the_content() ?>
							</div>
							<?php endif; ?>

                            <?php if ($pix_show_features_tab) : ?>
							<div class="tab-pane <?php echo esc_attr($pix_active_features_tab); ?>" id="tab2">
								<h3 class="ui-title-inner"><?php esc_html_e( 'Car Equipment', 'autozone' ) ?></h3>
								<div class="decor-1"></div>
								<?php
									$terms = wp_get_post_terms( get_the_ID(), 'auto-equipment', array('fields' => 'ids') );
									$args_eq = array( 'taxonomy' => 'auto-equipment', 'hide_empty' => '0');
									$auto_equipment_cat = get_categories($args_eq);
									$equip_out = '';
									foreach ($auto_equipment_cat as $category) {
										if (is_object($category)) {
											$t_id = $category->term_id;
											$equipment_icon = get_option("auto_equipment_icon_$t_id");
											$class_icon_set = $equipment_icon != '' ? 'equipment-icon-set' : '';
											if (in_array($category->term_id, $terms)) {
												$feature_icon_true = $equipment_icon != '' ? '<i class="icon '.esc_attr($equipment_icon).'"></i>' : '<i class="features-icon">+</i>';
												$equip_out .= '<li class="pixad-exist '.esc_attr($class_icon_set).'">' . wp_kses_post($feature_icon_true.$category->name) . '</li>';
											} elseif($settings['autos_equipment']){
												$feature_icon_false = $equipment_icon != '' ? '<i class="icon '.esc_attr($equipment_icon).'"></i>' : '<i class="features-icon">-</i>';
												$equip_out .= '<li class="pixad-none '.esc_attr($class_icon_set).'"> ' . wp_kses_post($feature_icon_false.$category->name) . '</li>';
											}
										}
									}
									if( $equip_out != '')
										echo '<ul class="pixad-features-list">'.wp_kses_post($equip_out).'</ul>';
								?>
							</div>
							<?php endif; ?>

							<?php
								if($title_1 != ''){
									?><div class="tab-pane <?php echo esc_attr($pix_active_title_1); ?>" id="tab4"><?php echo do_shortcode( get_post_meta( get_the_ID(), 'pixad_auto_custom_content_1', true ) ) ?></div><?php
								}
								if($title_2 != ''){
									?><div class="tab-pane <?php echo esc_attr($pix_active_title_2); ?>" id="tab5"><?php echo do_shortcode( get_post_meta( get_the_ID(), 'pixad_auto_custom_content_2', true ) ) ?></div><?php
								}
								if($title_3 != ''){
									?><div class="tab-pane <?php echo esc_attr($pix_active_title_3); ?>" id="tab6"><?php echo do_shortcode( get_post_meta( get_the_ID(), 'pixad_auto_custom_content_3', true ) ) ?></div><?php
								}

							?>

                            <?php if ($pix_show_contacts_tab) : ?>
							<div class="tab-pane <?php echo esc_attr($pix_active_contacts_tab); ?>" id="tab3">
								<dl class="list-descriptions list-unstyled">

									<?php if( $validate['first-name_show'] && $PIXAD_Autos->get_meta('_seller_first_name') ): ?>
									<!-- Made Year -->
										<dt class="left"><?php esc_html_e( 'First Name:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_first_name')) ?></dd>
									<!-- / Made Year -->
									<?php endif; ?>

									<?php if( $validate['last-name_show'] && $PIXAD_Autos->get_meta('_seller_last_name') ): ?>
									<!-- Mileage -->
										<dt class="left"><?php esc_html_e( 'Last Name:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_last_name')) ?></dd>
									<!-- / Mileage -->
									<?php endif; ?>

									<?php if( $validate['seller-company_show'] && $PIXAD_Autos->get_meta('_seller_company') ): ?>
									<!-- Made Year -->
										<dt class="left"><?php esc_html_e( 'First Name:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_company')) ?></dd>
									<!-- / Made Year -->
									<?php endif; ?>

									<?php if( $validate['seller-phone_show'] && $PIXAD_Autos->get_meta('_seller_phone') ): ?>
									<!-- Mileage -->
										<dt class="left"><?php esc_html_e( 'Phone:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_phone')) ?></dd>
									<!-- / Mileage -->
									<?php endif; ?>

									<?php if( $PIXAD_Autos->get_meta('_seller_email') ): ?>
									<!-- Made Year -->
										<dt class="left"><?php esc_html_e( 'Email:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_email')) ?></dd>
									<!-- / Made Year -->
									<?php endif; ?>

									<?php if( $validate['seller-country_show'] && $PIXAD_Autos->get_meta('_seller_country') ): ?>
									<!-- Mileage -->
										<dt class="left"><?php esc_html_e( 'Country:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_country')) ?></dd>
									<!-- / Mileage -->
									<?php endif; ?>

									<?php if( $validate['seller-state_show'] && $PIXAD_Autos->get_meta('_seller_state') ): ?>
									<!-- Made Year -->
										<dt class="left"><?php esc_html_e( 'State:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_state')) ?></dd>
									<!-- / Made Year -->
									<?php endif; ?>

									<?php if( $validate['seller-town_show'] && $PIXAD_Autos->get_meta('_seller_town') ): ?>
									<!-- Mileage -->
										<dt class="left"><?php esc_html_e( 'Town:', 'autozone' ); ?></dt>
										<dd class="right"><?php echo wp_kses_post($PIXAD_Autos->get_meta('_seller_town')) ?></dd>
									<!-- / Mileage -->
									<?php endif; ?>

								</dl>

								<?php
									echo get_post_meta( get_the_ID(), 'pixad_auto_contact', true );
								?>

								<?php if( $PIXAD_Autos->get_meta('_seller_location_lat') && $PIXAD_Autos->get_meta('_seller_location_long') ) : ?>
								<style>

								        #contact-map{
								            width: 100%;
								            height: 400px;
								            margin: 0 auto;
								        }

								</style>

								<div id="contact-map"></div>

								<script type="text/javascript">


								/*=== initializate google map ====*/

								function initMap() {

									var styles = [
									    {
									        "featureType": "administrative",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "on"
									            },
									            {
									                "saturation": -100
									            },
									            {
									                "lightness": 20
									            }
									        ]
									    },
									    {
									        "featureType": "road",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "on"
									            },
									            {
									                "saturation": -100
									            },
									            {
									                "lightness": 40
									            }
									        ]
									    },
									    {
									        "featureType": "water",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "on"
									            },
									            {
									                "saturation": -10
									            },
									            {
									                "lightness": 30
									            }
									        ]
									    },
									    {
									        "featureType": "landscape.man_made",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "simplified"
									            },
									            {
									                "saturation": -60
									            },
									            {
									                "lightness": 10
									            }
									        ]
									    },
									    {
									        "featureType": "landscape.natural",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "simplified"
									            },
									            {
									                "saturation": -60
									            },
									            {
									                "lightness": 60
									            }
									        ]
									    },
									    {
									        "featureType": "poi",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "off"
									            },
									            {
									                "saturation": -100
									            },
									            {
									                "lightness": 60
									            }
									        ]
									    },
									    {
									        "featureType": "transit",
									        "elementType": "all",
									        "stylers": [
									            {
									                "visibility": "off"
									            },
									            {
									                "saturation": -100
									            },
									            {
									                "lightness": 60
									            }
									        ]
									    }
									];

								var myLatLng = {lat: <?php echo esc_js($PIXAD_Autos->get_meta('_seller_location_lat')) ?>, lng: <?php echo esc_js($PIXAD_Autos->get_meta('_seller_location_long')) ?>};
								var address = "<?php echo esc_js($PIXAD_Autos->get_meta('_seller_location')) ?>";

								// Create a map object and specify the DOM element for display.
								var map = new google.maps.Map(document.getElementById("contact-map"), {
									center: myLatLng,
									scrollwheel: false,
									zoom: 15
								});

						        var marker = new google.maps.Marker({
						          position: myLatLng,
						          map: map,
						          title:address
						        });

								map.setOptions({styles: styles});

							}

							</script>

							<!-- GOOGLE MAP API -->
							<script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" async defer></script>
							<?php endif; ?>

							</div>
							<?php endif; ?>
						</div>

					</article>

					<?php if( get_post_meta( get_the_ID(), 'pixad_auto_banner', true ) != '' ) : ?>
					<div class="wrap-section-border">
						<section class="section_letter section-bg section-bg_primary">
							<div class="letter bg-inner">
								<div class="letter__inner">
									<?php echo get_post_meta( get_the_ID(), 'pixad_auto_banner', true ) ?>
								</div>
								<?php if( get_post_meta( get_the_ID(), 'pixad_auto_banner_link', true ) ) : ?>
								<div class="letter__btn wrap-social-block wrap-social-block_mod-a">
									<a class="social-block social-block_mod-a btn-effect" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'pixad_auto_banner_link', true ) ); ?>">
										<div class="social-block__inner"><?php esc_html_e( 'send details', 'autozone' ); ?></div>
									</a>
								</div>
								<?php endif; ?>
							</div><!-- end bg-inner -->
<!--							<div class="border-section-bottom border-section-bottom_mod-a"></div>-->
						</section><!-- end section_mod-b -->
					</div><!-- end wrap-section-border -->
					<?php endif; ?>

				</main>
			<?php
                // End the loop.
            endwhile;
            ?>
        </div>
        <?php if ($layout == 'right'):
			get_template_part( 'single', 'pixad-autos-sidebar' );
        endif;?>
    </div>
</div>

<?php get_footer();?>
