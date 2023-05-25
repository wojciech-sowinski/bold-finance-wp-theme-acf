<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'targets_items_blocks_with_list'): ?>
    <section <?= idTag(get_sub_field('targets_items_blocks_with_list_anchor')) ?> class="py-4 targets-block-list targets_items_blocks_with_list">
        <div class="container">
            <?php
            if (get_sub_field('targets_items_blocks_with_list_title') || get_sub_field('targets_items_blocks_with_list_excerpt')) {
                ?>
                <div class="row">
                    <?php
                    if (get_sub_field('targets_items_blocks_with_list_title')) {
                        ?>
                        <h2 class="fw-semibold">
                            <?php the_sub_field('targets_items_blocks_with_list_title'); ?>
                        </h2>
                        <?php
                    }
                    if (get_sub_field('targets_items_blocks_with_list_excerpt')) {
                        ?>
                        <p>
                            <?php the_sub_field('targets_items_blocks_with_list_excerpt'); ?>
                        </p>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="row">
                <?php $targets_items_blocks_with_list_targets = get_sub_field('targets_items_blocks_with_list_targets'); ?>
                <?php if ($targets_items_blocks_with_list_targets): ?>
                    <?php foreach ($targets_items_blocks_with_list_targets as $post): ?>
                        <?php setup_postdata($post); ?>
                        <div class="col-12 col-lg-6 p-3">
                            <div class="content shadow px-3 py-4 px-md-5 py-md-5">
                                <h2 class="fw-semibold">
                                    <?php the_title() ?>
                                </h2>
                                <p>
                                    <?php echo wp_trim_words(get_the_excerpt(), 20, '') ?>
                                </p>
                                <?php if (have_rows('target_list_items')): ?>
                                    <ul class="list-unstyled py-2">
                                        <?php while (have_rows('target_list_items')):
                                            the_row(); ?>
                                            <li class=" p-2 d-flex align-items-center"><i
                                                    class="icon-checked text-primary fs-2 px-3 py-1 py-md-3 px-md-5"></i>
                                                <?php the_sub_field('target_list_item'); ?>
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