<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'partners_carousel'): ?>
    <section class="partners-carousel py-4" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 col-xl-2 d-flex flex-column justify-content-center px-3">
                    <span>
                        <?php the_sub_field('partners_carousel_text'); ?>
                    </span>
                </div>
                <div class="col-12 col-md-9 col-xl-10">
                    <section class="splide py-0">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php if (have_rows('partner')): ?>
                                    <?php while (have_rows('partner')):
                                        the_row(); ?>
                                        <?php $partner_img = get_sub_field('partner_img'); ?>
                                        <?php $size = 'full'; ?>
                                        <?php if ($partner_img): ?>
                                            <li class="splide__slide d-flex flex-column justify-content-center">
                                                <?php echo wp_get_attachment_image($partner_img, $size); ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const partnerCarousel = new Splide('.partners-carousel .splide', {
                type: 'loop',
                drag: 'free',
                focus: 'center',
                perPage: 4,
                pagination: false,
                arrows: false,
                autoScroll: {
                    speed: 0,
                    pauseOnHover: false,
                    pauseOnFocus: false,
                },
                breakpoints: {
                    1000: {
                        perPage: 3,
                    },
                    576: {
                        perPage: 1,
                    },
                }
            });
            partnerCarousel.mount(window.splide.Extensions);
        })
    </script>
<?php endif; ?>