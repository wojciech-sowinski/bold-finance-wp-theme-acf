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
$slider_version = get_sub_field('slider_half_nav_bg_slider_version');

$isFirstSlider = false;
if (get_row_index() == 1) {
    $isFirstSlider = true;
}

?>
<?php if (get_row_layout() == 'slider_half_nav_bg'): ?>
    <?php if (have_rows('slider_half_nav_bg_slide')):
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
        if (have_rows('slider_half_nav_bg_slide')) {
            while (have_rows('slider_half_nav_bg_slide')) {
                the_row();
                $titleArray[] = get_sub_field('slider_half_nav_bg_title');
            }
        }
        ?>
        <section class="container-fluid p-0 gray-gradient">
            <?php
            $showBg = get_sub_field('slider_half_nav_bg_slider_version_bg_bool');
            ?>
            <div class="splide" id="<?= $id; ?>" class="p-0">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (have_rows('slider_half_nav_bg_slide')): ?>
                            <?php while (have_rows('slider_half_nav_bg_slide')):
                                the_row(); ?>
                                <?php
                                if ($showBg) {
                                    ?>
                                    <style>
                                        <?php
                                        if ($isFirstSlider) {
                                            ?>
                                            #<?= $id; ?> li.half-w-bg-<?= get_row_index() ?>{
                                                padding-top: 80px !important;
                                            }

                                            @media (min-width:768px) {
                                                #<?= $id; ?> li.half-w-bg-<?= get_row_index() ?>{
                                                    padding-top: 200px !important;
                                                }
                                            }
                                            <?php
                                        }
                                        ?>
                                        @media (min-width:992px) {
                                            #<?= $id; ?> li.half-w-bg-<?= get_row_index() ?>{
                                                background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.7),
                                                        rgba(255, 255, 255, 1)),
                                                    url('<?= wp_get_original_image_url(get_sub_field('slider_half_nav_bg_bg_img')); ?>');
                                                background-position: center;
                                                background-size: cover;
                                            }
                                    </style>
                                    <?php
                                }
                                ?>
                                <li class="splide__slide half-w-bg-<?= get_row_index() ?> pb-3">
                                    <div class="container h-100 d-flex flex-column justify-content-center py-0 py-lg-1">
                                        <div class="row flex-column-reverse flex-lg-row h-100">
                                            <div class="col-12 col-lg-6 d-flex flex-column justify-content-center">
                                                <h1 class="slide-title text-center text-lg-start fw-semibold"
                                                    style="color:<?php the_sub_field('slider_half_nav_bg_text_color'); ?>">
                                                    <?php the_sub_field('slider_half_nav_bg_title');
                                                    ?>
                                                </h1>
                                                <p class="slide-content  text-center text-lg-start "
                                                    style="color:<?php the_sub_field('slider_half_nav_bg_text_color'); ?>">
                                                    <?php the_sub_field('slider_half_nav_bg_text'); ?>
                                                </p>
                                                <div class="py-3 d-flex justify-content-center justify-content-lg-start">
                                                    <a class="btn btn-primary"
                                                        title="<?php the_sub_field('slider_half_nav_bg_btn_text'); ?>"
                                                        href="<?php the_sub_field('slider_half_nav_bg_btn_url'); ?>">
                                                        <?php the_sub_field('slider_half_nav_bg_btn_text'); ?></a>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 col-lg-6 d-flex flex-column justify-content-center slider-equal-img-col px-0 pb-5 p-lg-0 align-items-stretch flex-grow-1">
                                                <?php $bg_img = get_sub_field('slider_half_nav_bg_bg_img'); ?>
                                                <?php $size = 'full'; ?>
                                                <?php if ($bg_img): ?>
                                                    <?php echo wp_get_attachment_image($bg_img, $size, false, array('class' => "img-cover half-slider-img")); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row gap-3 justify-content-center px-2 pb-1 pt-3 pt-lg-5 pb-lg-0 d-flex">
                                            <?php
                                            foreach ($titleArray as $key => $title) {
                                                ?>
                                                <div onclick="splideBginstance.go(<?= $key; ?>)"
                                                    class="splide-nav-link flex-grow-1 text-center w-auto p-2 p-lg-4 <?= ((get_row_index() - 1) == $key) ? 'active' : null; ?>  additional_text_carousel text-start navi-<?= $key + 1; ?>">
                                                    <span class="fw-bold  d-none d-lg-block">
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
            let splideBginstance;
            document.addEventListener('DOMContentLoaded', () => {
                var splideId = '#' + <?php echo $idJson; ?>;
                var splide = new Splide(splideId, {
                    type: 'fade',
                    arrows: false,
                    pagination: false,
                    perPage: 1,
                    rewind: true,
                    speed: 2000
                });
                splideBginstance = splide.mount();
            });
        </script>
    <?php endif; ?>
<?php endif; ?>