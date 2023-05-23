<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'news_blocks'): ?>
    <section class="news-blocks py-5">
        <div class="container">
            <div class="row">
                <h2 class="fw-semibold">
                    <?php the_sub_field('news_blocks_title'); ?>
                </h2>
                <p>
                    <?php the_sub_field('news_block_excerption'); ?>
                </p>
            </div>
            <div class="row">
                <?php
                $posts = get_posts(
                    array(
                        'post_type' => 'news',
                        'order' => 'DESC',
                    )
                );
                if ($posts): ?>
                    <section class="splide py-0">
                        <div class="splide__track">
                            <ul class="splide__list py-4">
                                <?php foreach ($posts as $post):
                                    setup_postdata($post);
                                    ?>
                                    <li class="splide__slide">
                                        <div class="content shadow h-100">
                                            <div>
                                                <?php $news_img = get_field('news_img'); ?>
                                                <?php $size = 'full'; ?>
                                                <?php if ($news_img): ?>
                                                    <?php echo wp_get_attachment_image($news_img, $size, false, array('class' => 'img-cover')); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="p-3 d-flex flex-column justify-content-between news-block-content">
                                                <div>
                                                    <h3 class="fw-bold py-2">
                                                        <?php the_field('news_title'); ?>
                                                    </h3>
                                                    <p class="py-2">
                                                        <?php the_field('news_excerption'); ?>
                                                    </p>
                                                </div>
                                                <div class="py-2">
                                                    <a class="btn btn-primary btn-sm" title="Read more"
                                                        href="<?php the_permalink(); ?>">Czytaj
                                                        dalej</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const partnerCarousel = new Splide('.news-blocks .splide', {
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