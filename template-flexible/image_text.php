<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'image_text'): ?>


    <?php

    $colorTheme = get_sub_field('image_text_left_btn_text_theme_selector');
    $bgClass = '';
    $textClass = '';

    if ($colorTheme == 0) {
        $bgClass = 'primary';
        $textClass = 'white';
    } elseif ($colorTheme == 1) {
        $bgClass = "white";
        $textClass = 'dark';
    }

    $imgPosition = get_sub_field('image_text_left_img_position');
    $imgPositionClass = '';
    if ($imgPosition == 0) {

    } elseif ($imgPosition == 1) {
        $imgPositionClass = '-reverse';
    }?>

    <section class="container py-5" <?= idTag(get_sub_field( 'image_text_anchor' )) ?> >
        <div class="row p-0 flex-column-reverse flex-lg-row<?php echo $imgPositionClass ?>"
            style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
            <div class="col-12 col-lg-6 p-0 ">
                <?php $img = get_sub_field('image_text_img'); ?>
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
                class="col-12 col-lg-6 bg-<?php echo $bgClass ?> text-<?php echo $textClass ?> d-flex flex-column justify-content-center p-1 p-md-5 align-items-start">
                <div class="col-12 px-5">
                    <div class="text-center text-lg-start py-3">
                        <span>
                            <?php the_sub_field('image_text_header'); ?>
                        </span>
                    </div>
                    <h2 class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('image_text_title'); ?>
                    </h2>
                    <p class="py-2 text-center text-lg-start ">
                        <?php the_sub_field('image_text_text'); ?>
                    </p>
                    <div class="py-2 d-flex justify-content-center justify-content-lg-start">
                        <?php if (have_rows('image_text_btns')):
                            while (have_rows('image_text_btns')):
                                the_row(); ?>
                                <?php $image_text_btn_url = get_sub_field('image_text_btn_url'); ?>
                                <?php if ($image_text_btn_url): ?>
                                    <?php $post = $image_text_btn_url; ?>
                                    <?php setup_postdata($post); ?>
                                    <?php

                                    $btnTheme = get_sub_field('image_text_btn_theme');
                                    $btnClass = 'primary';

                                    if ($btnTheme == 0) {
                                        if ($colorTheme == 0) {
                                            $btnClass = 'secondary';
                                        } elseif ($colorTheme == 1) {
                                            $btnClass = 'primary';
                                        }
                                    } elseif ($btnTheme == 1) {
                                        if ($colorTheme == 0) {
                                            $btnClass = 'outline-secondary';
                                        } elseif ($colorTheme == 1) {
                                            $btnClass = 'outline';
                                        }
                                    }
                                    ?>
                                    <a title="<?php the_sub_field('image_text_btn_text'); ?>" class="btn btn-<?php echo $btnClass ?>"
                                        href="<?php the_permalink(); ?>"><?php the_sub_field('image_text_btn_text'); ?></a>

                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>