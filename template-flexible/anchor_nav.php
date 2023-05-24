<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>

<?php if (get_row_layout() == 'anchor_nav'): ?>
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs d-flex justify-content-center  mt-3 mb-5" id="nav-tabs-dot" role="tablist">
                    <?php if (have_rows('anchor_nav_link')): ?>
                        <?php while (have_rows('anchor_nav_link')):
                            the_row(); ?>
                            <li class="nav-item" role="presentation">
                                <a href="#<?php the_sub_field('anchor_nav_anchor'); ?>" class="nav-link <?php if (get_row_index() == 1):
                                      echo 'active';
                                  endif ?>">
                                    <?php the_sub_field('anchor_nav_link_title'); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>