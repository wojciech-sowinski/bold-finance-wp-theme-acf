<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>

<?php if (get_row_layout() == 'tabs'): ?>
    <?php if (have_rows('tabs_tab')): ?>
        <?php

        $tabsRandomId = generateId();

        ?>
        <section <?= idTag(get_sub_field('tabs_anchor')); ?>>
            <div class="container">
                <div class="row">
                    <ul class="nav nav-tabs d-flex justify-content-center  mt-3 mb-5" id="nav-tabs-dot" role="tablist">
                        <?php while (have_rows('tabs_tab')):
                            the_row(); ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if (get_row_index() == 1):
                                    echo 'active';
                                endif ?>" id="<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <?php the_sub_field('tabs_tab_title'); ?>
                                </button>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="row">
                    <div class="tab-content" id="myTabContent">
                        <?php while (have_rows('tabs_tab')):
                            the_row(); ?>
                            <div class="tab-pane fade show <?php if (get_row_index() == 1):
                                echo 'active';
                            endif ?>" id="<?php echo $tabsRandomId ?>product<?php echo get_row_index(); ?>"
                                role="tabpanel">
                                <?php
                                if (the_flexible_field("elastic_sections")) {
                                    get_template_part('template-flexible/' . get_row_layout());
                                }
                                ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>