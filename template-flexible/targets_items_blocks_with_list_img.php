<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'targets_items_blocks_with_list_img'): ?>
    <section <?= idTag(get_sub_field('targets_items_blocks_with_list_img_anchor')); ?> class="py-4">
        <div class="container ">
            <div class="row p-1 p-md-5 shadow"
                style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
                <div class="col-12 col-md-6">
                    <?php $targets_items_blocks_with_list_img_targets = get_sub_field('targets_items_blocks_with_list_img_target'); ?>
                    <?php if ($targets_items_blocks_with_list_img_targets): ?>
                        <?php $post = $targets_items_blocks_with_list_img_targets; ?>
                        <?php setup_postdata($post);
                        ?>
                        <h2 class="fw-semibold">
                            <?php the_title(); ?>
                        </h2>
                        <p>
                            <?php the_excerpt(); ?>
                        </p>
                        <ul class="list-unstyled">
                            <?php if (have_rows('target_list_items')): ?>
                                <?php while (have_rows('target_list_items')):
                                    the_row(); ?>
                                    <li class=" p-2 d-flex align-items-center"><i class="icon-checked text-primary fs-2 py-2 px-3"></i>
                                        <?php the_sub_field('target_list_item'); ?>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="py-3">
                            <a title="check offer" class="btn btn-primary btn-sm" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-6 p-5 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-center">
                        <?php $targets_items_blocks_with_list_img_products_img = get_sub_field('targets_items_blocks_with_list_img_products_img'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($targets_items_blocks_with_list_img_products_img): ?>
                            <?php echo wp_get_attachment_image($targets_items_blocks_with_list_img_products_img, $size, false, array('class' => 'img-fluid')); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>