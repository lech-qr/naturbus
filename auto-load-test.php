<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Template Name: Auto Load
 */


if ( isset( $_REQUEST['seller_auto_upload_nonce'] ) && wp_verify_nonce( $_REQUEST['seller_auto_upload_nonce'], 'seller_auto_upload' ) ){

    print_r($_FILES);
}

?>

<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">

                    <form enctype="multipart/form-data" method="post" action="">

                    <div class="pixad-form-horizontal">

                        <div class="pixad-form-group">
                            <label class="col-lg-2 pixad-control-label">
                                <?php _e( 'Main photo', 'autozone' ); ?> <span class="required-field">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="file" name="auto-image" id="auto-image">
                            </div>
                        </div>

                        <?php wp_nonce_field( 'seller_auto_upload', 'seller_auto_upload_nonce' ); ?>

                        <div class="pixad-form-group">
                            <label class="col-lg-2 pixad-control-label">
                            </label>
                            <div class="col-lg-9">
                                <input type="submit" name="submit" value="Upload Auto">
                            </div>
                        </div>


                    </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>