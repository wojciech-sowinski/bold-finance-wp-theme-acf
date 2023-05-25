<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'tags_cloud'): ?>
  <section class="container py-4 tags_cloud_section">
    <div class="row py-2">
      <?php
      if (get_sub_field('tags_cloud_title')) {
        ?>
        <h2 class="fw-bold">
          <?php the_sub_field('tags_cloud_title'); ?>
        </h2>
        <?php
      } ?>
      <?php
      if (get_sub_field('tags_cloud_excerpt')) {
        ?>
        <p class="pb-3">
          <?php the_sub_field('tags_cloud_excerpt'); ?>
        </p>
      <?php } ?>
    </div>
    <div class="row d-flex flex-row gap-3 px-2 py-2">
      <?php
      $postType = get_sub_field('tags_cloud_type') ? get_sub_field('tags_cloud_type') : 'post';
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
<?php endif; ?>