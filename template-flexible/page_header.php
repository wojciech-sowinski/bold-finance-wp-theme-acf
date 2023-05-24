<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>

<?php if (get_row_layout() == 'page_header'): ?>
    <section class="container pt-1 pb-4 ">
        <div class="row flex-column-reverse flex-lg-row-reverse"
            style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
            <?php if ( get_sub_field( 'page_header_img' ) ) : ?>
            <div class="col-12 col-lg-6 p-0 bg-img-cover" style="background-image:url(<?php the_sub_field( 'page_header_img' ); ?>); padding:150px 0 !important;">
			<?php endif ?>
            </div>
            <div
                class="col-12 col-lg-6 bg-primary text-light d-flex flex-column justify-content-start align-items-start">
                <div class="col-12 px-5 py-5 ">
                    <div>
                        <?php if (get_sub_field('page_header_breadcrumbs_bool') == 1): ?>
                            <?php
                            if (function_exists('yoast_breadcrumb')) {
                                yoast_breadcrumb('<p id="breadcrumbs "', '</p>');
                            }
                            ?>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h1 class="py-2 text-center text-lg-start ">
                            <?php the_sub_field('page_header_title'); ?>
                        </h1>
                        <p class="py-2 text-center text-lg-start ">
                            <?php the_sub_field('page_header_text'); ?>
                        </p>
                        <div class="py-2 d-flex flex-column flex-md-row justify-content-center justify-content-lg-start align-items-center  gap-5">
                            <?php if (have_rows('page_header_btn')): ?>
                                <?php while (have_rows('page_header_btn')):
                                    the_row(); ?>
                                    <?php $page_header_btn_url = get_sub_field('page_header_btn_url'); ?>
                                    <?php if ($page_header_btn_url): ?>
                                        <?php $post = $page_header_btn_url; ?>
                                        <?php setup_postdata($post); ?>
                                        <div>
                                            <a title="<?php the_sub_field('page_header_btn_text'); ?>" class="btn btn-secondary"
                                                href="<?php the_permalink(); ?>"><?php the_sub_field('page_header_btn_text'); ?></a>
                                        </div>
                                        <?php wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                            <?php if (have_rows('page_header_additional_link')): ?>
                                <?php while (have_rows('page_header_additional_link')):
                                    the_row(); ?>
                                    <?php $page_header_additional_link_url = get_sub_field('page_header_additional_link_url'); ?>
                                    <?php if ($page_header_additional_link_url): ?>
                                        <div>
                                            <a class="text-white text-decoration-underline"
                                                title="<?php the_sub_field('page_header_additional_link_text'); ?>"
                                                href="<?php echo esc_url($page_header_additional_link_url); ?>"><?php the_sub_field('page_header_additional_link_text'); ?></a>
                                        </div>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php endif; ?>