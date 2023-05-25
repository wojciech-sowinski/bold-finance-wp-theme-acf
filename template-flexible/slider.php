<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php
$slider_version = get_sub_field('slider_version');
?>
<?php if (get_row_layout() == 'slider'): ?>
    <?php if (have_rows('slide')):
        $length = 10;
        $randomBytes = random_bytes($length);
        $randomId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomId .= chr(ord('a') + (ord($randomBytes[$i]) % 26));
        };
        $id = $randomId;
        $idJson = json_encode($id);
        ?>
        <section class="container-fluid p-0">
            <div class="splide" id=<?php echo $id; ?> class="p-0">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('slide')): ?>
                            <?php while (have_rows('slide')):
                                the_row(); ?>
                                <li class="splide__slide py-2 py-md-5">
                                    <div class="container py-5 h-100 d-flex flex-column justify-content-center">
                                        <div class="row">
                                            <div class="col-12 col-lg-6 py-2 py-md-5">
                                                <h1 class="slide-title text-center text-lg-start py-3"
                                                    style="color:<?php the_sub_field('text_color'); ?>">
                                                    <?php the_sub_field('title');
                                                    ?>
                                                </h1>
                                                <p class="slide-content  text-center text-lg-start "
                                                    style="color:<?php the_sub_field('text_color'); ?>">
                                                    <?php the_sub_field('text'); ?>
                                                </p>
                                                <div class="py-3 d-flex justify-content-center justify-content-lg-start">
                                                    <a class="btn btn-primary" title="<?php the_sub_field('btn_text'); ?>"
                                                        href="<?php the_sub_field('btn_url'); ?>">
                                                        <?php the_sub_field('btn_text'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $bg_img = get_sub_field('bg_img'); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ($bg_img): ?>
                                        <?php echo wp_get_attachment_image($bg_img, $size); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const splideId = '#' + <?php echo $idJson; ?>;
                    const splide = new Splide(splideId, {
                        type: 'fade',
                        arrows: false,
                        pagination: false,
                        perPage: 1,
                        cover: true,
                        rewind: true,
                    });
                    splide.mount();
                });
            </script>
        </section>
    <?php endif; ?>
<?php endif; ?>