<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Template Name: Blog Custom
 */

?>

<?php
$rozklad_1 = get_posts(array(
    'post_type' => 'przystanek',
    'post_status'=> 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'linia',
            'field' => 'slug',
            'terms' => 'pulawy-lublin'
        )
    ),
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'DESC',
));
$rozklad_2 = get_posts(array(
    'post_type' => 'przystanek',
    'post_status'=> 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'linia',
            'field' => 'slug',
            'terms' => 'pulawy-lublin'
        )
    ),
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

?>




<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <section class="first-schedule single-schedule">
                        <div class="schedule-name">
                            Puławy - Kurów - Garbów - Lublin
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad_1 as $przystanek) {
                                    $godziny_odjazdu_d = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-odjazdu-d',false);
                                    $godziny_odjazdu_x = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-odjazdu-x',false);
                                    $godziny_odjazdu_w = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-odjazdu-w',false);
                                    $godziny_odjazdu_n = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-odjazdu-n',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    usort($godziny_odjazdu_unique, function($a, $b) {
                                        return (strtotime($a) > strtotime($b));
                                    });
                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
                                    ?>
<!--                                    --><?php //if (!$godziny_odjazdu[0] == '' && !$godziny_odjazdu[1] == ''): ?>
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


                                                    <div class="row">

                                                        <?php foreach ($godziny_odjazdu_unique as $godzina) {
                                                            if (in_array($godzina, $godziny_odjazdu_d) && in_array($godzina, $godziny_odjazdu_x) && in_array($godzina, $godziny_odjazdu_w) && in_array($godzina, $godziny_odjazdu_n)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">
                                                                        <div class="hour">

                                                                            <span><?php echo $godzina; ?></span><span class="lower">d, x, w, n</span>
                                                                        </div>
                                                                        <div class="desc">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } else if (in_array($godzina, $godziny_odjazdu_d) && in_array($godzina, $godziny_odjazdu_x) && in_array($godzina, $godziny_odjazdu_w)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">
                                                                        <div class="hour">
                                                                            <span><?php echo $godzina; ?></span><span class="lower">d, x, w</span>
                                                                        </div>
                                                                        <div class="desc">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php include 'legenda.php'; ?>
                                                        </div>
                                                    </div>
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
<!--                                    --><?php //endif; ?>
                                <?php } ?>

                            </div>
                        </div>
                    </section>
                    <section class="second-schedule single-schedule">
                        <div class="schedule-name">
                            Lublin - Garbów - Kurów - Puławy
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad_2 as $przystanek) {
                                    $godziny_odjazdu_d = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-przyjazdu-d',false);
                                    $godziny_odjazdu_x = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-przyjazdu-x',false);
                                    $godziny_odjazdu_w = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-przyjazdu-w',false);
                                    $godziny_odjazdu_n = get_post_meta($przystanek->ID, 'wpcf-pulawy-lublin-godziny-przyjazdu-n',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    usort($godziny_odjazdu_unique, function($a, $b) {
                                        return (strtotime($a) > strtotime($b));
                                    });
                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
                                    ?>
<!--                                    --><?php //if (!$godziny_odjazdu[0] == '' && !$godziny_odjazdu[1] == ''): ?>
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


                                                    <div class="row">
                                                        <?php foreach ($godziny_odjazdu_unique as $godzina) {
                                                            if (in_array($godzina, $godziny_odjazdu_d) && in_array($godzina, $godziny_odjazdu_x) && in_array($godzina, $godziny_odjazdu_w) && in_array($godzina, $godziny_odjazdu_n)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">
                                                                        <div class="hour">

                                                                            <span><?php echo $godzina; ?></span><span class="lower">d, x, w, n</span>
                                                                        </div>
                                                                        <div class="desc">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } else if (in_array($godzina, $godziny_odjazdu_d) && in_array($godzina, $godziny_odjazdu_x) && in_array($godzina, $godziny_odjazdu_w)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">
                                                                        <div class="hour">
                                                                            <span><?php echo $godzina; ?></span><span class="lower">d, x, w</span>
                                                                        </div>
                                                                        <div class="desc">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php include 'legenda.php'; ?>
                                                        </div>
                                                    </div>
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
<!--                                    --><?php //endif; ?>
                                <?php } ?>

                            </div>
                        </div>
                </div>
    </section>
    </div>
    </div>
    </div>
    </section>
<?php get_footer(); ?>