<?php
/**
 */
if ( have_posts() ) :
?>
<div id="tags" class="row">
    <div class="col-12 col-lg-10 offset-lg-1 d-flex">
        <?php
        while ( have_posts() ) :
            the_post();
            /**
             * Include the Post-Format-specific template for the content.
             * If you want to overload this in a child theme then include a file
             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
             */
            // get_template_part( 'content', 'index' ); // Post format: content-index.php
        endwhile;
    ?>
    </div>
</div>
<?php
endif;
wp_reset_postdata();