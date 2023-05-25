<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php
get_header();
?>

<section class="container pt-2 pb-2 ">
    <div class="row p-0 flex-column-reverse flex-lg-row-reverse"
        style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
        <div class="col-12 col-lg-6 p-0 bg-img-cover"
            style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>); padding:150px 0 !important;">
        </div>
        <div class="col-12 col-lg-6 bg-primary text-light d-flex flex-column justify-content-start align-items-start">
            <div class="col-12 p-1 px-md-5 py-md-4 ">
                <div>
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<p id="breadcrumbs "', '</p>');
                    }
                    ?>
                </div>
                <div>
                    <h1 class="py-2 text-center text-lg-start ">
                        <?php echo get_the_title(); ?>
                    </h1>
                    <p class="pt-2 pb-5 text-center text-lg-start ">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                </div>
                <div class="d-flex gap-5 align-items-center">
                    <a class="btn btn-secondary" href="#more">Czytaj Dalej</a>
                    <p>
                        <?php echo read_time_counter(); ?> minuty czytania.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container post-content" id="more">
        <?php
        the_content();
        ?>
        <?php
        while (the_flexible_field("elastic_sections")):
            get_template_part('template-flexible/' . get_row_layout());
        endwhile;
        ?>
        <div>
            <h2 class="fw-semibold">
                Tagi
            </h2>
            <div class="d-flex flex-row gap-3 py-2">
                <?php
                $tags = get_the_terms(get_the_ID(), 'post_tag');
                foreach ($tags as $tag) {
                    ?>
                    <a class="tag-cloud-link" href="<?php echo get_tag_link($tag->term_id); ?>">
                        <?= $tag->name ?>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>