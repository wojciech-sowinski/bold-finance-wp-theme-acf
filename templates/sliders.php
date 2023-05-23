<?php




function slider($hasRows, $sliderHeadingTag, $sliderTextTag, $sliderImg, $textColor = "#000000", $type=1)
{

    $length = 10;
    $randomBytes = random_bytes($length);
    $randomId = '';

    for ($i = 0; $i < $length; $i++) {
        $randomId .= chr(ord('a') + (ord($randomBytes[$i]) % 26));
    }
    ;

    $id = $randomId;
    $idJson = json_encode($id);

    $typeClass = "p-0";

    if ($type = 2) {
        $typeClass = 'p-5';
    }
    ;


    ?>


    <section class="container-fluid ">
        <div class="splide" id=<?php echo $id; ?> class="<?php echo $typeClass; ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php if (have_rows($hasRows)): ?>
                        <?php while (have_rows($hasRows)):
                            ?>
                            <li class="splide__slide py-5">
                                <?php the_row(); ?>
                                <?php $slider_bg_img = get_sub_field($sliderImg); ?>
                                <?php if ($slider_bg_img): ?>
                                    <img src="<?php echo esc_url($slider_bg_img['url']); ?>"
                                        alt="<?php echo esc_attr($slider_bg_img['alt']); ?>" />
                                <?php endif; ?>
                                <div class="container py-5">
                                    <div class="row">
                                        <div class="col-12 col-md-6 py-10">
                                            <h1 class="slide-title py-2 py-md-5 text-center text-md-start"
                                                style="color:<?php the_sub_field('homepage_section_1_slide_text_color'); ?>">
                                                <?php the_sub_field($sliderHeadingTag); ?>
                                            </h1>
                                            <p class="slide-content text-center text-md-start"
                                                style="color:<?php the_sub_field('homepage_section_1_slide_text_color'); ?>">
                                                <?php the_sub_field($sliderTextTag); ?>
                                            </p>
                                            <div class="py-3">
                                                <?php
                                                btnTemplate('Więcej informacji', 'primary');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <?php
}