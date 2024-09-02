<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Template Name: Opole - Karczmiska - Puławy
 */

?>

<?php
$rozklad_1 = cptr_populate(get_the_ID());
$rozklad_2 = cptr_populate(9139);

?>




<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="first-schedule single-schedule">
                        <div class="schedule-name">
                            Opole Lubelskie – Karczmiska – Kazimierz Dolny – Puławy
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_1 = 1;

                                foreach ($rozklad_1 as $przystanek) {
                                    $godziny_odjazdu_qr = get_post_meta($przystanek->ID, 'wpcf-opole-karczmiska-pulawy',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_qr);
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
                                                <?php foreach ($godziny_odjazdu_qr as $godzina) { ?>
                                                <?php $godzina = str_replace('_', '</span><span class="lower">', $godzina); ?>
                                                    <?php if(strlen($godzina)) { ?>
                                                        <div class="col-md-2">
                                                            <div class="single-hour standard-hour">
                                                                <div class="hour">
                                                                    <span class="godz"><?php echo $godzina; ?></span>
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
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                    <section class="second-schedule single-schedule">
                        <div class="schedule-name">
                            Puławy - Kazimierz Dolny - Karczmiska - Opole Lubelskie
                        </div>
                        <div class="row schedule-content">
                            <div class="col-md-12">
                                <?php
                                $godziny_odjazdu = array();
                                $count_rozklad_2 = 1;
                                foreach ($rozklad_2 as $przystanek) {
                                    $godziny_odjazdu_qr = get_post_meta($przystanek->ID, 'wpcf-pulawy-karczmiska-opole',false);
                                    $godziny_odjazdu = array_merge($godziny_odjazdu_qr);
                                    $godziny_odjazdu_unique = array_unique($godziny_odjazdu);

                                    $nazwa_przystanka = get_the_title($przystanek);

                                    usort($godziny_odjazdu_unique, function($a, $b) {
                                        return (strtotime($a) > strtotime($b));
                                    });
//                                    print_r($godziny_odjazdu_unique);
                                    $mapa = get_post_meta($przystanek->ID, 'wpcf-iframe-do-mapy', true);
                                    $foto = get_post_meta($przystanek->ID, 'wpcf-zdjecie-przystanka', true);
                                    ?>
                                <div class="single-przystanek">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="przystanek-name">
                                                <span class="counter">
                                                     <?php echo $count_rozklad_2++; ?>.
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
                                                <?php foreach ($godziny_odjazdu_qr as $godzina) { ?>
                                                <?php $godzina = str_replace('_', '</span><span class="lower">', $godzina); ?>
                                                    <?php if(strlen($godzina)) { ?>
                                                        <div class="col-md-2">
                                                            <div class="single-hour standard-hour">
                                                                <div class="hour">
                                                                    <span class="godz"><?php echo $godzina; ?></span>                                                                    
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
