<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>

<?php if (get_row_layout() == 'adress_blocks'): ?>
  <section class="py-4">
    <div class="container">
      <div class="row d-flex align-items-stretch justify-content-center">
        <?php
        $countBlockRows = 0;
        if (have_rows('adress_blocks_block')):
          while (have_rows('adress_blocks_block')):
            the_row();
            $countBlockRows++;
          endwhile;
        endif;
        ?>
        <?php if (have_rows('adress_blocks_block')): ?>
          <?php while (have_rows('adress_blocks_block')):
            the_row();
            ?>
            <div class="col-12 col-md-6 col-lg-3 p-3 ">
              <div class="adress-block d-flex flex-column gap-4 shadow py-5 px-4">
                <div style="max-width:50px; max-height:50px">
                  <?php $adress_blocks_block_icon = get_sub_field('adress_blocks_block_icon'); ?>
                  <?php $size = 'full'; ?>
                  <?php if ($adress_blocks_block_icon): ?>
                    <?php echo wp_get_attachment_image($adress_blocks_block_icon, $size, false, array('class' => 'img-fluid')); ?>
                  <?php endif; ?>
                </div>
                <h3 class="fw-bold">
                  <?php the_sub_field('adress_blocks_block_title'); ?>
                </h3>
                <div class="d-flex flex-column gap-3">
                  <?php if (have_rows('adress_blocks_block_adress_line')): ?>
                    <?php while (have_rows('adress_blocks_block_adress_line')):
                      the_row(); ?>
                      <div class="d-flex gap-2">
                        <span class="d-block" style="width:14px; height:14px;">
                          <?php $adress_blocks_block_adress_line_icon = get_sub_field('adress_blocks_block_adress_line_icon'); ?>
                          <?php $size = 'full'; ?>
                          <?php if ($adress_blocks_block_adress_line_icon): ?>
                            <?php echo wp_get_attachment_image($adress_blocks_block_adress_line_icon, $size, false, array('class' => 'img-fluid')); ?>
                          <?php endif; ?>
                        </span>
                        <span class="d-block fw-semibold">
                          <?php the_sub_field('adress_blocks_block_adress_text'); ?>
                        </span>
                      </div>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>