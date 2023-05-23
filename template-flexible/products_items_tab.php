<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'products_items_tab'): ?>
    <?php
    $tabsRandomId = generateId();
    ?>
    <section class="py-5">
        <div class="container ">
            <div class="row">
                <h2 class="fw-semibold">
                    <?php the_sub_field('products_items_tabs_title'); ?>
                </h2>
                <p>
                    <?php the_sub_field('products_items_tabs_excerpt'); ?>
                </p>
            </div>
            <div class="row">
                <ul class="nav nav-tabs  mt-3 mb-5" id="nav-tabs-dot" role="tablist">
                    <?php if (have_rows('products_items_tabs_tab')): ?>
                        <?php while (have_rows('products_items_tabs_tab')):
                            the_row();
                            ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if (get_row_index() == 1):
                                    echo 'active';
                                endif ?>" id="<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>-tab" data-bs-toggle="tab"
                                    data-bs-target="#<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>" type="button" role="tab"
                                    aria-controls="home" aria-selected="true">
                                    <?php the_sub_field('products_items_tabs_tab_header'); ?>
                                </button>
                            </li>
                        <?php endwhile; ?>
                    <?php endif ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php if (have_rows('products_items_tabs_tab')): ?>
                        <?php while (have_rows('products_items_tabs_tab')):
                            the_row(); ?>
                            <div class="tab-pane fade show <?php if (get_row_index() == 1):
                                echo 'active';
                            endif ?>" id="<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>" role="tabpanel">
                                <div class="row d-flex flex-column flex-lg-row">
                                    <div class="col-12 col-lg-6" style="max-height:400px">
                                        <div>
                                            <?php $products_items_tabs_tab_card_img = get_sub_field('products_items_tabs_tab_card_img'); ?>
                                            <?php $size = 'full'; ?>
                                            <?php if ($products_items_tabs_tab_card_img): ?>
                                                <?php echo wp_get_attachment_image(
                                                    $products_items_tabs_tab_card_img,
                                                    $size,
                                                    false,
                                                    array(
                                                        'class' => 'img-cover',
                                                        'style' => 'max-height:400px;'
                                                    )
                                                ); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 d-flex flex-column p-0 px-lg-5 ">
                                        <h3 class="fw-semibold pb-2 pt-4  pt-lg-5 pb-lg-4 px-4">
                                            <?php the_sub_field('products_items_tabs_tab_card_title');
                                            ?>
                                        </h3>
                                        <p class="py-2 px-4 pt-lg-4 pb-lg-5">
                                            <?php the_sub_field('products_items_tabs_tab_card_content'); ?>
                                        </p>
                                        <div class="py-2 px-4 pt-lg-4 pb-lg-5">
                                            <?php if (have_rows('products_items_tabs_tab_card_button')): ?>
                                                <?php while (have_rows('products_items_tabs_tab_card_button')):
                                                    the_row(); ?>
                                                    <a title="<?php the_sub_field('products_items_tabs_tab_card_button_text'); ?>"
                                                        href="<?php the_sub_field('products_items_tabs_tab_card_button_url'); ?>"
                                                        class="btn btn-primary">
                                                        <?php the_sub_field('products_items_tabs_tab_card_button_text'); ?>
                                                    </a>
                                                <?php endwhile; ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>