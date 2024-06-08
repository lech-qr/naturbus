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
//    $rozklad_1 = get_posts(array(
//        'post_type' => 'przystanek',
//        'post_status'=> 'publish',
//        'tax_query' => array(
//            array(
//                'taxonomy' => 'linia',
//                'field' => 'slug',
//                'terms' => 'opole-warszawa'
//            )
//        ),
//        'posts_per_page' => -1,
//        'orderby' => 'menu_order',
//        'order' => 'DESC',
//    ));
    $rozklad_1 = cptr_populate(get_the_ID());
    $rozklad_2 = cptr_populate(8413);

?>




<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <section class="first-schedule single-schedule">
                        <div class="schedule-name">
                            Opole Lubelskie – Nałęczów – Puławy – Dęblin - Warszawa
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <div style="display:none;">
                                    <?php
                                        echo "<br>".get_the_ID();
                                        echo "<pre>".print_r($rozklad_1,1)."</pre>";
                                    ?>
                                </div>
                                <?php
                                    $godziny_odjazdu = array();
                                    $count_rozklad_1 = 1;
                                    
                                    
                                    foreach ($rozklad_1 as $przystanek) {
                                        $godziny_odjazdu_powszednie = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-odjazdu-w-dni-powszednie',false);
                                        $godziny_odjazdu_sobota = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-odjazdu-sobota',false);                                        
                                        $godziny_odjazdu_pozostale = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-odjazdu-pozostale',false);
                                        $godziny_odjazdu = array_merge($godziny_odjazdu_powszednie, $godziny_odjazdu_sobota, $godziny_odjazdu_pozostale);
                                        $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                        $nazwa_przystanka = get_the_title($przystanek);

                                        $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                        $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
//                                        print_r($godziny_odjazdu);
                                        ?>
<!--                                        --><?php //if (!$godziny_odjazdu[0] == '' && !$godziny_odjazdu[1] == ''): ?>
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

                                                            <?php foreach ($godziny_odjazdu as $godzina) {
                                                                if (in_array($godzina, $godziny_odjazdu_pozostale)) { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour non-standard-hour">
                                                                            <div class="hour">

                                                                                <span><?php echo $godzina; ?></span><span class="lower">a, m, +, 5, 7</span>
                                                                            </div>
                                                                            <div class="desc">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } elseif (in_array($godzina, $godziny_odjazdu_sobota)) { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour standard-hour">
                                                                            <div class="hour">
                                                                                <span><?php echo $godzina; ?></span><span class="lower">6</span>
                                                                            </div>
                                                                            <div class="desc">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour standard-hour">
                                                                            <div class="hour">
                                                                                <span><?php echo $godzina; ?></span><span class="lower">1, 5</span>
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
                                                                            D - kursuje od poniedziałku do piątku w dni robocze
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            1 - kursuje w poniedziałki
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            5 - kursuje w piątki
                                                                        </li>
                                                                        <li class="standard-legend">
                                                                            6 - kursuje w soboty
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            7 - kursuje w niedziele
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            a – nie kursuje w pierwszy dzień Świąt Wielkanocnych oraz w dniu 25 XII
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            m – nie kursuje w dniach 24 i 31 XII
                                                                        </li>
                                                                        <li class="non-standard-legend">
                                                                            + - kursuje w dni wolne od pracy (niedziele i święta) oraz w dniu poprzedzającym długi weekend
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
<!--                                        --><?php //endif; ?>
                                       <?php } ?>

                            </div>
                        </div>
                    </section>
                    <section class="second-schedule single-schedule">
                        <div class="schedule-name">
                            Warszawa - Dęblin - Puławy - Nałęczów - Opole Lubelskie
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;
                                foreach ($rozklad_2 as $przystanek) {
                                    $godziny_odjazdu_powszednie = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-przyjazdu-w-dni-powszednie',false);
                                    $godziny_odjazdu_sobota = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-przyjazdu-sobota',false);
                                    $godziny_odjazdu_pozostale = get_post_meta($przystanek->ID, 'wpcf-opole-warszawa-godziny-przyjazdu-pozostale',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_powszednie, $godziny_odjazdu_sobota, $godziny_odjazdu_pozostale);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
                                    ?>
                                    <?php if (!$godziny_odjazdu[0] == '' && !$godziny_odjazdu[1] == ''): ?>
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

                                                        <?php foreach ($godziny_odjazdu as $godzina) {
                                                                if (in_array($godzina, $godziny_odjazdu_pozostale)) { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour non-standard-hour">
                                                                            <div class="hour">

                                                                                <span><?php echo $godzina; ?></span><span class="lower">a, m, +, 5, 7</span>
                                                                            </div>
                                                                            <div class="desc">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } elseif (in_array($godzina, $godziny_odjazdu_sobota)) { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour standard-hour">
                                                                            <div class="hour">
                                                                                <span><?php echo $godzina; ?></span><span class="lower">6</span>
                                                                            </div>
                                                                            <div class="desc">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="col-md-2">
                                                                        <div class="single-hour standard-hour">
                                                                            <div class="hour">
                                                                                <span><?php echo $godzina; ?></span><span class="lower">1, 5</span>
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
                                                                        D - kursuje od poniedziałku do piątku w dni robocze
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        1 - kursuje w poniedziałki
                                                                    </li>                                                                    
                                                                    <li class="non-standard-legend">
                                                                        5 - kursuje w piątki
                                                                    </li>
                                                                    <li class="standard-legend">
                                                                        6 - kursuje w soboty
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        7 - kursuje w niedziele
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        a – nie kursuje w pierwszy dzień Świąt Wielkanocnych oraz w dniu 25 XII
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        m – nie kursuje w dniach 24 i 31 XII
                                                                    </li>
                                                                    <li class="non-standard-legend">
                                                                        + - kursuje w dni wolne od pracy (niedziele i święta) oraz w dniu poprzedzającym długi weekend
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
                                    <?php endif; ?>
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