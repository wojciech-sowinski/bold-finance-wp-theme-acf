<?php
/**
 * Flexible template Advanced Custom Fields.
 *
 * @reference https://www.awesomeacf.com/snippets/split-acf-flexible-content-field-template-parts/
 *
 * @author Wojciech Sowiński <wojciech.sowinski@innhouse.pl>
 */
?>
<?php if (get_row_layout() == 'up_button'): ?>
  <div class="container d-none d-md-flex justify-content-end">
    <a href="#"
      class="border border-white rounded-1 d-block bg-primary d-flex justify-content-center align-items-center"
      style="width:50px;height:50px;margin-top:-25px;margin-bottom:-25px;">
      <i class="icon-arrow-up text-white fs-4"></i>
    </a>
  </div>
<?php endif; ?>