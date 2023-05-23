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
if (get_row_layout() == 'products_items_block'): ?>
    <?php

    $splideId = generateId();
    $splideIdJson = json_encode($splideId);


    $sectionThemeClass = '';
    $products_items_block_theme = get_sub_field('products_items_block_theme');

    if ($products_items_block_theme == 0):
        $sectionBgThemeClass = 'bg-white';
        $sectionTextThemeClass = 'text-dark';
    elseif ($products_items_block_theme == 1):
        $sectionBgThemeClass = 'bg-primary';
        $sectionTextThemeClass = 'text-light';
    endif

    ?>
    <section class="products-carousel <?php echo $sectionBgThemeClass; ?>">
        <div class="container py-5">
            <div class="row py-2">
                <h2 class='fw-semibold <?php echo $sectionTextThemeClass; ?>'>
                    <?php the_sub_field('products_title'); ?>
                </h2>
                <p class=" <?php echo $sectionTextThemeClass; ?>">
                    <?php the_sub_field('products_excerpt'); ?>
                </p>
            </div>
            <div id="<?php echo $splideId; ?>" class="row splide">
                <?php $colClass = (count(get_row('products')) == 2) ? 6 : 3; ?>
                <?php if (have_rows('products')): ?>
                    <div class="splide__track py-5">
                        <ul class="splide__list">
                            <?php while (have_rows('products')):
                                the_row(); ?>
                                <?php $product = get_sub_field('product'); ?>
                                <?php if ($product): ?>
                                    <?php foreach ($product as $post): ?>
                                        <?php setup_postdata($post); ?>
                                        <li class="bg-white splide__slide col-12 col-lg-6 col-xl-<?php echo $colClass ?> py-4 shadow">
                                            <div class="product-card-content h-100 ">
                                                <div class="p-4">
                                                    <?php $product_icon = get_field('product_icon'); ?>
                                                    <?php $size = 'full'; ?>
                                                    <?php if ($product_icon): ?>
                                                        <?php echo wp_get_attachment_image($product_icon, $size); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <h3 class="px-4 pb-4 fw-semibold">
                                                    <?php the_field('product_name'); ?>
                                                </h3>
                                                <p class="px-4 pb-4">
                                                    <?php the_field('product_excerpt'); ?>
                                                </p>
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
            focus: 'center',
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