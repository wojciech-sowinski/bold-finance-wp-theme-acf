<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'note'): ?>
  <?php

  $hideLeftCol = get_sub_field('note_text_show_column');

  ?>



  <section class="note-section bg-white px-2 py-4" <?= idTag(get_sub_field('note_text_anchor')); ?>>
    <div class="container">
      <div class="row">
        <?php
        if (!$hideLeftCol) {
          ?>
          <div class="col-12 col-lg-3 bg-primary text-light p-5 rounded-4">
            <p class="fw-semibold fs-5">
              <?php the_sub_field('note_title'); ?>
            </p>
          </div>
          <?php
        } ?>
        <div
          class="col-12 col-lg-8 flex-grow-1 note p-2 px-md-4 ms-0 ms-lg-4 mt-4 mt-lg-0 <?= !$hideLeftCol && "shadow border border-primary border-4" ?>  border-top-0 border-bottom-0 border-end-0">
          <?php the_sub_field('note_text'); ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>