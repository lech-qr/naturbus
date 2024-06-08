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

<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row rozklad_list">


                        <?php
                        $rozklady = get_posts(
                            array(
                                'posts_per_page'   => -1,
                                'orderby'          => 'menu_order',
                                'order'            => 'ASC',
                                'post_type'        => 'page',
                                'post_parent'      => get_the_ID(),
                        ));
                        foreach ($rozklady as $rozklad) {
                            $title = get_the_title($rozklad);
                            $img = get_the_post_thumbnail_url($rozklad);
                            $link = get_permalink($rozklad);

                            ?>
                            <div class="col-md-4">
                                <a href="<?php echo $link; ?>" class="single-rozklad" style="background-image: url('<?php echo $img; ?>');">
                                    <div class="single-rozklad-title">
                                        <?php echo $title; ?>
                                    </div>
                                </a>
                            </div>


                       <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>