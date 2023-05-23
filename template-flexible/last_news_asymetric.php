<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>

<?php if (get_row_layout() == 'last_news_asymetric'): ?>
    <section class="container px-1 px-md-0 py-3 py-md-5">
        <div class="row">
            <h2  class="fw-semibold">
                <?php the_sub_field('last_news_asymetric_title'); ?>
            </h2>
            <p>
                <?php the_sub_field('last_news_asymetric_excerpt'); ?>
            </p>
        </div>
        <div class="row">
            <?php
            $posts = get_posts(
                array(
                    'post_type' => 'news',
                    'order' => 'DESC',
                    'numberposts' => '2'
                )
            );
            if ($posts) {
                foreach ($posts as $index => $post) {
                    setup_postdata($post);
                    if ($index == 0) {
                        ?>
                        <div class="col-12  col-xl-8 p-0 m-0 p-4 ">
                            <div class=" row shadow asymetric-news-col">
                                <div class="col-12 col-md-6 p-0 ">
                                    <?php $news_img = get_field('news_img'); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ($news_img): ?>
                                        <?php echo wp_get_attachment_image($news_img, $size, false, array('class' => 'img-cover')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-md-6 px-3 py-5 d-flex flex-column justify-content-between">
                                    <div>
                                        <h3 class=" fw-semibold">
                                            <?php the_field('news_title'); ?>
                                        </h3>
                                        <p class="py-3">
                                            <?php the_field('news_excerption'); ?>
                                        </p>
                                    </div>
                                    <div>
                                        <a href="<?= get_permalink() ?>" class="btn btn-primary">Czytaj dalej</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="col-12  col-xl-4 p-4 ">
                            <div class="row shadow pb-5 asymetric-news-col">
                                <div class="p-0 pb-5">
                                    <?php $news_img = get_field('news_img'); ?>
                                    <?php $size = 'full'; ?>
                                    <?php if ($news_img): ?>
                                        <?php echo wp_get_attachment_image($news_img, $size, false, array('class' => 'img-cover')); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <h3 class="px-3 fw-semibold">
                                            <?php the_field('news_title'); ?>
                                        </h3>
                                        <p class="py-3 px-3">
                                            <?php the_field('news_excerption'); ?>
                                        </p>
                                    </div>
                                    <div class="pt-3 px-3">
                                        <a href="<?= get_permalink() ?>" class="btn btn-primary">Czytaj dalej</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
            }
            ?>
        </div>
    </section>
<?php endif; 
wp_reset_postdata();
?>