<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>


<?php if (get_row_layout() == 'q_a_acordion'): ?>
  <?php

  $accordionId = generateId();

  ?>
  <section class="py-5">
    <div class="container">
      <div class="row pb-3">
        <h2 class="fw-semibold">
          <?php the_sub_field('q_a_acordion_title'); ?>
        </h2>
        <p>
        <?php the_sub_field('q_a_acordion_excerpt'); ?>
        </p>
      </div>
      <div class="row">
        <div
          class="col-12 accordion accordion-flush mx-auto shadow border border-primary border-4 border-top-0 border-bottom-0 border-end-0"
          id="<?= $accordionId; ?>">
          <?php if (have_rows('q_a_acordion_item')): ?>
            <?php while (have_rows('q_a_acordion_item')):
              the_row(); ?>
              <div class="accordion-item  border-0">
                <h3 class="m-0 p-0 border-1 border-bottom">
                  <button class="accordion-button collapsed text-decoration-none border-0 text-dark bg-white" type="button"
                    data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#<?= $accordionId . get_row_index(); ?>">
                    <i class="icon-doc-paper fs-4 mx-3"></i>
                    <?php the_sub_field('q_a_acordion_item_quest'); ?>
                  </button>
                </h3>
                <div id="<?= $accordionId . get_row_index(); ?>" class="accordion-collapse collapse border-0"
                  data-bs-parent="#<?= $accordionId; ?>">
                  <div class="accordion-body">
                    <?php the_sub_field('q_a_acordion_item_answear'); ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>