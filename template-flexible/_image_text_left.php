<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'image_text_left'): ?>
    <section class="container py-5 ">
        <div class="row p-0 flex-column-reverse flex-lg-row"
            style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
            <div class="col-12 col-lg-6 p-0 ">
                <?php $img = get_sub_field('img'); ?>
                <?php $size = 'full'; ?>
                <?php if ($img): ?>
                    <div class="h-100">
                        <?php echo wp_get_attachment_image(
                            $img,
                            $size,
                            false,
                            array(
                                'class' => 'img-cover'
                            )
                        ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div
                class="col-12 col-lg-6 bg-primary text-light d-flex flex-column justify-content-center p-1 p-md-5 align-items-start">
                <div class="col-12 px-5">
                    <div class="text-center text-lg-start py-3">
                        <span>
                            <?php the_sub_field('header'); ?>
                        </span>
                    </div>
                    <h2 class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('title'); ?>
                    </h2>
                    <p class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('text'); ?>
                    </p>
                    <div class="py-2 d-flex justify-content-center justify-content-lg-start">
                        <?php $image_text_left_btn_url = get_sub_field('image_text_left_btn_url'); ?>
                        <?php if ($image_text_left_btn_url): ?>
                            <a class="btn btn-outline-secondary" title="<?php the_sub_field('image_text_left_btn_text'); ?>" href="<?php echo esc_url($image_text_left_btn_url); ?>"><?php the_sub_field('image_text_left_btn_text'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>