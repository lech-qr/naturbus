<?php

$rozklad = get_posts(array(
    'post_type' => 'przystanek',
    'post_status'=> 'publish',
//    'tax_query' => array(
//        array(
//            'taxonomy' => 'linia',
//            'field' => 'slug',
//            'terms' => 'pulawy-lublin'
//        )
//    ),
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'DESC',
));

?>

<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="first-schedule single-schedule">
                        <div class="schedule-name">
                            Lublin - Garbów - Kurów - Puławy
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad as $przystanek) {
                                    $nazwa_przystanka = get_the_title($przystanek);

                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
                                    ?>
                                        <div class="single-przystanek">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="przystanek-name">
                                                        <span class="counter">
                                                             <?php echo $count_rozklad_1++; ?>.
                                                        </span>
                                                        <span>
                                                            <?php echo $nazwa_przystanka; ?><i class="fa fa-caret-down"></i>

                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row przystanek-content">
                                                <div class="col-md-12">
                                                    <?php if ($mapa || $foto): ?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="localization">
                                                                    <div class="row">
                                                                        <?php if ($mapa): ?>
                                                                            <div class="col-md-6">
                                                                                <div class="przystanek-mapa">
                                                                                    <?php echo $mapa; ?>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php if ($foto): ?>
                                                                            <div class="col-md-6">
                                                                                <div class="przystanek-zdjecie">
                                                                                    <img src="<?php echo $foto; ?>">
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php } ?>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>