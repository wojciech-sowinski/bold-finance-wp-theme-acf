<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'image_text_right_icon'): ?>
    <section class="container py-4 ">
        <div class="row  flex-column-reverse flex-lg-row-reverse"
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
                    <h2 class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('title'); ?>
                    </h2>
                    <p class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('text_1'); ?>
                    </p>
                    <div class="d-flex py-3 gap-5 justify-content-center justify-content-lg-start">
                        <?php if (have_rows('icons')): ?>
                            <?php while (have_rows('icons')):
                                the_row(); ?>
                                <?php $icon_img = get_sub_field('icon_img'); ?>
                                <?php $size = 'icon'; ?>
                                <?php if ($icon_img): ?>
                                    <div>
                                    <?php echo wp_get_attachment_image($icon_img, $size,false ,array(
                                'class' => 'img-fluid',
                                'style' => 'max-height:40px; max-width:40px;'
                            )); ?></div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif ?>
                    </div>
                    <p class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('text_2'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>