<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'products_items_blocks_with_list_img'): ?>
    <section <?= idTag(get_sub_field('products_items_blocks_with_list_img_anchor')); ?> class="py-3">
        <div class="container ">
            <div class="row p-4 shadow" style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
                <div class="col-12 col-md-6">
                    <?php $products_items_blocks_with_list_img_products = get_sub_field('products_items_blocks_with_list_img_products'); ?>
                    <?php if ($products_items_blocks_with_list_img_products): ?>
                        <?php $post = $products_items_blocks_with_list_img_products; ?>
                        <?php setup_postdata($post); ?>
                        <h2 class="fw-semibold">
                            <?php the_title(); ?>
                        </h2>
                        <p>
                            <?php the_excerpt( ); ?>
                        </p>
                        <ul class="list-unstyled">
                            <?php if (have_rows('product_list_items')): ?>
                                <?php while (have_rows('product_list_items')):
                                    the_row(); ?>
                                    <li class=" p-2 d-flex align-items-center"><i class="icon-checked text-primary fs-2 py-2 px-3"></i>
                                        <?php the_sub_field('product_list_item'); ?>
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
                        <?php $products_items_blocks_with_list_img_products_img = get_sub_field('products_items_blocks_with_list_img_products_img'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($products_items_blocks_with_list_img_products_img): ?>
                            <?php echo wp_get_attachment_image($products_items_blocks_with_list_img_products_img, $size, false, array('class' => 'img-fluid')); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>