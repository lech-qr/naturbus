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
            'terms' => 'opole-pulawy'
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
            'terms' => 'opole-pulawy'
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
                            Puławy - Kazimierz Dolny - Karczmiska - Opole Lubelskie
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad_2 as $przystanek) {
                                    $godziny_odjazdu_powszednie = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godzin-przyjazdu-dni-powszednie',false);
                                    $godziny_odjazdu_d = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-d',false);
                                    $godziny_odjazdu_x = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-x',false);
                                    $godziny_odjazdu_w = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-w',false);
                                    $godziny_odjazdu_n = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-n',false);
                                    $godziny_odjazdu_s = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-s',false);
                                    $godziny_odjazdu_r = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-r',false);
                                    $godziny_odjazdu_euro = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-przyjazdu-euro',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_powszednie, $godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n, $godziny_odjazdu_s, $godziny_odjazdu_r, $godziny_odjazdu_euro);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    usort($godziny_odjazdu_unique, function($a, $b) {
                                        return (strtotime($a) > strtotime($b));
                                    });
//                                    print_r($godziny_odjazdu_unique);
                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
//                                    print_r($godziny_odjazdu_unique);
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

                                                        <?php foreach ($godziny_odjazdu_unique as $godzina) { ?>
                                                            <?php if(strlen($godzina)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">
                                                                        <div class="hour">
                                                                            <span><?php echo $godzina; ?></span><span class="lower"><?php echo numerki($godzina, $godziny_odjazdu_powszednie, $godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n, $godziny_odjazdu_s, $godziny_odjazdu_r, $godziny_odjazdu_euro); ?></span>
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
                                                            <div class="legend">
                                                            <span class="legend-name">
                                                                Legenda
                                                            </span>

                                                                <ul>
                                                                    <li class="standard-legend">
                                                                        D - kursuje od poniedziałku do piątku oprócz świąt.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        d – nie kursuje 01 I, w pierwszy i drugi dzień Świąt Wielkanocnych oraz w dniach 25 i 26 XII.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        x – nie kursuje 06 I i 11 XI.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        n – nie kursuje w Wielką Sobotę oraz w dniach 24 i 31 XII.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        S - kursuje w dni nauki szkolnej.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        r - nie kursuje w okresie ferii zimowych oraz szkolnych przerw świątecznych.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        € - nie kursuje w niedziele.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        w - nie kursuje w Boże Ciało
                                                                    </li>
                                                                </ul>
                                                            </div>
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
                            Opole Lubelskie – Karczmiska – Kazimierz Dolny – Puławy
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad_1 as $przystanek) {
                                    $godziny_odjazdu_powszednie = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godzin-odjazdu-dni-powszednie',false);
                                    $godziny_odjazdu_d = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-d',false);
                                    $godziny_odjazdu_x = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-x',false);
                                    $godziny_odjazdu_w = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-w',false);
                                    $godziny_odjazdu_n = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-n',false);
                                    $godziny_odjazdu_s = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-s',false);
                                    $godziny_odjazdu_r = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-r',false);
                                    $godziny_odjazdu_euro = get_post_meta($przystanek->ID, 'wpcf-opole-pulawy-godziny-odjazdu-euro',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_powszednie, $godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n, $godziny_odjazdu_s, $godziny_odjazdu_r, $godziny_odjazdu_euro);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    usort($godziny_odjazdu_unique, function($a, $b) {
                                        return (strtotime($a) > strtotime($b));
                                    });
//                                    print_r($godziny_odjazdu_unique);
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
                                                        <?php foreach ($godziny_odjazdu_unique as $godzina) { ?>
                                                            <?php if(strlen($godzina)) { ?>
                                                                <div class="col-md-2">
                                                                    <div class="single-hour standard-hour">

                                                                        <div class="hour">

                                                                            <span><?php echo $godzina; ?></span><span class="lower"><?php echo numerki($godzina, $godziny_odjazdu_powszednie, $godziny_odjazdu_d, $godziny_odjazdu_x, $godziny_odjazdu_w, $godziny_odjazdu_n, $godziny_odjazdu_s, $godziny_odjazdu_r, $godziny_odjazdu_euro); ?></span>
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
                                                            <div class="legend">
                                                            <span class="legend-name">
                                                                Legenda
                                                            </span>

                                                                <ul>
                                                                    <li class="standard-legend">
                                                                        D - kursuje od poniedziałku do piątku oprócz świąt.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        d – nie kursuje 01 I, w pierwszy i drugi dzień Świąt Wielkanocnych oraz w dniach 25 i 26 XII.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        x – nie kursuje 06 I i 11 XI.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        n – nie kursuje w Wielką Sobotę oraz w dniach 24 i 31 XII.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        S - kursuje w dni nauki szkolnej.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        r - nie kursuje w okresie ferii zimowych oraz szkolnych przerw świątecznych.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        € - nie kursuje w niedziele.
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        w - nie kursuje w Boże Ciało
                                                                    </li>
                                                                </ul>
                                                            </div>
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