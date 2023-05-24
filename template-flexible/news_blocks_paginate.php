<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>


<?php if (get_row_layout() == 'news_blocks_paginate'): ?>

    <section class="news-blocks py-4" <?= idTag(get_sub_field('news_blocks_paginate_title_anchor')); ?>>
        <div class="container">
            <div class="row">
                <h2 class="fw-semibold">
                    <?php the_sub_field('news_blocks_paginate_title'); ?>
                </h2>
                <p>
                    <?php the_sub_field('news_blocks_paginate_excerption'); ?>
                </p>
            </div>
            <div class="row">
                <?php
                $paged = $_GET["newspage"] ? $_GET["newspage"] : 1;
                $postPerPage = 3;
                $args = array(
                    'posts_per_page' => $postPerPage,
                    'post_type' => 'news',
                    'order' => 'DESC',
                    'paged' => $paged
                );
                $query = new WP_Query($args);
                $posts = $query->get_posts();
                if ($posts): ?>
                    <?php foreach ($posts as $post):
                        setup_postdata($post);
                        ?>
                        <div class="col-12 col-md-4">
                            <div class="content shadow h-100">
                                <div class="card-img-container">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'img-cover')); ?>
                                </div>
                                <div class="p-3 d-flex flex-column justify-content-between news-paginate-block-content">
                                    <div>
                                    <h3 class="fw-bold py-2">
                                                        <?php the_title(); ?>
                                                    </h3>
                                                    <p class="py-2"><?php 
                                                    ?>
                                                        <?php echo wp_trim_words(get_the_excerpt() , 10 , '' ) ?>
                                                    </p>
                                    </div>
                                    <div class="py-2">
                                        <a class="btn btn-primary btn-sm" title="Read more" href="<?php the_permalink(); ?>">Czytaj
                                            dalej</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="row pt-4">
                        <?php
                        $args = array(
                            'total' => $query->max_num_pages,
                            'current' => max(1, $paged),
                            'format' => '?newspage=%#%',
                            'prev_text' => __('<i style="font-size: 12px !important;" class="icon-left-arrow p-0 d-flex flex-column justify-content-center"></i>', 'text-domain'),
                            'next_text' => __('<i style="font-size: 12px !important;" class="icon-right-arrow p-0 d-flex flex-column justify-content-center"></i>', 'text-domain'),
                            'type' => 'array',
                        );
                        echo '<ul class="pagination justify-content-center gap-2 d-flex">';
                        foreach (paginate_links($args) as $link) {
                            ?>
                            <li class="page-item">
                                <?php echo str_replace('class="', 'class="h-100 page-link bg-secondary text-dark rounded rounded-3 ', $link); ?>
                            </li>
                            <?php
                        }
                        echo '</ul>';
                        ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php endif; ?>