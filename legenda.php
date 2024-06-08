<div class="col-md-12">
    <div class="legend">
        <div class="col-md-12">
            <span class="legend-name">
                Legenda:
            </span>
                <?php
                $id = 9060;
                $p = get_page($id);
                echo apply_filters('the_content', $p->post_content);
            ?>
        </div>
</div>