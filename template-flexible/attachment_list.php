<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'attachment_list'): ?>
    <section class="attachments-list px-1 py-5 ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-9 col-lg-6 m-auto border border-primary border-4 border-top-0 border-bottom-0 border-end-0 shadow p-1 p-md-3">
                    <?php if (have_rows('attachment_list_item')): ?>
                        <?php while (have_rows('attachment_list_item')):
                            the_row(); ?>
                            <?php $attachment_list_item_url = get_sub_field('attachment_list_item_url'); ?>
                            <?php if ($attachment_list_item_url): ?>
                                <?php $post = $attachment_list_item_url; ?>
                                <?php setup_postdata($post); ?>
                                <a class="decoration-none text-dark" title="<?php the_sub_field('attachment_list_item_name'); ?>"
                                    href="<?php the_permalink(); ?>">
                                    <div class="d-flex align-content-center px-1  px-md-4 py-4 border-bottom border-1">
                                        <i class="icon-doc-paper fs-4 mx-3"></i>
                                        <?php the_sub_field('attachment_list_item_name'); ?>
                                    </div>
                                </a>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>