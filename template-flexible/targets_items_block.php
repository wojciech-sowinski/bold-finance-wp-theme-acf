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
if (get_row_layout() == 'targets_items_block'): ?>
    <?php

    $splideId = generateId();
    $splideIdJson = json_encode($splideId);

    $sectionThemeClass = '';
    $targets_items_block_theme = get_sub_field('targets_items_block_theme');

    if ($targets_items_block_theme == 0):
        $sectionBgThemeClass = 'bg-white';
        $sectionTextThemeClass = 'text-dark';
    elseif ($targets_items_block_theme == 1):
        $sectionBgThemeClass = 'bg-primary';
        $sectionTextThemeClass = 'text-light';
    endif
    ?>
    <section class="targets-carousel py-4 <?php echo $sectionBgThemeClass; ?>"
        <?= idTag(get_sub_field('targets_items_block_anchor')); ?>>
        <div class="container ">
            <?php
            if (get_sub_field('targets_title') || get_sub_field('targets_excerpt')) {
                ?>
                <div class="row py-2">
                    <?php
                    if (get_sub_field('targets_title')) {
                        ?>
                        <h2 class='fw-semibold <?php echo $sectionTextThemeClass; ?>'>
                            <?php the_sub_field('targets_title'); ?>
                        </h2>
                        <?php
                    }
                    if (get_sub_field('targets_excerpt')) {
                        ?>
                        <p class=" <?php echo $sectionTextThemeClass; ?>">
                            <?php the_sub_field('targets_excerpt'); ?>
                        </p>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <div id="<?php echo $splideId; ?>" class="row splide">
                <?php $colClass = (count(get_row('targets')) == 2) ? 6 : 3; ?>
                <?php if (have_rows('targets')): ?>
                    <div class="splide__track py-4">
                        <ul class="splide__list">
                            <?php while (have_rows('targets')):
                                the_row(); ?>
                                <?php $target = get_sub_field('target'); ?>
                                <?php if ($target): ?>
                                    <?php foreach ($target as $post): ?>
                                        <?php setup_postdata($post); ?>
                                        <li class="bg-white splide__slide col-12 col-lg-6 col-xl-<?php echo $colClass ?> shadow">
                                            <div class="product-card-content h-100 ">
                                                <div class="product-card-autoheight">
                                                    <div class="p-4 ">
                                                        <?php $target_icon_img = get_field('target_icon_img'); ?>
                                                        <?php $size = 'full';
                                                        if ($target_icon_img) {
                                                            echo wp_get_attachment_image($target_icon_img, $size, false, ['class' => 'img-contain']);
                                                        } else {
                                                            the_post_thumbnail('medium_large', array('class' => 'img-cover'));
                                                        }
                                                        ?>
                                                    </div>
                                                    <h3 class="px-4 pb-4 fw-semibold">
                                                        <?php the_title(); ?>
                                                    </h3>
                                                    <p class="px-4 pb-4">
                                                        <?php echo wp_trim_words(get_the_excerpt(), 20, '') ?>
                                                    </p>
                                                </div>
                                                <div class="px-4 pb-4">
                                                    <a class="btn btn-primary btn-sm" title="check offer"
                                                        href="<?php the_permalink(); ?>">Sprawdź</a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        splideId = '#' + <?php echo $splideIdJson; ?>;
        const partnerCarousel = new Splide(splideId, {
            type: 'loop',
            drag: 'free',
            perPage: 4,
            gap: 20,
            pagination: false,
            arrows: false,
            breakpoints: {
                1200: {
                    perPage: 3,
                },
                990: {
                    perPage: 2,
                },
                450: {
                    perPage: 1,
                },
            }
        });
        partnerCarousel.mount();

    })

</script>