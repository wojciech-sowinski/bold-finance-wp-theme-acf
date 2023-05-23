<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'products_items_blocks_with_list'): ?>
    <section>
        <div class="container">
            <div class="row">
                <?php $produktyproducts_items_blocks_with_list_products = get_sub_field('products_items_blocks_with_list_products'); ?>
                <?php if ($produktyproducts_items_blocks_with_list_products): ?>
                    <?php foreach ($produktyproducts_items_blocks_with_list_products as $post): ?>
                        <?php setup_postdata($post); ?>
                        <div class="col-12 col-lg-6 p-3">
                            <div class="content shadow px-5 py-5">
                                <h2 class="fw-semibold">
                                    <?php the_field('product_name'); ?>
                                </h2>
                                <p >
                                    <?php the_field( 'product_excerpt' ); ?>
                                </p>
                                <?php if (have_rows('product_list_items')): ?>
                                    <ul class="list-unstyled">
                                    <?php while (have_rows('product_list_items')):
                                        the_row(); ?>
                                       <li class=" p-2 d-flex align-items-center"><i
                                                class="icon-checked text-primary fs-2 py-3 px-5"></i>
                                            <?php the_sub_field('product_list_item'); ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="py-3">
                                    <a class="btn btn-primary btn-sm" title="Read more" href="<?php the_permalink(); ?>">Sprawdź</a>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>