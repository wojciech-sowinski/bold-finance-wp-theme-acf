<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'products_items_blocks_with_list_bg_img'): ?>
    <section class="p-4" <?= idTag(get_sub_field('products_items_blocks_with_list_bg_img_anchor')); ?>>
        <div class="container " style= "">
            <div class="row p-4 shadow" style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 ); background-image:url(<?php the_sub_field( 'products_items_blocks_with_list_bg_img_products_img' ); ?>); background-size:contain; background-position:right; background-repeat:no-repeat;">
                <div class="col-12 col-md-6">
                    <?php $products_items_blocks_with_list_bg_img_products = get_sub_field('products_items_blocks_with_list_bg_img_products'); ?>
                    <?php if ($products_items_blocks_with_list_bg_img_products): ?>
                        <?php $post = $products_items_blocks_with_list_bg_img_products; ?>
                        <?php setup_postdata($post); ?>
                        <h2 class="fw-semibold">
                            <?php the_title(); ?>
                        </h2>
                        <p>
                            <?php echo wp_trim_words( get_the_excerpt(), 20, '' ); ?>
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
            </div>
        </div>
    </section>
<?php endif; ?>