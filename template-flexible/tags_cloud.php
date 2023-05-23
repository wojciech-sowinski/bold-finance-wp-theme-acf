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
  <section class="container py-3">
    <div class="row px-2 px-md-0 py-2">
      <h2 class="fw-bold px-0">
        <?php the_sub_field('tags_cloud_title'); ?>
      </h2>
      <p class="pb-3 px-0">
        <?php the_sub_field('tags_cloud_excerpt'); ?>
      </p>
    </div>
    <div class="row d-flex flex-row gap-3 px-2 px-md-0 py-2">
      <?php
      $postType = get_sub_field('tags_cloud_type') ? get_sub_field('tags_cloud_type') : 'post';
      $args = array(
        'number' => 0,
        'post_type' => $postType,
        'format' => 'array',
        'orderby' => 'name',
        'order' => 'ASC',
      );
      $tags = wp_tag_cloud($args);
      foreach ($tags as $tag) {
        ?>
        <?= $tag; ?>
        <?php
      }
      ?>
    </div>
  </section>
<?php endif; ?>