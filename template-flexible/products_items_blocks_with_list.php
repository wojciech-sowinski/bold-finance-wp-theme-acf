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
    <section <?= idTag(get_sub_field('products_items_blocks_with_list_anchor')) ?> class="py-4 products_items_blocks_with_list">
        <div class="container">
            <?php
            if (get_sub_field('products_items_blocks_with_list_title') || get_sub_field('products_items_blocks_with_list_excerpt')) {
                ?>
                <div class="row">
                    <h2 class="fw-semibold">
                        <?php the_sub_field('products_items_blocks_with_list_title'); ?>
                    </h2>
                    <p>
                        <?php the_sub_field('products_items_blocks_with_list_excerpt'); ?>
                    </p>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <?php $produktyproducts_items_blocks_with_list_products = get_sub_field('products_items_blocks_with_list_products'); ?>
                <?php if ($produktyproducts_items_blocks_with_list_products): ?>
                    <?php foreach ($produktyproducts_items_blocks_with_list_products as $post): ?>
                        <?php setup_postdata($post); ?>
                        <div class="col-12 col-lg-6 p-3">
                            <div class="content shadow px-3 py-4 px-md-5 py-md-5">
                                <h2 class="fw-semibold">
                                    <?php the_title() ?>
                                </h2>
                                <p>
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '') ?>
                                </p>
                                <?php if (have_rows('product_list_items')): ?>
                                    <ul class="list-unstyled py-2">
                                        <?php while (have_rows('product_list_items')):
                                            the_row(); ?>
                                            <li class=" p-2 d-flex align-items-center"><i
                                                    class="icon-checked text-primary fs-2 px-3 py-1 py-md-3 px-md-5"></i>
                                                <?php the_sub_field('product_list_item'); ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="py-3 d-flex justify-content-center justify-content-lg-start">
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