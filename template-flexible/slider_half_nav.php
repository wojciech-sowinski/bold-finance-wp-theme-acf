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
$slider_version = get_sub_field('slider_half_nav_slider_version');
?>
<?php if (get_row_layout() == 'slider_half_nav'): ?>
    <?php if (have_rows('slider_half_nav_slide')):
        $length = 10;
        $randomBytes = random_bytes($length);
        $randomId = '';
        for ($i = 0; $i < $length; $i++) {
            $randomId .= chr(ord('a') + (ord($randomBytes[$i]) % 26));
        }
        ;
        $id = $randomId;
        $idJson = json_encode($id);

        $titleArray = array();
        if (have_rows('slider_half_nav_slide')) {
            while (have_rows('slider_half_nav_slide')) {
                the_row();

                $titleArray[] = get_sub_field('slider_half_nav_title');
            }
        }
        ?>
        <section class="container-fluid p-0 gray-gradient">
            <div class="splide" id="<?= $id; ?>" class="p-0">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('slider_half_nav_slide')): ?>
                            <?php while (have_rows('slider_half_nav_slide')):
                                the_row(); ?>
                                <li class="splide__slide py-3">
                                    <div class="container h-100 d-flex flex-column justify-content-center py-5">
                                        <div class="row flex-column-reverse flex-lg-row">
                                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center">
                                                <h1 class="slide-title text-center text-lg-start"
                                                    style="color:<?php the_sub_field('slider_half_nav_text_color'); ?>">
                                                    <?php the_sub_field('slider_half_nav_title');
                                                    ?>
                                                </h1>
                                                <p class="slide-content  text-center text-lg-start "
                                                    style="color:<?php the_sub_field('slider_half_nav_text_color'); ?>">
                                                    <?php the_sub_field('slider_half_nav_text'); ?>
                                                </p>
                                                <div class="py-3 d-flex justify-content-center justify-content-lg-start">
                                                    <a class="btn btn-primary"
                                                        title="<?php the_sub_field('slider_half_nav_btn_text'); ?>"
                                                        href="<?php the_sub_field('slider_half_nav_btn_url'); ?>">
                                                        <?php the_sub_field('slider_half_nav_btn_text'); ?></a>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center slider-equal-img-col pb-5 p-lg-0">
                                                <?php $bg_img = get_sub_field('slider_half_nav_bg_img'); ?>
                                                <?php $size = 'full'; ?>
                                                <?php if ($bg_img): ?>
                                                    <?php echo wp_get_attachment_image($bg_img, $size, false, array('class' => "img-cover rounded rounded-4 border border-dark shadow-card")); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row gap-5 justify-content-center pt-5 pb-3 d-none d-lg-flex">
                                            <?php
                                            foreach ($titleArray as $key => $title) {
                                                ?>
                                                <div onclick="splideinstance.go(<?= $key; ?>)"
                                                    class="splide-nav-link flex-grow-1 text-center w-auto p-4 <?= ((get_row_index() - 1) == $key) ? 'active' : null; ?>  additional_text_carousel text-start navi-<?= $key + 1; ?>">
                                                    <span class="fw-bold">
                                                        <?= $title; ?>
                                                    </span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <script>
            let splideinstance;
            document.addEventListener('DOMContentLoaded', () => {
                const splideId = '#' + <?php echo $idJson; ?>;
                var splideasd = new Splide(splideId, {
                    type: 'fade',
                    arrows: true,
                    pagination: false,
                    perPage: 1,
                    cover: true,
                    rewind: true,
                });
                splideinstance = splideasd.mount();
            });
        </script>
    <?php endif; ?>
<?php endif; ?>