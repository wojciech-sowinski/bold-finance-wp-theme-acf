<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'text_list_img'):
    $listStyle = get_sub_field('text_list_style');
    ?>
    <section class="py-5" <?= idTag(get_sub_field('text_list_img_anchor')); ?>>
        <div class="container">
            <div class="row">
                <div class="col-12 py-3 col-lg-6">
                    <h3 class="fw-bold py-3">
                        <?php the_sub_field('text_list_img_title'); ?>
                    </h3>
                    <p class=" py-3">
                        <?php the_sub_field('text_list_img_text'); ?>
                    </p>
                    <ul class="list-group list-unstyled">
                        <?php if (have_rows('text_list_img_list')): ?>
                            <?php while (have_rows('text_list_img_list')):
                                the_row(); ?>
                                <?php
                                $isLink = get_sub_field('text_list_img_list_item_link_bool')
                                    ?>
                                <?php if ($isLink) {
                                    $text_list_img_list_item_url = get_sub_field('text_list_img_list_item_url');
                                    if ($text_list_img_list_item_url):
                                        $post = $text_list_img_list_item_url;
                                        setup_postdata($post);
                                        wp_reset_postdata();
                                        echo '<a href="' . esc_url(get_the_permalink()) . '">';
                                    endif;
                                }
                                ; ?>
                                <li class=" p-2 ps-0 d-flex align-items-center <?php if ($isLink) {
                                    echo 'text-primary';
                                }
                                ?>">
                                    <?php
                                    if ($listStyle == 0) {
                                        ?>
                                        <span class="number-counter border border-1 rounded-circle fs-4 me-4 <?php if ($isLink) {
                                            echo 'border-primary';
                                        } else {
                                            echo 'border-dark';
                                        }
                                        ; ?>"><?php echo get_row_index() ?></span>
                                        <?php the_sub_field('text_list_img_list_item_name');
                                    } elseif ($listStyle == 1) { ?>
                                        <i class="icon-checked text-primary fs-2 py-1 px-5"></i>
                                        <?php the_sub_field('text_list_img_list_item_name');
                                    }
                                    ?>
                                </li>
                                <?php if ($isLink) {
                                    echo '</a>';
                                }
                                ; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-12 py-3 col-lg-6 position-relative">
                    <div class="position-absolute top-0 start-0">
                        <?php if (get_sub_field('text_list_img_show_attachment') == 1): ?>
                            <?php $text_list_img_attachment_url = get_sub_field('text_list_img_attachment_url'); ?>
                            <?php if ($text_list_img_attachment_url): ?>
                                <?php $post = $text_list_img_attachment_url; ?>
                                <?php setup_postdata($post); ?>
                                <a class="p-3 bg-light shadow rounded-3 d-inline-block position-absolute top-0 start-0"
                                    href="<?php the_permalink(); ?>">
                                    <i class="icon-doc-paper text-primary" style="font-size:70px"></i>
                                </a>
                                <?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="p-5">
                        <?php $text_list_img_img = get_sub_field('text_list_img_img'); ?>
                        <?php $size = 'full'; ?>
                        <?php if ($text_list_img_img): ?>
                            <?php echo wp_get_attachment_image($text_list_img_img, $size, false, array('class' => 'img-cover rounded-3')); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>