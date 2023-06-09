<?php
/**
 * Template Name: Page SiteMap
 * Description: Page template SiteMap.
 *
 */
get_header();
?>
<section class="container pt-2 pb-2 ">
    <div class="row p-0 flex-column-reverse flex-lg-row-reverse"
        style=" margin-left: calc((100% - 100vw)/5 ); margin-right: calc((100% - 100vw)/5 );">
        <div class="col-12 bg-primary text-light d-flex flex-column justify-content-start align-items-start">
            <div class="col-12 p-1 px-md-5 py-md-4 ">
                <h1 class="py-2 text-center text-lg-start ">
                    <?php echo get_the_title(); ?>
                </h1>

            </div>
        </div>
    </div>
</section>
<section class="sitemap-page-pages py-5">
    <div class="container">
        <div class="row">
            <h2>
                Strony
            </h2>
        </div>
        <div class="row">
            <ul class="d-flex gap-2 flex-wrap p-4 primary-styled">
                <?php
                $pages = get_pages();
                foreach ($pages as $page) {
                    $page_title = $page->post_title;
                    ?>
                    <li class="m-2 col-12 col-md-4">
                        <?= $page_title; ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</section>
<section class="sitemap-page-posts">
    <div class="container">
        <?php
        $args = array(
            'public' => true,
            '_builtin' => false
        );
        $postTypes = get_post_types($args);

        foreach ($postTypes as $postType) {
            $postFullName = get_post_type_object($postType)->labels->singular_name;
            $postType = get_post_type_object($postType);
            $postTypeName = $postType->name;
            ?>
            <div class="row">
                <h2>
                    <?= $postFullName; ?>
                </h2>
                <ul class="d-flex gap-2 flex-wrap p-4 primary-styled">
                    <?php
                    $posts = get_posts(
                        array(
                            'post_type' => $postTypeName,
                        )
                    );
                    foreach ($posts as $post) {
                        ?>
                        <li class="m-2 col-12 col-md-4">
                            <?= $post->post_title; ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</section>
<section class="container py-4 tags_cloud_section">
    <div class="row py-2">
     
        <h2 class="fw-bold">
          Tagi
        </h2>
      
    </div>
    <div class="row d-flex flex-row gap-3 px-2 py-2">
      <?php
      $args = array(
        'format' => 'array',
        'order' => 'asc',
      );
      $tags = wp_tag_cloud($args);
      foreach ($tags as $tag) {
        echo $tag;
      }
      //       ?>
    </div>
  </section>

<?php
get_footer();